<style>
    .image-index-box {
        background: #fff;
        border: 1px solid #e3e7eb;
        border-radius: 10px;
        padding: 25px;
        max-width: 850px;
        margin: 30px auto;
    }

    .index-stats {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .index-stat {
        flex: 1;
        min-width: 140px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        text-align: center;
    }

    .index-stat strong {
        display: block;
        font-size: 25px;
    }

    .index-progress {
        height: 30px;
        background: #eee;
        border-radius: 7px;
        overflow: hidden;
        margin-bottom: 20px;
    }

    #indexProgressBar {
        height: 100%;
        width: 0%;
        background: #53d1b2;
        transition: width .3s;
        text-align: center;
        line-height: 30px;
        font-weight: bold;
    }

    #indexLog {
        height: 250px;
        overflow-y: auto;
        background: #111;
        color: #eee;
        padding: 15px;
        border-radius: 6px;
        font-family: monospace;
        font-size: 13px;
    }

    .index-buttons {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }
</style>


<div class="image-index-box">

    <h3>
        <i class="fa fa-image"></i>
        Indeksimi i Fotove
    </h3>

    <p>
        Gemini Embedding + Qdrant
    </p>

    <hr>


    <div class="index-stats">

        <div class="index-stat">
            <span>Gjithsej</span>
            <strong id="statTotal">0</strong>
        </div>

        <div class="index-stat">
            <span>Indeksuar</span>
            <strong id="statIndexed">0</strong>
        </div>

        <div class="index-stat">
            <span>Mbetur</span>
            <strong id="statRemaining">0</strong>
        </div>

        <div class="index-stat">
            <span>Gabime</span>
            <strong id="statFailed">0</strong>
        </div>

    </div>


    <div class="index-progress">

        <div id="indexProgressBar">
            0%
        </div>

    </div>


    <div class="index-buttons">

        <button
            type="button"
            id="startIndexing"
            class="btn btn-success">

            <i class="fa fa-play"></i>
            Fillo indeksimin

        </button>


        <button
            type="button"
            id="stopIndexing"
            class="btn btn-danger"
            disabled>

            <i class="fa fa-stop"></i>
            Ndalo

        </button>


        <button
            type="button"
            id="retryFailed"
            class="btn btn-warning">

            <i class="fa fa-refresh"></i>
            Provo gabimet përsëri

        </button>

    </div>


    <div id="indexLog"></div>

</div>


<script>
    (function() {

        let running = false;

        const baseUrl =
            <?php echo json_encode(base_url()); ?>;


        function log(message) {

            const logBox =
                document.getElementById('indexLog');

            const time =
                new Date().toLocaleTimeString();

            logBox.insertAdjacentHTML(
                'beforeend',
                `<div>[${time}] ${message}</div>`
            );

            logBox.scrollTop =
                logBox.scrollHeight;
        }


        async function getStatus() {

            try {

                const response =
                    await fetch(
                        baseUrl +
                        'admin/products/image_index_status'
                    );

                const data =
                    await response.json();

                if (!data.status) {
                    return;
                }


                document.getElementById(
                        'statTotal'
                    ).innerText =
                    data.total;


                document.getElementById(
                        'statIndexed'
                    ).innerText =
                    data.indexed;


                document.getElementById(
                        'statRemaining'
                    ).innerText =
                    data.remaining;


                document.getElementById(
                        'statFailed'
                    ).innerText =
                    data.failed;


                const percentage =
                    parseFloat(
                        data.percentage || 0
                    );


                const bar =
                    document.getElementById(
                        'indexProgressBar'
                    );

                bar.style.width =
                    percentage + '%';

                bar.innerText =
                    percentage + '%';


                return data;

            } catch (error) {

                log(
                    'Gabim statusi: ' +
                    error.message
                );

            }

        }


        async function runBatch() {

            if (!running) {
                return;
            }

            try {

                const formData =
                    new FormData();

                formData.append(
                    'batch_size',
                    '5'
                );


                const response =
                    await fetch(
                        baseUrl +
                        'admin/products/index_product_batch', {
                            method: 'POST',
                            body: formData
                        }
                    );


                const data =
                    await response.json();


                if (
                    data.retryable === true
                ) {

                    log(
                        'API përkohësisht i zënë. ' +
                        'Procesi u ndal.'
                    );

                    stop();

                    return;
                }


                if (!data.status) {

                    log(
                        'Gabim: ' +
                        (
                            data.message ||
                            'Gabim i panjohur'
                        )
                    );

                    stop();

                    return;
                }


                if (
                    Array.isArray(data.results)
                ) {

                    data.results.forEach(
                        function(item) {

                            if (item.status) {

                                log(
                                    '✓ ' +
                                    item.code +
                                    ' - ' +
                                    item.name
                                );

                            } else {

                                log(
                                    '✗ ' +
                                    item.code +
                                    ' - ' +
                                    item.message
                                );

                            }

                        }
                    );

                }


                await getStatus();


                if (data.finished) {

                    log(
                        'INDESKIMI PERFUNDOI.'
                    );

                    stop();

                    return;
                }


                if (running) {

                    setTimeout(
                        runBatch,
                        300
                    );

                }

            } catch (error) {

                log(
                    'Gabim: ' +
                    error.message
                );

                stop();

            }

        }


        function start() {

            if (running) {
                return;
            }

            running = true;


            document.getElementById(
                'startIndexing'
            ).disabled = true;


            document.getElementById(
                'stopIndexing'
            ).disabled = false;


            log(
                'Indeksimi filloi...'
            );


            runBatch();
        }


        function stop() {

            running = false;


            document.getElementById(
                'startIndexing'
            ).disabled = false;


            document.getElementById(
                'stopIndexing'
            ).disabled = true;


            log(
                'Indeksimi u ndal.'
            );
        }


        document.getElementById(
            'startIndexing'
        ).addEventListener(
            'click',
            start
        );


        document.getElementById(
            'stopIndexing'
        ).addEventListener(
            'click',
            stop
        );


        document.getElementById(
            'retryFailed'
        ).addEventListener(
            'click',
            async function() {

                if (running) {
                    return;
                }

                try {

                    const response =
                        await fetch(
                            baseUrl +
                            'admin/products/retry_failed_image_index', {
                                method: 'POST'
                            }
                        );

                    const data =
                        await response.json();


                    if (data.status) {

                        log(
                            data.affected_rows +
                            ' produkte u kthyen për retry.'
                        );

                        await getStatus();

                    }

                } catch (error) {

                    log(
                        'Gabim: ' +
                        error.message
                    );

                }

            }
        );


        getStatus();

    })();
</script>