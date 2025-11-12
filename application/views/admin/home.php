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
            transition: box-shadow 0.3s ease;
        }

        #searchContainer {
            position: sticky;
            top: 90px;                 /* adjust this value to move it lower (try 120–180px) */
            z-index: 110 !important;    /* above content, below dropdown */
            background: #fff;
            width: min(960px, 100%);
            margin: 20px auto 24px;     /* spacing around */
            border-radius: 8px;
            transition: box-shadow 0.2s ease, transform 0.2s ease;
        }


        #searchContainer.focused {
            box-shadow: 0 0 10px #5aa8e98c;
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
            /* Spinner styling */
        #loadingIndicator .spinner {
            display: inline-block;
            width: 40px;
            height: 40px;
            border: 3px solid rgba(0, 0, 0, 0.1);
            border-radius: 50%;
            border-top-color: #3498db;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px; /* Space between spinner and text */
        }

        /* Spinner animation */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        body.modal-open .background-blur:not(.modal):not(.modal *) {
            filter: blur(5px);
            pointer-events: none;
            user-select: none;
        }


        .modal {
            z-index: 1055; /* default is 1050, this just ensures it's above */
            position: fixed; /* ensure it's outside blur flow */
        }


        #productListing {
            display: flex;
            flex-wrap: wrap;
            margin-left: -15px; /* match Bootstrap column padding */
            margin-right: -15px;
        }

        #productListing > .col-md-12.col-lg-4 {
            padding-left: 5px;
            padding-right: 5px;
            padding-bottom: 15px;
        }


        .card {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .admin-actions { display: none; }
        .show-admin-actions .admin-actions { display: block; }

    </style>

    <?php if ($this->session->userdata('role') == 'admin') : ?>

    <?php endif ?>

    
    <div role="search" class="background-blur" id="searchContainer">
        <label for="s1">Search for:</label>
        <input type="text" id="searchInput" placeholder="Kerko...">
        <button aria-label="Do search" id="searchIcon">
        <i class="fa fa-search"></i>
        </button>
    </div>

    <!-- Preview of captured image -->
    <img id="previewImage" class="background-blur" class="mt-3 img-thumbnail" style="display: none;">


    <div class="col-md-12" >
            <hr style="border-top: 2px solid #bdb8b8ff;">
    </div>
    <!-- /.usercard -->
    <div class="row el-element-overlay m-b-40 background-blur" id="productListing">
        <?php foreach ($products as $key => $value) { ?>
            <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                <div class="card" style="margin-bottom: 10px;">
                    <img id="imageresource_<?php echo $key; ?>" imgId="<?php echo $key; ?>" style="margin-left: auto;margin-right: auto;display: block;width:90px;height:70px;" data-src="<?php echo base_url(); ?>optimum/products_images/<?php echo $value['image']; ?>" class="lazyload img-fluid" />
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="mb-0">Kodi:</h5>
                            <h5 class="text-dark mb-0"><b><?php echo $value['code']; ?></b></h5>
                        </div>
                        <div class="d-flex justify-content-between mb-3">
                            <h5 class="mb-0">Përshkrimi:</h5>
                            <?php if (strlen($value['name']) > 20) : ?>
                                <h5 class="text-dark mb-0" style="margin-left: 10px;"><b><?php echo htmlspecialchars($value['name']); ?></b></h5>
                            <?php else : ?>
                                <h5 class="text-dark mb-0"><b><?php echo htmlspecialchars($value['name']); ?></b></h5>
                            <?php endif; ?>
                        </div>
                        <?php if ($this->session->userdata('price_status') == 1) : ?>
                            <div class="d-flex justify-content-between mb-3">
                                <h5 class="mb-0">Çmimi:</h5>
                                <h5 class="text-dark mb-0"><b><?php echo $value['price']; ?><i class="fa fa-euro"></i></b></h5>
                            </div>
                        <?php endif ?>
                    </div>
                    <?php if ($this->session->userdata('role') == 'admin') : ?>
                        <div class="mt-2 admin-actions">
                            <a href="<?php echo base_url('admin/products/get_product/' . $value['id']); ?>"  target="_blank">
                                <button class="btn btn-block" style="background:#53d1b2; font-size: 14px;" id="editButton_<?php echo $value['id']; ?>">
                                    <i class="fa fa-edit"></i> Ndrysho Produktin
                                </button>
                            </a>
                            <a href="<?php echo base_url('admin/products/delete_product/' . $value['category_id'] . '/' . $value['id']); ?>" 
                                data-toggle="modal" data-target="#confirmDeleteModal" data-productid="<?php echo $value['id']; ?>" data-categoryid="<?php echo $value['category_id']; ?>" >
                                <button class="btn btn-block mt-2" style="background:#ff5e2dcc; font-size: 14px;" id="deleteButton_<?php echo $value['id']; ?>">
                                    <i class="fa fa-trash"></i> Fshije Produktin
                                </button>
                            </a>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        <?php } ?>
    </div>

    <div id="loadingIndicator" class="background-blur" style="display: none; text-align: center; padding: 10px;">
        <div class="spinner"></div><br>
        <span>Me shume produkte..</span>
    </div>

    <?php foreach ($products as $key => $value) { ?>
        <div class="modal" id="imagemodal_<?php echo $key; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <div class="modal-header d-flex justify-content-between align-items-center">
                            <h4 class="modal-title" id="myModalLabel"><?php echo $value['name']; ?></h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>
                    <div class="modal-body">
                        <img src="<?php echo base_url(); ?>optimum/products_images/<?php echo $value['image']; ?>" id="imagepreview_<?php echo $key; ?>" style="margin-left: auto;margin-right: auto;display: block;width:270px;height:220px;">
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="modal background-blur" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
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

    <div class="modal background-blur" id="confirmUNDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmUNDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="confirmUNDeleteModalLabel">Konfirmo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                A jeni i sigurt qe deshironi te riktheni kete produkt?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Jo</button>
                <a id="UNdeleteProductLink" href="#" class="btn btn-danger">Rikthe</a>
            </div>
        </div>
        </div>
    </div>


    <script>
        document.addEventListener("DOMContentLoaded", function() {
            history.scrollRestoration = "manual";
                setTimeout(() => {
                window.scrollTo(0, 0);
            }, 10);
            var role = "<?php echo $_SESSION['role']; ?>";
            const searchInput = document.getElementById("searchInput");
            const searchIcon = document.getElementById("searchIcon");
            const productListing = document.getElementById("productListing");
            window.base_url = <?php echo json_encode(base_url()); ?>;
            const url = window.base_url;
            
            function onCtrlB(e) {
                if (e.ctrlKey && (e.key === 'b' || e.key === 'B')) {
                e.preventDefault();        // stop browser default (bold, bookmarks, etc.)
                e.stopPropagation();       // stop other handlers
                document.body.classList.toggle('show-admin-actions');
                }
            }

            // Capture-phase listener so it runs even when inputs have focus
            document.addEventListener('keydown', onCtrlB, true);

            // (Optional) belt-and-suspenders: also bind directly to the input
            if (searchInput) {
                searchInput.addEventListener('keydown', onCtrlB);
            }
            let loadingIndicator = document.getElementById("loadingIndicator");
            let isLoading = false; // Prevent multiple simultaneous requests
            let offset = 0; // Start after the initially loaded products
            const limit = 20; // Number of products to load per request
            let getSearchResult;
            let searchInProgress = false;


            // Attach click event listener to the search icon
            searchIcon.addEventListener("click", performSearch);

            // Attach keydown event listener to the search input
            searchInput.addEventListener("keydown", function(event) {
                if (event.key === "Enter") {
                    performSearch();
                }
            });

            function checkScrollLoadMore() {
                const scrollTop = $(window).scrollTop();
                const windowHeight = $(window).height();
                const documentHeight = $(document).height();

                if (
                    !isLoading &&
                    !searchInProgress &&
                    (scrollTop + windowHeight >= documentHeight - 100)
                ) {
                    isLoading = true;
                    offset += limit;
                    if(getSearchResult > offset){
                        showLoadingIndicator();
                        searchProducts(searchInput.value).finally(() => hideLoadingIndicator());
                    }
                }
            }

            function showLoadingIndicator() {
                loadingIndicator.style.display = "block";
            }

            function hideLoadingIndicator() {
                loadingIndicator.style.display = "none";
                isLoading = false; // Reset loading state
            }

            function performSearch() {
                const searchQuery = searchInput.value;
                if (searchQuery.trim() === "") {
                    window.location.href = url + `admin/dashboard/`;
                } else {
                     // Reset scroll position to top
                    window.scrollTo(0, 0);

                    // Temporarily disable scroll event listener
                    $(window).off("scroll", checkScrollLoadMore);

                    // Reset all variables and state for a fresh search
                    resetSearchState();

                    // Set searching flag and initiate search
                    isSearching = true;
                    searchInProgress = true;
                    searchProducts(searchQuery).finally(() => {
                        isSearching = false;
                        searchInProgress = false;

                        // Re-enable scroll event listener
                        $(window).on("scroll", checkScrollLoadMore);
                    });
                    searchInput.focus();
                    window.scrollTo(0, 0);
                }
            }

            function resetSearchState() {
                offset = 0;                    // Reset offset for fresh search
                isLoading = false;              // Allow new requests
                productListing.innerHTML = "";  // Clear displayed products
            }

            async function searchProducts(query) {
                const encodedQuery = encodeURIComponent(query);
                response = await makeAsyncRequest(url + `admin/dashboard/search_products?query=${encodedQuery}&offset=${offset}`);
                getSearchResult = response.productsAll.length;
                updateProductListing(response.products, query);
            }
            
            function makeAsyncRequest(urlParam) {
                return new Promise((resolve, reject) => {
                    const xhr = new XMLHttpRequest();
                    xhr.open("GET", urlParam, true); // true makes it asynchronous

                    xhr.onload = () => {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            if (xhr.responseText.length < 2) {
                                window.location.href = url + `admin/dashboard/`;
                            } else {
                                resolve(JSON.parse(xhr.responseText));
                            }
                        } else {
                            reject(`Error: ${xhr.status} - ${xhr.statusText}`);
                        }
                    };

                    xhr.onerror = () => reject("Network error");

                    xhr.send();
                });
            }

            function updateProductListing(products, query) {
                var priceStatus = "<?php echo $_SESSION['price_status']; ?>";
                searchInput.value = query;
                const productListing = document.getElementById("productListing");
                // productListing.innerHTML = "";

                if (products.length > 0) {
                    console.log(products,'products')
                    products.forEach(product => {
                        const productCard = `
                                            <div class="col-md-12 col-lg-4 mb-4 mb-lg-0" style="margin-bottom: 18px; padding-right: 10px;">
                                                <div class="card" style="margin-bottom: 10px;">
                                                    <img id="imageresource_${product.id}" imgId=${product.id} style="margin-left: auto;margin-right: auto;display: block;width:90px;height:70px;" data-src="${url}optimum/products_images/${product.image}" class="lazyload img-fluid" / >
                                                        <div class="card-body">
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
                                                        </div>
                                                        
                                                        ${role === 'admin' ? `
                                                        <div class="mt-2 admin-actions">
                                                            ${product.is_deleted == 0 ? `
                                                                <a href="${url}admin/products/get_product/${product.id}"  target="_blank">
                                                                    <button class="btn btn-block" style="background:#53d1b2; font-size: 14px;" id="editButton_${product.id}">
                                                                        <i class="fa fa-edit"></i> Ndrysho Produktin
                                                                    </button>
                                                                </a>
                                                                <a href="${url}admin/products/delete_product/${product.category_id}/${product.id}" 
                                                                    data-toggle="modal" data-target="#confirmDeleteModal" data-productid="${product.id}" data-categoryid="${product.category_id}">
                                                                    <button class="btn btn-block mt-2" style="background:#ff5e2dcc; font-size: 14px;" id="deleteButton_${product.id}">
                                                                        <i class="fa fa-trash"></i> Fshije Produktin
                                                                    </button>
                                                                </a>`
                                                                :
                                                                `<a href="${url}admin/products/delete_product/${product.category_id}/${product.id}" 
                                                                    data-toggle="modal" data-target="#confirmUNDeleteModal" data-productid="${product.id}" data-categoryid="${product.category_id}">
                                                                    <button class="btn btn-block mt-2" style="background:#ff5e2dcc; font-size: 14px;" id="deleteButton_${product.id}">
                                                                        <i class="fa fa-angle-left"></i> Rikthe Produktin
                                                                    </button>
                                                                </a>`
                                                            }
                                                        </div>` : ''}
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
                                                            <img data-src="${url}optimum/products_images/${product.image}" class="lazyload img-fluid" id="imagepreview_${product.id}" style="margin-left: auto;margin-right: auto;display: block;width:270px;height:220px;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        `;
                        productListing.innerHTML += productCard;
                        moveModalsOutside();
                    });
                } else {
                    productListing.innerHTML = ""; 
                    productListing.innerHTML += `<h4 class="page-title" style="color:#d9534f;font-weight:600; margin-left:26px;">Produkti nuk u gjend!</h4>`;
                    window.scrollTo(0, 0);
                    searchInput.focus();

                }

                productListing.innerHTML += `</div>`;
            }
        });

        $(document).ready(function() {
            // Listen for the modal's "Delete" button click event
            $('#confirmDeleteModal').on('show.bs.modal', function(e) {
            var productID = $(e.relatedTarget).data('productid'); // Get the product ID
            var categoryID = $(e.relatedTarget).data('categoryid'); // Get the product ID
            var deleteButton = $(this).find('#deleteProductLink'); // Get the "Delete" button in the modal

            // Update the "Delete" button link with the appropriate product ID
            deleteButton.attr('href', '<?php echo base_url("admin/products/delete_product/"); ?>' + categoryID + '/' + productID + '/' + 'true');
            });
        });
        
        $(document).ready(function() {
            // Listen for the modal's "Delete" button click event
            $('#confirmUNDeleteModal').on('show.bs.modal', function(e) {
            var productID = $(e.relatedTarget).data('productid'); // Get the product ID
            var categoryID = $(e.relatedTarget).data('categoryid'); // Get the product ID
            var undeleteButton = $(this).find('#UNdeleteProductLink'); // Get the "Delete" button in the modal

            // Update the "Delete" button link with the appropriate product ID
            undeleteButton.attr('href', '<?php echo base_url("admin/products/un_delete_product/"); ?>' + categoryID + '/' + productID + '/'  + 'true');
            });
        });

        function moveModalsOutside() {
            $('#productListing .modal').each(function () {
                $('body').append(this); // move modal to body
            });
        }
        

        function cacheBust(url) {
            if (!url) return url;
            const sep = url.includes('?') ? '&' : '?';
            return url + sep + 'cb=' + Date.now();
        }

        document.getElementById("productListing").addEventListener("click", function(event) {
            // only react when a product image is clicked
            const el = event.target;
            if (!el.classList.contains("img-fluid")) return;

            const fullid = el.getAttribute('imgId');
            // prefer src if present; otherwise fall back to data-src (lazyload)
            const listImg = document.getElementById('imageresource_' + fullid);
            const currentListUrl = listImg.getAttribute('src') || listImg.getAttribute('data-src');

            // set the MODAL preview src to the *current* list image url with cache-buster
            const modalImg = document.getElementById('imagepreview_' + fullid);
            modalImg.removeAttribute('data-src');     // ensure lazyload won’t interfere
            modalImg.classList.remove('lazyload');    // modal should load immediately
            modalImg.setAttribute('src', cacheBust(currentListUrl));

            // show the modal
            $('#imagemodal_' + fullid).modal('show');
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