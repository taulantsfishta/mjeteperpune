<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
<style>
 
 /* body {
   zoom: 90%;
} */

#invoiceTableData{
    zoom: 83%;
}

tbody, td, tfoot, th, thead, tr {
    border-color: inherit;
    border-style: solid;
    border-width: medium;
}

.table-hover > tbody > tr:hover {
  background-color: #7395b3;
}

.table-col-7 { width: 7%; }
.table-col-33 { width: 33%; }
.table-col-12 { width: 12%; }
.table-col-36 { width: 41%; }
.table-col-20 { width: 20%; }
.table-col-10 { width: 10%; }


.no-border {
    border: none !important;
}

.product_name, .quantity, .price, .code,.total_product_price {
    border-top: none;
    border-right: none;
    border-left: none;
    width: 100%;
    border-bottom: 0.1px solid #e4e7ea;;
}

.results-expanded {
    max-height: 750px; /* më shumë lartësi për 12–15 rreshta */
    overflow-y: auto;
    font-size: 17px;
}

textarea:focus, input:focus{
    outline: none;
}

.selected-row {
    background-color: #d1e7dd !important;
}

#total_price{
    border-right: none;
}

#total_price_invoice{
    border-top: none;
    border-right: none;
    border-left: none;
    width: 100%;
    border-bottom: 1px solid #e4e7ea;
    font-weight: bold;
    font-size:16px;
}

#total_price_invoice_name{
    border-right: none;
}

#total_price{
    border-right: none;
}

#total_price_invoice{
    border-top: none;
    border-right: none;
    border-left: none;
    width: 100%;
    border-bottom: 1px solid #e4e7ea;
    font-weight: bold;
    font-size:16px;
}

#prepayment_price_invoice{
    border-top: none;
    border-right: none;
    border-left: none;
    width: 100%;
    border-bottom: 1px solid #e4e7ea;
    font-weight: bold;
    font-size:16px;

}

#total_price_left_invoice{
    border-top: none;
    border-right: none;
    border-left: none;
    width: 100%;
    border-bottom: 1px solid #e4e7ea;
    font-weight: bold;
}
#search_results_container {
    max-height: 600px;
    overflow-y: auto;
    font-family: Arial, Helvetica, sans-serif;
}

#search_results_table td, #search_results_table th {
    padding: 4px 6px !important;
}

.modal-backdrop {
    display: none !important;
}

.input-error {
    border: 1px solid rgb(238, 100, 100) !important;
    background-color:rgb(245, 236, 236);
}

.price-zero-row {
    background-color:  #ffcfcf !important;/* ngjyrë e verdhë e lehtë, për paralajmërim */
}

.price-zero-row td {
    background-color: #ffcfcf !important; /* ngjyrë rozë paralajmëruese për input cells */
}

.price-zero-row input {
    background-color: #ffcfcf !important; /* sfond për input-et */
}

        /* ===== MOBILE-ONLY FIXES ===== */
        @media (max-width: 576px) {
          /* kill the desktop zoom hacks on phones */
          #invoiceTableData { zoom: 100% !important; }
          .white-box { padding: 10px; font-size: 14px; }

          /* form fields: full-width, readable */
          label { font-size: 14px; }
          input[type="text"],
          input[type="date"],
          textarea { font-size: 16px; } /* avoids iOS zoom-on-focus */

          /* Table: keep structure, allow horizontal scroll */
          #sales_table,
          #search_results_table {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
            white-space: nowrap;
          }
          #sales_table thead th,
          #search_results_table thead th {
            font-size: 13px;
          }
          #sales_table td,
          #sales_table th,
          #search_results_table td,
          #search_results_table th {
            padding: 6px 8px !important;
          }

          /* Make inputs inside table comfortable to tap */
          .product_name,
          .quantity,
          .price,
          .code,
          .total_product_price {
            min-width: 120px;        /* prevents squish */
            height: 36px;            /* bigger tap target */
            font-size: 16px;
          }
          /* Keep the first column small */
          #sales_table td:first-child,
          #search_results_table td:first-child { min-width: 40px; }

          /* Search results area: shorter on phones */
          #search_results_container { max-height: 390px; }
          .results-expanded { max-height: 480px; font-size: 15px; }

          /* Totals box: stack nicely and fill width */
          .totals-section-box { margin-top: 12px; }
          .totals-section-box .totals-line {
            display: grid;
            grid-template-columns: 1fr;
            gap: 6px;
            margin-bottom: 10px;
          }
          #total_price_invoice,
          #prepayment_price_invoice,
          #total_price_left_invoice {
            width: 100%;
            height: 40px;
            font-size: 16px;
          }

          /* Action buttons: stack, full width */
          #saveBtn, #printBtn, #downloadBtn, #delete_row {
            display: block;
            width: 100%;
            margin: 8px 0 0 0;
            padding: 10px 12px;
            border-radius: 12px;
            font-size: 16px;
          }

          /* Modals: fit screen width */
          .modal-dialog {
            margin: 10px;
            max-width: 100%;
            width: auto;
          }
          #productImage {
            width: 100% !important;
            height: auto !important;
            max-height: 60vh;
          }

          /* Warning/selection colors still visible on mobile */
          .selected-row { background-color: #d1e7dd !important; }
          .price-zero-row { background-color: #ffcfcf !important; }
          .price-zero-row td, .price-zero-row input { background-color: #ffcfcf !important; }
        }
                /* Force equal row for client_name, address, date */
        .form-row-equal {
        display: flex;
        align-items: center;       /* vertically align label + input */
        gap: 10px;                 /* spacing between fields */
        }

        .form-row-equal .form-group {
        flex: 1;                   /* each field takes equal width */
        display: flex;
        flex-direction: column;    /* stack label on top of input */
        }

        .form-row-equal label {
        margin-bottom: 4px;
        font-weight: bold;
        font-size: 14px;
        }

        .form-row-equal input {
        height: 40px;              /* comainDivnsistent height */
        font-size: 15px;
        padding: 6px 10px;
        }

        @media (max-width: 576px) {
            .form-row-equal {
                flex-direction: column;
            }
        }
        /* Equal, full-width action buttons (incl. delete) */
        .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 10px;
        }

        .action-buttons .btn {
        display: block;
        width: 100% !important;        /* overrides the inline 170px on RUAJ */
        padding: 12px;
        border-radius: 12px;
        font-weight: bold;
        font-size: 16px;
        }

        .action-buttons .btn i { margin-right: 6px; }
        
        /* ====== INVOICES: MOBILE FRIENDLY ====== */
        @media (max-width: 576px) {
        /* input i kërkimit: lexueshëm dhe pa zoom iOS */
        #invoicesStructure .form-control#myInput {
            font-size: 16px;
            height: 42px;
        }

        /* wrapper që lejon scroll horizontal “butter-smooth” */
        .table-responsive-mobile {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        /* jep një minimum gjerësi tabelës që të mos shtypet kolonat */
        #invoiceData {
            min-width: 820px; /* rrit/ul sipas kolonave që ke */
        }

        /* header sticky që të mos humbasësh titujt gjatë scroll-it */
        #invoiceData thead th {
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 2;
            font-size: 13px;
            white-space: nowrap;
        }

        /* pak më kompakte dhe të prekshme qelizat */
        #invoiceData td, #invoiceData th {
            padding: 8px 10px !important;
        }

        /* për të shmangur “squish” në kolonat tekstuale */
        #invoiceData td:nth-child(2),
        #invoiceData td:nth-child(3) {
            min-width: 160px;
        }

        /* butoni i fshirjes: target më i madh për gishtin */
        #invoiceData .btn.btn-xs,
        #invoiceData .btn.btn-danger.btn-circle.btn-xs {
            padding: 10px 12px;
            font-size: 16px;
            border-radius: 12px;
            line-height: 1.1;
        }

        /* modali të futet në ekran */
        #confirmDeleteModal .modal-dialog {
            margin: 10px;
            max-width: 100%;
            width: auto;
        }
        }




</style>
</head>

<body>
<div class="row" id='invoicesStructure'>
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6"><input class="form-control" id="myInput" type="text" placeholder="Kerko..."></div>
            <div class="col-lg-3"></div>
        </div>
        <br>
        <div class="table-responsive-mobile">
            <table class="table table-bordered table-striped table-hover" data-tablesaw-mode="columntoggle" id="invoiceData" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">
                <thead>
                <tr>
                    <th  class="table-col-7">ID</th>
                    <th class="table-col-10">KLIENTI</th>
                    <th class="table-col-10">ADRESA</th>
                    <th class="table-col-10">TOTALI</th>
                    <th class="table-col-10">PARAPAGESË</th>
                    <th class="table-col-10">SHUMA E MBETUR</th>
                    <th class="table-col-10">DATA E KRIJIMIT</th>
                    <th class="table-col-7">VEPRIMI</th>
                </tr>
                </thead>
                <tbody id="invoicesStructureBody">
                    <?php if(isset($invoicesCreated)) { ?>
                            <?php foreach ($invoicesCreated as $key => $value) { ?>
                            <tr data-id="<?php echo $value['id']; ?>">
                                <td  class="table-col-7"><?php echo $adminName.'-'.$value['id']; ?></td>
                                <td class="table-col-10"><?php echo htmlspecialchars($value['client_name']); ?></td>
                                <td class="table-col-10"><?php echo htmlspecialchars($value['address']); ?></td>
                                <td class="table-col-10"><?php echo htmlspecialchars($value['total_price_invoice']); ?></td>
                                <td class="table-col-10"><?php echo htmlspecialchars($value['prepayment_price_invoice']); ?></td>
                                <td class="table-col-10"><?php echo htmlspecialchars($value['total_price_left_invoice']); ?></td>
                                <td class="table-col-10"><?php echo htmlspecialchars($value['created_at']); ?></td>
                                <td class="table-col-7"><a href="<?php echo base_url('admin/invoices/delete_inovice/' . $value['id']); ?>" data-toggle="modal" data-target="#confirmDeleteModal" data-invoiceid="<?php echo $value['id']; ?>"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="icon-trash"></i></button></a></td>
                            </tr>
                            <?php } ?>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                A jeni i sigurt qe deshironi te fshini kete fature?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Jo</button>
                <a id="deleteProductLink" href="#" class="btn btn-danger">Fshije</a>
            </div>
        </div>
    </div>
</div>

<div class="row" id="invoiceTableData" style="display:none;">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-3 text-left">
                <button type="button" class="btn btn-info" style="color:white;background:#7396CE;"  id="backButton"><i class="fa fa-arrow-left"></i> KTHEHU</button>
            </div>
        </div>
        <br>
        <div class="white-box" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">
            <!-- Form to display the detailed invoice data -->
            <form id="sales_form" method="post" action="<?php echo base_url('admin/invoices/sheet_invoice/'); ?>" target="_blank" enctype="multipart/form-data">
                <div class="row form-row-equal">
                    <div class="form-group">
                        <label for="client_name">Emri I Klientit:</label>
                        <input type="text" id="client_name" name="client_name" autocomplete="off" required><br><br>
                    </div>
                    <div class="form-group">
                        <label for="address">Adresa:</label>
                        <input type="text" id="address" name="address" autocomplete="off" required><br><br>
                    </div>
                    <div class="form-group">
                        <label for="date">Data:</label>
                        <input type="date" id="date" name="date" value="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-lg-8">
                        <table id="sales_table" class="table-bordered table">
                            <thead>
                                <tr>
                                    <th class="table-col-7">#</th>
                                    <th class="table-col-33">EMRI I PRODUKTIT</th>
                                    <th class="table-col-12">KODI</th>
                                    <th class="table-col-12">SASIA</th>
                                    <th class="table-col-12">ÇMIMI</th>
                                    <th class="table-col-12">CMIMI TOTAL I PRODUKTIT</th>
                                </tr>
                            </thead>
                            <tbody id="product_rows">
                                <!-- Placeholder for detailed invoice rows -->
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-4">
                        <div id="totalsBox" class="totals-section-box">
                            <div class="totals-line">
                            <label><strong>TOTALI</strong></label>
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
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div id="search_results_container" >
                            <table id="search_results_table" class="table table-bordered" style="display: none;">
                                <thead>
                                    <tr>
                                        <th class="table-col-7">NR <i class="fa fa-sort p-r-10" aria-hidden="true"></i></th>
                                        <th class="table-col-42">EMRI I PRODUKTIT <i class="fa fa-sort p-r-10" aria-hidden="true"></i></th>
                                        <th class="table-col-12">KODI</th>
                                        <th class="table-col-12">SASIA</th>
                                        <th class="table-col-12">ÇMIMI <i class="fa fa-sort p-r-10" aria-hidden="true"></i></th>
                                    </tr>
                                </thead>
                                <br>
                                <tbody id="search_results_body"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="totalsPlaceholder"></div>
                <br><br>
                <div class="row">
                    <div class="col-lg-8"><textarea name="comment" id="comment" style="width:100%;height:90px;" placeholder="Koment"></textarea></div>
                </div>
                <br>
                <div class="row">    
                    <div class="col-lg-10 action-buttons">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>"
                                value="<?= $this->security->get_csrf_hash(); ?>" />
                        <button type="submit" id="saveBtn" class="btn" name="submit_type"
                                style="color:white;background:#ff5733;" value="ruaj_faturen">
                            <i class="fa fa-save"></i> RUAJ
                        </button>
                        <button type="submit" id="printBtn" class="btn" name="submit_type"
                                style="color:white;background:#7396CE;" value="printo_faturen">
                            <i class="fa fa-edit"></i> PRINTO FATUREN
                        </button>
                        <button type="submit" id="downloadBtn" class="btn" name="submit_type"
                                style="color:white;background:green;" value="printo_faturen_excel">
                            <i class="fa fa-edit"></i> PRINTO EXCEL
                        </button>
                        <!-- hidden by default; same width when shown -->
                        <button type="button" class="btn" id="delete_row"
                                style="display:none;background:#ff5e2dcc;color:white;">
                            <i class="fa fa-trash"></i> FSHIJ RRESHTAT
                        </button>
                    </div>
               </div>
            </form>
        </div>
    </div>
</div>


<div class="modal" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel" data-dismiss='imageModal' aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h4 class="modal-title" id="productName"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="productImage" src="" alt="Product Image" style="margin-left: auto;margin-right: auto;display: block;width:270px;height:220px;">
            </div>
        </div>
    </div>
</div>

<div class="modal" id="noRowAdded" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h4 class="modal-title" id="myModalLabel"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id='noRowAddedMessage'  style="color:black;font-size:15px;">
              <div></div>
            </div>
        </div>
    </div>
</div>


<script>
window.base_url = <?php echo json_encode(base_url()); ?>;
window.blockResultsAutoClose = false;
$(document).ready(function() {
    var rowIdx = 1;
    var lastClickedRow = null;
    var prepayment;
    var totalSum;

    let searchDebounceTimer = null;
    let currentXhr = null;
    let lastQueryIssued = "";

    $('#imageModal')
    .on('show.bs.modal', function () { window.blockResultsAutoClose = true; })
    .on('hidden.bs.modal', function () {
    setTimeout(() => { window.blockResultsAutoClose = false; }, 50);
    });
        
    
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
                    <td class="table-col-33"><input type="text" class="product_name" name="product_name[]" autocomplete="off"></td>
                    <td class="table-col-12"><input class="code" name="code[]" readonly></td>
                    <td class="table-col-12"><input type="text" class="quantity" name="quantity[]" autocomplete="off"></td>
                    <td class="table-col-12"><input type="text" class="price" name="price[]" autocomplete="off"></td>
                    <td class="table-col-12"><input class="total_product_price" name="total_product_price[]" readonly></td>
                    <td style="display:none;"><input class="id" name="id" hidden></td>
                    <td style="display:none;"><input class="image" name="image[]" hidden></td>
                </tr>
            `);
            $('#product_rows').find('.product_name').last().focus();
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


    // Function to update the total sum

    function updateTotalSum(skipReset = false) {
        if (!skipReset) {
            $('#prepayment_price_invoice').val('');
            $('#total_price_left_invoice').val('');
        }

        totalSum = 0;
            $('#sales_table tbody tr').each(function () {
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

        var totalSumNew = $('#total_price_invoice').val() - prepayment;

        $('#total_price_left_invoice').val(totalSumNew.toFixed(2));

        // If input is empty, keep it empty instead of showing 0
        if (prepaymentVal === "" || $('#total_price_invoice').val() < prepayment) {
            $('#prepayment_price_invoice').val("");
            $('#total_price_left_invoice').val("");

        }
    });

    // Event listener for adding row button
    $('#add_row').click(function() {
        addRow();
    });

    // Event listener for dynamically fetching product details based on product_name input

    $(document).on('input', '.product_name', function() {
        const $row = $(this).closest('tr');
        const raw = $(this).val();
        const q = raw.trim();

        // basic UI handling
        $row.find('.product_name,.quantity,.price').removeClass('input-error');
        if (!q) {
            $('#search_results_table').hide();
            $('#search_results_container').removeClass('results-expanded');
            return;
        } else {
            $('#search_results_container').addClass('results-expanded');
        }

        // debounce: wait a bit after typing stops
        clearTimeout(searchDebounceTimer);
        searchDebounceTimer = setTimeout(() => {
            // cancel any in-flight request
            if (currentXhr && currentXhr.readyState !== 4) {
            currentXhr.abort();
            currentXhr = null;
            }

            const encoded = encodeURIComponent(q);
            lastQueryIssued = q;

            currentXhr = new XMLHttpRequest();
            currentXhr.open("GET", window.base_url + 'admin/invoices/?product_name=' + encoded, true);

            currentXhr.onreadystatechange = function() {
            if (currentXhr.readyState === 4) {
                if (currentXhr.status === 200) {
                // ignore stale responses (user kept typing)
                if ($row.find('.product_name').val().trim() !== lastQueryIssued) return;

                try {
                    const resp = JSON.parse(currentXhr.responseText);
                    displaySearchResults(resp.products || [], $row);
                } catch (e) {
                    console.error('Bad JSON from server', e);
                }
                } else if (currentXhr.status !== 0) {
                // status 0 is from abort(); ignore it
                console.error('Search XHR error', currentXhr.status);
                }
            }
            };

            currentXhr.send();
        }, 250); // 250ms is a good balance
    });

    function displaySearchResults(results, row) {
        var tableBody = $('#search_results_body');
        var tableHead = $('#search_results_table thead'); // Select the thead
        tableBody.empty(); // Clear existing results

        if (results.length > 0) {
            tableHead.show(); // Show the thead
            $.each(results, function(index, result) {
                var searchRow = `
                    <tr tabindex="0" data-product-name="${_.escape(result.name)}" data-code="${result.code}" data-quantity="0" data-price="${result.price}" data-total-product-price="0" data-total-price-invoice="0" data-image=${window.base_url+'/optimum/products_images/'+result.image} data-id=${invoiceId}>
                        <td class="table-col-7">${index+1}</td>
                        <td class="table-col-36">${_.escape(result.name)}</td>
                        <td class="table-col-12">${result.code}</td>
                        <td class="table-col-12">0</td>
                        <td class="table-col-12">${result.price}</td>
                        <td style="display:none;" class="table-col-1">${invoiceId}</td>
                        <td style="display:none;" class="table-col-1" hidden>${window.base_url+'/optimum/products_images/'+result.image}}</td>
                    </tr>
                `;
                tableBody.append(searchRow);
            });

            // Show the search results table
            $('#search_results_table').show();

            // Handle keyboard navigation to the search results table
            $(document).on('keydown', '.product_name', function(e) {
                if (e.key === 'ArrowDown' && $('#search_results_table').is(':visible')) {
                    e.preventDefault();
                    $('#search_results_body tr').first().focus();
                }else if (e.key === 'Tab') {
                    $('#search_results_container').removeClass('results-expanded');
                    $('#search_results_table').hide();
                    const row = $(this).closest('tr');
                    const quantityInput = row.find('.quantity');
                    
                    // If no autocomplete results are open, go to quantity
                    if ($('#search_results_table').is(':hidden')) {
                        e.preventDefault(); // Prevent default Tab behavior
                        quantityInput.focus();
                    }
                }
            });

            $(document).on('blur', '.quantity,.price', function(e) {
                $('#search_results_container').removeClass('results-expanded');
                $('#search_results_table').hide();
            });

            $(document).on('click', '.quantity,.price', function(e) {
                $('#search_results_container').removeClass('results-expanded');
                $('#search_results_table').hide();
            });

            $(document).off('keydown', '#search_results_body tr').on('keydown', '#search_results_body tr', function(e) {
                var currentRow = $(this);
                if (e.key === 'ArrowDown') {
                    e.preventDefault();
                    currentRow.next().focus();
                    currentRow.closest('#search_results_container').scrollTop(currentRow.next().position().top + currentRow.closest('#search_results_container').scrollTop());
                } else if (e.key === 'ArrowUp') {
                    e.preventDefault();
                    currentRow.prev().focus();
                    currentRow.closest('#search_results_container').scrollTop(currentRow.prev().position().top + currentRow.closest('#search_results_container').scrollTop());
                } else if (e.key === 'Enter') {
                    e.preventDefault();
                    currentRow.click();
                }
            });

            // Event listener for selecting a product from search results
            $('#search_results_body tr').off('click').on('click', function() {
                var selectedProduct = $(this);
                var productName = selectedProduct.data('product-name');
                var code = selectedProduct.data('code');
                var price = selectedProduct.data('price');
                var quantity = selectedProduct.data('quantity');
                var total_product_price = selectedProduct.data('total-product-price');
                var id = selectedProduct.data('id');
                var image = selectedProduct.data('image');

                image = image.split("/").pop();
                // Populate the corresponding fields in the main table row
                row.find('.product_name').val(productName);
                row.find('.code').val(code);
                row.find('.price').val(price);
                row.find('.quantity').val(quantity);
                row.find('.total_product_price').val(total_product_price);
                row.find('.id').val(id);
                row.find('.image').val(image);
                row.find('.quantity').focus().select();

                $('#search_results_table').hide();

                $('#search_results_container').removeClass('results-expanded');

                row.find('.product_name,.quantity, .price').removeClass('input-error');
                if (parseFloat(price) === 0 || price < 0) {
                    row.addClass('price-zero-row');
                } else {
                    row.removeClass('price-zero-row');
                }
            });

            $("#search_results_body tr td.table-col-7").hover(
                function() {
                    var imageUrl = $(this).closest('tr').data('image');
                    var productName = $(this).closest('tr').data('product-name');

                    $('#productName').text(productName);

                    $('#productImage').attr('src', imageUrl);
                    $('#imageModal').modal('show');
                }, function() {
                    $(this).find("#imageModal").remove();
                }
            );
            
            $("#search_results_body tr td.table-col-7").hover(function() {
                $(this).fadeOut(100);
                $(this).fadeIn(500);
            });
        } else {
            // Hide the search results table if no results found
            $('#search_results_table').hide();
        }
    }

    

    // Event listener for adding a new row when Enter key is pressed in product_name input
    $(document).on('keypress', '.product_name,.quantity,.price,.total_product_price', function(e) {
        if (e.which == 13) { // Enter
            e.preventDefault();
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


// new TABLE OF INVOICES
var invoiceId;
$(document).ready(function(){
  // Filter invoices based on input
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#invoicesStructureBody tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
    });
  });

  $("#backButton").click(function() {
    $('#search_results_table').hide();
    $.ajax({
        url: window.base_url + 'admin/invoices/get_invoices', // Replace with your actual PHP script URL
        method: 'GET',
        data: { id: invoiceId },
        success: function(response) {
            var res = JSON.parse(response);
            let html = `<div class="row" id='invoicesStructure'>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3"></div>
                                <div class="col-lg-6"><input class="form-control" id="myInput" type="text" placeholder="Kerko..."></div>
                                <div class="col-lg-3"></div>
                            </div>
                            <br>
                            <table class="table table-bordered table-striped table-hover" data-tablesaw-mode="columntoggle" id="invoiceData" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">
                                <thead>
                                <tr>
                                    <th  class="table-col-7">ID</th>
                                    <th class="table-col-10">KLIENTI</th>
                                    <th class="table-col-10">ADRESA</th>
                                    <th class="table-col-10">TOTALI</th>
                                    <th class="table-col-10">PARAPAGESË</th>
                                    <th class="table-col-10">SHUMA E MBETUR</th>
                                    <th class="table-col-10">DATA E KRIJIMIT</th>
                                    <th class="table-col-7">VEPRIMI</th>
                                </tr>
                                </thead>
                            <tbody id="invoicesStructureBody">`;
                            res.forEach(function(value, index) {
                            html += `
                                        <tr data-id="${value.id}">
                                        <td  class="table-col-7"><?php echo $adminName ?> - ${value.id}</td>
                                        <td class="table-col-10">${escapeHtml(value.client_name)}</td>
                                        <td class="table-col-10">${escapeHtml(value.address)}</td>
                                        <td class="table-col-10">${escapeHtml(value.total_price_invoice)}</td>
                                        <td class="table-col-10">${escapeHtml(value.prepayment_price_invoice)}</td>
                                        <td class="table-col-10">${escapeHtml(value.total_price_left_invoice)}</td>
                                        <td class="table-col-12">${escapeHtml(value.created_at)}</td>
                                        <td>
                                            <a href="${window.base_url}admin/invoices/delete_inovice/${value.id}" data-toggle="modal" data-target="#confirmDeleteModal" data-invoiceid="${value.id}">
                                                <button type="button" class="btn btn-danger btn-circle btn-xs"><i class="icon-trash"></i></button>
                                            </a>
                                        </td>
                                        </tr>`
                            });
                            html += `</tbody>
                                    </table>
                                </div>
                            </div>`;
            $("#invoicesStructure").html(html);
            $("#invoiceTableData").hide();
            $("#invoicesStructure").show();
                // 🔁 ADD THIS BELOW
            $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#invoicesStructureBody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
            });
        },
        error: function(error) {
            console.error("Error fetching details:", error);
        }
    });

    function escapeHtml(text) {
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
  });

  // Event listener for clicking on a row to load invoice details
    $(document).on("click", "#invoiceData tbody tr", function(e) {
        if (e.target.tagName === 'TD' || e.target.tagName === 'TR') {
            invoiceId = $(this).data("id");
            loadDetailsTable(invoiceId);
        }
    });
});

function loadDetailsTable(invoiceId) {
    $.ajax({
        url: window.base_url + 'admin/invoices/get_invoice_data', // Replace with your actual PHP script URL
        method: 'GET',
        data: { id: invoiceId },
        success: function(response) {
            $("#invoicesStructure").hide();
            $("#invoiceTableData").show();
            var res = JSON.parse(response);

            $("#client_name").val(res.client_name);
            $("#address").val(res.address);
            $("#date").val(res.date);
            $("#comment").val(res.comment);

            // Clear and populate product rows
            $("#product_rows").empty();
            var row_data = JSON.parse(res.row_data);
            row_data.forEach(function(product, index) {
                var price = parseFloat(product.price) || 0;
                var highlightClass = price === 0 || price < 0 ? 'price-zero-row' : '';
                var row = `<tr class="${highlightClass}">
                    <td>${index + 1}</td>
                    <td><input type="text" class="product_name" name="product_name[]" value="${_.escape(product.product_name)}"></td>
                    <td><input type="text" class="code" name="code[]" value="${product.code}"></td>
                    <td><input type="text" class="quantity" name="quantity[]" value="${product.quantity}"></td>
                    <td><input type="text" class="price" name="price[]" value="${product.price}"></td>
                    <td><input type="text" class="total_product_price" name="total_product_price[]" value="${product.total_product_price}"></td>
                    <td style="display:none;"><input type="text" class="id" name="id" value="${invoiceId}" hidden></td>
                    <td style="display:none;"><input type="text" class="image" name="image[]" value="${product.image}" hidden></td>
                </tr>`;
                $("#product_rows").append(row);
            });

            $("#total_price_invoice").val(res.total_price_invoice);
            $("#prepayment_price_invoice").val(res.prepayment_price_invoice);
            $("#total_price_left_invoice").val(res.total_price_left_invoice);

        },
        error: function(error) {
            console.error("Error fetching details:", error);
        }
    });
}


$(document).ready(function() {
    // Listen for the modal's "Delete" button click event
    $('#confirmDeleteModal').on('show.bs.modal', function(e) {
    var invoiceID = $(e.relatedTarget).data('invoiceid'); // Get the product ID
    var deleteButton = $(this).find('#deleteProductLink'); // Get the "Delete" button in the modal

    // Update the "Delete" button link with the appropriate product ID
    deleteButton.attr('href', '<?php echo base_url("admin/invoices/delete_invoice/"); ?>' + invoiceID);
    });
});
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
                 rows.each(function () {
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
             $('#sales_table tbody tr').each(function (index) {
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
                     success: function (response) {
                         try {
                      const res = JSON.parse(response);

                      input.type = "hidden";
                      input.name = "id";
                      input.value = res.id;
                      input.id = "id";

                      document.getElementById("sales_form").appendChild(input);

                      if (typeof callback === 'function') {
                          callback(); // Printo ose Excel
                      } else {
                          $('#successModal').modal('show');
                      }

                         } catch (err) {
                      // Nëse nuk është valid JSON
                      console.error("Nuk është JSON valid:", response);

                      alert("Gabim gjatë ruajtjes: " + response);

                      // Nëse të gjithë rreshtat janë fshirë, shto një të ri bosh
                      if ($('#product_rows tr').length === 0) {
                          $('#product_rows').append(`
                              <tr>
                                  <td class="table-col-7">1</td>
                                  <td class="table-col-33"><input type="text" class="product_name" name="product_name[]" autocomplete="off"></td>
                                  <td class="table-col-12"><input class="code" name="code[]" readonly></td>
                                  <td class="table-col-12"><input type="text" class="quantity" name="quantity[]" autocomplete="off"></td>
                                  <td class="table-col-12"><input type="text" class="price" name="price[]" autocomplete="off"></td>
                                  <td class="table-col-12"><input class="total_product_price" name="total_product_price[]" readonly></td>
                                  <td hidden><input type="text" class="image" name="image[]" hidden></td>
                              </tr>
                          `);
                      }
                         }
                     },

                     error: function (xhr, status, error) {
                         console.error('Error saving:', error);
                         $('#errorModal').modal('show');
                     }
                 });
             } else {
                 // Submit normal
                 $('#sales_form').append(`<input type="hidden" name="submit_type" value="${submitType}">`);
                 $('#sales_form')[0].submit();
             }
         }

         $('#saveBtn').on('click', function (e) {
            const rows = $('#sales_table tbody tr');
            if (rows.length > 1) {
                rows.each(function () {
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

        $('#printBtn').on('click', function (e) {
            const rows = $('#sales_table tbody tr');
            if (rows.length > 1) {
                rows.each(function () {
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
            validateAndSubmitForm('ruaj_faturen', true, function () {
                $('#sales_form').append(`<input type="hidden" name="submit_type" value="printo_faturen">`);
                $('#sales_form')[0].submit();
            });
        });


        $('#downloadBtn').on('click', function (e) {
            const rows = $('#sales_table tbody tr');
            if (rows.length > 1) {
                rows.each(function () {
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

            validateAndSubmitForm('ruaj_faturen', true, function () {
                $('#sales_form').append(`<input type="hidden" name="submit_type" value="printo_faturen_excel">`);
                $('#sales_form')[0].submit();
            });
        });

            (function () {
    const isMobile = window.matchMedia && window.matchMedia('(max-width: 576px)').matches;
    if (!isMobile) return;

    // Kill any desktop hover handlers on these cells
    $(document).off('mouseenter mouseleave', '#search_results_body td.table-col-7');

    let suppressClick = false;      // avoid double trigger (touchstart + click)
    let lastImageUrl = null;
    let scrollStartY = null;

    function openPreview($tr) {
        const imageUrl = $tr.data('image');
        const name = $tr.data('product-name');
        if (!imageUrl) return;

        // If already showing this image, don't flicker
        if ($('#imageModal').hasClass('show') && imageUrl === lastImageUrl) return;

        $('#productName').text(name);
        $('#productImage').attr('src', imageUrl);
        lastImageUrl = imageUrl;

        if (!$('#imageModal').hasClass('show')) {
        $('#imageModal').modal('show');
        }
    }

    // Tap to open (touch first, then click fallback)
    $(document).on('touchstart', '#search_results_body td.table-col-7', function (e) {
        suppressClick = true; setTimeout(() => suppressClick = false, 350);
        e.stopPropagation();
        openPreview($(this).closest('tr'));
    });

    $(document).on('click', '#search_results_body td.table-col-7', function (e) {
        if (suppressClick) return; // ignore the click that follows touch
        e.stopPropagation();
        openPreview($(this).closest('tr'));
    });

    // Hide preview when user scrolls the results list (prevents “stuck” modal)
    $('#search_results_container')
        .off('touchstart.searchscroll touchmove.searchscroll touchend.searchscroll')
        .on('touchstart.searchscroll', function (ev) {
        const t = ev.originalEvent.touches && ev.originalEvent.touches[0];
        scrollStartY = t ? t.clientY : null;
        })
        .on('touchmove.searchscroll', function (ev) {
        const t = ev.originalEvent.touches && ev.originalEvent.touches[0];
        if (scrollStartY != null && t && Math.abs(t.clientY - scrollStartY) > 10) {
            $('#imageModal').modal('hide');
        }
        })
        .on('touchend.searchscroll', function () {
        scrollStartY = null;
        });

    // Close when tapping outside the modal or NR cell
    $(document).on('touchstart', function (e) {
        const $t = $(e.target);
        if (
        $t.closest('#imageModal .modal-content').length === 0 &&
        $t.closest('#search_results_body td.table-col-7').length === 0
        ) {
        $('#imageModal').modal('hide');
        }
    });

    // Lock body scroll while modal is open (iOS)
    $('#imageModal')
        .on('shown.bs.modal', function () { $('body').css('overflow', 'hidden'); })
        .on('hidden.bs.modal', function () { $('body').css('overflow', ''); });
    })();

            // Remove any previous hover handlers you had on these cells
        $(document).off('mouseenter mouseleave', '#search_results_body td.table-col-7');

        // Smooth hide timer to avoid flicker when moving between rows
        let imgHideTimer = null;

        // Show/refresh preview on hover
        $(document).on('mouseenter', '#search_results_body td.table-col-7', function () {
        clearTimeout(imgHideTimer);

        const $tr = $(this).closest('tr');
        const imageUrl = $tr.data('image');           // already stored in your row
        const productName = $tr.data('product-name');

        $('#productName').text(productName);
        $('#productImage').attr('src', imageUrl);

        // If modal already open, just update; otherwise open it
        const isVisible = $('#imageModal').hasClass('show');
        if (!isVisible) {
            $('#imageModal').modal('show');
        }
        });

        // Hide preview shortly after leaving the index cell
        $(document).on('mouseleave', '#search_results_body td.table-col-7', function () {
        imgHideTimer = setTimeout(function () {
            $('#imageModal').modal('hide');
        }, 120);
        });

        
        /* ========= MOBILE-ONLY JS (keeps desktop untouched) ========= */
        (function() {
        const isMobile = window.matchMedia && window.matchMedia('(max-width: 576px)').matches;
        if (!isMobile) return;

        // Numeric keyboard for qty/price
        $(document).on('focus', '.quantity, .price', function() {
            $(this).attr({ inputmode: 'decimal', pattern: '[0-9]*[.,]?[0-9]*', step: 'any' });
        });

        // Replace hover with tap for image preview on index cell
        $(document).off('mouseenter mouseleave', '#search_results_body tr td.table-col-7');
        $(document).off('hover', '#search_results_body tr td.table-col-7');
        // $(document).on('click', '#search_results_body tr td.table-col-7', function(e) {
        //     e.stopPropagation();
        //     var imageUrl = $(this).closest('tr').data('image');
        //     var productName = $(this).closest('tr').data('product-name');
        //     $('#productName').text(productName);
        //     $('#productImage').attr('src', imageUrl);
        //     $('#imageModal').modal('show');
        // });

        // ❌ REMOVE the auto-hide-on-scroll behavior entirely.
        // If you previously added it, make sure it’s gone:
        // (No window.addEventListener('scroll', ...) anymore)

        // Close results when tapping outside (but NOT while tapping inside input or table)
        $(document)
        .off('click touchstart._closeResults')
        .on('click touchstart._closeResults', function(e) {
            if (blockResultsAutoClose) return; // <-- don't close while image modal is open

            const $t = $(e.target);
            const insideResults = $t.closest('#search_results_container').length > 0;
            const insideInput   = $t.closest('.product_name').length > 0;

            if (!insideResults && !insideInput) {
            $('#search_results_container').removeClass('results-expanded');
            $('#search_results_table').hide();

            // (only the bottom block had this part — keep it here if this is that block)
            if (!$('#sales_table').closest('.row').find('#totalsBox').length) {
                $('.col-lg-4').append($('#totalsBox'));
            }
            }
        });


        // Enter: if last row valid → add row; otherwise move focus forward
        $(document).off('keypress', '.product_name,.quantity,.price,.total_product_price');
        $(document).on('keypress', '.product_name,.quantity,.price,.total_product_price', function(e) {
            if (e.which === 13) {
            e.preventDefault();
            const row = $(this).closest('tr');
            const inputs = row.find('.product_name, .quantity, .price');
            const idx = inputs.index(this);

            if (typeof isValidRow === 'function' && isValidRow(row)) {
                if (typeof addRow === 'function') addRow();
                return;
            }
            const next = inputs.get(idx + 1);
            if (next) $(next).focus();
            }
        });
        })();

        /* ========= END MOBILE-ONLY JS ========= */

    }); // end document.ready


    (function() {
    // when typing in product_name -> move totals below search table
        $(document).on('input', '.product_name', function() {
            var val = $(this).val().trim();
            if (val !== '') {
            if (!$('#totalsPlaceholder #totalsBox').length) {
                $('#totalsBox').appendTo('#totalsPlaceholder');
            }
            } else {
            if (!$('#sales_table').closest('.row').find('#totalsBox').length) {
                // move back to the original column (col-lg-4)
                $('.col-lg-4').append($('#totalsBox'));
            }
            }
        });

        // also hide search results restores totals
        $(document)
        .off('click touchstart._closeResults')
        .on('click touchstart._closeResults', function(e) {
            if (blockResultsAutoClose) return; // <-- don't close while image modal is open

            const $t = $(e.target);
            const insideResults = $t.closest('#search_results_container').length > 0;
            const insideInput   = $t.closest('.product_name').length > 0;

            if (!insideResults && !insideInput) {
            $('#search_results_container').removeClass('results-expanded');
            $('#search_results_table').hide();

            // (only the bottom block had this part — keep it here if this is that block)
            if (!$('#sales_table').closest('.row').find('#totalsBox').length) {
                $('.col-lg-4').append($('#totalsBox'));
            }
            }
        });

                // helper: handle selection + show/hide delete button
        function selectRowForDelete($row) {
        if (window._lastClickedRow && window._lastClickedRow.length) {
            window._lastClickedRow.removeClass('selected-row');
        }

        if (window._lastClickedRow && window._lastClickedRow.is($row)) {
            // same row tapped again -> unselect
            window._lastClickedRow = null;
            $('#delete_row').hide();
        } else {
            window._lastClickedRow = $row;
            $row.addClass('selected-row');
            $('#delete_row').show();
        }
        }

        // make it work on mobile too (touch/click)
        $(document)
        .off('click touchstart', '#product_rows td:first-child')
        .on('click touchstart', '#product_rows td:first-child', function (e) {
            // avoid competing global handlers swallowing the event
            e.stopPropagation();
            e.preventDefault();

            const $row = $(this).closest('tr');
            selectRowForDelete($row);
        });

});

</script>
</body>
</html>
