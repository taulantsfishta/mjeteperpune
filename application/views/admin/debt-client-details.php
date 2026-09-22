<style>
    .debt-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .debt-total {
        text-align: right;
    }

    .debt-total h2 {
        margin: 0;
        color: #d9534f;
    }

    .pagination-area {
        text-align: center;
        margin-top: 15px;
    }

    .pagination-area .page-info {
        display: inline-block;
        margin: 0 15px;
        font-weight: 600;
    }

    #transactionsContainer.loading {
        opacity: 0.5;
        pointer-events: none;
    }

    @media (max-width: 767px) {
        .debt-total {
            text-align: left;
            margin-top: 10px;
        }
    }
</style>

<button
    type="button"
    class="btn btn-default"
    onclick="history.back();">
    <i class="fa fa-arrow-left"></i>
    Kthehu te klientët
</button>
<br>
<br>


<!-- KLIENTI / DETYRIMI TOTAL -->

<div class="row">

    <div class="col-md-12">

        <div class="white-box">

            <div class="debt-header">

                <div>

                    <h2 style="margin:0;">

                        <?php echo htmlspecialchars(
                            $client['name'],
                            ENT_QUOTES,
                            'UTF-8'
                        ); ?>

                    </h2>


                    <?php if (!empty($client['address'])): ?>

                        <div style="margin-top:5px;">

                            <i class="fa fa-map-marker"></i>

                            <?php echo htmlspecialchars(
                                $client['address'],
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>

                        </div>

                    <?php endif; ?>


                    <?php if (!empty($client['phone'])): ?>

                        <div style="margin-top:5px;">

                            <i class="fa fa-phone"></i>

                            <?php echo htmlspecialchars(
                                $client['phone'],
                                ENT_QUOTES,
                                'UTF-8'
                            ); ?>

                        </div>

                    <?php endif; ?>

                </div>


                <div class="debt-total">

                    <small>
                        DETYRIMI AKTUAL
                    </small>

                    <h2>

                        <?php echo number_format(
                            (float)$total_debt,
                            2,
                            '.',
                            ','
                        ); ?> €

                    </h2>

                </div>

            </div>

        </div>

    </div>

</div>


<br>


<div class="row">


    <!-- SHTO TRANSAKSION -->

    <div class="col-md-4">

        <div class="white-box">

            <h4>
                Transaksion i ri
            </h4>


            <form
                method="post"
                action="<?php echo base_url(
                            'admin/invoices/add_debt_transaction/' .
                                $client['id']
                        ); ?>">


                <div class="form-group">

                    <label>
                        Veprimi
                    </label>

                    <select
                        name="type"
                        class="form-control"
                        required>

                        <option value="debt">
                            Shto detyrimin
                        </option>

                        <option value="payment">
                            Zbrit detyrimin / Pagesë
                        </option>

                    </select>

                </div>


                <div class="form-group">

                    <label>
                        Shuma
                    </label>

                    <input
                        type="number"
                        name="amount"
                        step="0.01"
                        min="0.01"
                        class="form-control"
                        required>

                </div>


                <div class="form-group">

                    <label>
                        Përshkrimi
                    </label>

                    <textarea
                        name="description"
                        class="form-control"
                        rows="3"></textarea>

                </div>


                <button
                    type="submit"
                    class="btn btn-success btn-block">

                    <i class="fa fa-save"></i>

                    Ruaj

                </button>

            </form>

        </div>

    </div>



    <!-- HISTORIA -->

    <div class="col-md-8">

        <div class="white-box">

            <div
                style="
                    display:flex;
                    justify-content:space-between;
                    align-items:center;
                    flex-wrap:wrap;
                    gap:10px;
                    margin-bottom:15px;
                ">

                <h4 style="margin:0;">
                    Historia e transaksioneve
                </h4>


                <!-- PRINTO -->

                <form
                    method="post"
                    action="<?php echo base_url(
                                'admin/invoices/print_debt'
                            ); ?>"
                    target="_blank"
                    style="margin:0;">

                    <input
                        type="hidden"
                        name="client_id"
                        value="<?php echo $client['id']; ?>">

                    <button
                        type="submit"
                        class="btn btn-primary btn-sm">

                        <i class="fa fa-print"></i>

                        PRINTO HISTORINË

                    </button>

                </form>

            </div>


            <!--
                KËTU NGARKOHET TABELA.
                AJAX ndryshon vetëm këtë DIV.
            -->

            <div id="transactionsContainer">

                <?php
                $this->load->view(
                    'admin/debt-transactions-table',
                    [
                        'transactions'       => $transactions,
                        'page'               => 1,
                        'per_page'           => $per_page,
                        'total_transactions' => $total_transactions
                    ]
                );
                ?>

            </div>

        </div>

    </div>

</div>


<script>
    $(document).ready(function() {


        /*
         * AJAX PAGINATION
         *
         * Kapim klikimin e butonave Para / Tjetra.
         */
        $(document).on(
            'click',
            '.debt-page-btn',
            function() {

                var page = $(this).data('page');


                /*
                 * Mos bëj request nëse butoni
                 * është disabled.
                 */
                if ($(this).prop('disabled')) {
                    return;
                }


                if (!page || page < 1) {
                    return;
                }


                $('#transactionsContainer')
                    .addClass('loading');


                $.ajax({

                    url: '<?php echo base_url(
                                "admin/invoices/debt_transactions_ajax/" .
                                    $client["id"]
                            ); ?>',

                    type: 'GET',

                    data: {
                        page: page
                    },


                    success: function(response) {

                        $('#transactionsContainer')
                            .html(response)
                            .removeClass('loading');

                    },


                    error: function() {

                        $('#transactionsContainer')
                            .removeClass('loading');

                        alert(
                            'Ndodhi një gabim gjatë ngarkimit të transaksioneve.'
                        );

                    }

                });

            }
        );


    });
</script>