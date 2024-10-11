        <style>
        /* Insert the updated CSS here */
        #searchContainer {
            position: sticky;
            top: 12px;
            z-index: 999;
            background-color: white;
            width: 100%;
            padding-right: 0px;
            padding-left: 0px;
            margin-right: auto;
            margin-left: auto;
            margin-bottom: 20px; /* Add bottom margin for spacing */
            margin-top:35px;
            display: flex;
            align-items: center;
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
            transition: box-shadow 0.3s ease;
        }

        #searchContainer.focused {
            box-shadow: 0 0 10px rgba(0, 123, 255, 0.5);
        }

        .dropdown-toggle {
            border-color: #fff;
            border-top: none;
            border-right: none;
            border-left: none;
            width: 100%;
        }

        .dropdown-menu {
            width: 100%;
        }

        .product-card.selected {
            background-color: lightblue; /* Change this to the desired color */
        }

        #selectedProductsButtonContainer {
            position: fixed;
            bottom: 20px;
            left: 60%;
            transform: translateX(-50%);
            z-index: 1000;
            display: none;
        }

        svg {
            display: none;
        }

        [role="search"] {
            box-sizing: border-box;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, .5);
            border-radius: 1em;
            padding: 0;
            max-width: 100em;
            height: 34px;
        }

        [role="search"] label {
            display: inline-block;
            width: 0;
            overflow: hidden;
            text-indent: -1000px;
            margin: 0;
        }

        input::-webkit-input-placeholder {
            color: #757575;
        }

        input:-ms-input-placeholder {
            color: #757575;
        }

        input::-moz-placeholder {
            color: #757575;
        }

        input[type="text"] {
            border-radius: .5em;
            border: 0.1em solid #666;
            padding: .5em .75em;
            font-family: Lato, Arial, sans-serif;
            font-size: 100%;
        }

        [role="search"] input[type="text"] {
            border: none;
            background-color: transparent;
            width: 100%;
            padding: .5em 1em;
            font-size: 18px;
            font-family: Lato, Arial, sans-serif;
            border-radius: 20px 0 0 20px;
            box-sizing: border-box;
            transition: box-shadow 0.3s ease;
        }

        [role="search"] button {
            background: transparent;
            cursor: pointer;
            border: none;
            padding: .5em;
            border-radius: 0 20px 20px 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        [role="search"] button svg {
            display: block;
            margin: 0 auto;
            fill: #666;
            width: 100%;
            height: auto;
        }

        [role="search"] button:hover, [role="search"] button:focus {
            outline: none;
        }

        [role="search"] button:hover svg, [role="search"] button:focus svg {
            fill: #7396CE;
        }

        [role="search"] input[type="text"]:focus {
            outline: none;
            box-shadow: none;
        }

        [role="search"] button i {
            color: #666;
            transition: color 0.3s ease;
            font-size: 1.2em;
        }

        [role="search"] button:hover i, 
        [role="search"] button:focus i {
            color: #7396CE;
        }
        </style>

        <?php if ($this->session->userdata('role') == 'admin') : ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-5"></div>
                    <div class="col-lg-3">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background:#7396CE;">
                                <i class="fa fa-print"></i> Aktivizo Printimin
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" id="printOption" onClick="onClickButton('print')" style="font-size:13px;"><i class="fa fa-print"></i> Printo</a></li>
                                <li><a class="dropdown-item" id="selectOption" onClick="onClickButton('select')" style="font-size:13px;"><i class="fa fa-check" aria-hidden="true"></i> Selekto</a></li>
                                <li><a class="dropdown-item" id="cancelOption" onClick="onClickButton('cancel')" style="font-size:13px;"><i class="fa fa-times" aria-hidden="true"></i> Anulo Printimin</a></li>
                            </ul>
                        </div>
                    </div>
                    <br/>
                    <div class="col-lg-3 mb-3 mb-lg-0">
                        <a href="<?php echo base_url('admin/products/add/' . $category['id']); ?>"> 
                            <button type="submit" class="btn btn-block" style="background:#ffcd35;"> 
                                <i class="fa fa-plus"></i>&nbsp;&nbsp;Shto Produktin
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif ?>

        <div role="search" id="searchContainer">
            <label for="s1">Search for:</label>
            <input type="text" id="searchInput" placeholder="Kerko...">
            <button aria-label="Do search" id="searchIcon">
                <i class="fa fa-search"></i>
            </button>
        </div>

        <div class="col-md-12">
            <hr>
        </div>

        <!-- /.usercard -->
        <div class="row el-element-overlay m-b-40" id="productListing">
            <?php foreach ($products as $key => $value) { ?>
                <div class="col-md-12 col-lg-4 mb-4 mb-lg-0" id="mainDiv">
                    <div class="card product-card" data-product-id-main="<?php echo $value['id']; ?>" style="margin-bottom: 10px;">
                        <img id="imageresource_<?php echo $key; ?>" imgId="<?php echo $key; ?>" style="margin-left: auto;margin-right: auto;display: block;width:90px;height:70px;" src="<?php echo base_url(); ?>optimum/products_images/<?php echo $value['image']; ?>" class="img-fluid"  />
                            <div class="col-md-12 col-lg-4 mb-4 mb-lg-0" id="product_<?php echo $value['id']; ?>">
                                <!-- Product content -->
                            </div>
                        <div class="card-body" >
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="mb-0">Kodi:</h5>
                                <h5 class="text-dark mb-0"><b><?php echo $value['code']; ?></b></h5>
                            </div>
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="mb-0">Përshkrimi:</h5>
                                    <h5 class="text-dark mb-0" style="margin-left: 10px;"><b><?php echo htmlspecialchars($value['name']); ?></b></h5>
                            </div>
                            <?php if ($this->session->userdata('price_status') == 1) : ?>
                                <div class="d-flex justify-content-between mb-3">
                                    <h5 class="mb-0">Çmimi:</h5>
                                    <h5 class="text-dark mb-0"><b><?php echo $value['price']; ?><i class="fa fa-euro"></i></b></h5>
                                </div>
                            <?php endif ?>
                            <?php if ($this->session->userdata('role') == 'admin') : ?>
                                <a href="<?php echo base_url('admin/products/get_product/' . $value['id']); ?>" style="color:white;margin-right: 0px;"><button class="btn btn-block" style="background:#53d1b2;" id="editButton_<?php echo $value['id']; ?>"><i class="fa fa-edit"></i> Ndrysho Produktin</button></a>
                                <br>
                                <a href="<?php echo base_url('admin/products/delete_product/' . $category['id'] . '/' . $value['id']); ?>" style="color:white;margin-right: 0px;" data-toggle="modal" data-target="#confirmDeleteModal" data-productid="<?php echo $value['id']; ?>" data-categoryid="<?php echo $category['id']; ?>" id="deleteButton_<?php echo $value['id']; ?>"><button class="btn btn-block" style="background:#ff5e2dcc;"><i class="fa fa-trash"></i> Fshije Produktin</button></a>
                                <br>
                                <a href="<?php echo base_url('admin/printproduct/print_one_product/'. $value['id']); ?>" style="color:white;margin-right: 0px;display:none;background:#7396CE;" id="printButton_<?php echo $value['id']; ?>"><button class="btn btn-block"><i class="fa fa-print"></i> Printo Produktin</button></a>
                            <?php endif ?>
                        </div>
                    </div>
                </div>
                <div class="modal" id="imagemodal_<?php echo $key; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header d-flex justify-content-between align-items-center">
                                    <h4 class="modal-title" id="myModalLabel"><?php echo htmlspecialchars($value['name']); ?></h4>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="<?php echo base_url(); ?>optimum/products_images/<?php echo $value['image']; ?>" id="imagepreview_<?php echo $key; ?>" style="margin-left: auto;margin-right: auto;display: block;width:270px;height:220px;">
                                </div>
                            </div>
                        </div>
                </div>
            <?php } ?>
            <div class="col-md-12 col-lg-4 mb-4 mb-lg-0" id="selectedProductsButtonContainer" >
                <button id="gatherSelectedProductsBtn" class="btn" style="background:#7396CE;"><span><i class="fa fa-print" aria-hidden="true"></i> PRINTO PRODUKTET</span></button>
            </div>
        </div>

        <div class="modal" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmo</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        A jeni i sigurt qe deshironi te fshini kete produkt?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Jo</button>
                        <a id="deleteProductLink" href="#" class="btn btn-danger">Fshije</a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            var productsList = <?php echo json_encode($products); ?>;
            document.addEventListener("DOMContentLoaded", function() {
                const searchInput = document.getElementById("searchInput");
                const searchIcon = document.getElementById("searchIcon");
                const productListing = document.getElementById("productListing");
                window.base_url = <?php echo json_encode(base_url()); ?>;
                const url = window.base_url;
                
                //go to the updated product after redirect from page edit-product
                const urlParams = new URLSearchParams(window.location.search);
                const updatedProductId = urlParams.get('updated_product_id');
            
                // var productJS = <?php echo json_encode($products); ?>;

                // Scroll to the updated product if the product ID is available
                if (updatedProductId) {
                    const updatedProductElement = document.getElementById(`product_${updatedProductId}`);
                    if (updatedProductElement) {
                        updatedProductElement.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                }

                // Attach click event listener to the search icon
                searchIcon.addEventListener("click", performSearch);

                // Attach keydown event listener to the search input
                searchInput.addEventListener("keydown", function(event) {
                    if (event.key === "Enter") {
                        performSearch();
                    }
                });

                function performSearch() {
                    const searchQuery = searchInput.value;
                    if (searchQuery.trim() === "") {
                        window.location.href = url + `admin/dashboard/get_category/<?php echo $category['id']; ?>`;
                    } else {
                        searchProducts(searchQuery);
                    }
                }

                function searchProducts(query) {
                    const xhr = new XMLHttpRequest();
                    xhr.open("GET", url + `admin/dashboard/search_products_by_category/<?php echo $category['id']; ?>/?query=${query}`, true);

                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            if(xhr.responseText.length <2){
                                window.location.href = url + `admin/dashboard/`;
                            }else{
                                const response = JSON.parse(xhr.responseText);
                                updateProductListing(response.products, response.category_id, query);
                                productsList = response.products;
                                if(stateDropdown == 'print'){
                                    onClickButton('print');
                                }else if(stateDropdown == 'select'){
                                    onClickButton('select');
                                }else{
                                    onClickButton('cancel');
                                }
                            }
                        }
                    };
                    xhr.send();
                }

                function updateProductListing(products, category_id, query) {
                    var priceStatus = "<?php echo $_SESSION['price_status']; ?>";
                    var role = "<?php echo $_SESSION['role']; ?>";
                    searchInput.value = query;
                    const productListing = document.getElementById("productListing");
                    productListing.innerHTML = "";
                    if (products.length > 0) {
                        products.forEach(product => {
                            const productCard = `
                                            <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                                                <div class="card product-card" data-product-id-main=${product.id} style="margin-bottom: 10px;">
                                                    <img id="imageresource_${product.id}" imgId=${product.id} style="margin-left: auto;margin-right: auto;display: block;width:90px;height:70px;" src="${url}optimum/products_images/${product.image}" class="img-fluid" />
                                                    <div class="card-body" >
                                                        <div class="d-flex justify-content-between mb-3">
                                                            <h5 class="mb-0">Kodi:</h5>
                                                            <h5 class="text-dark mb-0"><b>${product.code}</b></h5>
                                                        </div>
                                                        <div class="d-flex justify-content-between mb-3">
                                                            <h5 class="mb-0">Përshkrimi:</h5>
                                                            <h5 class="text-dark mb-0" style="margin-left:10px;"><b>${product.name}</b></h5>
                                                        </div>
                                                        ${priceStatus == 1 ? `
                                                        <div class="d-flex justify-content-between mb-3">
                                                            <h5 class="mb-0">Çmimi:</h5>
                                                            <h5 class="text-dark mb-0"><b>${product.price}<i class="fa fa-euro"></i></b></h5>
                                                        </div>
                                                        ` : ''}
                                                        ${role == 'admin' ? `
                                                            <a href=${url}admin/products/get_product/${product.id} style="color:white;margin-right: 0px;" id=editButton_${product.id}><button class="btn btn-block" style="background:#53d1b2;"><i class="fa fa-edit"></i> Ndrysho Produktin</button></a>
                                                        <br>` : ''}
                                                        ${role == 'admin' ? `
                                                            <a href=${url}admin/products/delete_product/${category_id}/${product.id} style="color:white;margin-right: 0px;" data-toggle="modal" data-target="#confirmDeleteModal" style="background:#ff5e2dcc;" data-productid=${product.id} data-categoryid=${category_id} id=deleteButton_${product.id}><button class="btn btn-block" style="background:#ff5e2dcc;"><i class="fa fa-trash"></i> Fshije Produktin</button></a>
                                                        <br>` : ''}
                                                        ${role == 'admin' ? `
                                                            <a href=${url}admin/printproduct/print_one_product/${product.id} style="color:white;margin-right: 0px;display:none;background:#7396CE;" id=printButton_${product.id}><button class="btn btn-block"><i class="fa fa-print"></i> Printo Produktin</button></a>
                                                        ` : ''}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal" id="imagemodal_${product.id}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header border-0">
                                                            <div class="modal-header d-flex justify-content-between align-items-center">
                                                                <h4 class="modal-title" id="myModalLabel">${product.name}</h4>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="${url}optimum/products_images/${product.image}" id="imagepreview_${product.id}" style="margin-left: auto;margin-right: auto;display: block;width:270px;height:220px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        `;
                            productListing.innerHTML += productCard;
                        });
                    } else {
                        productListing.innerHTML += `<h4 class="page-title" style="color:rgba(0,0,0,.5);font-weight:600; margin-left:26px;">Produkti nuk u gjend!</h4>`;
                    }

                    productListing.innerHTML += ` <div class="col-md-12 col-lg-4 mb-4 mb-lg-0" id="selectedProductsButtonContainer" >
                                                    <a href="#" onclick="foo(event)"><button class="btn btn-primary" style="background:#7396CE;"><span><i class="fa fa-print" aria-hidden="true"></i> PRINTO PRODUKTET</span></button></a>
                                                  </div>
                                                </div>`;
                    window.scrollTo(0, 0);
                }
            });

            $(document).ready(function() {
                // Listen for the modal's "Delete" button click event
                $('#confirmDeleteModal').on('show.bs.modal', function(e) {
                    var productID = $(e.relatedTarget).data('productid'); // Get the product ID
                    var categoryID = $(e.relatedTarget).data('categoryid'); // Get the product ID
                    var deleteButton = $(this).find('#deleteProductLink'); // Get the "Delete" button in the modal

                    // Update the "Delete" button link with the appropriate product ID
                    deleteButton.attr('href', '<?php echo base_url("admin/products/delete_product/"); ?>' + categoryID + '/' + productID);
                });
            });
            
            document.getElementById("productListing").addEventListener("click", function(event) {
                    // Check if the clicked element has the class "img-fluid"
                    if (event.target.classList.contains("img-fluid")) {
                        var fullid = event.target.getAttribute('imgId');
                        $('#imageresource_' + fullid).attr('src', $('#imagepreview_' + fullid).attr('src'));
                        $('#imagemodal_' + fullid).modal('show');
                    }
                });

                $(".img-fluid").on("click", function() {
                    var fullid = $(this).attr('imgId');
                    $('#imageresource_' + fullid).attr('src', $('#imagepreview_' + fullid).attr('src')); // here asign the image to the modal when the user click the enlarge link
                    $('#imagemodal_' + fullid).modal('show'); // imagemodal is the id attribute assigned to the bootstrap modal, then i use the show function
                });
                

                //PRINT PRODUCTS

                let stateDropdown = '';
                let selectedProducts = [];

                
                function updateButtonContainerWidth() {
                    const overlayRow = document.querySelector(".row.el-element-overlay.m-b-40");
                    if (overlayRow) {
                        const overlayRowWidth = overlayRow.offsetWidth;
                        selectedProductsButtonContainer.style.width = `${overlayRowWidth}px`;
                    }
                }

                updateButtonContainerWidth();

                window.addEventListener('resize', updateButtonContainerWidth);

                function onClickButton(option) {
                    stateDropdown = option;
                    selectedProducts = []; // Clear selected products

                    productsList.forEach(value => {
                        const printButton = document.getElementById("printButton_" + value.id);
                        const editButton = document.getElementById("editButton_" + value.id);
                        const deleteButton = document.getElementById("deleteButton_" + value.id);
                        const productCard = document.querySelector(`.product-card[data-product-id-main="${value.id}"]`);

                        if (option === 'print') {
                            printButton.style.display = "block";
                            editButton.style.display = "none";
                            deleteButton.style.display = "none";
                            
                            productCard.removeEventListener('click', handleProductCardClick);
                        } else if (option === 'select') {
                            printButton.style.display = "none";
                            editButton.style.display = "none";
                            deleteButton.style.display = "none";

                            productCard.addEventListener('click', handleProductCardClick);
                        } else if (option === 'cancel') {
                            printButton.style.display = "none";
                            editButton.style.display = "block";
                            deleteButton.style.display = "block";

                            productCard.removeEventListener('click', handleProductCardClick);
                        }

                        // Clear selected styles
                        productCard.classList.remove('selected');
                    });

                    if (option !== 'select') {
                        document.getElementById('selectedProductsButtonContainer').style.display = 'none';
                    }
                }

                function handleProductCardClick(event) {
                    if (stateDropdown !== 'select') return;

                    const productCard = event.currentTarget;
                    const productId = parseInt(productCard.getAttribute('data-product-id-main'));

                    productCard.classList.toggle('selected');
                    if (productCard.classList.contains('selected')) {
                        if (!selectedProducts.includes(productId)) {
                            selectedProducts.push(productId);
                        }
                    } else {
                        const index = selectedProducts.indexOf(productId);
                        if (index > -1) {
                            selectedProducts.splice(index, 1);
                        }
                    }

                    if (selectedProducts.length > 0) {
                        document.getElementById('selectedProductsButtonContainer').style.display = 'block';
                        updateButtonContainerWidth();
                    } else {
                        document.getElementById('selectedProductsButtonContainer').style.display = 'none';
                    }
                }

                document.getElementById('gatherSelectedProductsBtn').addEventListener('click', function() {
                    var gatheredProductIds = selectedProducts.join(',');
                    event.preventDefault(); // Prevent the default action of the link
                    var gatheredProductIds = selectedProducts.join(',');
                    makeRequestToBackEnd(gatheredProductIds);
                });

                function foo(event){
                    var gatheredProductIds = selectedProducts.join(',');
                    event.preventDefault(); // Prevent the default action of the link
                    var gatheredProductIds = selectedProducts.join(',');
                    window.location= `${window.base_url}admin/printproduct/print_selected_products?products=`+encodeURIComponent(gatheredProductIds);
                }

                function makeRequestToBackEnd(products){
                    // Convert products array to a comma-separated string if it's not already
                    if (Array.isArray(products)) {
                        products = products.join(',');
                    }

                    var form = document.createElement('form');
                    form.setAttribute('method', 'get');
                    form.setAttribute('action', `${window.base_url}admin/printproduct/print_selected_products`);

                    // Create a hidden input to hold the products query parameter
                    var hiddenField = document.createElement('input');
                    hiddenField.setAttribute('type', 'hidden');
                    hiddenField.setAttribute('name', 'products');
                    hiddenField.setAttribute('value', products);

                    form.appendChild(hiddenField);
                    form.style.display = 'none';
                    document.body.appendChild(form);

                    form.submit();
                }

                // Attach event listeners initially
                document.querySelectorAll('.product-card').forEach(card => {
                    card.addEventListener('click', handleProductCardClick);
                });      
        </script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var searchContainer = document.getElementById('searchContainer');
        var searchInput = document.getElementById('searchInput');
        var searchIcon = document.getElementById('searchIcon');

        searchInput.addEventListener('focus', function() {
        searchContainer.classList.add('focused');
        });

        searchInput.addEventListener('blur', function() {
        searchContainer.classList.remove('focused');
        });

        searchIcon.addEventListener('focus', function() {
        searchContainer.classList.add('focused');
        });

        searchIcon.addEventListener('blur', function() {
        searchContainer.classList.remove('focused');
        });
    });
</script>