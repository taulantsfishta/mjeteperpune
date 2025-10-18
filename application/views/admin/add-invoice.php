<style>
:root{
  --border:#e4e7ea;
  --warn:#ffcfcf;
  --radius:12px;
  --shadow:0 6px 20px rgba(0,0,0,.06);

  /* MAIN table column widths */
  --w-nr:50px;   /* main table NR */
  --w-name:45%;
  --w-code:8%;
  --w-qty:12%;
  --w-price:12%;
  --w-total:12%;
}

/* Main layout */
#mainDiv{
  max-width:1600px;       /* bigger workspace */
  margin:0 auto;
  padding:35px 40px;
  background:#fff;
  font-family: Arial, Helvetica, sans-serif;
  font-size:15px;
}

/* Top form */
.form-grid{
  display:grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap:20px;
  align-items:end;
}
.form-grid label{ font-weight:600; color:#4b5563; font-size:14px; }
.form-grid input{
  width:100%;
  border:1px solid var(--border);
  border-radius:8px;
  padding:10px;
  font-size:15px;
  outline:none;
}

/* Two-column content area */
.content-grid{
  display:grid;
  grid-template-columns: 2fr 1fr;
  gap:20px;
}

/* Tables */
.table{
  width:100%;
  border-collapse:collapse;
  table-layout:fixed;
}
.table th, .table td{
  border:1px solid var(--border);
  padding:8px;
  font-size:15px;
  text-align:left;
  vertical-align:middle;
}
.table th{
  background:#f5f7fb;
  font-weight:700;
}
.table input{
  width:100%;
  border:none;
  border-bottom:1px solid var(--border);
  outline:none;
  font-size:15px;
  padding:5px;
}

/* MAIN table widths ONLY (do NOT target #search_results_table here) */
#sales_table thead th:nth-child(1),
#sales_table tbody td:nth-child(1){ width:var(--w-nr); text-align:center; }
#sales_table thead th:nth-child(2),
#sales_table tbody td:nth-child(2){ width:var(--w-name); }
#sales_table thead th:nth-child(3),
#sales_table tbody td:nth-child(3){ width:var(--w-code); }
#sales_table thead th:nth-child(4),
#sales_table tbody td:nth-child(4){ width:var(--w-qty); }
#sales_table thead th:nth-child(5),
#sales_table tbody td:nth-child(5){ width:var(--w-price); }
#sales_table thead th:nth-child(6),
#sales_table tbody td:nth-child(6){ width:var(--w-total); }

/* Search results: NR centered (width is enforced by <colgroup>) */
#search_results_table thead th:first-child,
#search_results_table tbody td:first-child{
  text-align:center;
  padding:4px 6px;
}

/* Wrappers */
.table-wrap{
  border:1px solid var(--border);
  border-radius:var(--radius);
  overflow:auto;
  box-shadow:var(--shadow);
  background:#fff;
}

/* Search results directly under the main table */
#search_results_container{ margin-top:12px; }
#search_results_table{
  width:100%;
  border-collapse:collapse;
  table-layout:fixed;          /* honors colgroup widths */
  border:1px solid var(--border);
  border-radius:var(--radius);
  overflow:hidden;
  background:#fff;
  display:none;                /* shown by JS when results exist */
}

/* Totals card */
.totals-card{
  border:1px solid var(--border);
  border-radius:var(--radius);
  box-shadow:var(--shadow);
  background:#fff;
  padding:16px;
}
.totals-line{
  display:grid;
  grid-template-columns:1fr 1fr;
  gap:12px;
  margin-bottom:12px;
}
.totals-card input{
  border:1px solid var(--border);
  border-radius:8px;
  padding:8px;
  font-weight:bold;
  font-size:16px;
}

/* Buttons */
.btn{
  border:none;
  border-radius:8px;
  padding:10px 16px;
  font-weight:bold;
  color:#fff;
}
#saveBtn{background:#ff5733;}
#printBtn{background:#7396CE;}
#downloadBtn{background:green;}
#delete_row{background:#ff5e2d;}

.input-error{border:1px solid red !important; background:#ffecec;}
.price-zero-row td,.price-zero-row input{background:var(--warn) !important;}
.selected-row{background:#d1e7dd !important;}

.modal-backdrop { display: none !important; }

/* Preferred: stop stretching all items in the grid row */
.content-grid{
  align-items: start;   /* prevents the right column from matching left column height */
}

/* Extra safety: explicitly keep the totals card at its intrinsic height */
.totals-card{
  align-self: start;
}

/* --- Responsive behavior for totals-card --- */
@media (max-width: 1024px) {
  .content-grid {
    grid-template-columns: 1fr;   /* stack vertically */
  }

  .totals-card {
    margin-top: 20px;             /* spacing from table */
    order: 2;                     /* ensures it stays after the table */
    width: 100%;
  }

  .table-col {
    order: 1;
  }
}


/* --- Equal height for table section and totals-card on desktop --- */
@media (min-width: 1025px) {
  .content-grid {
    align-items: stretch; /* forces both columns to equal height */
  }

  .table-col,
  .totals-card {
    display: flex;
    flex-direction: column;
  }

  .table-wrap {
    flex: 1 1 auto; /* makes the table fill available space */
  }

  #search_results_container {
    flex-shrink: 0; /* keeps search results visible below */
  }
}

/* Buttons section (no border, no card look) */
#sales_form > .row:last-of-type {
  background: transparent;   /* no background box */
  border: none;               /* remove border */
  box-shadow: none;           /* remove shadow */
  border-radius: 0;           /* remove rounding */
  padding: 16px;

  display: flex;
  justify-content: center;    /* center horizontally */
  align-items: center;        /* center vertically */
}

/* Stack buttons vertically and center them */
#sales_form > .row:last-of-type .col-lg-10 {
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 14px;
  width: 100%;
  padding: 0;
}

/* Buttons same width, clean layout */
#sales_form > .row:last-of-type .btn {
  width: 70%;        /* adjust to 80% or 100% if you want wider */
  padding: 14px 0;
  font-size: 15px;
  border-radius: 8px;
  font-weight: bold;
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
          </div>
          <div>
            <label for="address">Adresa:</label>
            <input type="text" id="address" name="address" value="KOSOVE" required>
          </div>
          <div>
            <label for="date">Data:</label>
            <input type="date" id="date" name="date" value="<?= date('Y-m-d') ?>" required>
          </div>
        </div>

        <br>

        <!-- Main content -->
        <div class="content-grid">
          <!-- LEFT: table + search -->
          <div class="table-col">
            <div class="table-wrap">
              <table id="sales_table" class="table table-bordered">
                <colgroup>
                  <!-- NR fixed at ~34px -->
                  <col style="width:38px">
                  <!-- Keep other columns aligned; last column soaks the remaining space so NR never expands -->
                  <col style="width:50%">
                  <col style="width:5%">
                  <col style="width:5%">
                  <col style="width:calc(100% - 38px - 50% - 5% - 5%)">
                </colgroup>
                <thead>
                  <tr>
                    <th >NR</th>
                    <th>EMRI I PRODUKTIT</th>
                    <th>KODI</th>
                    <th>SASIA</th>
                    <th>ÇMIMI</th>
                    <th>TOTALI</th>
                  </tr>
                </thead>
                <tbody id="product_rows">
                  <tr>
                    <td>1</td>
                    <td><input type="text" class="product_name" name="product_name[]" autocomplete="off"></td>
                    <td><input class="code" name="code[]" readonly></td>
                    <td><input type="text" class="quantity" name="quantity[]" autocomplete="off"></td>
                    <td><input type="text" class="price" name="price[]" autocomplete="off"></td>
                    <td><input class="total_product_price" name="total_product_price[]" readonly></td>
                    <td hidden><input type="text" class="image" name="image[]" hidden></td>
                  </tr>
                </tbody>
              </table>
            </div>

            <!-- Search results directly under -->
            <div id="search_results_container">
              <table id="search_results_table" class="table table-bordered">
                <!-- Force a smaller NR only for the search table -->
                <colgroup>
                  <!-- NR fixed at ~34px -->
                  <col style="width:38px">
                  <!-- Keep other columns aligned; last column soaks the remaining space so NR never expands -->
                  <col style="width:50%">
                  <col style="width:10%">
                  <col style="width:10%">
                  <col style="width:calc(100% - 38px - 50% - 10% - 10%)">
                </colgroup>
                <thead>
                  <tr>
                    <th>NR</th>
                    <th>EMRI I PRODUKTIT</th>
                    <th>KODI</th>
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

        <!-- Actions -->
        <div class="row">
          <div class="col-lg-10">
            <button type="submit" id="saveBtn" class="btn" name="submit_type" value="ruaj_faturen"><i class="fa fa-save"></i> RUAJ</button>
            <button type="submit" id="printBtn" class="btn" name="submit_type" value="printo_faturen"><i class="fa fa-edit"></i> PRINTO FATUREN</button>
            <button type="submit" id="downloadBtn" class="btn" name="submit_type" value="printo_faturen_excel"><i class="fa fa-edit"></i> PRINTO EXCEL</button>
            <button type="button" id="delete_row" class="btn" style="display:none;"><i class="fa fa-trash"></i> FSHIJ RRESHTAT</button>
          </div>
        </div>

      </form>
    </div>
  </div>
</div>


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
        var rowIdx = 1;
        var lastClickedRow = null;
        var prepayment;
        var totalSum;
        
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
                            <td class="table-col-34">${_.escape(result.name)}</td>
                            <td class="table-col-12">${result.code}</td>
                            <td class="table-col-12">0</td>
                            <td class="table-col-12">${result.price}</td>
                            <td style="display:none;" class="table-col-12" hidden>${result.image}</td>
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
                    row.find('.quantity').focus().select();

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
            console.log('123')
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
            if (priceVal === '' || isNaN(priceNum) ) {
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

    });

</script>