<style>
    .dropdown-toggle {
        border-color: #fff;
        border-top: none;
        border-right: none;
        border-left: none;
        width: 100%;
    }

    .dropdown-menu { width: 100%; }

    .product-card.selected { background-color: lightblue; }

    #selectedProductsButtonContainer {
        position: fixed;
        bottom: 20px;
        left: 60%;
        transform: translateX(-50%);
        z-index: 1000;
        display: none;
    }

    svg { display: none; }

    [role="search"] {
        box-sizing: border-box;
        background-color: #fff;
        border: 1px solid rgba(0,0,0,.5);
        border-radius: 1em;
        padding: 0;
        max-width: 100em;
        height: 34px;
    }
    [role="search"] label {
        display: inline-block;
        width: 0; overflow: hidden; text-indent: -1000px; margin: 0;
    }

    input::-webkit-input-placeholder { color: #757575; }
    input:-ms-input-placeholder { color: #757575; }
    input::-moz-placeholder { color: #757575; }

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
        transition: box-shadow .3s ease;
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
        display: block; margin: 0 auto; fill: #666; width: 100%; height: auto;
    }
    [role="search"] button:hover, [role="search"] button:focus { outline: none; }
    [role="search"] button:hover svg, [role="search"] button:focus svg { fill: #7396CE; }

    [role="search"] input[type="text"]:focus { outline: none; box-shadow: none; }

    [role="search"] button i {
        color: #666; transition: color .3s ease; font-size: 1.2em;
    }
    [role="search"] button:hover i,
    [role="search"] button:focus i { color: #7396CE; }

    #loadingIndicator .spinner {
        display: inline-block;
        width: 40px; height: 40px;
        border: 3px solid rgba(0,0,0,0.1);
        border-radius: 50%;
        border-top-color: #3498db;
        animation: spin 1s ease-in-out infinite;
        margin-right: 8px;
    }
    @keyframes spin { to { transform: rotate(360deg); } }

    body.modal-open .background-blur:not(.modal):not(.modal *) {
        filter: blur(5px);
        pointer-events: none;
        user-select: none;
    }
    .modal { z-index: 1055; position: fixed; }

    .card.product-card {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        height: 100%;
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        flex-grow: 1;
    }

    .product-description{
        margin-left:10px;
        font-size:14px;
        line-height:1.3;
        display:block;
        overflow:visible;
        white-space:normal;
    }

    .navbar .dropdown-menu {
        width: auto !important;
        max-height: none !important;
        overflow: visible !important;
        z-index: 1200 !important;
        border: 1px solid #e3e7eb;
        border-radius: 4px;
        box-shadow: 0 2px 8px rgba(0,0,0,.06);
        padding-top: 6px;
        padding-bottom: 6px;
    }
    #searchContainer { z-index: 100 !important; }

    .container.background-blur .dropdown .dropdown-toggle { width: 100%; }
    .container.background-blur .dropdown .dropdown-menu   { width: 100%; }

    #searchContainer {
        position: sticky;
        top: 90px;
        z-index: 110 !important;
        background: #fff;
        width: min(960px, 100%);
        margin: 20px auto 24px;
        border-radius: 8px;
        transition: box-shadow .2s ease, transform .2s ease;
        padding-right: 0;
        padding-left: 0;
        display: flex;
        align-items: center;
    }

    #searchContainer.focused { box-shadow: 0 0 10px #67b2f08c; }

    .background-blur { overflow: visible; }
</style>

<?php if ($this->session->userdata('role') == 'admin') : ?>
    <div class="container background-blur">
        <div class="row">
            <div class="col-lg-5"></div>
            <div class="col-lg-3">
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton1"
                            data-bs-toggle="dropdown" aria-expanded="false" style="background:#7396CE;">
                        <i class="fa fa-print"></i> Aktivizo Printimin
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item" id="printOption" onClick="onClickButton('print')" style="font-size:13px;">
                            <i class="fa fa-print"></i> Printo</a></li>
                        <li><a class="dropdown-item" id="selectOption" onClick="onClickButton('select')" style="font-size:13px;">
                            <i class="fa fa-check" aria-hidden="true"></i> Selekto</a></li>
                        <li><a class="dropdown-item" id="cancelOption" onClick="onClickButton('cancel')" style="font-size:13px;">
                            <i class="fa fa-times" aria-hidden="true"></i> Anulo Printimin</a></li>
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

<div role="search" id="searchContainer" class="background-blur">
    <label for="s1">Search for:</label>
    <input type="text" id="searchInput" placeholder="Kerko...">
    <button aria-label="Do search" id="searchIcon">
        <i class="fa fa-search"></i>
    </button>
</div>

<div class="col-md-12">
    <hr style="border-top: 2px solid #bdb8b8ff;">
</div>

<!-- PRODUCT LIST -->
<div class="row el-element-overlay background-blur" id="productListing">
    <?php foreach ($products as $key => $value) { ?>
        <div class="col-md-12 col-lg-4 mb-lg-0" style="padding-left:5px;padding-right:5px;padding-bottom:15px;">
            <div class="card product-card d-flex flex-column h-100"
                 data-product-id-main="<?php echo $value['id']; ?>"
                 data-product-name="<?php echo htmlspecialchars($value['name']); ?>">
                <img
                    id="imageresource_<?php echo $value['id']; ?>"
                    imgId="<?php echo $value['id']; ?>"
                    class="lazyload img-fluid mx-auto mt-3"
                    style="width:90px; height:70px; object-fit: contain;"
                    data-src="<?php echo base_url(); ?>optimum/products_images/<?php echo $value['image']; ?>"
                />

                <div class="card-body d-flex flex-column justify-content-between flex-grow-1">
                    <div>
                        <div class="d-flex justify-content-between mb-2">
                            <h5 class="mb-0">Kodi:</h5>
                            <h5 class="text-dark mb-0"><b><?php echo $value['code']; ?></b></h5>
                        </div>

                        <div class="d-flex justify-content-between mb-2">
                            <h5 class="mb-0">Përshkrimi:</h5>
                            <h5 class="text-dark mb-0 text-end product-description">
                                <b><?php echo htmlspecialchars($value['name']); ?></b>
                            </h5>
                        </div>

                        <?php if ($this->session->userdata('price_status') == 1) : ?>
                            <div class="d-flex justify-content-between mb-2">
                                <h5 class="mb-0">Çmimi:</h5>
                                <h5 class="text-dark mb-0">
                                    <b><?php echo $value['price']; ?><i class="fa fa-euro"></i></b>
                                </h5>
                            </div>
                        <?php endif ?>
                    </div>

                    <?php if ($this->session->userdata('role') == 'admin') : ?>
                        <div class="mt-2">
                            <a href="<?php echo base_url('admin/products/get_product/' . $value['id']); ?>" target="_blank">
                                <button class="btn btn-block" style="background:#53d1b2; font-size: 14px;"
                                        id="editButton_<?php echo $value['id']; ?>">
                                    <i class="fa fa-edit"></i> Ndrysho Produktin
                                </button>
                            </a>

                            <a href="<?php echo base_url('admin/products/delete_product/' . $category['id'] . '/' . $value['id']); ?>"
                               data-toggle="modal" data-target="#confirmDeleteModal"
                               data-productid="<?php echo $value['id']; ?>"
                               data-categoryid="<?php echo $category['id']; ?>">
                                <button class="btn btn-block mt-2" style="background:#ff5e2dcc; font-size: 14px;"
                                        id="deleteButton_<?php echo $value['id']; ?>">
                                    <i class="fa fa-trash"></i> Fshije Produktin
                                </button>
                            </a>

                            <a href="<?php echo base_url('admin/printproduct/print_one_product/'. $value['id']); ?>"
                               style="display:none;" id="printButton_<?php echo $value['id']; ?>" target="_blank">
                                <button class="btn btn-block mt-2" style="background:#7396CE; font-size: 14px;">
                                    <i class="fa fa-print"></i> Printo Produktin
                                </button>
                            </a>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<!-- Print selected container OUTSIDE listing so it's never deleted -->
<div class="col-md-12 col-lg-4 mb-lg-0" id="selectedProductsButtonContainer">
    <button id="gatherSelectedProductsBtn" class="btn" style="background:#7396CE;">
        <span><i class="fa fa-print" aria-hidden="true"></i> PRINTO PRODUKTET</span>
    </button>
</div>

<!-- SINGLE IMAGE MODAL -->
<div class="modal" id="imagemodal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
                <h4 class="modal-title" id="imagemodal_title"></h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="imagemodal_img" class="img-fluid"
                     style="margin-left:auto;margin-right:auto;display:block;width:270px;height:220px;">
            </div>
        </div>
    </div>
</div>

<!-- DELETE MODALS -->
<div class="modal background-blur" id="confirmDeleteModal" tabindex="-1" role="dialog"
     aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">A jeni i sigurt qe deshironi te fshini kete produkt?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Jo</button>
                <a id="deleteProductLink" href="#" class="btn btn-danger">Fshije</a>
            </div>
        </div>
    </div>
</div>

<div class="modal background-blur" id="confirmUNDeleteModal" tabindex="-1" role="dialog"
     aria-labelledby="confirmUNDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="confirmUNDeleteModalLabel">Konfirmo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">A jeni i sigurt qe deshironi te riktheni kete produkt?</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Jo</button>
                <a id="UNdeleteProductLink" href="#" class="btn btn-danger">Rikthe</a>
            </div>
        </div>
    </div>
</div>

<div id="loadingIndicator" style="display:none;text-align:center;padding:10px;">
    <div class="spinner"></div><br>
    <span>Me shume produkte..</span>
</div>

<script>
// ===== products.php JS (only) =====

// server data
let productsList = <?php echo json_encode($products); ?>;
let total_row_products = <?php echo json_encode($total_row_products); ?>;

// selection / print state
let selectedProducts = [];
let stateDropdown = '';

document.addEventListener("DOMContentLoaded", function () {
  history.scrollRestoration = "manual";
  setTimeout(() => window.scrollTo(0, 0), 10);

  const searchInput = document.getElementById("searchInput");
  const searchIcon = document.getElementById("searchIcon");
  const productListing = document.getElementById("productListing");
  const loadingIndicator = document.getElementById("loadingIndicator");
  const selectedBtnContainer = document.getElementById("selectedProductsButtonContainer");
  const gatherBtn = document.getElementById("gatherSelectedProductsBtn");

  window.base_url = <?php echo json_encode(base_url()); ?>;
  const url = window.base_url;

  const priceStatus = "<?php echo $_SESSION['price_status']; ?>";
  const role = "<?php echo $_SESSION['role']; ?>";

  // paging / search flags
  let isLoading = false;
  let isSearching = false;
  let searchInProgress = false;
  let hasMore = true;                 // HARD stop when no more data
  let getSearchResult = 0;            // total matches from backend (if provided)

  const limit = 20;

  // IMPORTANT: start after SSR products
  let offset = Array.isArray(productsList) ? productsList.length : 0;
  if (offset >= total_row_products) hasMore = false;

  let searchAbort = null;

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
    isSearching = false;
    searchInProgress = false;
    hasMore = true;
    getSearchResult = 0;

    productListing.innerHTML = "";
    productsList.length = 0;
    selectedProducts.length = 0;

    if (selectedBtnContainer) selectedBtnContainer.style.display = "none";
  }

  function showNotFound() {
    productListing.innerHTML =
      `<h4 class="page-title" style="color:#d9534f;font-weight:600;margin-left:26px;">
         PRODUKTI NUK U GJEND!
       </h4>`;
    searchInput.focus();
    window.scrollTo(0, 0);
  }

  async function searchProducts(query) {
    let response;

    if (query === "") {
      if (!hasMore || offset >= total_row_products) {
        hasMore = false;
        return;
      }
      response = await makeAsyncRequest(
        url + `admin/dashboard/get_products_with_limit/<?php echo $category['id']; ?>/${offset}`
      );
    } else {
      response = await makeAsyncRequest(
        url + `admin/dashboard/search_products_by_category/<?php echo $category['id']; ?>/?query=${encodeURIComponent(query)}&offset=${offset}`
      );
      if (typeof response.total === "number") getSearchResult = response.total;
    }

    const batch = response.products || [];

    // end of results
    if (batch.length === 0) {
      hasMore = false;

      // only show "not found" on first page of a search
      if (query !== "" && offset === 0) showNotFound();
      return;
    }

    // move forward only after successful batch
    offset += limit;

    productsList.push(...batch);
    updateProductListing(batch, response.category_id, query);

    // restore dropdown mode
    if (stateDropdown === "print") onClickButton("print");
    else if (stateDropdown === "select") onClickButton("select");
    else onClickButton("cancel");
  }

  function updateProductListing(products, category_id, query) {
    searchInput.value = query;

    if (products.length === 0) return;

    const html = products.map(product => `
      <div class="col-md-12 col-lg-4 mb-4 mb-lg-0" style="padding-left:5px;padding-right:5px;padding-bottom:15px;">
        <div class="card product-card d-flex flex-column h-100"
             data-product-id-main="${product.id}"
             data-product-name="${product.name}">
          <img
            id="imageresource_${product.id}"
            imgId="${product.id}"
            class="lazyload img-fluid mx-auto mt-3"
            style="width:90px; height:70px; object-fit: contain;"
            data-src="${url}optimum/products_images/${product.image}"
          />
          <div class="card-body d-flex flex-column justify-content-between flex-grow-1">
            <div>
              <div class="d-flex justify-content-between mb-2">
                <h5 class="mb-0">Kodi:</h5>
                <h5 class="text-dark mb-0"><b>${product.code}</b></h5>
              </div>
              <div class="d-flex justify-content-between mb-2">
                <h5 class="mb-0">Përshkrimi:</h5>
                <h5 class="text-dark mb-0 text-end product-description"><b>${product.name}</b></h5>
              </div>
              ${priceStatus == 1 ? `
              <div class="d-flex justify-content-between mb-2">
                <h5 class="mb-0">Çmimi:</h5>
                <h5 class="text-dark mb-0"><b>${product.price}<i class="fa fa-euro"></i></b></h5>
              </div>` : ''}
            </div>

            ${role === "admin" ? `
            <div class="mt-2">
              ${product.is_deleted == 0 ? `
              <a href="${url}admin/products/get_product/${product.id}" target="_blank">
                <button class="btn btn-block" style="background:#53d1b2; font-size:14px;" id="editButton_${product.id}">
                  <i class="fa fa-edit"></i> Ndrysho Produktin
                </button>
              </a>
              <a href="${url}admin/products/delete_product/${category_id}/${product.id}"
                 data-toggle="modal" data-target="#confirmDeleteModal"
                 data-productid="${product.id}" data-categoryid="${category_id}">
                <button class="btn btn-block mt-2" style="background:#ff5e2dcc; font-size:14px;" id="deleteButton_${product.id}">
                  <i class="fa fa-trash"></i> Fshije Produktin
                </button>
              </a>
              <a href="${url}admin/printproduct/print_one_product/${product.id}"
                 style="display:none;" id="printButton_${product.id}" target="_blank">
                <button class="btn btn-block mt-2" style="background:#7396CE; font-size:14px;">
                  <i class="fa fa-print"></i> Printo Produktin
                </button>
              </a>
              ` : `
              <a href="${url}admin/products/delete_product/${category_id}/${product.id}"
                 data-toggle="modal" data-target="#confirmUNDeleteModal"
                 data-productid="${product.id}" data-categoryid="${category_id}">
                <button class="btn btn-block mt-2" style="background:#ff5e2dcc; font-size:14px;" id="deleteButton_${product.id}">
                  <i class="fa fa-angle-left"></i> Rikthe Produktin
                </button>
              </a>`}
            </div>` : ""}
          </div>
        </div>
      </div>
    `).join("");

    productListing.insertAdjacentHTML("beforeend", html);

    // attach select handler to newly added cards only if in select mode
    if (stateDropdown === "select") {
      productListing.querySelectorAll(".product-card:not([data-select-bound])").forEach(card => {
        card.setAttribute("data-select-bound", "1");
        card.addEventListener("click", handleProductCardClick);
      });
    }
  }

  function performSearch() {
    const searchQuery = searchInput.value.trim();

    resetSearchState();
    window.scrollTo(0, 0);

    if (searchQuery === "") {
      isSearching = false;
      searchProducts("").catch(console.error);
    } else {
      isSearching = true;
      searchInProgress = true;
      searchProducts(searchQuery)
        .catch(console.error)
        .finally(() => (searchInProgress = false));
    }
  }

  // click / enter search
  searchIcon.addEventListener("click", performSearch);
  searchInput.addEventListener("keydown", e => {
    if (e.key === "Enter") performSearch();
  });


  // infinite scroll (throttled)
  function checkScrollLoadMore() {
    if (isLoading || searchInProgress || !hasMore) return;

    // stop if we know total and we've loaded all
    if (isSearching && getSearchResult > 0 && offset >= getSearchResult) {
      hasMore = false;
      return;
    }

    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const windowHeight = window.innerHeight;
    const documentHeight = document.documentElement.scrollHeight;

    if (scrollTop + windowHeight >= documentHeight - 120) {
      isLoading = true;
      showLoadingIndicator();

      const q = isSearching ? searchInput.value.trim() : "";
      searchProducts(q)
        .catch(console.error)
        .finally(hideLoadingIndicator);
    }
  }

  let scrollTick = false;
  window.addEventListener(
    "scroll",
    () => {
      if (scrollTick) return;
      scrollTick = true;
      requestAnimationFrame(() => {
        checkScrollLoadMore();
        scrollTick = false;
      });
    },
    { passive: true }
  );

  // ===== single image modal =====
  function cacheBust(u) {
    if (!u) return u;
    const sep = u.includes("?") ? "&" : "?";
    return u + sep + "cb=" + Date.now();
  }

  productListing.addEventListener("click", function (e) {
    const el = e.target;
    if (!el.classList.contains("img-fluid")) return;

    const id = el.getAttribute("imgId");
    const listImg = document.getElementById("imageresource_" + id);
    const src = listImg.getAttribute("src") || listImg.getAttribute("data-src");

    document.getElementById("imagemodal_img").src = cacheBust(src);

    const card = el.closest(".product-card");
    document.getElementById("imagemodal_title").textContent =
      card?.getAttribute("data-product-name") || "";

    $("#imagemodal").modal("show");
  });

  // ===== print/select dropdown =====
  updateButtonContainerWidth();
  window.addEventListener("resize", updateButtonContainerWidth);

  function updateButtonContainerWidth() {
    const overlayRow = document.querySelector("#productListing");
    if (overlayRow && selectedBtnContainer) {
      selectedBtnContainer.style.width = `${overlayRow.offsetWidth}px`;
    }
  }

  window.onClickButton = function (option) {
    stateDropdown = option;

    productsList.forEach(value => {
      const printButton = document.getElementById("printButton_" + value.id);
      const editButton = document.getElementById("editButton_" + value.id);
      const deleteButton = document.getElementById("deleteButton_" + value.id);
      const productCard = document.querySelector(
        `.product-card[data-product-id-main="${value.id}"]`
      );
      if (!productCard) return;

      if (option === "print") {
        if (printButton) printButton.style.display = "block";
        if (editButton) editButton.style.display = "none";
        if (deleteButton) deleteButton.style.display = "none";
        productCard.removeEventListener("click", handleProductCardClick);
      } else if (option === "select") {
        if (printButton) printButton.style.display = "none";
        if (editButton) editButton.style.display = "none";
        if (deleteButton) deleteButton.style.display = "none";

        if (!productCard.hasAttribute("data-select-bound")) {
          productCard.setAttribute("data-select-bound", "1");
          productCard.addEventListener("click", handleProductCardClick);
        }
      } else {
        if (printButton) printButton.style.display = "none";
        if (editButton) editButton.style.display = "block";
        if (deleteButton) deleteButton.style.display = "block";
        productCard.removeEventListener("click", handleProductCardClick);
      }

      productCard.classList.remove("selected");
    });

    if (option !== "select" && selectedBtnContainer) {
      selectedBtnContainer.style.display = "none";
      selectedProducts.length = 0;
    }
  };

  function handleProductCardClick(e) {
    if (stateDropdown !== "select") return;

    const card = e.currentTarget;
    const id = parseInt(card.getAttribute("data-product-id-main"), 10);

    card.classList.toggle("selected");

    if (card.classList.contains("selected")) {
      if (!selectedProducts.includes(id)) selectedProducts.push(id);
    } else {
      const i = selectedProducts.indexOf(id);
      if (i > -1) selectedProducts.splice(i, 1);
    }

    if (!selectedBtnContainer) return;

    if (selectedProducts.length > 0) {
      selectedBtnContainer.style.display = "block";
      updateButtonContainerWidth();
    } else {
      selectedBtnContainer.style.display = "none";
    }
  }

  // attach to initial cards
  document.querySelectorAll(".product-card").forEach(card => {
    card.setAttribute("data-select-bound", "1");
    card.addEventListener("click", handleProductCardClick);
  });

  // ===== print selected =====
  function makeRequestToBackEnd(products) {
    if (Array.isArray(products)) products = products.join(",");
    if (!products) return;

    const form = document.createElement("form");
    form.setAttribute("method", "get");
    form.setAttribute("action", `${window.base_url}admin/printproduct/print_selected_products`);

    const hiddenField = document.createElement("input");
    hiddenField.setAttribute("type", "hidden");
    hiddenField.setAttribute("name", "products");
    hiddenField.setAttribute("value", products);

    form.appendChild(hiddenField);
    form.style.display = "none";
    document.body.appendChild(form);
    form.submit();
  }

  gatherBtn.addEventListener("click", function (ev) {
    ev.preventDefault();
    const ids = selectedProducts.join(",");
    if (!ids) return;
    makeRequestToBackEnd(ids);
  });
});

// ===== focus glow for search bar =====
document.addEventListener("DOMContentLoaded", function () {
  const searchContainer = document.getElementById("searchContainer");
  const searchInput = document.getElementById("searchInput");
  const searchIcon = document.getElementById("searchIcon");

  function addFocus() {
    searchContainer.classList.add("focused");
  }
  function removeFocus() {
    searchContainer.classList.remove("focused");
  }

  searchInput.addEventListener("focus", addFocus);
  searchInput.addEventListener("blur", removeFocus);
  searchIcon.addEventListener("focus", addFocus);
  searchIcon.addEventListener("blur", removeFocus);
});

</script>
