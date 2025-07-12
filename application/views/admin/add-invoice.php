<style>
        /* body {
            zoom: 90%;
        } */

        #mainDiv{
            zoom: 83%
        }
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

        .table-col-7 { width: 7%; }
        .table-col-33 { width: 35%; }
        .table-col-12 { width: 12%; }
        .table-col-36 { width: 41%; }
        
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
</style>
<div class="row" id='mainDiv'>
    <div class="col-lg-12">
        <div class="white-box" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">
            <form id="sales_form" method="post" action="<?php echo base_url('admin/invoices/sheet_invoice/'); ?>" target="_blank" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-3">
                        <label for="client_name">Emri I Klientit:</label>
                        <input type="text" id="client_name" name="client_name" autocomplete="off" value="QYTETAR" required><br><br>
                    </div>
                    <div class="col-lg-3">
                        <label for="address">Adresa:</label>
                        <input type="text" id="address" name="address" value="KOSOVE" autocomplete="off" required><br><br>
                    </div>
                    
                    <div class="col-lg-3">
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
                                    <th class="table-col-5">#</th>
                                    <th class="table-col-35">EMRI I PRODUKTIT</th>
                                    <th class="table-col-12">KODI</th>
                                    <th class="table-col-12">SASIA</th>
                                    <th class="table-col-12">ÇMIMI</th>
                                    <th class="table-col-12">CMIMI TOTAL I PRODUKTIT</th>
                                </tr>
                            </thead>
                            <tbody id="product_rows">
                                <tr>
                                    <td class="table-col-7">1</td>
                                    <td class="table-col-33"><input type="text" class="product_name" name="product_name[]" autocomplete="off"></td>
                                    <td class="table-col-12"><input class="code" name="code[]" readonly></td>
                                    <td class="table-col-12"><input type="text" class="quantity" name="quantity[]" autocomplete="off"></td>
                                    <td class="table-col-12"><input type="text" class="price" name="price[]" autocomplete="off"></td>
                                    <td class="table-col-12"><input class="total_product_price" name="total_product_price[]" readonly></td>
                                    <td hidden><input type="text" class="image" name="image[]" hidden></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="totals-section-box col-lg-4">
                        <div class="totals-line">
                            <label><strong>TOTALI</strong></label>
                            <input type="text" id="total_price_invoice" name="total_price_invoice" readonly>
                        </div>
                        <div class="totals-line">
                            <label><strong>PARAPAGESE</strong></label>
                            <input type="text" id="prepayment_price_invoice" name="prepayment_price_invoice">
                        </div>
                        <div class="totals-line">
                            <label><strong>SHUMA E MBETUR</strong></label>
                            <input type="text" id="total_price_left_invoice" name="total_price_left_invoice" readonly>
                        </div>    
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-8">
                        <div id="search_results_container">
                            <table id="search_results_table" class="table table-bordered" style="display: none;border: 1px solid #e4e7ea;">
                                <thead>
                                    <tr>
                                        <th class="table-col-5">NR <i class="fa fa-sort p-r-10" aria-hidden="true"></i></th>
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
                <br><br>
                <div class="row">
                    <div class="col-lg-8"><textarea name="comment" id="comment" style="width:100%;height:90px;font-size:16px;" placeholder="Koment" autocomplete="off"></textarea></div>
                </div>
                <br>
                <div class="row">    
                    <div class="col-lg-10">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <button type="submit" id="saveBtn"  class="btn" name="submit_type" style="color:white;background:#ff5733;width:170px;font-weight:bold;font-family: Arial, Helvetica, sans-serif;" value="ruaj_faturen"><i class="fa fa-save"></i> RUAJ</button>
                        <button type="submit" id="printBtn" class="btn" name="submit_type" style="color:white;background:#7396CE;font-weight: bold;font-family: Arial, Helvetica, sans-serif;" value="printo_faturen"><i class="fa fa-edit"></i> PRINTO FATUREN</button>
                        <button type="submit" id="downloadBtn"  class="btn" name="submit_type" style="color:white;background:green;font-weight:bold;font-family: Arial, Helvetica, sans-serif;" value="printo_faturen_excel"><i class="fa fa-edit"></i> PRINTO EXCEL</button>
                        <button type="button" class="btn" id="delete_row" style="display: none;background:#ff5e2dcc;"><i class="fa fa-trash"></i> FSHIJ RRESHTAT</button>
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
                updateTotalSum(); // Update total sum
            }
        }

        // Function to calculate total product price
        function calculateTotalPrice(row) {
            $('#prepayment_price_invoice').val('')
            $('#total_price_left_invoice').val('')

            var quantity = parseFloat(row.find('.quantity').val()) || 0;
            var price = parseFloat(row.find('.price').val()) || 0;
            var total = quantity * price;

            // If quantity or price is zero, ensure total is zero
            if (quantity === 0 || price === 0) {
                total = 0;
            }

            row.find('.total_product_price').val(total.toFixed(2)); // Update total product price
            updateTotalSum(); // Update total sum

            if (price === 0) {
                row.addClass('price-zero-row');
            } else {
                row.removeClass('price-zero-row');
            }
        }

        // Function to update the total sum
        function updateTotalSum() {
            $('#prepayment_price_invoice').val('')
            $('#total_price_left_invoice').val('')

            totalSum = 0;
            $('#sales_table tbody tr').each(function() {
                var total = parseFloat($(this).find('.total_product_price').val()) || 0;
                totalSum += total;
            });
            $('#total_price_invoice').val(totalSum.toFixed(2));
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
                    if (parseFloat(price) === 0) {
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
                    updateTotalSum(); // Update total sum
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
              const isPriceValid = price !== '' && !isNaN(priceNum) && priceNum >= 0;
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

            if (price === '' || isNaN(priceNum) || priceNum < 0) {
                errors.push(`Rreshti ${rowIndex}: Çmimi duhet të jetë ≥ 0 dhe numër i vlefshëm.`);
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
            if (priceVal === '' || isNaN(priceNum) || priceNum < 0) {
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

                 if (price === '' || isNaN(priceNum) || priceNum < 0) {
                     errorMessages.push(`Rreshti ${index + 1}: Çmimi duhet të jetë ≥ 0.`);
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