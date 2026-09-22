<style>
    :root {
        --border: #e4e7ea;
        --warn: #ffcfcf;
        --radius: 12px;
        --shadow: 0 6px 20px rgba(0, 0, 0, .06);

        /* MAIN table column widths */
        --w-nr: 50px;
        /* main table NR */
        --w-name: 45%;
        --w-code: 8%;
        --w-qty: 12%;
        --w-price: 12%;
        --w-total: 12%;
    }

    /* Main layout */
    #mainDiv {
        width: 100%;
        max-width: none;
        margin: 0;
        padding: 10px 15px;
        background: #fff;
        font-family: Arial, Helvetica, sans-serif;
        font-size: 15px;
    }

    /* Top form */
    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
        gap: 20px;
        align-items: end;
    }

    .form-grid label {
        font-weight: 600;
        color: #4b5563;
        font-size: 14px;
    }

    .form-grid input {
        width: 100%;
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 10px;
        font-size: 15px;
        outline: none;
    }

    /* Two-column content area */
    .content-grid {
        display: grid;
        grid-template-columns: minmax(0, 3fr) minmax(280px, 1fr);
        gap: 15px;
    }

    /* Tables */
    .table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
    }

    .table th,
    .table td {
        border: 1px solid var(--border);
        padding: 8px;
        font-size: 15px;
        text-align: left;
        vertical-align: middle;
    }

    .table th {
        background: #f5f7fb;
        font-weight: 700;
    }

    .table input {
        width: 100%;
        border: none;
        border-bottom: 1px solid var(--border);
        outline: none;
        font-size: 15px;
        padding: 5px;
    }

    /* MAIN table widths ONLY (do NOT target #search_results_table here) */
    #sales_table thead th:nth-child(1),
    #sales_table tbody td:nth-child(1) {
        width: var(--w-nr);
        text-align: center;
    }

    #sales_table thead th:nth-child(2),
    #sales_table tbody td:nth-child(2) {
        width: var(--w-code);
    }

    #sales_table thead th:nth-child(3),
    #sales_table tbody td:nth-child(3) {
        width: var(--w-name);
    }

    #sales_table thead th:nth-child(4),
    #sales_table tbody td:nth-child(4) {
        width: var(--w-qty);
    }

    #sales_table thead th:nth-child(5),
    #sales_table tbody td:nth-child(5) {
        width: var(--w-price);
    }

    #sales_table thead th:nth-child(6),
    #sales_table tbody td:nth-child(6) {
        width: var(--w-total);
    }

    /* Search results: NR centered (width is enforced by <colgroup>) */
    #search_results_table thead th:first-child,
    #search_results_table tbody td:first-child {
        text-align: center;
        padding: 4px 6px;
    }

    /* Wrappers */
    .table-wrap {
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: auto;
        box-shadow: var(--shadow);
        background: #fff;
    }

    /* Search results directly under the main table */
    #search_results_container {
        margin-top: 12px;
    }

    #search_results_table {
        width: 100%;
        border-collapse: collapse;
        table-layout: fixed;
        /* honors colgroup widths */
        border: 1px solid var(--border);
        border-radius: var(--radius);
        overflow: hidden;
        background: #fff;
        display: none;
        /* shown by JS when results exist */
    }

    /* Totals card */
    .totals-card {
        border: 1px solid var(--border);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        background: #fff;
        padding: 16px;
    }

    .totals-line {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 12px;
        margin-bottom: 12px;
    }

    .totals-card input {
        border: 1px solid var(--border);
        border-radius: 8px;
        padding: 8px;
        font-weight: bold;
        font-size: 16px;
    }

    /* Buttons */
    .btn {
        border: none;
        border-radius: 8px;
        padding: 10px 16px;
        font-weight: bold;
        color: #fff;
    }

    #saveBtn {
        background: #ff5733;
    }

    #printBtn {
        background: #7396CE;
    }

    #downloadBtn {
        background: green;
    }

    #delete_row {
        background: #ff5e2d;
    }

    .input-error {
        border: 1px solid red !important;
        background: #ffecec;
    }

    .price-zero-row td,
    .price-zero-row input {
        background: var(--warn) !important;
    }

    .selected-row {
        background: #d1e7dd !important;
    }

    .modal-backdrop {
        display: none !important;
    }

    /* Preferred: stop stretching all items in the grid row */
    .content-grid {
        align-items: start;
        /* prevents the right column from matching left column height */
    }

    /* Extra safety: explicitly keep the totals card at its intrinsic height */
    .totals-card {
        align-self: start;
    }

    /* --- Responsive behavior for totals-card --- */
    @media (max-width: 1024px) {
        .content-grid {
            grid-template-columns: 1fr;
            /* stack vertically */
        }

        .totals-card {
            margin-top: 20px;
            /* spacing from table */
            order: 2;
            /* ensures it stays after the table */
            width: 100%;
        }

        .table-col {
            order: 1;
        }
    }


    /* Full-width invoice workspace */
    #mainDiv>.col-lg-12 {
        width: 100%;
        padding: 0;
    }

    #mainDiv .white-box {
        width: 100%;
        padding: 15px;
    }

    .table-col {
        min-width: 0;
    }

    .totals-card {
        min-width: 0;
        height: auto;
        align-self: start;
    }

    .totals-line {
        grid-template-columns: minmax(0, 1fr) minmax(0, 1fr);
        align-items: center;
        gap: 10px;
    }

    .totals-line label {
        font-size: 13px;
        margin: 0;
    }

    .totals-line input {
        width: 100%;
        min-width: 0;
        height: 40px;
        text-align: right;
        box-sizing: border-box;
    }

    .invoice-actions {
        display: flex;
        flex-direction: column;
        gap: 10px;
        margin-top: 15px;
        padding-top: 15px;
        border-top: 1px solid var(--border);
    }

    .invoice-actions .btn {
        display: block;
        width: 100%;
        min-height: 43px;
        padding: 10px;
        font-size: 14px;
        text-align: center;
        white-space: normal;
    }

    #debtBtn {
        background: #d9534f;
        color: #fff;
    }

    @media (max-width: 1024px) {
        .form-grid {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 600px) {
        .form-grid {
            grid-template-columns: 1fr;
        }

        #mainDiv {
            padding: 8px;
        }
    }

    .debt-client-suggestions {
        position: absolute;
        z-index: 9999;
        background: #fff;
        border: 1px solid #ddd;
        max-height: 240px;
        overflow-y: auto;
        min-width: 320px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, .15)
    }

    .debt-client-suggestion {
        padding: 9px 12px;
        cursor: pointer;
        border-bottom: 1px solid #eee
    }

    .debt-client-suggestion:hover,
    .debt-client-suggestion.active {
        background: #dbeafe;
        color: #111827
    }

    .debt-client-suggestion small {
        display: block;
        color: #777;
        margin-top: 2px
    }

    /* Fixed invoice workspace: selected products above search results. */
    #mainDiv {
        height: calc(100dvh - 115px);
        min-height: 540px;
        overflow: hidden;
    }

    #mainDiv>.col-lg-12,
    #mainDiv .white-box,
    #sales_form {
        height: 100%;
        min-height: 0;
    }

    #mainDiv .white-box {
        overflow: hidden;
    }

    #sales_form {
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    #sales_form>.form-grid {
        flex: 0 0 auto;
    }

    #sales_form>br {
        display: none;
    }

    #sales_form>.content-grid {
        flex: 1 1 auto;
        min-height: 0;
        margin-top: 12px;
    }

    .content-grid {
        align-items: stretch !important;
    }

    .table-col {
        display: flex !important;
        flex-direction: column;
        min-height: 0;
        overflow: hidden;
        gap: 10px;
    }

    #search_results_container {
        order: 1;
        flex: 0 0 auto;
        min-height: 0;
        max-height: 48%;
        overflow: auto;
        margin-top: 0;
        overscroll-behavior: contain;
    }

    #search_results_container.results-expanded {
        flex: 0 0 48%;
    }

    #search_results_table {
        margin-bottom: 0;
    }

    #search_results_table thead th,
    #sales_table thead th {
        position: sticky;
        top: 0;
        z-index: 2;
        background: #f5f7fb;
    }

    .table-col>.table-wrap {
        order: 0;
        flex: 1 1 auto;
        min-height: 0;
        overflow: auto;
        overscroll-behavior: contain;
    }

    .totals-card {
        align-self: start;
        max-height: 100%;
        overflow-y: auto;
    }

    #sales_form>.row {
        flex: 0 0 auto;
        margin-top: 10px;
    }

    #comment {
        height: 55px !important;
        resize: vertical;
    }

    @media (max-width: 1024px) {
        #mainDiv {
            height: auto;
            min-height: 0;
            overflow: visible;
        }

        #mainDiv>.col-lg-12,
        #mainDiv .white-box,
        #sales_form {
            height: auto;
            overflow: visible;
        }

        #sales_form>.content-grid {
            min-height: 520px;
        }

        .table-col {
            height: 520px;
        }

        #search_results_container {
            max-height: 220px;
        }

        #search_results_container.results-expanded {
            flex-basis: 220px;
        }
    }

    /* Me shume hapesire per rezultatet, pa ndryshuar renditjen e tabelave. */
    .table-col>.table-wrap {
        flex: 1 1 auto !important;
        min-height: 80px !important;
        max-height: none !important;
        overflow-y: auto !important;
    }

    #search_results_container {
        flex: 0 0 0 !important;
        height: 0 !important;
        min-height: 0 !important;
        max-height: 0 !important;
        overflow: hidden !important;
        margin-top: 0 !important;
    }

    #search_results_container.results-expanded {
        flex: 0 0 70% !important;
        height: 70% !important;
        min-height: 0 !important;
        max-height: 70% !important;
        overflow-y: auto !important;
        overflow-x: hidden !important;
        margin-top: 10px !important;
    }

    #search_results_table thead th {
        position: sticky;
        top: 0;
        z-index: 10;
        background: #f5f7fb;
    }


    /* Tabelat kompakte: produktet e faturës dhe rezultatet e kërkimit */
    #sales_table th,
    #sales_table td,
    #search_results_table th,
    #search_results_table td {
        font-size: 12px !important;
        padding: 3px 5px !important;
        line-height: 1.2 !important;
        vertical-align: middle !important;
    }

    /* Fushat brenda rreshtave të faturës */
    #sales_table tbody input {
        font-size: 12px !important;
        height: 24px !important;
        min-height: 24px !important;
        padding: 2px 4px !important;
        line-height: 18px !important;
        box-sizing: border-box;
    }

    /* Rreshtat e rezultateve të kërkimit */
    #search_results_table tbody tr {
        height: 27px;
    }

    /* Titujt e kolonave */
    #sales_table thead th,
    #search_results_table thead th {
        font-size: 12px !important;
        padding: 5px !important;
    }
</style>

<div class="row" id="mainDiv">
    <div class="col-lg-12">
        <div class="white-box">
            <form id="sales_form" method="post" action="<?php echo base_url('admin/invoices/sheet_invoice/'); ?>" target="_blank" enctype="multipart/form-data">

                <!-- Top inputs -->
                <div class="form-grid">
                    <div>
                        <label for="client_name">Emri I Klientit:</label>
                        <input type="text" id="client_name" name="client_name" value="QYTETAR" required>
                        <input type="hidden" id="debt_client_id" name="debt_client_id" value="">
                        <div id="debtClientSuggestions" class="debt-client-suggestions" style="display:none;"></div>
                    </div>
                    <div>
                        <label for="address">Adresa:</label>
                        <input type="text" id="address" name="address" value="KOSOVE" required>
                    </div>
                    <div>
                        <label for="phone_number">Numri I Telefonit:</label>
                        <input type="text" id="phone_number" name="phone" value="">
                    </div>
                    <div>
                        <label for="date">Data:</label>
                        <input type="date" id="date" name="date" value="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>

                <br>

                <!-- Main content -->
                <div class="content-grid">
                    <!-- LEFT: selected products above search results -->
                    <div class="table-col">
                        <div class="table-wrap">
                            <table id="sales_table" class="table table-bordered">
                                <colgroup>
                                    <!-- NR fixed at ~34px -->
                                    <col style="width:38px">
                                    <!-- Keep other columns aligned; last column soaks the remaining space so NR never expands -->
                                    <col style="width:5%">
                                    <col style="width:50%">
                                    <col style="width:5%">
                                    <col style="width:calc(100% - 38px - 50% - 5% - 5%)">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>NR</th>
                                        <th>KODI</th>
                                        <th>EMRI I PRODUKTIT</th>
                                        <th>SASIA</th>
                                        <th>ÇMIMI</th>
                                        <th>TOTALI</th>
                                    </tr>
                                </thead>
                                <tbody id="product_rows">

                                    <?php if (!empty($cart_products)) : ?>

                                        <?php foreach ($cart_products as $index => $item) : ?>

                                            <tr>

                                                <td>
                                                    <?php echo $index + 1; ?>
                                                </td>


                                                <td>

                                                    <input class="code"
                                                        name="code[]"
                                                        readonly
                                                        value="<?php echo htmlspecialchars(
                                                                    $item['code'],
                                                                    ENT_QUOTES,
                                                                    'UTF-8'
                                                                ); ?>">

                                                </td>


                                                <td>

                                                    <input type="text"
                                                        class="product_name"
                                                        name="product_name[]"
                                                        autocomplete="off"
                                                        value="<?php echo htmlspecialchars(
                                                                    $item['name'],
                                                                    ENT_QUOTES,
                                                                    'UTF-8'
                                                                ); ?>">

                                                </td>


                                                <td>

                                                    <input type="text"
                                                        class="quantity"
                                                        name="quantity[]"
                                                        autocomplete="off"
                                                        value="<?php echo htmlspecialchars(
                                                                    $item['quantity'],
                                                                    ENT_QUOTES,
                                                                    'UTF-8'
                                                                ); ?>">

                                                </td>


                                                <td>

                                                    <input type="text"
                                                        class="price"
                                                        name="price[]"
                                                        autocomplete="off"
                                                        value="<?php echo number_format(
                                                                    (float)$item['price'],
                                                                    2,
                                                                    '.',
                                                                    ''
                                                                ); ?>">

                                                </td>


                                                <td>

                                                    <input class="total_product_price"
                                                        name="total_product_price[]"
                                                        readonly
                                                        value="<?php echo number_format(
                                                                    (float)$item['total'],
                                                                    2,
                                                                    '.',
                                                                    ''
                                                                ); ?>">

                                                </td>


                                                <td hidden>

                                                    <input type="text"
                                                        class="image"
                                                        name="image[]"
                                                        hidden
                                                        value="<?php echo htmlspecialchars(
                                                                    $item['image'],
                                                                    ENT_QUOTES,
                                                                    'UTF-8'
                                                                ); ?>">

                                                </td>

                                            </tr>

                                        <?php endforeach; ?>


                                    <?php else : ?>


                                        <tr>

                                            <td>1</td>

                                            <td>
                                                <input class="code"
                                                    name="code[]"
                                                    readonly>
                                            </td>

                                            <td>
                                                <input type="text"
                                                    class="product_name"
                                                    name="product_name[]"
                                                    autocomplete="off">
                                            </td>

                                            <td>
                                                <input type="text"
                                                    class="quantity"
                                                    name="quantity[]"
                                                    autocomplete="off">
                                            </td>

                                            <td>
                                                <input type="text"
                                                    class="price"
                                                    name="price[]"
                                                    autocomplete="off">
                                            </td>

                                            <td>
                                                <input class="total_product_price"
                                                    name="total_product_price[]"
                                                    readonly>
                                            </td>

                                            <td hidden>
                                                <input type="text"
                                                    class="image"
                                                    name="image[]"
                                                    hidden>
                                            </td>

                                        </tr>


                                    <?php endif; ?>

                                </tbody>
                            </table>
                        </div>

                        <div id="search_results_container">
                            <table id="search_results_table" class="table table-bordered">
                                <!-- Force a smaller NR only for the search table -->
                                <colgroup>
                                    <!-- NR fixed at ~34px -->
                                    <col style="width:38px">
                                    <!-- Keep other columns aligned; last column soaks the remaining space so NR never expands -->
                                    <col style="width:10%">
                                    <col style="width:50%">
                                    <col style="width:10%">
                                    <col style="width:calc(100% - 38px - 50% - 10% - 10%)">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>NR</th>
                                        <th>KODI</th>
                                        <th>EMRI I PRODUKTIT</th>
                                        <th>SASIA</th>
                                        <th>ÇMIMI</th>
                                    </tr>
                                </thead>
                                <tbody id="search_results_body"></tbody>
                            </table>
                        </div>

                    </div>

                    <!-- RIGHT: totals -->
                    <div class="totals-card">
                        <div class="totals-line">
                            <label><strong>TOTALI I FATURES</strong></label>
                            <input type="text" id="total_price_invoice" name="total_price_invoice" readonly>
                        </div>
                        <div class="totals-line">
                            <label><strong>PARAPAGESË</strong></label>
                            <input type="text" id="prepayment_price_invoice" name="prepayment_price_invoice">
                        </div>
                        <div class="totals-line">
                            <label><strong>SHUMA E MBETUR</strong></label>
                            <input type="text" id="total_price_left_invoice" name="total_price_left_invoice" readonly>
                        </div>
                        <!-- Veprimet e faturës, poshtë shumës së mbetur -->
                        <div class="invoice-actions">
                            <button type="submit" id="saveBtn" class="btn" name="submit_type" value="ruaj_faturen"><i class="fa fa-save"></i> RUAJ</button>
                            <button type="submit" id="printBtn" class="btn" name="submit_type" value="printo_faturen"><i class="fa fa-edit"></i> PRINTO FATUREN</button>
                            <button type="submit" id="downloadBtn" class="btn" name="submit_type" value="printo_faturen_excel"><i class="fa fa-edit"></i> PRINTO EXCEL</button>
                            <button type="button" id="debtBtn" class="btn"><i class="fa fa-money"></i> DETYRIM NGA KLIENTI</button>
                            <button type="button" id="delete_row" class="btn" style="display:none;"><i class="fa fa-trash"></i> FSHIJ RRESHTAT</button>
                        </div>
                    </div>
                </div>

                <br>

                <!-- Comment -->
                <div class="row">
                    <div class="col-lg-12">
                        <textarea name="comment" id="comment" style="width:100%;height:90px;font-size:16px;" placeholder="Koment"></textarea>
                    </div>
                </div>

                <br>

            </form>
        </div>
    </div>
</div>



<!-- Konfirmimi i detyrimit -->
<div class="modal" id="confirmDebtModal" tabindex="-1" role="dialog" aria-labelledby="confirmDebtModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDebtModalLabel">Konfirmo detyrimin</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="confirmDebtModalMessage">A dëshironi ta regjistroni ose përditësoni shumën e mbetur si detyrim?</div>
            <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Jo</button>
                <button type="button" class="btn btn-danger" id="confirmDebtAction">Po, konfirmo</button>
            </div>
        </div>
    </div>
</div>
<!-- Njoftimet e detyrimit -->
<div class="modal" id="debtNotificationModal" tabindex="-1" role="dialog" aria-labelledby="debtNotificationModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="debtNotificationModalLabel">Njoftim</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body" id="debtNotificationMessage"></div>
            <div class="modal-footer"><button type="button" class="btn btn-primary" data-bs-dismiss="modal">Në rregull</button></div>
        </div>
    </div>
</div>
<script>
    function showDebtNotification(message, title) {
        $('#debtNotificationModalLabel').text(title || 'Njoftim');
        $('#debtNotificationMessage').text(message);
        $('#debtNotificationModal').modal('show');
    }
</script>

<!-- Image preview modal (required by the hover on NR) -->
<div class="modal" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius:12px;">
            <div class="modal-header d-flex justify-content-between align-items-center" style="border-bottom:1px solid #e4e7ea;">
                <h4 class="modal-title" id="productName" style="margin:0;"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="productImage" src="" alt="Product Image" style="display:block;margin:0 auto;width:270px;height:220px;object-fit:contain;">
            </div>
        </div>
    </div>
</div>

<!-- Validation / errors modal (your JS already uses #noRowAdded) -->
<div class="modal" id="noRowAdded" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius:12px;">
            <div class="modal-header d-flex justify-content-between align-items-center" style="border-bottom:1px solid #e4e7ea;">
                <h4 class="modal-title" id="myModalLabel" style="margin:0;">Vërejtje</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="noRowAddedMessage" style="color:black;font-size:15px;">
                <div></div>
            </div>
        </div>
    </div>
</div>



<script>
    window.base_url = <?php echo json_encode(base_url()); ?>;
    $(document).ready(function() {
        var rowIdx = $('#product_rows tr').length;
        var lastClickedRow = null;
        var prepayment;
        var totalSum;

        updateRowNumbers();

        updateTotalSum(true);

        $(document).on('blur', '.product_name, .quantity, .price', function() {
            const row = $(this).closest('tr');
            validateRowFields(row);
        });

        $('.product_name').first().focus(); //fokusohet tek emri i produktit

        // Function to add a new row to the main table (#sales_table)
        function addRow() {
            if ($('.product_name').last().val() !== '') {
                rowIdx++;
                $('#product_rows').append(`
                    <tr>
                        <td class="table-col-7">${rowIdx}</td>
                        <td class="table-col-12"><input class="code" name="code[]" readonly></td>
                        <td class="table-col-33"><input type="text" class="product_name" name="product_name[]" autocomplete="off"></td>
                        <td class="table-col-12"><input type="text" class="quantity" name="quantity[]" autocomplete="off"></td>
                        <td class="table-col-12"><input type="text" class="price" name="price[]" autocomplete="off"></td>
                        <td class="table-col-12"><input class="total_product_price" name="total_product_price[]" readonly></td>
                        <td style="display:none;"><input class="image" name="image[]" hidden></td>
                    </tr>
                `);
                const invoiceScroll = document.querySelector('.table-col > .table-wrap');
                if (invoiceScroll) invoiceScroll.scrollTop = invoiceScroll.scrollHeight;
                $('#product_rows').find('.product_name').last()[0].focus({
                    preventScroll: true
                });
                updateRowNumbers(); // Update row numbers
                updateTotalSum(true); // Update total sum
                // Rifresko shumën e mbetur nëse parapagesa ekziston
                const prepaymentVal = $('#prepayment_price_invoice').val().trim();
                const prepayment = prepaymentVal === "" ? 0 : parseFloat(prepaymentVal);

                if (!isNaN(prepayment) && prepayment > 0) {
                    if (prepayment > totalSum) {
                        $('#prepayment_price_invoice').val('');
                        $('#total_price_left_invoice').val('');
                    } else {
                        const remaining = totalSum - prepayment;
                        $('#total_price_left_invoice').val(remaining.toFixed(2));
                    }
                }

            }
        }

        // Function to calculate total product price
        function calculateTotalPrice(row) {
            var quantity = parseFloat(row.find('.quantity').val()) || 0;
            var price = parseFloat(row.find('.price').val()) || 0;
            var total = quantity * price;

            // If quantity or price is zero, ensure total is zero
            if (quantity === 0 || price === 0) {
                total = 0;
            }

            row.find('.total_product_price').val(total.toFixed(2)); // Update total product price
            let totalSum = updateTotalSum(true); // mos e fshi parapagesën

            // Rifresko shumën e mbetur nëse parapagesa ekziston
            const prepaymentVal = $('#prepayment_price_invoice').val().trim();
            const prepayment = prepaymentVal === "" ? 0 : parseFloat(prepaymentVal);

            if (!isNaN(prepayment) && prepayment > 0) {
                if (prepayment > totalSum) {
                    $('#prepayment_price_invoice').val('');
                    $('#total_price_left_invoice').val('');
                } else {
                    const remaining = totalSum - prepayment;
                    $('#total_price_left_invoice').val(remaining.toFixed(2));
                }
            }

            if (price === 0 || price < 0) {
                row.addClass('price-zero-row');
            } else {
                row.removeClass('price-zero-row');
            }
        }


        function updateTotalSum(skipReset = false) {
            if (!skipReset) {
                $('#prepayment_price_invoice').val('');
                $('#total_price_left_invoice').val('');
            }

            totalSum = 0;
            $('#sales_table tbody tr').each(function() {
                const total = parseFloat($(this).find('.total_product_price').val()) || 0;
                totalSum += total;
            });

            $('#total_price_invoice').val(totalSum.toFixed(2));

            if (skipReset) {
                const prepaymentVal = $('#prepayment_price_invoice').val().trim();
                const prepayment = prepaymentVal === "" ? 0 : parseFloat(prepaymentVal);

                // Nëse parapagesa është bosh ose jo numër i vlefshëm
                if (isNaN(prepayment) || prepaymentVal === "") {
                    $('#total_price_left_invoice').val('');
                }
                // Nëse parapagesa > totali → fshij parapagesën dhe shumën e mbetur
                else if (prepayment > totalSum) {
                    $('#prepayment_price_invoice').val('');
                    $('#total_price_left_invoice').val('');
                }
                // Përndryshe → rifresko shumën e mbetur
                else {
                    const remaining = totalSum - prepayment;
                    $('#total_price_left_invoice').val(remaining.toFixed(2));
                }
            }

            return totalSum;
        }

        // Event listener for quantity and price changes
        $(document).on('input', '.quantity, .price', function() {
            var row = $(this).closest('tr');
            calculateTotalPrice(row);
        });

        $(document).on('input', '#prepayment_price_invoice', function() {
            var prepaymentVal = $(this).val().trim();

            // Convert to a number only if it's not empty
            var prepayment = prepaymentVal === "" ? 0 : parseFloat(prepaymentVal) || 0;

            var totalSumNew = totalSum - prepayment;

            $('#total_price_left_invoice').val(totalSumNew.toFixed(2));

            // If input is empty, keep it empty instead of showing 0
            if (prepaymentVal === "" || totalSum < prepayment) {
                $('#prepayment_price_invoice').val("");
                $('#total_price_left_invoice').val("");
            }
        });

        // Event listener for adding row button
        $('#add_row').click(function() {
            addRow();
        });

        $(document).on('input', '.product_name', function() {
            var productName = $(this).val().trim();
            var encodedProductName = encodeURIComponent(productName);
            var row = $(this).closest('tr');
            row.find('.product_name,.quantity, .price').removeClass('input-error');

            if (productName === '') {
                // Nëse inputi është bosh → rikthe gjendjen normale
                $('#search_results_table').hide();
                $('#search_results_container').removeClass('results-expanded');
                return;
            } else {
                // Sapo ka filluar kërkimi → fshi totalin, zmadho containerin
                $('#search_results_container').addClass('results-expanded');
            }

            const xhr = new XMLHttpRequest();
            xhr.open("GET", window.base_url + 'admin/invoices/?product_name=' + encodedProductName, true);

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (!row.closest('body').length || row.find('.product_name').val().trim() !== productName) return;
                    displaySearchResults(response.products, row);
                }
            };
            xhr.send();
        });


        function displaySearchResults(results, row) {
            var tableBody = $('#search_results_body');
            var tableHead = $('#search_results_table thead'); // Select the thead
            tableBody.empty(); // Clear existing results

            if (results.length > 0) {
                tableHead.show(); // Show the thead
                $.each(results, function(index, result) {
                    var searchRow = `
                        <tr tabindex="0" data-product-name="${_.escape(result.name)}" data-code="${result.code}" data-quantity="0" data-price="${result.price}" data-total-product-price="0" data-total-price-invoice="0" data-image=${window.base_url+'/optimum/products_images/'+result.image}>
                            <td class="table-col-7">${index+1}</td>
                            <td class="table-col-12">${result.code}</td>
                            <td class="table-col-34">${_.escape(result.name)}</td>
                            <td class="table-col-12">0</td>
                            <td class="table-col-12">${result.price}</td>
                            <td style="display:none;" class="table-col-12" hidden>${result.image}</td>
                        </tr>
                    `;
                    tableBody.append(searchRow);
                });

                // Show the search results table
                $('#search_results_table').show();
                $('#search_results_container').scrollTop(0);

                // Tastiera menaxhohet një herë, jashtë funksionit të rezultateve.
                // Kjo shmang regjistrimin e shumëfishtë të eventeve pas çdo kërkimi.

                // Event listener for selecting a product from search results
                $('#search_results_body tr').off('click').on('click', function() {

                    var selectedProduct = $(this);
                    var productName = selectedProduct.data('product-name');
                    var code = selectedProduct.data('code');
                    var price = selectedProduct.data('price');
                    var quantity = selectedProduct.data('quantity');
                    var total_product_price = selectedProduct.data('total-product-price');
                    var total_price_invoice = selectedProduct.data('total-price-invoice');
                    var image = selectedProduct.data('image');
                    image = image.split("/").pop();
                    // Populate the corresponding fields in the main table row
                    row.find('.product_name').val(productName);
                    row.find('.code').val(code);
                    row.find('.price').val(price);
                    row.find('.quantity').val(quantity);
                    row.find('.total_product_price').val(total_product_price);
                    row.find('.total_price_invoice').val(total_price_invoice);
                    row.find('.image').val(image);
                    row.find('.quantity')[0].focus({
                        preventScroll: true
                    });
                    row.find('.quantity').select();

                    // Hide the search results table after selection
                    $('#search_results_table').hide();

                    $('#search_results_container').removeClass('results-expanded');

                    row.find('.product_name,.quantity, .price').removeClass('input-error');
                    if (parseFloat(price) === 0 || price < 0) {
                        row.addClass('price-zero-row');
                    } else {
                        row.removeClass('price-zero-row');
                    }

                });

                // Shfaqja e fotografisë bëhet me klik në NR, jo me hover:
                // modal-i nuk ia merr fokusin tastierës gjatë navigimit.
            } else {
                // Hide the search results table if no results found
                $('#search_results_table').hide();
            }
        }

        $(document).on('focus', '.quantity, .price', function() {
            $('#search_results_table').hide();
            $('#search_results_container').removeClass('results-expanded');
        });

        // NAVIGIMI ME TASTIERË – një event për të gjitha kërkimet.
        function focusSearchRow($target) {
            if (!$target.length) return;
            $target[0].focus({
                preventScroll: true
            });
            const scroller = document.getElementById('search_results_container');
            if (!scroller) return;
            const rowBox = $target[0].getBoundingClientRect();
            const box = scroller.getBoundingClientRect();
            const header = $('#search_results_table thead').outerHeight() || 0;
            if (rowBox.bottom > box.bottom) {
                scroller.scrollTop += rowBox.bottom - box.bottom + 4;
            } else if (rowBox.top < box.top + header) {
                scroller.scrollTop -= box.top + header - rowBox.top + 4;
            }
        }

        $(document).on('keydown', '.product_name', function(e) {
            if (e.key === 'ArrowDown' && $('#search_results_table').is(':visible')) {
                e.preventDefault();
                focusSearchRow($('#search_results_body tr').first());
            } else if (e.key === 'Tab' && $('#search_results_table').is(':visible')) {
                e.preventDefault();
                $('#search_results_table').hide();
                $('#search_results_container').removeClass('results-expanded');
                $(this).closest('tr').find('.quantity').focus({
                    preventScroll: true
                });
            }
        });

        $(document).on('keydown', '#search_results_body tr', function(e) {
            const $current = $(this);
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                focusSearchRow($current.next('tr').length ? $current.next('tr') : $current);
            } else if (e.key === 'ArrowUp') {
                e.preventDefault();
                if ($current.prev('tr').length) {
                    focusSearchRow($current.prev('tr'));
                } else {
                    $('#product_rows .product_name').filter(function() {
                        return $(this).val().trim() !== '';
                    }).last().focus({
                        preventScroll: true
                    });
                }
            } else if (e.key === 'Enter') {
                e.preventDefault();
                $current.trigger('click');
            }
        });

        // Foto vetëm me klik në numrin e produktit (pa ndërprerë shigjetat).
        $(document).on('click', '#search_results_body tr td:first-child', function(e) {
            e.stopPropagation();
            const $product = $(this).closest('tr');
            $('#productName').text($product.data('product-name') || '');
            $('#productImage').attr('src', $product.data('image') || '');
            $('#imageModal').modal('show');
        });

        // Event listener for adding a new row when Enter key is pressed in product_name input
        $(document).on('keydown', '.product_name,.quantity,.price,.total_product_price', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                if ($(this).hasClass('product_name') && $('#search_results_table').is(':visible') && $('#search_results_body tr').length) {
                    $('#search_results_body tr').first().trigger('click');
                    return;
                }
                var lastRow = $('#product_rows tr').last();
                if (isValidRow(lastRow)) {
                    addRow();
                } else {
                    validateRowFields(lastRow);
                    const errors = getValidationErrorsForRow(lastRow, $('#product_rows tr').index(lastRow) + 1);
                    const html = '<ul><li>' + errors.join('</li><li>') + '</li></ul>';
                    $('#noRowAddedMessage').html(html);
                    $('#noRowAdded').modal('show');
                }
            }
        });

        // Function to update row numbers
        function updateRowNumbers() {
            rowIdx = 1;
            $('#sales_table tbody tr').each(function() {
                $(this).find('td:first-child').text(rowIdx++);
            });
        }

        // Event listener for clicking the first column to show/hide delete button
        $(document).on('click', '#product_rows td:first-child', function() {
            if (lastClickedRow) {
                lastClickedRow.removeClass('selected-row');
            }

            var currentRow = $(this).closest('tr');

            if (lastClickedRow && lastClickedRow.is(currentRow)) {
                lastClickedRow = null;
                $('#delete_row').hide();
            } else {
                lastClickedRow = currentRow;
                lastClickedRow.addClass('selected-row');
                $('#delete_row').show();
            }
        });

        // Event listener for deleting a row
        $('#delete_row').click(function() {
            if ($('#product_rows tr').length > 1) {
                if (lastClickedRow) {
                    lastClickedRow.remove();
                    lastClickedRow = null;
                    $('#delete_row').hide();
                    updateRowNumbers(); // Update row numbers
                    updateTotalSum(true); // Update total sum
                }
            } else {
                if (lastClickedRow) {
                    lastClickedRow.find('input').val('');
                    lastClickedRow = null;
                    $('#delete_row').hide();
                    updateTotalSum(); // Update total sum
                }
            }
        });

        $('#sales_form').submit(function(event) {
            let isFormValid = true;

            $('#sales_table tbody tr').each(function() {
                const row = $(this);
                if (!isValidRow(row)) {
                    validateRowFields(row);
                    isFormValid = false;
                    return false;
                }
            });

            if (!isFormValid) {
                $('#noRowAdded').modal('show');
                event.preventDefault();
            }
        });


        $('#search_results_table th').click(function() {
            var table = $(this).closest('table');
            var index = $(this).index();
            var isNumericSort = $(this).text().trim() === 'NR' || $(this).text().trim() === 'ÇMIMI'; // Sort numerically for NR and ÇMIMI
            var asc = $(this).hasClass('asc');

            // Check if the clicked column is "EMRI I PRODUKTIT", "NR", or "ÇMIMI"
            if ($(this).text().trim() === 'EMRI I PRODUKTIT' || $(this).text().trim() === 'NR' || $(this).text().trim() === 'ÇMIMI') {
                // Toggle ascending/descending sort
                $('#search_results_table th').removeClass('asc desc');
                $(this).toggleClass('asc', !asc).toggleClass('desc', asc);

                sortTable(table, index, isNumericSort, !asc);
            }
        });

        function sortTable(table, index, isNumeric, asc) {
            var rows = table.find('tbody tr').toArray();
            rows.sort(function(a, b) {
                var A = $(a).children('td').eq(index).text().toUpperCase();
                var B = $(b).children('td').eq(index).text().toUpperCase();

                if (isNumeric) {
                    A = parseFloat(A) || 0;
                    B = parseFloat(B) || 0;
                }

                if (A < B) {
                    return asc ? 1 : -1; // Change direction for numeric columns to sort from greatest to lowest by default
                }
                if (A > B) {
                    return asc ? -1 : 1;
                }
                return 0;
            });

            $.each(rows, function(index, row) {
                table.children('tbody').append(row);
            });
        }

        // Funksion që kontrollon nëse një rresht është valid
        function isValidRow(row) {
            const name = row.find('.product_name').val().trim();
            const quantity = row.find('.quantity').val().trim();
            const price = row.find('.price').val().trim();

            const quantityNum = parseFloat(quantity);
            const priceNum = parseFloat(price);

            const isQuantityValid = quantity !== '' && !isNaN(quantityNum) && quantityNum > 0;
            const isPriceValid = price !== '' && !isNaN(priceNum);
            const isNameValid = name !== '';

            return isQuantityValid && isPriceValid && isNameValid;
        }

        function getValidationErrorsForRow(row, rowIndex) {
            const errors = [];
            const name = row.find('.product_name').val().trim();
            const quantity = row.find('.quantity').val().trim();
            const price = row.find('.price').val().trim();

            const quantityNum = parseFloat(quantity);
            const priceNum = parseFloat(price);

            if (name === '') {
                errors.push(`Rreshti ${rowIndex}: Emri i produktit është bosh.`);
            }

            if (quantity === '' || isNaN(quantityNum) || quantityNum <= 0) {
                errors.push(`Rreshti ${rowIndex}: Sasia duhet të jetë numër më i madh se 0.`);
            }

            if (price === '' || isNaN(priceNum)) {
                errors.push(`Rreshti ${rowIndex}: Çmimi duhet të jete i mbushur dhe numër i vlefshëm.`);
            }
            return errors;
        }

        // Funksion që bën validimin vizual të inputeve në rresht
        function validateRowFields(row) {
            const name = row.find('.product_name');
            const quantity = row.find('.quantity');
            const price = row.find('.price');

            const quantityVal = quantity.val().trim();
            const priceVal = price.val().trim();

            const quantityNum = parseFloat(quantityVal);
            const priceNum = parseFloat(priceVal);

            // Emri i produktit
            if (name.val().trim() === '') {
                name.addClass('input-error');
            } else {
                name.removeClass('input-error');
            }

            // Sasia
            if (quantityVal === '' || isNaN(quantityNum) || quantityNum <= 0) {
                quantity.addClass('input-error');
            } else {
                quantity.removeClass('input-error');
            }

            // Çmimi
            if (priceVal === '' || isNaN(priceNum)) {
                price.addClass('input-error');
            } else {
                price.removeClass('input-error');
            }
        }


        function validateAndSubmitForm(submitType, isAjax = false, callback = null) {
            if (!isAjax && $('#id').length) {
                // Veçse është ruajtur njëherë, thjesht printo/eksporto
                $('#sales_form').append(`<input type="hidden" name="submit_type" value="${submitType}">`);
                $('#sales_form')[0].submit();
                return;
            }

            let isFormValid = true;
            const errorMessages = [];

            // Remove empty rows before submitting
            const rows = $('#sales_table tbody tr');
            if (rows.length > 1) {
                rows.each(function() {
                    const row = $(this);
                    const name = row.find('.product_name').val().trim();
                    const quantity = row.find('.quantity').val().trim();
                    const price = row.find('.price').val().trim();

                    const isEmpty = name === '' && quantity === '' && price === '';
                    if (isEmpty) {
                        row.remove();
                    }
                });
            }


            // Revalidate rows after empty rows are removed
            $('#sales_table tbody tr').each(function(index) {
                const row = $(this);
                const name = row.find('.product_name').val().trim();
                const quantity = row.find('.quantity').val().trim();
                const price = row.find('.price').val().trim();

                const quantityNum = parseFloat(quantity);
                const priceNum = parseFloat(price);

                if (name === '') {
                    errorMessages.push(`Rreshti ${index + 1}: Emri i produktit është bosh.`);
                    row.find('.product_name').addClass('input-error');
                    isFormValid = false;
                } else {
                    row.find('.product_name').removeClass('input-error');
                }

                if (quantity === '' || isNaN(quantityNum) || quantityNum <= 0) {
                    errorMessages.push(`Rreshti ${index + 1}: Sasia duhet të jetë më e madhe se 0.`);
                    row.find('.quantity').addClass('input-error');
                    isFormValid = false;
                } else {
                    row.find('.quantity').removeClass('input-error');
                }

                if (price === '' || isNaN(priceNum)) {
                    errorMessages.push(`Rreshti ${index + 1}: Çmimi duhet të jete i mbushur dhe numër i vlefshëm.`);
                    row.find('.price').addClass('input-error');
                    isFormValid = false;
                } else {
                    row.find('.price').removeClass('input-error');
                }
            });

            if (!isFormValid) {
                const html = '<ul><li>' + errorMessages.join('</li><li>') + '</li></ul>';
                $('#noRowAddedMessage').html(html);
                $('#noRowAdded').modal('show');
                return;
            }

            if (isAjax) {
                const formData = $('#sales_form').serialize() + '&submit_type=' + submitType;
                const input = document.createElement("input");

                $.ajax({
                    type: 'POST',
                    url: $('#sales_form').attr('action'),
                    data: formData,
                    success: function(response) {
                        try {
                            const res = JSON.parse(response);

                            input.type = "hidden";
                            input.name = "id";
                            input.value = res.id;
                            input.id = "id";

                            $('#sales_form > #id').remove();
                            document.getElementById("sales_form").appendChild(input);

                            if (typeof callback === 'function') {
                                callback(); // Printo ose Excel
                            } else {
                                $('#successModal').modal('show');
                            }

                        } catch (err) {
                            // Nëse nuk është valid JSON
                            console.error("Nuk është JSON valid:", response);

                            showDebtNotification('Gabim gjatë ruajtjes së faturës.', 'Gabim');
                            $(document).trigger('invoiceSaveFailed');

                            // Nëse të gjithë rreshtat janë fshirë, shto një të ri bosh
                            if ($('#product_rows tr').length === 0) {
                                $('#product_rows').append(`
                              <tr>
                                  <td class="table-col-7">1</td>
                                  <td class="table-col-12"><input class="code" name="code[]" readonly></td>
                                  <td class="table-col-33"><input type="text" class="product_name" name="product_name[]" autocomplete="off"></td>
                                  <td class="table-col-12"><input type="text" class="quantity" name="quantity[]" autocomplete="off"></td>
                                  <td class="table-col-12"><input type="text" class="price" name="price[]" autocomplete="off"></td>
                                  <td class="table-col-12"><input class="total_product_price" name="total_product_price[]" readonly></td>
                                  <td hidden><input type="text" class="image" name="image[]" hidden></td>
                              </tr>
                          `);
                            }
                        }
                    },

                    error: function(xhr, status, error) {
                        console.error('Error saving:', error);
                        $('#errorModal').modal('show');
                        $(document).trigger('invoiceSaveFailed');
                    }
                });
            } else {
                // Submit normal
                $('#sales_form').append(`<input type="hidden" name="submit_type" value="${submitType}">`);
                $('#sales_form')[0].submit();
            }
        }

        // Bëje funksionin të qasshëm edhe nga skripti i butonit DETYRIM NGA KLIENTI.
        window.validateAndSubmitForm = validateAndSubmitForm;

        $('#saveBtn').on('click', function(e) {
            const rows = $('#sales_table tbody tr');
            if (rows.length > 1) {
                rows.each(function() {
                    const row = $(this);
                    const name = row.find('.product_name').val().trim();
                    const quantity = row.find('.quantity').val().trim();
                    const price = row.find('.price').val().trim();

                    const isEmpty = name === '' && quantity === '' && price === '';
                    if (isEmpty) {
                        row.remove();
                    }
                });
            }

            e.preventDefault();
            validateAndSubmitForm('ruaj_faturen', true);
        });

        $('#printBtn').on('click', function(e) {
            const rows = $('#sales_table tbody tr');
            if (rows.length > 1) {
                rows.each(function() {
                    const row = $(this);
                    const name = row.find('.product_name').val().trim();
                    const quantity = row.find('.quantity').val().trim();
                    const price = row.find('.price').val().trim();

                    const isEmpty = name === '' && quantity === '' && price === '';
                    if (isEmpty) {
                        row.remove();
                    }
                });
            }
            e.preventDefault();

            // Nëse fatura është ruajtur më parë (ka `id`), thjesht printo
            if ($('#id').length) {
                $('#sales_form').append(`<input type="hidden" name="submit_type" value="printo_faturen">`);
                $('#sales_form')[0].submit();
                return;
            }

            // Përndryshe, ruaje me AJAX pastaj printo
            validateAndSubmitForm('ruaj_faturen', true, function() {
                $('#sales_form').append(`<input type="hidden" name="submit_type" value="printo_faturen">`);
                $('#sales_form')[0].submit();
            });
        });


        $('#downloadBtn').on('click', function(e) {
            const rows = $('#sales_table tbody tr');
            if (rows.length > 1) {
                rows.each(function() {
                    const row = $(this);
                    const name = row.find('.product_name').val().trim();
                    const quantity = row.find('.quantity').val().trim();
                    const price = row.find('.price').val().trim();

                    const isEmpty = name === '' && quantity === '' && price === '';
                    if (isEmpty) {
                        row.remove();
                    }
                });
            }
            e.preventDefault();

            if ($('#id').length) {
                $('#sales_form').append(`<input type="hidden" name="submit_type" value="printo_faturen_excel">`);
                $('#sales_form')[0].submit();
                return;
            }

            validateAndSubmitForm('ruaj_faturen', true, function() {
                $('#sales_form').append(`<input type="hidden" name="submit_type" value="printo_faturen_excel">`);
                $('#sales_form')[0].submit();
            });
        });

    });
</script>

<script>
    $(document).ready(function() {
        var debtSearchTimer = null;
        var debtSearchRequest = null;
        var activeDebtClientIndex = -1;

        function selectDebtClient($item) {
            if (!$item.length) return;
            $('#debt_client_id').val($item.attr('data-id'));
            $('#client_name').val($item.attr('data-name'));
            if ($item.attr('data-address')) $('#address').val($item.attr('data-address'));
            if ($item.attr('data-phone')) $('#phone_number').val($item.attr('data-phone'));
            activeDebtClientIndex = -1;
            $('#debtClientSuggestions').hide().empty();
            $('#client_name').focus();
        }

        $('#client_name').on('input', function() {
            $('#debt_client_id').val('');
            activeDebtClientIndex = -1;
            clearTimeout(debtSearchTimer);
            if (debtSearchRequest) debtSearchRequest.abort();
            var q = $.trim($(this).val());
            if (q.length < 2) {
                $('#debtClientSuggestions').hide().empty();
                return;
            }
            debtSearchTimer = setTimeout(function() {
                debtSearchRequest = $.ajax({
                    url: '<?php echo base_url("admin/invoices/search_debt_clients_invoice"); ?>',
                    type: 'GET',
                    dataType: 'json',
                    data: {
                        search: q
                    },
                    success: function(res) {
                        // Mos shfaq rezultate të vjetra nëse emri ndërkohë ka ndryshuar.
                        if ($.trim($('#client_name').val()) !== q) return;
                        var box = $('#debtClientSuggestions').empty();
                        activeDebtClientIndex = -1;
                        if (!res || !res.length) {
                            box.hide();
                            return;
                        }
                        $.each(res, function(_, c) {
                            $('<div class="debt-client-suggestion" role="option"></div>')
                                .attr('data-id', c.id)
                                .attr('data-name', c.name || '')
                                .attr('data-address', c.address || '')
                                .attr('data-phone', c.phone || '')
                                .html('<strong>' + $('<div>').text(c.name || '').html() + '</strong>' +
                                    '<small>' + $('<div>').text((c.address || '') + ((c.phone || '') ? ' | ' + c.phone : '')).html() + '</small>')
                                .appendTo(box);
                        });
                        box.show();
                    }
                });
            }, 250);
        });

        $('#client_name').on('keydown', function(e) {
            var $box = $('#debtClientSuggestions');
            var $items = $box.find('.debt-client-suggestion');
            if (!$box.is(':visible') || !$items.length) return;

            if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
                e.preventDefault();
                if (e.key === 'ArrowDown') {
                    activeDebtClientIndex = Math.min(activeDebtClientIndex + 1, $items.length - 1);
                } else {
                    activeDebtClientIndex = activeDebtClientIndex <= 0 ? $items.length - 1 : activeDebtClientIndex - 1;
                }
                $items.removeClass('active').attr('aria-selected', 'false');
                var $active = $items.eq(activeDebtClientIndex).addClass('active').attr('aria-selected', 'true');
                $active[0].scrollIntoView({
                    block: 'nearest'
                });
            } else if (e.key === 'Enter') {
                e.preventDefault(); // Mos e dërgo formularin kur zgjedhim klientin.
                selectDebtClient($items.eq(activeDebtClientIndex < 0 ? 0 : activeDebtClientIndex));
            } else if (e.key === 'Escape') {
                e.preventDefault();
                $box.hide();
                activeDebtClientIndex = -1;
            }
        });

        $(document).on('click', '.debt-client-suggestion', function() {
            selectDebtClient($(this));
        });

        $(document).on('click', function(e) {
            if (!$(e.target).closest('#client_name,#debtClientSuggestions').length) {
                $('#debtClientSuggestions').hide();
                activeDebtClientIndex = -1;
            }
        });

        // Hap konfirmimin para ruajtjes dhe regjistrimit të detyrimit.
        $('#debtBtn').on('click', function(e) {
            e.preventDefault();
            $('#confirmDebtModalMessage').text(
                'A dëshironi ta ruani faturën dhe ta regjistroni ose përditësoni shumën e mbetur si detyrim?'
            );
            $('#confirmDebtModal').modal('show');
        });

        $('#confirmDebtAction').on('click', function() {
            var $confirmButton = $(this);
            var $debtButton = $('#debtBtn');
            var clientId = $('#debt_client_id').val();
            var invoiceId = $('#sales_form > #id').val();

            // Klienti kërkohet vetëm kur detyrimi regjistrohet për herë të parë.
            // Për faturën ekzistuese, controller-i e gjen klientin nga transaksioni i lidhur.
            if (!invoiceId && !clientId) {
                $('#confirmDebtModal').modal('hide');
                $('#confirmDebtModal').one('hidden.bs.modal', function() {
                    showDebtNotification('Zgjidhni klientin ekzistues nga lista e borxheve.', 'Vërejtje');
                });
                return;
            }

            $confirmButton.prop('disabled', true).text('Duke ruajtur...');
            $debtButton.prop('disabled', true);
            $('#confirmDebtModal').modal('hide');

            function unlock() {
                $confirmButton.prop('disabled', false).text('Po, konfirmo');
                $debtButton.prop('disabled', false);
            }

            // Ruaje gjithmonë faturën e ndryshuar përpara sinkronizimit të borxhit.
            window.validateAndSubmitForm('ruaj_faturen', true, function() {
                var savedInvoiceId = $('#sales_form > #id').val();
                if (!savedInvoiceId) {
                    unlock();
                    showDebtNotification('Fatura nuk u ruajt. Detyrimi nuk u ndryshua.', 'Gabim');
                    return;
                }
                $confirmButton.text('Duke regjistruar...');
                $.ajax({
                    url: window.base_url + 'admin/invoices/invoice_to_debt',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        invoice_id: savedInvoiceId,
                        debt_client_id: clientId
                    },
                    success: function(res) {
                        if (res && res.status) {
                            if (res.client_id) $('#debt_client_id').val(res.client_id);
                            showDebtNotification(res.message || 'Detyrimi u regjistrua me sukses.', 'Sukses');
                        } else {
                            showDebtNotification((res && res.message) || 'Detyrimi nuk u regjistrua.', 'Vërejtje');
                        }
                    },
                    error: function(xhr) {
                        var message = (xhr.responseJSON && xhr.responseJSON.message) ||
                            'Ndodhi një gabim gjatë regjistrimit të detyrimit.';
                        showDebtNotification(message, 'Gabim');
                    },
                    complete: unlock
                });
            });
            // Nëse validimi/ruajtja dështon, nuk ekzekutohet callback-u.
            // Riaktivizo butonat kur modali i validimit ose gabimit mbyllet.
            $(document).one('invoiceSaveFailed', unlock);
        });

    });
</script>