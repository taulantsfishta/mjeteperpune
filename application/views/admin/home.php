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
                            <a href="<?php echo base_url('admin/invoices/print_product_invoice/' . $value['id']); ?>"  target="_blank">
                                <button class="btn btn-block mt-2" style="background:#85b3f7; font-size: 14px;" id="invoiceButton_<?php echo $value['id']; ?>">
                                    <i class="fa fa-plus me-2"></i> Printo Faturen
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
            <div class="col-md-12 col-lg-4 mb-4 mb-lg-0" style="margin-bottom: 18px; padding-right: 10px;">
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
                            <a href="${url}admin/invoices/print_product_invoice/${product.id}" target="_blank">
                                <button class="btn btn-block mt-2" style="background:#85b3f7; font-size:14px;" id="invoiceButton_${product.id}">
                                    <i class="fa fa-edit"></i> Printo Faturen
                                </button>
                            </a>
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
        if (modalImg) {
            modalImg.removeAttribute("data-src");
            modalImg.classList.remove("lazyload");
            modalImg.setAttribute("src", cacheBust(listUrl));
        }

        const modalId = modalEl.getAttribute("id");
        $("#" + modalId).modal("show");
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

