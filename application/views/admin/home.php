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

        .modal-body img {
            transition: opacity 0.15s ease;
        }

        .product-col{
            padding-bottom: 10px;
        }

        .product-info-table {
            max-height: 230px; /* About 3 rows */
            overflow-y: auto;
            border: 1px solid #dee2e6;
        }

        .product-info-table thead th {
            position: sticky;
            top: 0;
            background: #fff;
            z-index: 2;
        }

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
            <div class="col-md-12 col-lg-3 product-col">
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
                            <button type="button"
                                    class="btn btn-block mt-2 product-info-btn"
                                    style="background:#85b3f7; font-size: 14px;"
                                    id="infoButton_<?php echo $value['id']; ?>"
                                    data-productid="<?php echo $value['id']; ?>">
                                <i class="fa fa-info-circle" aria-hidden="true"></i> Informata Produkti
                            </button>
                            <!-- <a href="<?php echo base_url('admin/invoices/print_product_invoice/' . $value['id']); ?>"  target="_blank">
                                <button class="btn btn-block mt-2" style="background:#85b3f7; font-size: 14px;" id="invoiceButton_<?php echo $value['id']; ?>">
                                    <i class="fa fa-plus me-2"></i> Printo Faturen
                                </button>
                            </a> -->
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

<div class="modal" id="productInfoModal" tabindex="-1" role="dialog" aria-labelledby="productInfoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Informata Produkti</h5>

                <button type="button" class="close" data-bs-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>

            <div class="px-3 pt-3">
                <button type="button"
                        class="btn btn-success btn-sm"
                        id="openAddProductOrderModal">
                    <i class="fa fa-plus"></i> Shto porosi të re
                </button>
            </div>

            <div class="modal-body">
                <div id="productInfoContent" class="text-center py-3">
                    Duke ngarkuar...
                </div>
            </div>

        </div>
    </div>
</div>

<div class="modal" id="addProductOrderModal" tabindex="-1" role="dialog" aria-labelledby="addProductOrderModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="addProductOrderForm">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Shto porosi të re</h5>

                    <button type="button" class="close" data-bs-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="order_product_id" name="product_id">

                    <div class="form-group">
                        <label>Emri i Dyqanit</label>
                        <input type="text" class="form-control" id="order_shop_name" name="shop_name" required>
                    </div>

                    <div class="form-group">
                        <label>Sasia</label>
                        <input type="number" step="any" class="form-control" id="order_product_quantity" name="product_quantity" required>
                    </div>

                    <div class="form-group">
                        <label>Çmimi i Blerjes</label>
                        <input type="float" step="any" class="form-control" id="order_product_buying_price" name="product_buying_price" required>
                    </div>

                    <div class="form-group">
                        <label>Numri i Faturës</label>
                        <input type="text" class="form-control" id="order_invoice_number" name="invoice_number" >
                    </div>

                    <div id="addProductOrderError" class="alert alert-danger d-none"></div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mbyll</button>
                    <button type="submit" class="btn btn-success">
                        <i class="fa fa-save"></i> Ruaj
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>

<div class="modal" id="editProductInfoModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <form id="editProductInfoForm">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Edito porosinë</h5>

                    <button type="button" class="close" data-bs-dismiss="modal">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="edit_product_info_id" name="id">

                    <div class="form-group">
                        <label>Emri i Dyqanit</label>
                        <input type="text" class="form-control" id="edit_shop_name" name="shop_name" required>
                    </div>

                    <div class="form-group">
                        <label>Sasia</label>
                        <input type="number" step="any" class="form-control" id="edit_product_quantity" name="product_quantity" required>
                    </div>

                    <div class="form-group">
                        <label>Çmimi i Blerjes</label>
                        <input type="number" step="any" class="form-control" id="edit_product_buying_price" name="product_buying_price" required>
                    </div>

                    <div class="form-group">
                        <label>Numri i Faturës</label>
                        <input type="text" class="form-control" id="edit_invoice_number" name="invoice_number">
                    </div>

                    <div id="editProductInfoError" class="alert alert-danger d-none"></div>

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Mbyll</button>
                    <button type="submit" class="btn btn-warning">
                        <i class="fa fa-save"></i> Përditëso
                    </button>
                </div>

            </div>
        </form>
    </div>
</div>


<script>
document.addEventListener("DOMContentLoaded", function () {
    history.scrollRestoration = "manual";
    setTimeout(() => window.scrollTo(0, 0), 10);

    // ===== server vars =====
    const role = "<?php echo $_SESSION['role']; ?>";
    const priceStatus = "<?php echo $_SESSION['price_status']; ?>";

    window.base_url = <?php echo json_encode(base_url()); ?>;
    const url = window.base_url;

    // ===== DOM =====
    const searchInput = document.getElementById("searchInput");
    const searchIcon  = document.getElementById("searchIcon");
    const productListing = document.getElementById("productListing");
    const loadingIndicator = document.getElementById("loadingIndicator");

    // ===== Ctrl+B toggles admin actions =====
    function onCtrlB(e) {
        if (e.ctrlKey && (e.key === 'b' || e.key === 'B')) {
            e.preventDefault();
            e.stopPropagation();
            document.body.classList.toggle('show-admin-actions');
        }
    }
    document.addEventListener('keydown', onCtrlB, true);
    if (searchInput) searchInput.addEventListener('keydown', onCtrlB);

    // ===== state =====
    let productsList = <?php echo json_encode($products); ?> || [];
    const limit = 20;

    let offset = productsList.length;  // start after SSR products
    let isLoading = false;
    let isSearching = false;           // IMPORTANT: scroll load works ONLY when true
    let searchInProgress = false;
    let hasMore = true;               // hard stop at end
    let getSearchResult = 0;          // total matches returned by backend
    let searchAbort = null;           // abort old searches

    function showLoadingIndicator() {
        loadingIndicator.style.display = "block";
    }
    function hideLoadingIndicator() {
        loadingIndicator.style.display = "none";
        isLoading = false;
    }

    async function makeAsyncRequest(urlParam) {
        if (searchAbort) searchAbort.abort();
        searchAbort = new AbortController();

        const res = await fetch(urlParam, { signal: searchAbort.signal });
        if (!res.ok) throw new Error(res.statusText);
        return await res.json();
    }

    function resetSearchState() {
        offset = 0;
        isLoading = false;
        hasMore = true;
        getSearchResult = 0;
        productsList.length = 0;
        productListing.innerHTML = "";
        hideLoadingIndicator(); // ensure spinner hidden
    }

    function showNotFound() {
        productListing.innerHTML =
            `<h4 class="page-title" style="color:#d9534f;font-weight:600; margin-left:26px;">
                PRODUKTI NUK U GJEND!
             </h4>`;
        window.scrollTo(0,0);
        searchInput.focus();
    }

    async function searchProducts(query) {
        const encodedQuery = encodeURIComponent(query);
        const response = await makeAsyncRequest(
            url + `admin/dashboard/search_products?query=${encodedQuery}&offset=${offset}`
        );

        // backend gives productsAll to compute total
        getSearchResult = (response.productsAll && response.productsAll.length)
            ? response.productsAll.length
            : 0;

        const batch = response.products || [];

        if (batch.length === 0) {
            hasMore = false;
            hideLoadingIndicator(); // kill spinner immediately

            // show "not found" only on FIRST search page
            if (query.trim() !== "" && offset === 0) showNotFound();
            return;
        }

        // move offset ONLY after we got items
        offset += limit;

        productsList.push(...batch);
        updateProductListing(batch, query);
    }

    function updateProductListing(products, query) {
        searchInput.value = query;
        if (!products || products.length === 0) return;

        const html = products.map(product => `
            <div class="col-md-12 col-lg-3 product-col" >
                <div class="card" style="margin-bottom: 10px;">
                    <img id="imageresource_${product.id}"
                         imgId="${product.id}"
                         style="margin-left:auto;margin-right:auto;display:block;width:90px;height:70px;"
                         data-src="${url}optimum/products_images/${product.image}"
                         class="lazyload img-fluid" />

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
                        </div>` : ''}
                    </div>

                    ${role === 'admin' ? `
                    <div class="mt-2 admin-actions">
                        ${product.is_deleted == 0 ? `
                            <a href="${url}admin/products/get_product/${product.id}" target="_blank">
                                <button class="btn btn-block" style="background:#53d1b2; font-size:14px;" id="editButton_${product.id}">
                                    <i class="fa fa-edit"></i> Ndrysho Produktin
                                </button>
                            </a>
                            <a href="${url}admin/products/delete_product/${product.category_id}/${product.id}"
                               data-toggle="modal" data-target="#confirmDeleteModal"
                               data-productid="${product.id}" data-categoryid="${product.category_id}">
                                <button class="btn btn-block mt-2" style="background:#ff5e2dcc; font-size:14px;" id="deleteButton_${product.id}">
                                    <i class="fa fa-trash"></i> Fshije Produktin
                                </button>
                            </a>

                            <button type="button"
                                    class="btn btn-block mt-2 product-info-btn"
                                    style="background:#85b3f7; font-size:14px;"
                                    id="infoButton_${product.id}"
                                    data-productid="${product.id}">
                                <i class="fa fa-info-circle" aria-hidden="true"></i> Informata Produkti
                            </button>
 
                        ` : `
                            <a href="${url}admin/products/delete_product/${product.category_id}/${product.id}"
                               data-toggle="modal" data-target="#confirmUNDeleteModal"
                               data-productid="${product.id}" data-categoryid="${product.category_id}">
                                <button class="btn btn-block mt-2" style="background:#ff5e2dcc; font-size:14px;" id="deleteButton_${product.id}">
                                    <i class="fa fa-angle-left"></i> Rikthe Produktin
                                </button>
                            </a>
                        `}
                    </div>` : ''}
                </div>
            </div>

            <div class="modal" id="imagemodal_${product.id}" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header border-0">
                            <div class="modal-header d-flex justify-content-between align-items-center">
                                <h4 class="modal-title">${product.name}</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>
                        </div>
                        <div class="modal-body">
                            <img data-src="${url}optimum/products_images/${product.image}"
                                 class="lazyload img-fluid"
                                 id="imagepreview_${product.id}"
                                 style="margin-left:auto;margin-right:auto;display:block;width:270px;height:220px;">
                        </div>
                    </div>
                </div>
            </div>
        `).join("");

        productListing.insertAdjacentHTML("beforeend", html);
        moveModalsOutside();
    }

    function performSearch() {
        const searchQuery = searchInput.value.trim();

        if (searchQuery === "") {
            window.location.href = url + `admin/dashboard/`;
            return;
        }

        resetSearchState();

        isSearching = true;       // enable infinite scroll only now
        searchInProgress = true;

        window.scrollTo(0, 0);
        $(window).off("scroll", throttledScroll);

        searchProducts(searchQuery)
            .catch(console.error)
            .finally(() => {
                searchInProgress = false;
                $(window).on("scroll", throttledScroll);
            });
    }

    // Search triggers ONLY Enter / click (no live search)
    searchIcon.addEventListener("click", performSearch);
    searchInput.addEventListener("keydown", function (event) {
        if (event.key === "Enter") performSearch();
    });

    // ===== infinite scroll (SEARCH-ONLY) =====
    function checkScrollLoadMore() {
        if (!isSearching) return; // NO search => NO loader
        if (isLoading || searchInProgress || !hasMore) return;

        // stop if we know total and loaded all
        if (getSearchResult > 0 && offset >= getSearchResult) {
            hasMore = false;
            hideLoadingIndicator();
            return;
        }

        const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
        const windowHeight = window.innerHeight;
        const documentHeight = document.documentElement.scrollHeight;

        if (scrollTop + windowHeight >= documentHeight - 120) {
            isLoading = true;
            showLoadingIndicator();

            searchProducts(searchInput.value.trim())
                .catch(console.error)
                .finally(hideLoadingIndicator);
        }
    }

    // rAF throttle
    let scrollTick = false;
    function throttledScroll() {
        if (scrollTick) return;
        scrollTick = true;
        requestAnimationFrame(() => {
            checkScrollLoadMore();
            scrollTick = false;
        });
    }
    $(window).on("scroll", throttledScroll);

    // ===== move appended modals to body =====
    function moveModalsOutside() {
        $('#productListing .modal').each(function () {
            $('body').append(this);
        });
    }

    // ===== product information modal (works for initial products + search products) =====
    function escapeHtml(value) {
        if (value === null || value === undefined || value === '') return '-';
        return String(value)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#039;');
    }

    function money(value) {
        if (value === null || value === undefined || value === '') return '-';
        return escapeHtml(value) + ' RMB';
    }

    $(document).on('click', '.product-info-btn', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const productId = $(this).data('productid');
        if (!productId) return;

        $('#productInfoContent').html('<div class="py-3">Duke ngarkuar...</div>');
        $('#productInfoModal').modal('show');

        $.ajax({
            url: url + 'admin/products/product_information/' + productId,
            type: 'GET',
            dataType: 'json',
            success: function (res) {
                if (!res || res.status === false) {
                    $('#productInfoContent').html(
                        '<div class="alert alert-warning mb-0">Nuk ka informata për këtë produkt.</div>'
                    );
                    return;
                }

                const data = res.data ? res.data : res;

                const product = data.product_info || {};
                const purchases = Array.isArray(data.purchases) ? data.purchases : [];

                let totalQuantity = 0;
                let totalValue = 0;

                let rowsHtml = '';

                if (Array.isArray(purchases) && purchases.length > 0) {
                    rowsHtml = purchases.map(function (item, index) {
                        const qtyRaw = item.product_quantity || 0;
                        const priceRaw = item.product_buying_price || 0;

                        const qty = parseFloat(qtyRaw) || 0;
                        const price = parseFloat(priceRaw) || 0;
                        const rowTotal = qty * price;
                        const date = item.created_at.split(' ')[0];

                        totalQuantity += qty;
                        totalValue += rowTotal;

                        const createdDate = item.created_at ? item.created_at.split(' ')[0] : '-';

                        return `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${escapeHtml(item.shop_name)}</td>
                                <td>${escapeHtml(qtyRaw)}</td>
                                <td>${money(priceRaw)}</td>
                                <td>${rowTotal ? money(rowTotal.toFixed(2)) : '-'}</td>
                                <td>${escapeHtml(item.invoice_number)}</td>
                                <td>${escapeHtml(createdDate)}</td>
                                <td class="text-nowrap">
                                    <button type="button"
                                            class="btn btn-warning btn-sm edit-product-info-row"
                                            title="Edito"
                                            data-id="${escapeHtml(item.id)}"
                                            data-shop="${escapeHtml(item.shop_name)}"
                                            data-quantity="${escapeHtml(qtyRaw)}"
                                            data-price="${escapeHtml(priceRaw)}"
                                            data-invoice="${escapeHtml(item.invoice_number === null || item.invoice_number === undefined ? '' : item.invoice_number)}">
                                        <i class="fa fa-edit"></i>
                                    </button>

                                    <button type="button"
                                            class="btn btn-danger btn-sm delete-product-info-row"
                                            title="Fshije"
                                            data-id="${escapeHtml(item.id)}">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        `;
                    }).join('');
                } else {
                    // fallback për endpoint të vjetër që kthen vetëm një objekt
                    const qtyRaw = product.product_quantity || 0;
                    const priceRaw = product.product_buying_price || 0;

                    const qty = parseFloat(qtyRaw) || 0;
                    const price = parseFloat(priceRaw) || 0;
                    const rowTotal = qty * price;

                    totalQuantity = qty;
                    totalValue = rowTotal;

                    // rowsHtml = `
                    //     <tr>
                    //         <td>1</td>
                    //         <td>${escapeHtml(product.shop_name)}</td>
                    //         <td>${escapeHtml(qtyRaw)}</td>
                    //         <td>${money(priceRaw)}</td>
                    //         <td>${rowTotal ? money(rowTotal.toFixed(2)) : '-'}</td>
                    //         <td>${escapeHtml(product.invoice_number)}</td>
                    //         <td>${escapeHtml(product.created_at)}</td>
                    //     </tr>
                    // `;
                }

                $('#productInfoContent').html(`
                    <div class="text-left">
                        <div class="row mb-3">
                            <div class="col-md-4 mb-2">
                                <div class="border rounded p-2 h-100">
                                    <small class="text-muted">Kodi</small><br>
                                    <b>${escapeHtml(product.code)}</b>
                                </div>
                            </div>
                            <div class="col-md-8 mb-2">
                                <div class="border rounded p-2 h-100">
                                    <small class="text-muted">Produkti</small><br>
                                    <b>${escapeHtml(product.name)}</b>
                                </div>
                            </div>
                            <div class="col-md-4 mb-2">
                                <div class="border rounded p-2 h-100">
                                    <small class="text-muted">Numri i blerjeve / shitoreve</small><br>
                                    <b>${Array.isArray(purchases) && purchases.length ? purchases.length : 1}</b>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive product-info-table">
                            <table class="table table-bordered table-striped mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Shitorja</th>
                                        <th>Sasia e blerë</th>
                                        <th>Çmimi blerës</th>
                                        <th>Totali</th>
                                        <th>Fatura</th>
                                        <th>Data</th>
                                        <th>Veprimi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    ${rowsHtml}
                                </tbody>
                            </table>
                        </div>
                    </div>
                `);
            },
            error: function () {
                $('#productInfoContent').html(
                    '<div class="alert alert-danger mb-0">Gabim. Nuk u lexuan informatat e produktit.</div>'
                );
            }
        });
    });

    let currentProductInfoId = null;

    $(document).on('click', '.product-info-btn', function (e) {
        currentProductInfoId = $(this).data('productid');
    });

    $(document).on('click', '#openAddProductOrderModal', function () {

    if (!currentProductInfoId) {
        alert('Produkti nuk u gjet.');
        return;
    }

        $('#order_product_id').val(currentProductInfoId);

        $('#order_shop_name').val('');
        $('#order_product_quantity').val('');
        $('#order_product_buying_price').val('');
        $('#order_invoice_number').val('');

        $('#addProductOrderError').addClass('d-none').html('');

        $('#addProductOrderModal').modal('show');
    });

    $(document).on('submit', '#addProductOrderForm', function (e) {
        e.preventDefault();

        const productId = $('#order_product_id').val();
        const shopName = $('#order_shop_name').val().trim();
        const quantity = $('#order_product_quantity').val().trim();
        const buyingPrice = $('#order_product_buying_price').val().trim();
        const invoiceNumber = $('#order_invoice_number').val().trim();

        if (!shopName || !quantity || !buyingPrice) {
            $('#addProductOrderError')
                .removeClass('d-none')
                .html('Ju lutem plotësoni të gjitha fushat.');
            return;
        }

        $.ajax({
            url: url + 'admin/products/add_product_information',
            type: 'POST',
            dataType: 'json',
            data: {
                product_id: productId,
                shop_name: shopName,
                product_quantity: quantity,
                product_buying_price: buyingPrice,
                invoice_number: invoiceNumber
            },
            success: function (res) {

                if (!res || res.status === false) {
                    $('#addProductOrderError')
                        .removeClass('d-none')
                        .html(res.message || 'Porosia nuk u ruajt.');
                    return;
                }

                $('#addProductOrderModal').modal('hide');

                $('.product-info-btn[data-productid="' + productId + '"]').trigger('click');
            },
            error: function () {
                $('#addProductOrderError')
                    .removeClass('d-none')
                    .html('Gabim gjatë ruajtjes së porosisë.');
            }
        });
    });

    // ===== edit product information row =====
    $(document).on('click', '.edit-product-info-row', function (e) {
        e.preventDefault();
        e.stopPropagation();

        $('#edit_product_info_id').val($(this).data('id'));
        $('#edit_shop_name').val($(this).data('shop'));
        $('#edit_product_quantity').val($(this).data('quantity'));
        $('#edit_product_buying_price').val($(this).data('price'));
        $('#edit_invoice_number').val($(this).data('invoice') || '');

        $('#editProductInfoError').addClass('d-none').html('');
        $('#editProductInfoModal').modal('show');
    });

    $(document).on('submit', '#editProductInfoForm', function (e) {
        e.preventDefault();

        const id = $('#edit_product_info_id').val();
        const shopName = $('#edit_shop_name').val().trim();
        const quantity = $('#edit_product_quantity').val().trim();
        const buyingPrice = $('#edit_product_buying_price').val().trim();
        const invoiceNumber = $('#edit_invoice_number').val().trim();

        if (!id || !shopName || !quantity || !buyingPrice) {
            $('#editProductInfoError')
                .removeClass('d-none')
                .html('Ju lutem plotësoni të gjitha fushat obligative.');
            return;
        }

        $.ajax({
            url: url + 'admin/products/update_product_information',
            type: 'POST',
            dataType: 'json',
            data: {
                id: id,
                shop_name: shopName,
                product_quantity: quantity,
                product_buying_price: buyingPrice,
                invoice_number: invoiceNumber
            },
            success: function (res) {
                if (!res || res.status === false) {
                    $('#editProductInfoError')
                        .removeClass('d-none')
                        .html((res && res.message) ? res.message : 'Rreshti nuk u përditësua.');
                    return;
                }

                $('#editProductInfoModal').modal('hide');

                if (currentProductInfoId) {
                    $('.product-info-btn[data-productid="' + currentProductInfoId + '"]').first().trigger('click');
                }
            },
            error: function () {
                $('#editProductInfoError')
                    .removeClass('d-none')
                    .html('Gabim gjatë përditësimit të rreshtit.');
            }
        });
    });

    // ===== delete product information row =====
    $(document).on('click', '.delete-product-info-row', function (e) {
        e.preventDefault();
        e.stopPropagation();

        const id = $(this).data('id');
        if (!id) {
            alert('Rreshti nuk u gjet.');
            return;
        }

        if (!confirm('A jeni i sigurt që dëshironi ta fshini këtë rresht?')) {
            return;
        }

        $.ajax({
            url: url + 'admin/products/delete_product_information',
            type: 'POST',
            dataType: 'json',
            data: { id: id },
            success: function (res) {
                if (!res || res.status === false) {
                    alert((res && res.message) ? res.message : 'Rreshti nuk u fshi.');
                    return;
                }

                if (currentProductInfoId) {
                    $('.product-info-btn[data-productid="' + currentProductInfoId + '"]').first().trigger('click');
                }
            },
            error: function () {
                alert('Gabim gjatë fshirjes së rreshtit.');
            }
        });
    });

    // ===== image modal opener (works for initial $key IDs + appended product.id IDs) =====
    function cacheBust(u) {
        if (!u) return u;
        const sep = u.includes('?') ? '&' : '?';
        return u + sep + 'cb=' + Date.now();
    }

    document.getElementById("productListing").addEventListener("click", function (event) {
        const el = event.target;
        if (!el.classList.contains("img-fluid")) return;

        // try imgId first (exists on both old+new)
        const rawId = el.getAttribute("imgId");
        let modalEl = rawId ? document.getElementById("imagemodal_" + rawId) : null;

        if (!modalEl) {
            // fallback: infer from id="imageresource_{id}"
            const inferred = (el.id || "").split("_").pop();
            modalEl = inferred ? document.getElementById("imagemodal_" + inferred) : null;
        }

        if (!modalEl) return;

        const listUrl = el.getAttribute("src") || el.getAttribute("data-src");
        const modalImg = modalEl.querySelector("img");

        if (!modalImg) return;

        const freshUrl = cacheBust(listUrl);

        // fshehe derisa te ngarkohet
        modalImg.style.opacity = "0";

        const preloadImg = new Image();

        preloadImg.onload = function () {

            modalImg.removeAttribute("data-src");
            modalImg.classList.remove("lazyload");

            modalImg.src = freshUrl;

            // shfaqe pasi u ngarkua
            modalImg.style.opacity = "1";

            const modalId = modalEl.getAttribute("id");
            $("#" + modalId).modal("show");
        };

        preloadImg.src = freshUrl;
    });
});
</script>

<script>
/* delete / undelete modal link binding (same as before) */
$(document).ready(function() {
    $('#confirmDeleteModal').on('show.bs.modal', function(e) {
        var productID = $(e.relatedTarget).data('productid');
        var categoryID = $(e.relatedTarget).data('categoryid');
        var deleteButton = $(this).find('#deleteProductLink');
        deleteButton.attr(
            'href',
            '<?php echo base_url("admin/products/delete_product/"); ?>' + categoryID + '/' + productID + '/' + 'true'
        );
    });
});

$(document).ready(function() {
    $('#confirmUNDeleteModal').on('show.bs.modal', function(e) {
        var productID = $(e.relatedTarget).data('productid');
        var categoryID = $(e.relatedTarget).data('categoryid');
        var undeleteButton = $(this).find('#UNdeleteProductLink');
        undeleteButton.attr(
            'href',
            '<?php echo base_url("admin/products/un_delete_product/"); ?>' + categoryID + '/' + productID + '/' + 'true'
        );
    });
});
</script>

<script>
/* focus glow for search bar (unchanged) */
document.addEventListener('DOMContentLoaded', function() {
    var searchContainer = document.getElementById('searchContainer');
    var searchInput = document.getElementById('searchInput');
    var searchIcon = document.getElementById('searchIcon');

    function addFocus(){ searchContainer.classList.add('focused'); }
    function removeFocus(){ searchContainer.classList.remove('focused'); }

    searchInput.addEventListener('focus', addFocus);
    searchInput.addEventListener('blur', removeFocus);
    searchIcon.addEventListener('focus', addFocus);
    searchIcon.addEventListener('blur', removeFocus);
});
</script>

