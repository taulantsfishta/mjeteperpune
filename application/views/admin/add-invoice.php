<style>
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

        textarea:focus, input:focus{
            outline: none;
        }

        .selected-row {
            background-color: #d1e7dd !important;
        }

        .table-col-5 { width: 5%; }
        .table-col-35 { width: 35%; }
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
        }

        #total_price_invoice_name{
            border-right: none;
        }
        #search_results_container {
            width: 100%;
            height: auto;
            overflow-y: auto;
            transition: height 0.3s ease-in-out;
        }
</style>
<div class="row">
    <div class="col-lg-12">
        <div class="white-box" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">
            <form id="sales_form" method="post" action="<?php echo base_url('admin/invoices/sheet_invoice/'); ?>" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-3">
                        <label for="client_name">Emri I Klientit:</label>
                        <input type="text" id="client_name" name="client_name" autocomplete="off" required><br><br>
                    </div>
                    <div class="col-lg-3">
                        <label for="address">Adresa:</label>
                        <input type="text" id="address" name="address" autocomplete="off" required><br><br>
                    </div>
                    
                    <div class="col-lg-3">
                        <label for="date">Data:</label>
                        <input type="date" id="date" name="date" value="<?= date('Y-m-d') ?>" required>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-lg-2"></div>
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
                                    <td class="table-col-5">1</td>
                                    <td class="table-col-35"><input type="text" class="product_name" name="product_name[]" autocomplete="off"></td>
                                    <td class="table-col-12"><input class="code" name="code[]" readonly></td>
                                    <td class="table-col-12"><input type="text" class="quantity" name="quantity[]" autocomplete="off"></td>
                                    <td class="table-col-12"><input type="text" class="price" name="price[]" autocomplete="off"></td>
                                    <td class="table-col-12"><input class="total_product_price" name="total_product_price[]" readonly></td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr >
                                    <td colspan="5" id="total_price_invoice_name" style="text-align: left;"><strong><b>TOTALI</b></strong></td>
                                    <td><input type="text" id="total_price_invoice" name="total_price_invoice" readonly></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2"></div>
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
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8"><textarea name="comment" id="comment" style="width:100%;height:90px;" placeholder="Koment" autocomplete="off"></textarea></div>
                </div>
                <br>
                <div class="row">    
                    <div class="col-lg-2"></div>
                    <div class="col-lg-10">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <button type="submit" class="btn" style="color:white;background:#7396CE;" ><i class="fa fa-edit"></i> PRINTO FATUREN</button>
                        <button type="button" class="btn" id="delete_row" style="display: none;background:#ff5e2dcc;"><i class="fa fa-trash"></i> FSHIJ RRESHTAT</button>
                    </div>              
                </div>
            </form>
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
            <div class="modal-body">
                <p style="color:red;font-size:15px;">Te gjitha kolonat duhet te jene te mbushura!</p>
            </div>
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


<script>
window.base_url = <?php echo json_encode(base_url()); ?>;
$(document).ready(function() {
    var rowIdx = 1;
    var lastClickedRow = null;

    // Function to add a new row to the main table (#sales_table)
    function addRow() {
        if ($('.product_name').last().val() !== '') {
            rowIdx++;
            $('#product_rows').append(`
                <tr>
                    <td class="table-col-5">${rowIdx}</td>
                    <td class="table-col-35"><input type="text" class="product_name" name="product_name[]" autocomplete="off"></td>
                    <td class="table-col-12"><input class="code" name="code[]" readonly></td>
                    <td class="table-col-12"><input type="text" class="quantity" name="quantity[]" autocomplete="off"></td>
                    <td class="table-col-12"><input type="text" class="price" name="price[]" autocomplete="off"></td>
                    <td class="table-col-12"><input class="total_product_price" name="total_product_price[]" readonly></td>
                </tr>
            `);
            $('#product_rows').find('.product_name').last().focus();
            updateRowNumbers(); // Update row numbers
            updateTotalSum(); // Update total sum
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
        updateTotalSum(); // Update total sum
    }

    // Function to update the total sum
    function updateTotalSum() {
        var totalSum = 0;
        $('#sales_table tbody tr').each(function() {
            var total = parseFloat($(this).find('.total_product_price').val()) || 0;
            totalSum += total;
        });
        $('#total_price_invoice').val(totalSum.toFixed(2));
    }

    // Event listener for quantity and price changes
    $(document).on('input', '.quantity, .price', function() {
        var row = $(this).closest('tr');
        calculateTotalPrice(row);
    });

    // Event listener for adding row button
    $('#add_row').click(function() {
        addRow();
    });

    // Event listener for dynamically fetching product details based on product_name input
    $(document).on('input', '.product_name', function() {
        var productName = $(this).val(); // Trim to remove any leading/trailing whitespace
        var encodedProductName = encodeURIComponent(productName);
        var row = $(this).closest('tr');

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
                    <tr tabindex="0" data-product-name="${_.escape(result.name)}" data-code="${result.code}" data-quantity="0" data-price="${result.price}" data-total-product-price="0" data-total-price-invoice="0" data-image=${window.base_url+'optimum/products_images/'+result.image}>
                        <td class="table-col-5">${index+1}</td>
                        <td class="table-col-36">${_.escape(result.name)}</td>
                        <td class="table-col-12">${result.code}</td>
                        <td class="table-col-12">0</td>
                        <td class="table-col-12">${result.price}</td>
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
                }
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

                // Populate the corresponding fields in the main table row
                row.find('.product_name').val(productName);
                row.find('.code').val(code);
                row.find('.price').val(price);
                row.find('.quantity').val(quantity);
                row.find('.total_product_price').val(total_product_price);
                row.find('.total_price_invoice').val(total_price_invoice);

                // Focus on the quantity input field
                row.find('.quantity').focus();

                // Hide the search results table after selection
                $('#search_results_table').hide();
            });

            $("#search_results_body tr td.table-col-5").hover(
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
            
            $("#search_results_body tr td.table-col-5").hover(function() {
                $(this).fadeOut(100);
                $(this).fadeIn(500);
            });
        } else {
            // Hide the search results table if no results found
            $('#search_results_table').hide();
        }
    }

    // // Form submission prevention
    // $('#sales_form').submit(function(event) {
    //     event.preventDefault();
    //     // Handle form submission here, possibly via AJAX
    // });

    // Event listener for adding a new row when Enter key is pressed in product_name input
    $(document).on('keypress', '.product_name,.quantity,.price,.total_product_price', function(e) {
        if (e.which == 13) { // Enter key pressed
            e.preventDefault();

            // Check if the last row's product_name, price, and quantity are not empty
            var lastRow = $('#product_rows tr').last();
            var productName = lastRow.find('.product_name').val().trim();
            var price = lastRow.find('.price').val().trim();
            var quantity = lastRow.find('.quantity').val().trim();
            var total_product_price = lastRow.find('.total_product_price').val().trim();
            if (productName !== '' && price !== '' && quantity !== '') {
                addRow();
            } else {
                $('#noRowAdded').modal('show'); // Show the modal if fields are empty
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
        // Check if all fields are filled before submitting the form
        var allFilled = true;
        $('#sales_table tbody tr').each(function() {
            $(this).find('input').each(function() {
                if ($(this).val() === '') {
                    allFilled = false;
                    return false; // Exit the each loop
                }
            });
            if (!allFilled) {
                return false; // Exit the each loop
            }
        });

        if (!allFilled) {
            $('#noRowAdded').modal('show');
            event.preventDefault(); // Prevent form submission
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

});
</script>





