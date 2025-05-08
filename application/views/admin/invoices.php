<style>

    tbody, td, tfoot, th, thead, tr {
    border-color: inherit;
    border-style: solid;
    border-width: medium;
}

.table-hover > tbody > tr:hover {
  background-color: #7395b3;
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

textarea:focus, input:focus{
    outline: none;
}

.selected-row {
    background-color: #d1e7dd !important;
}

.table-col-7 { width: 7%; }
.table-col-33 { width: 33%; }
.table-col-12 { width: 12%; }
.table-col-36 { width: 41%; }
.table-col-20 { width: 20%; }

#total_price{
    border-right: none;
}

#total_price_invoice{
    border-top: none;
    border-right: none;
    border-left: none;
    width: 100%;
    border-bottom: 1px solid #e4e7ea;;
}

#total_price_invoice_name{
    border-right: none;
}
#prepayment_price_invoice{
    border-top: none;
    border-right: none;
    border-left: none;
    width: 100%;
    border-bottom: 1px solid #e4e7ea;;
}

#prepayment_price_invoice_name{
    border-right: none;
}
#total_price_left_invoice{
    border-top: none;
    border-right: none;
    border-left: none;
    width: 100%;
    border-bottom: 1px solid #e4e7ea;;
}

#total_price_left_invoice_name{
    border-right: none;
}
#search_results_container {
            width: 100%;
            height: auto;
            overflow-y: auto;
            transition: height 0.3s ease-in-out;
}
</style>
<div class="row" id='invoicesStructure'>
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
                <th class="table-col-20">KLIENTI</th>
                <th class="table-col-20">ADRESA</th>
                <th class="table-col-12">TOTALI</th>
                <th class="table-col-12">DATA E KRIJIMIT</th>
                <th class="table-col-7">VEPRIMI</th>
            </tr>
            </thead>
            <tbody id="invoicesStructureBody">
            <?php if(isset($invoicesCreated)) { ?>
                    <?php foreach ($invoicesCreated as $key => $value) { ?>
                    <tr data-id="<?php echo $value['id']; ?>">
                        <td  class="table-col-7"><?php echo $adminName.'-'.$value['id']; ?></td>
                        <td class="table-col-20"><?php echo htmlspecialchars($value['client_name']); ?></td>
                        <td class="table-col-20"><?php echo htmlspecialchars($value['address']); ?></td>
                        <td class="table-col-12"><?php echo htmlspecialchars($value['total_price_invoice']); ?></td>
                        <td class="table-col-12"><?php echo htmlspecialchars($value['created_at']); ?></td>
                        <td class="table-col-7"><a href="<?php echo base_url('admin/invoices/delete_inovice/' . $value['id']); ?>" data-toggle="modal" data-target="#confirmDeleteModal" data-invoiceid="<?php echo $value['id']; ?>"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="icon-trash"></i></button></a></td>
                    </tr>
                    <?php } ?>
                <?php } ?>
            </tbody>
        </table>
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
                <button type="button" class="btn btn-info" style="color:white;background:#7396CE;"  id="backButton"><i class="fa fa-arrow-left"></i> Kthehu</button>
            </div>
        </div>
        <div class="white-box" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">
            <!-- Form to display the detailed invoice data -->
            <form id="sales_form" method="post" action="<?php echo base_url('admin/invoices/sheet_invoice/'); ?>" target="_blank" enctype="multipart/form-data">
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
                            <tfoot>
                                <tr >
                                    <td colspan="5" id="total_price_invoice_name" style="text-align: left;"><strong><b>TOTALI</b></strong></td>
                                    <td><input type="text" id="total_price_invoice" name="total_price_invoice" readonly></td>
                                <tr >   
                                <tr>                                 
                                    <td colspan="5" id="prepayment_price_invoice_name" style="text-align: left;"><strong><b>PARAPAGESE</b></strong></td>
                                    <td><input type="text" id="prepayment_price_invoice" name="prepayment_price_invoice"></td>
                                </tr>
                                <tr>
                                    <td colspan="5" id="total_price_left_invoice_name" style="text-align: left;"><strong><b>SHUMA E MBETUR</b></strong></td>
                                    <td><input type="text" id="total_price_left_invoice" name="total_price_left_invoice" readonly></td>
                                </tr>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-2"></div>
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
                <br><br>
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8"><textarea name="comment" id="comment" style="width:100%;height:90px;" placeholder="Koment"></textarea></div>
                </div>
                <br>
                <div class="row">    
                    <div class="col-lg-2"></div>
                    <div class="col-lg-10">
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <button type="submit" id="printBtn" class="btn" name="submit_type" style="color:white;background:#7396CE;" value="printo_faturen"><i class="fa fa-edit"></i> PRINTO FATUREN</button>
                        <button type="submit" id="downloadBtn" class="btn" name="submit_type" style="color:white;background:green;" value="printo_faturen_excel"><i class="fa fa-edit"></i> PRINTO EXCEL</button>
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
                <p style="color:red;font-size:15px;">Te gjitha kolonat duhet te jene te plotesuara!</p>
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
    var prepayment;
    var totalSum;

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
    }

    $(document).on('input', '#prepayment_price_invoice', function() {
        var row = $(this).closest('tr');
        var prepaymentVal = row.find('#prepayment_price_invoice').val().trim();
        
        // Convert to a number only if it's not empty
        var prepayment = prepaymentVal === "" ? 0 : parseFloat(prepaymentVal) || 0;

        var totalSumNew = $('#total_price_invoice').val() - prepayment;

        $('#total_price_left_invoice').val(totalSumNew.toFixed(2));

        // If input is empty, keep it empty instead of showing 0
        if (prepaymentVal === "" || $('#total_price_invoice').val() < prepayment) {
            row.find('#prepayment_price_invoice').val("");
            $('#total_price_left_invoice').val("");

        }
    });

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
        tableBody.empty(); // Clear existing results

        if (results.length > 0) {
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
                var id = selectedProduct.data('id');
                var image = selectedProduct.data('image');

                // Populate the corresponding fields in the main table row
                row.find('.product_name').val(productName);
                row.find('.code').val(code);
                row.find('.price').val(price);
                row.find('.quantity').val(quantity);
                row.find('.total_product_price').val(total_product_price);
                row.find('.id').val(id);
                row.find('.image').val(image);



                // Focus on the quantity input field
                row.find('.quantity').focus().select();

                // Hide the search results table after selection
                $('#search_results_table').hide();
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
    $(document).on('keypress', '.product_name,.quantity,.price,.total_product_price,.image', function(e) {
        if (e.which == 13) { // Enter key pressed
            e.preventDefault();

            // Check if the last row's product_name, price, and quantity are not empty
            var lastRow = $('#product_rows tr').last();
            var productName = lastRow.find('.product_name').val().trim();
            var price = lastRow.find('.price').val().trim();
            var quantity = lastRow.find('.quantity').val().trim();
            var total_product_price = lastRow.find('.total_product_price').val().trim();
            var image = lastRow.find('.image').val().trim();

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
                if ($(this).is('[type="hidden"]') || $(this).hasClass('image') || $(this).attr('name') === 'image') {
                    return; // continue to next input
                }
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
        console.log('123');

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
        $("#invoiceTableData").hide();
        $("#invoicesStructure").show();
  });

  // Event listener for clicking on a row to load invoice details
  $("#invoiceData").on("click", "tr", function(e) {
    if (e.target.tagName === 'TD' || e.target.tagName === 'TR') { // Ensure click is on row or cell, not child elements like buttons
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
                var row = `<tr>
                    <td>${index + 1}</td>
                    <td><input type="text" class="product_name" name="product_name[]" value="${_.escape(product.product_name)}"></td>
                    <td><input type="text" class="code" name="code[]" value="${product.code}"></td>
                    <td><input type="text" class="quantity" name="quantity[]" value="${product.quantity}"></td>
                    <td><input type="text" class="price" name="price[]" value="${product.price}"></td>
                    <td><input type="text" class="total_product_price" name="total_product_price[]" value="${product.total_product_price}"></td>
                    <td style="display:none;"><input type="text" class="id" name="id" value="${invoiceId}" hidden></td>
                    <td style="display:none;"><input type="text" class="image" name="image[]" value="${(product.image)}" hidden></td>
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

</script>
<script>
    document.getElementById('downloadBtn').addEventListener('click', function () {
        // Start redirect timer on current page
        setTimeout(function () {
            window.location.reload();
        }, 3000); // Adjust time if needed
    });

    document.getElementById('printBtn').addEventListener('click', function () {
        // Start redirect timer on current page
        setTimeout(function () {
            window.location.reload();
        }, 2000); // Adjust time if needed
    });
</script>