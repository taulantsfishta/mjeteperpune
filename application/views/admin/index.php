<?php include 'layout/css.php'; ?>

<style>
/* —— Remove old sidebar —— */
.navbar-default.sidebar,
.slimscrollsidebar {
  display: none !important;
}
#page-wrapper {
  margin-left: 0 !important;
}

/* Navbar adjustments */
body { padding-top: 64px; }

.navbar {
  background: #fff;
}
.navbar .nav-link,
.navbar .navbar-brand {
  font-family: Verdana, sans-serif;
  font-size: 13px;
  font-weight: bold;
  color: #111 !important;
}
.dropdown-menu {
  font-family: Verdana, sans-serif;
  font-size: 12px;
}

/* Badge style (mimics label-danger look) */
.nav-badge {
  display:inline-block;
  padding: 2px 6px;
  font-size: 11px;
  line-height: 1;
  border-radius: 9999px;
}
.nav-badge-danger {
  background: #ef5350; color: #fff;
}

/* Mobile fix for collapse overlay */
@media (max-width: 991.98px) {
  .navbar-collapse.collapse:not(.show) { display: none !important; }
}

/* ===== Light modern, realistic palette ===== */
:root {
  --header-bg: #fbfcfd;        /* very light blue-gray */
  --header-text: #2d3e50;      /* neutral dark for contrast */
  --header-hover: #dce6ed;     /* slight hover tint */
  --accent: #1694fa8c;           /* red for counts / actions */
  --body-bg: #f8fafc;          /* near-white background */
  --card-bg: #ffffff;
  --border: #e3e7eb;
  --text-main: #212529;
  --text-muted: #6c757d;
}

/* ===== General ===== */
body {
  background: var(--body-bg);
  color: var(--text-main);
  font-family: "Segoe UI", "Verdana", sans-serif;
  font-size: 13px;
}
#page-wrapper { background: var(--body-bg); }

/* ===== Navbar ===== */
.navbar.navbar-light {
  background-color: var(--header-bg);
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
}
.navbar .navbar-brand,
.navbar .nav-link {
  color: var(--header-text) !important;
  font-weight: 600;
}
.navbar .nav-link:hover,
.navbar .nav-link:focus {
  background-color: var(--header-hover);
  color: var(--header-text) !important;
  border-radius: 4px;
}
.navbar .dropdown-menu {
  background: var(--card-bg);
  border: 1px solid var(--border);
  box-shadow: 0 2px 8px rgba(0,0,0,0.06);
}
.navbar .dropdown-item {
  color: var(--text-main);
}
.navbar .dropdown-item:hover {
  background: #f1f5f8;
}

/* ===== Badges ===== */
.nav-badge, .label-danger, .badge-danger {
  background: var(--accent);
  color: #fff;
  font-size: 11px;
  padding: 2px 6px;
  border-radius: 10px;
}

/* ===== Search box ===== */
input.form-control {
  background: #fff;
  border: 1px solid var(--border);
  border-radius: 5px;
  transition: all 0.2s ease;
}
input.form-control:focus {
  border-color: #b7c7d3;
  box-shadow: 0px -3px 6px -2px var(--accent);
}

/* ===== Cards / product boxes ===== */
.panel, .white-box, .card {
  background: var(--card-bg);
  border: 1px solid var(--border);
  border-radius: 6px;
  box-shadow: 0 1px 2px rgba(0,0,0,0.04);
  transition: box-shadow 0.2s ease, border-color 0.2s ease;
}
.panel:hover, .white-box:hover, .card:hover {
  border-color: #d4dae0;
  box-shadow: 0 4px 8px rgba(0,0,0,0.06);
}

/* ===== Titles / Text ===== */
.page-title {
  color: var(--text-main);
  font-weight: 600;
  letter-spacing: 0.3px;
}
.text-muted { color: var(--text-muted) !important; }

/* ===== Buttons ===== */
.btn-primary {
  background: #90a4b7;
  border-color: #90a4b7;
  color: #fff;
}
.btn-primary:hover {
  background: #7d95a8;
  border-color: #7d95a8;
}
.btn-outline-primary {
  color: #7d95a8;
  border-color: #7d95a8;
}
.btn-outline-primary:hover {
  background: #7d95a8;
  color: #fff;
}

/* ===== Scrollbar ===== */
::-webkit-scrollbar { width: 10px; }
::-webkit-scrollbar-thumb {
  background-color: #cfd5da;
  border-radius: 6px;
}
::-webkit-scrollbar-thumb:hover {
  background-color: #b7c0c7;
}

/* Add space between menu links */
.navbar-nav > li {
  margin-right: 22px;       /* increase/decrease as needed (16–28px is good range) */
}

/* Reduce margin on the very last element (profile dropdown) */
.navbar-nav > li:last-child {
  margin-right: 0;
}

/* Improve dropdown toggle padding (clickable area) */
.navbar .nav-link {
  padding: 10px 14px;
  display: flex;
  align-items: center;
  gap: 6px;                 /* small gap between icon and text */
}

/* On larger screens, increase separation visually */
@media (min-width: 992px) {
  .navbar-nav > li {
    margin-right: 28px;
  }
}

/* Dropdowns: small padding tweak for consistent spacing */
.dropdown-menu {
  padding-top: 6px;
  padding-bottom: 6px;
}

/* Inside dropdown items */
.dropdown-item {
  padding: 6px 14px;
  font-size: 13px;
}

/* Ensure icons and text in dropdowns align nicely */
.dropdown-item i {
  width: 16px;
  text-align: center;
  opacity: 0.85;
}

/* ===== Navbar border styling ===== */
.navbar.navbar-light {
  background-color: var(--header-bg);
  border-bottom: #f9f7f7; /* light black separator */
  box-shadow: 0px -4px 20px 0px var(--accent);
}

.bg-title h4 {
    color: #4b4a4aff;
    font-weight: 600;
    margin-top: 6px;
}

/* ===== Mobile fix: make every menu row full-width and align badge+arrow right ===== */
@media (max-width: 767.98px) {
  /* Make the collapsed list truly full width */
  .navbar-collapse .navbar-nav { width: 100% !important; display: block !important; }
  .navbar-collapse .navbar-nav .nav-item { width: 100% !important; }

  /* Each link spans the row and uses flex */
  .navbar-collapse .navbar-nav .nav-link {
    width: 100% !important;
    display: flex !important;
    align-items: center !important;
    justify-content: flex-start !important;
    padding: 12px 18px !important;
    position: static !important;     /* kill any absolute rules from earlier */
  }

  /* Left icon */
  .navbar-collapse .navbar-nav .nav-link i {
    margin-right: 10px;
    opacity: .65;
    flex-shrink: 0;
  }

  /* Badge pushes everything after it to the far right */
  .navbar-collapse .navbar-nav .nav-link .nav-badge {
    margin-left: auto !important;
    position: static !important;
    transform: none !important;
    background: #90a4b7 !important;
    color: #fff !important;
    font-size: 11px;
    font-weight: 700;
    line-height: 1;
    padding: 3px 8px;
    border-radius: 9999px;
  }

  /* Arrow sits right after the badge, same baseline */
  .navbar-collapse .navbar-nav .dropdown-toggle::after {
    content: '›';
    display: inline-block !important;
    border: 0 !important;
    margin-left: 8px !important;
    color: #9aa5b1;
    font-weight: 700;
    font-size: 16px;
    line-height: 1;
    position: static !important;
    transform: none !important;
  }
}
/* Mobile-only logout row styling (arrow at the far right) */
@media (max-width: 767.98px) {
  .navbar-nav .nav-item.d-md-none .nav-link.mobile-chevron {
    display: flex;
    align-items: center;
    padding: 12px 18px;
    color: #2d3e50 !important;
    font-weight: 700;
    width: 100%;
  }
  .navbar-nav .nav-item.d-md-none .nav-link.mobile-chevron i {
    opacity: .65;
    margin-right: 10px;
    flex-shrink: 0;
  }
  .navbar-nav .nav-item.d-md-none .nav-link.mobile-chevron::after {
    content: '›';
    display: inline-block;
    margin-left: auto;         /* push to the far right */
    color: #9aa5b1;
    font-weight: 700;
    font-size: 16px;
    line-height: 1;
  }
}

/* Make ALL buttons' text bolder */
button,
.btn,
.btn.btn-block,
.btn[class*="btn-"] {
  font-weight: 600 !important;   /* 700–800 looks solid; raise/lower if you want */
  letter-spacing: 0.4px;         /* tiny spacing so bold doesn't look cramped */
}

/* Keep icons from getting weirdly bold */
.btn i,
button i {
  font-weight:600 !important;
}

/* If you also want dropdown toggles (that look like buttons) bolder */
.dropdown .btn.dropdown-toggle {
  font-weight: 600 !important;
}


</style>


<!-- Preloader -->
<h1></h1>
<div class="preloader">
  <div class="cssload-speeding-wheel"></div>
</div>

<div id="wrapper">
  <!-- Top Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top border-bottom">
    <div class="container-fluid">

      <!-- Brand -->


      <!-- Mobile hamburger -->
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#topbarNav" aria-controls="topbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="topbarNav">
        <ul class="navbar-nav me-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navProducts" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="ti-dashboard p-r-10 me-1"></i>
              PRODUKTET
              <span class="ms-2 nav-badge nav-badge-danger">
                <?php echo count($this->session->userdata('category')) + 1; ?>
              </span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navProducts">
              <li>
                <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('admin/dashboard'); ?>">
                  <i class="fa fa-wrench me-2"></i> TË GJITHA PRODUKTET
                </a>
              </li>
              <li><hr class="dropdown-divider"></li>

              <!-- Categories -->
              <?php foreach ($this->session->userdata('category') as $key => $value) { ?>
                <li>
                  <a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('admin/dashboard/get_category/' . $value['id']); ?>">
                    <i class="fa fa-wrench me-2"></i>
                    <?php echo $value['id'] . '. ' . $value['name']; ?>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>

          <?php if (($this->session->userdata('name') == 'Admin' || $this->session->userdata('name') == 'Adminpz')): ?>

          <!-- KRIJO dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navCreate" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="icon-user p-r-10 me-1"></i>
              KRIJO
              <span class="ms-2 nav-badge nav-badge-danger">4</span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navCreate">
              <li><a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('admin/user'); ?>"><i class="fa fa-plus me-2"></i> PËRDORUES I RI</a></li>
              <li><a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('admin/user/all_user_list'); ?>"><i class="fa fa-list me-2"></i> LISTA E TË GJITHË PËRDORUESVE</a></li>
              <li><a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('admin/categories'); ?>"><i class="fa fa-list me-2"></i> KATEGORIT</a></li>
              <li><a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('admin/user/login_history'); ?>"><i class="fa fa-list me-2"></i> HISTORIKU I PËRDORUESVE</a></li>
            </ul>
          </li>

          <!-- PRINTO dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navPrint" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-print p-r-10 me-1"></i>
              PRINTO
              <span class="ms-2 nav-badge nav-badge-danger">2</span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navPrint">
              <li><a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('admin/printproduct'); ?>"><i class="fa fa-print me-2"></i> PRINTO PRODUKTET</a></li>
              <li><a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('admin/printproduct/page_dimension'); ?>"><i class="fa fa-paper-plane me-2"></i> DIMENSIONET E FLETËS</a></li>
            </ul>
          </li>

          <!-- FATURAT dropdown -->
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navInvoices" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fa fa-file p-r-10 me-1" aria-hidden="true"></i>
              FATURAT
              <span class="ms-2 nav-badge nav-badge-danger">2</span>
            </a>
            <ul class="dropdown-menu" aria-labelledby="navInvoices">
              <li><a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('admin/invoices/'); ?>"><i class="fa fa-plus me-2"></i> KRIJO FATURËN</a></li>
              <li><a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('admin/invoices/created'); ?>"><i class="fa fa-file me-2"></i> FATURAT E KRIJUARA</a></li>
            </ul>
          </li>

          <?php endif; ?>
        </ul>

        <!-- Right side: Profile + Logout -->
      <li class="nav-item dropdown d-none d-md-flex" id="navProfile">
        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navProfile" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          <img src="<?php echo base_url(); ?>optimum/images/profile-icon1.png" alt="user-img" width="32" height="32" class="rounded-circle me-2">
          <span class="d-none d-lg-inline"><?php echo $this->session->userdata('name'); ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navProfile">
          <li><a class="dropdown-item d-flex align-items-center" href="<?php echo base_url('auth/logout'); ?>"><i class="fa fa-power-off me-2"></i> Logout</a></li>
        </ul>
      </li>

      <!-- Mobile-only logout item -->
      <li class="nav-item d-md-none">
        <a href="<?php echo base_url('auth/logout'); ?>" class="nav-link d-flex align-items-center mobile-chevron">
          <i class="icon-logout fa-fw me-2"></i>
          DIL NGA PROGRAMI
        </a>
      </li>

        
      </div>
    </div>
  </nav>

  <!-- Page content -->
  <div id="page-wrapper">
    <div class="container-fluid">
      <div class="row bg-title">
        <h4 class="page-title"><?php echo $page_title; ?></h4>
      </div>
      <?php echo $main_content; ?>
    </div>
    <?php include 'layout/footer.php'; ?>
  </div>
</div>

<?php include 'layout/js.php'; ?>

<script>
(function($){
  $(function(){
    $('body').removeClass('mini-sidebar');
    $('.navbar-collapse').removeClass('in show').attr('aria-expanded','false');
  });
})(jQuery);
</script>
