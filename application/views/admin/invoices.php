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
  grid-template-columns: 1fr 1fr 1fr 1fr;
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


/* === Buttons: vertical, full-width, same visual size as other cards === */

/* Target the last row in the form (the one with the buttons) */
#sales_form > .row:last-of-type {
  /* make the whole block a card like totals/table */
  border: 1px solid var(--border);
  border-radius: var(--radius);
  box-shadow: var(--shadow);
  background: #fff;
  padding: 16px;
  margin: 0;        /* keep tight with container */
}

/* Make its column fill the row and stack buttons vertically */
#sales_form > .row:last-of-type .col-lg-10 {
  width: 100%;           /* full width so it matches other blocks */
  max-width: 100%;
  display: flex;
  flex-direction: column;
  gap: 12px;             /* space between buttons */
  padding: 0;            /* remove Bootstrap column padding so card edges line up */
}

/* Buttons fill width and look consistent */
#sales_form > .row:last-of-type .btn {
  width: 100%;
  padding: 16px 0;
  border-radius: 8px;
  font-weight: bold;
  font-size: 15px;
}

/* Optional: tighten on small screens (already stacks, but keep consistency) */
@media (max-width: 1024px) {
  #sales_form > .row:last-of-type {
    margin-top: 16px;
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


/*invocieStructure*/

/* Wrapper për tablet/desktop: scroll horizontal kur ka shumë kolona */
.invoices-table-wrap {
  width: 100%;
  overflow-x: auto;
  -webkit-overflow-scrolling: touch;
}

/* Pak konsolidim spacing në ekran të vogël */
#invoicesStructure #myInput {
  margin-bottom: 8px;
}

/* —— Tablet (<= 992px): ruaj tabelën me scroll, pak tipografi më e vogël —— */
@media (max-width: 992px) {
  #invoiceData {
    font-size: 14px;
  }
  #invoicesStructure .table th,
  #invoicesStructure .table td {
    white-space: nowrap;
  }
}

/* —— Mobile (<= 768px): kthim në "card/list" —— */
@media (max-width: 768px) {
  /* Fshi header për mobile */
  #invoiceData thead {
    display: none;
  }

  /* Çdo rresht si kartë */
  #invoiceData tbody tr {
    display: block;
    border: 1px solid #e4e7ea;
    border-radius: 12px;
    padding: 10px 12px;
    margin-bottom: 12px;
    box-shadow: 0 1px 3px rgba(0,0,0,.04);
    background: #fff;
  }

  /* Qelizat në dy kolona: Label (para) + Vlera (pas) */
  #invoiceData tbody td {
    display: grid;
    grid-template-columns: 42% 58%;
    align-items: center;
    border: none !important;
    padding: 6px 0 !important;
    font-size: 15px;
  }

  /* Vija ndarëse e lehtë mes fushave */
  #invoiceData tbody td + td {
    border-top: 1px dashed #e9ecef !important;
    padding-top: 8px !important;
    margin-top: 6px;
  }

  /* Label-at e kolonave (hard-coded me nth-child) */
  #invoiceData tbody td:nth-child(1)::before { content: "ID"; }
  #invoiceData tbody td:nth-child(2)::before { content: "Klienti"; }
  #invoiceData tbody td:nth-child(3)::before { content: "Adresa"; }
  #invoiceData tbody td:nth-child(4)::before { content: "Telefoni"; }
  #invoiceData tbody td:nth-child(5)::before { content: "Totali"; }
  #invoiceData tbody td:nth-child(6)::before { content: "Parapagesë"; }
  #invoiceData tbody td:nth-child(7)::before { content: "Shuma e mbetur"; }
  #invoiceData tbody td:nth-child(8)::before { content: "Data e krijimit"; }
  #invoiceData tbody td:nth-child(9)::before { content: "Veprimi"; }

  /* Stili i label-it */
  #invoiceData tbody td::before {
    font-weight: 600;
    color: #475569;
    padding-right: 10px;
  }

  /* Butoni i veprimit në fund, i rreshtuar bukur */
  #invoiceData tbody td:last-child {
    margin-top: 8px;
  }
  #invoiceData tbody td:last-child a .btn {
    transform: scale(1.05);
  }

  /* Hover/selected ngjyrat të përshtatshme për card */
  #invoiceData.table-hover > tbody > tr:hover {
    background-color: #f8fafc !important;
  }
  .selected-row {
    background-color: #eef6ff !important;
  }

  /* Shmang overflow nga width fiks të kolonave */
  .table-col-7, .table-col-10, .table-col-12, .table-col-33, .table-col-36, .table-col-20 {
    width: auto !important;
  }
}

/* —— Small mobile (<= 380px): tipografi edhe më kompakte —— */
@media (max-width: 380px) {
  #invoiceData tbody td {
    grid-template-columns: 48% 52%;
    font-size: 14px;
  }
  #invoicesStructure .btn.btn-circle.btn-xs {
    transform: scale(0.95);
  }
}



.debt-client-suggestions{position:absolute;z-index:9999;background:#fff;border:1px solid #ddd;max-height:240px;overflow-y:auto;min-width:320px;box-shadow:0 4px 12px rgba(0,0,0,.15)}
.debt-client-suggestion{padding:9px 12px;cursor:pointer;border-bottom:1px solid #eee}
.debt-client-suggestion:hover,.debt-client-suggestion.keyboard-active{background:#dbeafe;outline:2px solid #93c5fd;outline-offset:-2px}
.invoice-debt-client-option.keyboard-active{background:#dbeafe!important;outline:2px solid #93c5fd;outline-offset:-2px}
.debt-client-suggestion small{display:block;color:#777;margin-top:2px}
</style>
<div class="row" id="invoicesStructure">
  <div class="col-lg-12">
    <div class="row">
      <?php if (!empty($invoiceIsAdmin)): ?>
      <div class="col-md-2 col-lg-2">
        <select id="invoiceUserFilter" class="form-control" aria-label="Faturat sipas përdoruesit">
          <?php foreach ($invoiceUserOptions as $invoiceUser): ?>
            <option value="<?php echo (int)$invoiceUser['id']; ?>" <?php echo (int)$invoiceUser['id'] === (int)$invoiceSelectedUserId ? 'selected' : ''; ?>>
              <?php echo htmlspecialchars($invoiceUser['display_name'], ENT_QUOTES, 'UTF-8'); ?>
            </option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="col-md-10 col-lg-10">
        <input class="form-control" id="myInput" type="text" placeholder="Kerko...">
      </div>
      <?php else: ?>
      <div class="col-lg-3 d-none d-lg-block"></div>
      <div class="col-12 col-md-8 col-lg-6"><input class="form-control" id="myInput" type="text" placeholder="Kerko..."></div>
      <div class="col-lg-3 d-none d-lg-block"></div>
      <?php endif; ?>
    </div>
    <br>

    <!-- WRAPPER për responsivitet -->
    <div class="invoices-table-wrap">
      <table class="table table-bordered table-striped table-hover"
             data-tablesaw-mode="columntoggle"
             id="invoiceData"
             style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">
        <thead>
          <tr>
            <th class="table-col-7">ID</th>
            <th class="table-col-10">KLIENTI</th>
            <th class="table-col-10">ADRESA</th>
            <th class="table-col-10">TELEFONI</th>
            <th class="table-col-10">TOTALI</th>
            <th class="table-col-10">PARAPAGESË</th>
            <th class="table-col-10">SHUMA E MBETUR</th>
            <th class="table-col-10">DATA E KRIJIMIT</th>
            <th class="table-col-7">VEPRIMI</th>
          </tr>
        </thead>
        <tbody id="invoicesStructureBody">
          <?php if(isset($invoicesCreated)) { ?>
            <?php foreach ($invoicesCreated as $key => $value) { ?>
            <tr data-id="<?php echo $value['id']; ?>" data-own="<?php echo (int)$value['user_id'] === (int)$invoiceOwnUserId ? 1 : 0; ?>">
              <td class="table-col-7"><?php echo htmlspecialchars($adminName, ENT_QUOTES, 'UTF-8').'-'.(int)$value['id']; ?></td>
              <td class="table-col-10"><?php echo htmlspecialchars($value['client_name']); ?></td>
              <td class="table-col-10"><?php echo htmlspecialchars($value['address']); ?></td>
              <td class="table-col-10"><?php echo htmlspecialchars(isset($value['phone']) ? $value['phone'] : (isset($value['phone_number']) ? $value['phone_number'] : '')); ?></td>
              <td class="table-col-10"><?php echo htmlspecialchars($value['total_price_invoice']); ?></td>
              <td class="table-col-10"><?php echo htmlspecialchars($value['prepayment_price_invoice']); ?></td>
              <td class="table-col-10"><?php echo htmlspecialchars($value['total_price_left_invoice']); ?></td>
              <td class="table-col-10"><?php echo htmlspecialchars($value['created_at']); ?></td>
              <td class="table-col-7">
                <?php if ((int)$value['user_id'] === (int)$invoiceOwnUserId): ?>
                <a href="<?php echo base_url('admin/invoices/delete_inovice/' . $value['id']); ?>"
                   data-toggle="modal"
                   data-target="#confirmDeleteModal"
                   data-invoiceid="<?php echo $value['id']; ?>">
                  <button type="button" class="btn btn-danger btn-circle btn-lg"><i class="icon-trash"></i></button>
                </a>
                <?php else: ?>
                <a class="btn btn-info btn-sm" target="_blank" rel="noopener" href="<?php echo base_url('admin/invoices/print_pdf?id=' . (int)$value['id']); ?>">Shiko PDF</a>
                <?php endif; ?>
              </td>
            </tr>
            <?php } ?>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>


<div class="modal" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmo</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                A jeni i sigurt qe deshironi te fshini kete fature?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Jo</button>
                <a id="deleteProductLink" href="#" class="btn btn-danger">Fshije</a>
            </div>
        </div>
    </div>
</div>

<div class="row" id="mainDiv" style="display:none;">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-lg-3 text-left">
                <button type="button" class="btn btn-info" style="color:white;background:#7396CE;"  id="backButton"><i class="fa fa-arrow-left"></i> KTHEHU</button>
            </div>
        </div>
        <br>
        <div class="white-box">
        <form id="sales_form" method="post" action="<?php echo base_url('admin/invoices/sheet_invoice/'); ?>" target="_blank" enctype="multipart/form-data">

            <!-- Top inputs -->
            <div class="form-grid">
            <div>
                <label for="client_name">Emri I Klientit:</label>
                <input type="text" id="client_name" name="client_name" value="QYTETAR" required>
            <input type="hidden" id="debt_client_id" name="debt_client_id" value="">
            <div id="debtClientSuggestions" class="debt-client-suggestions" style="display:none;"></div>
            </div>
            <div>
                <label for="address">Adresa:</label>
                <input type="text" id="address" name="address" value="KOSOVE" required>
            </div>
            <div>
                <label for="phone_number">Numri I Telefonit:</label>
                <input type="text" id="phone_number" name="phone" value="">
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
            <button type="button" id="debtBtn" class="btn" style="background:#d9534f;color:#fff;"><i class="fa fa-money"></i> DETYRIM NGA KLIENTI</button>
                <button type="button" id="delete_row" class="btn" style="display:none;"><i class="fa fa-trash"></i> FSHIJ RRESHTAT</button>
            </div>
            </div>

        </form>
        </div>
    </div>
</div>



<!-- Konfirmimi i detyrimit nga lista e faturave -->
<div class="modal" id="confirmListDebtModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title">Konfirmo detyrimin</h5><button type="button" class="close" data-bs-dismiss="modal">&times;</button></div>
    <div class="modal-body" id="confirmListDebtMessage"></div>
    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Jo</button><button type="button" class="btn btn-danger" id="confirmListDebtAction">Po, konfirmo</button></div>
  </div></div>
</div>
<!-- Konfirmimi i detyrimit -->
<div class="modal" id="confirmDebtModal" tabindex="-1" role="dialog" aria-labelledby="confirmDebtModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title" id="confirmDebtModalLabel">Konfirmo detyrimin</h5>
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body" id="confirmDebtModalMessage">A dëshironi ta regjistroni ose përditësoni shumën e mbetur si detyrim?</div>
    <div class="modal-footer"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Jo</button>
      <button type="button" class="btn btn-danger" id="confirmDebtAction">Po, konfirmo</button></div>
  </div></div>
</div>
<!-- Njoftimet e detyrimit -->
<div class="modal" id="debtNotificationModal" tabindex="-1" role="dialog" aria-labelledby="debtNotificationModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document"><div class="modal-content">
    <div class="modal-header"><h5 class="modal-title" id="debtNotificationModalLabel">Njoftim</h5>
      <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    </div>
    <div class="modal-body" id="debtNotificationMessage"></div>
    <div class="modal-footer"><button type="button" class="btn btn-primary" data-bs-dismiss="modal">Në rregull</button></div>
  </div></div>
</div>
<script>
function showDebtNotification(message, title) {
    $('#debtNotificationModalLabel').text(title || 'Njoftim');
    $('#debtNotificationMessage').text(message);
    $('#debtNotificationModal').modal('show');
}
</script>

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

    function jumpToTopImmediate() {
        // vendose scroll në krye në mënyrë agresive, pa animacion
        document.body.style.scrollBehavior = 'auto';
        document.documentElement.style.scrollBehavior = 'auto';

        // vendos 0 në të dyja, disa herë për siguri (para pikturimit)
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
        window.scrollTo(0, 0);

        // forcoje edhe në frame-in tjetër (shmang flicker në disa browsera)
        requestAnimationFrame(function () {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
            window.scrollTo(0, 0);
        });
    }

    
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
                    <td style="display:none;"><input class="id" hidden></td>
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


    // Function to update the total sum

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

        var totalSumNew = $('#total_price_invoice').val() - prepayment;

        $('#total_price_left_invoice').val(totalSumNew.toFixed(2));

        // If input is empty, keep it empty instead of showing 0
        if (prepaymentVal === "" || $('#total_price_invoice').val() < prepayment) {
            $('#prepayment_price_invoice').val("");
            $('#total_price_left_invoice').val("");

        }
    });

    // Event listener for adding row button
    $('#add_row').click(function() {
        addRow();
    });

    // Event listener for dynamically fetching product details based on product_name input

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
                var id = selectedProduct.data('id');
                var image = selectedProduct.data('image');

                image = image.split("/").pop();
                // Populate the corresponding fields in the main table row
                row.find('.product_name').val(productName);
                row.find('.code').val(code);
                row.find('.price').val(price);
                row.find('.quantity').val(quantity);
                row.find('.total_product_price').val(total_product_price);
                row.find('.id').val(id);
                row.find('.image').val(image);
                row.find('.quantity').focus().select();

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

  $(document).on('change', '#invoiceUserFilter', function() {
    var url = new URL(window.location.href);
    url.searchParams.set('invoice_user_id', this.value);
    window.location.href = url.toString();
  });

  $("#backButton").click(function() {
    $('#search_results_table').hide();
    $.ajax({
        url: window.base_url + 'admin/invoices/get_invoices', // Replace with your actual PHP script URL
        method: 'GET',
        data: { invoice_user_id: <?php echo (int)$invoiceSelectedUserId; ?> },
        success: function(response) {
            var res = typeof response === 'string' ? JSON.parse(response) : response;
            let html = `<div class="row" id='invoicesStructure'>
                        <div class="col-lg-12">
                            <div class="row">
                                <?php if (!empty($invoiceIsAdmin)): ?>
                                <div class="col-lg-4"><select id="invoiceUserFilter" class="form-control" aria-label="Faturat sipas përdoruesit"><?php foreach ($invoiceUserOptions as $invoiceUser): ?><option value="<?php echo (int)$invoiceUser['id']; ?>" <?php echo (int)$invoiceUser['id'] === (int)$invoiceSelectedUserId ? 'selected' : ''; ?>><?php echo htmlspecialchars($invoiceUser['display_name'], ENT_QUOTES, 'UTF-8'); ?></option><?php endforeach; ?></select></div>
                                <div class="col-lg-8"><input class="form-control" id="myInput" type="text" placeholder="Kerko..."></div>
                                <?php else: ?>
                                <div class="col-lg-3"></div><div class="col-lg-6"><input class="form-control" id="myInput" type="text" placeholder="Kerko..."></div><div class="col-lg-3"></div>
                                <?php endif; ?>
                            </div>
                            <br>
                            <table class="table table-bordered table-striped table-hover" data-tablesaw-mode="columntoggle" id="invoiceData" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">
                                <thead>
                                <tr>
                                    <th  class="table-col-7">ID</th>
                                    <th class="table-col-10">KLIENTI</th>
                                    <th class="table-col-10">ADRESA</th>
                                    <th class="table-col-10">TELEFONI</th>
                                    <th class="table-col-10">TOTALI</th>
                                    <th class="table-col-10">PARAPAGESË</th>
                                    <th class="table-col-10">SHUMA E MBETUR</th>
                                    <th class="table-col-10">DATA E KRIJIMIT</th>
                                    <th class="table-col-7">VEPRIMI</th>
                                </tr>
                                </thead>
                            <tbody id="invoicesStructureBody">`;

                            res.forEach(function(value, index) {
                                html += `
                                    <tr data-id="${value.id}" data-own="${Number(value.user_id) === <?php echo (int)$invoiceOwnUserId; ?> ? 1 : 0}">
                                        <td class="table-col-7"><?php echo htmlspecialchars($adminName, ENT_QUOTES, 'UTF-8'); ?> - ${value.id}</td>
                                        <td class="table-col-10">${escapeHtml(value.client_name)}</td>
                                        <td class="table-col-10">${escapeHtml(value.address || '')}</td>
                                        <td class="table-col-10">${escapeHtml(value.phone || value.phone_number || '')}</td>
                                        <td class="table-col-10">${escapeHtml(value.total_price_invoice)}</td>
                                        <td class="table-col-10">${escapeHtml(value.prepayment_price_invoice)}</td>
                                        <td class="table-col-10">${escapeHtml(value.total_price_left_invoice)}</td>
                                        <td class="table-col-12">${escapeHtml(value.created_at)}</td>
                                        <td>
                                            ${Number(value.user_id) === <?php echo (int)$invoiceOwnUserId; ?>
                                                ? `<a href="${window.base_url}admin/invoices/delete_inovice/${value.id}"
                                                    data-toggle="modal"
                                                    data-target="#confirmDeleteModal"
                                                    data-invoiceid="${value.id}">
                                                    <button type="button" class="btn btn-danger btn-circle btn-xs">
                                                        <i class="icon-trash"></i>
                                                    </button>
                                                </a>`
                                                : `<a class="btn btn-info btn-sm"
                                                    target="_blank"
                                                    rel="noopener"
                                                    href="${window.base_url}admin/invoices/print_pdf?id=${value.id}">
                                                    Shiko PDF
                                                </a>`
                                            }
                                        </td>
                                    </tr>`;
                            });

                            html += `</tbody>
                                    </table>
                                    </div>
                                    </div>`;
            $("#invoicesStructure").html(html);
            $("#mainDiv").hide();
            jumpToTopImmediate();

            $("#invoicesStructure").show();
                // 🔁 ADD THIS BELOW
            $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#invoicesStructureBody tr").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
            });
        },
        error: function(error) {
            console.error("Error fetching details:", error);
        }
    });

    function escapeHtml(text) {
    return text
        .replace(/&/g, "&amp;")
        .replace(/</g, "&lt;")
        .replace(/>/g, "&gt;")
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#039;");
}
  });

  // Event listener for clicking on a row to load invoice details
    $(document).on("click", "#invoiceData tbody tr", function(e) {
        if (e.target.tagName === 'TD' || e.target.tagName === 'TR') {
            if (String($(this).data('own')) === '0') return;
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
            $("#mainDiv").show();
            var res = JSON.parse(response);

            // Kur hapet faturë tjetër, mos përdor ID-në e faturës së mëparshme.
            $('#sales_form input#id').remove();
            $('#sales_form').append($('<input>', {type:'hidden', id:'id', name:'id', value:res.id || invoiceId}));
            $('#debt_client_id').val('');
            $("#client_name").val(res.client_name);
            $("#address").val(res.address);
            $("#phone_number").val(res.phone || res.phone_number || '');
            $("#date").val(res.date);
            $("#comment").val(res.comment);
  jumpToTopImmediate();

            // Clear and populate product rows
            $("#product_rows").empty();
            var row_data = JSON.parse(res.row_data);
            row_data.forEach(function(product, index) {
                var price = parseFloat(product.price) || 0;
                var highlightClass = price === 0 || price < 0 ? 'price-zero-row' : '';
                var row = `<tr class="${highlightClass}">
                    <td>${index + 1}</td>
                    <td><input type="text" class="product_name" name="product_name[]" value="${_.escape(product.product_name)}"></td>
                    <td><input type="text" class="code" name="code[]" value="${product.code}"></td>
                    <td><input type="text" class="quantity" name="quantity[]" value="${product.quantity}"></td>
                    <td><input type="text" class="price" name="price[]" value="${product.price}"></td>
                    <td><input type="text" class="total_product_price" name="total_product_price[]" value="${product.total_product_price}"></td>
                    <td style="display:none;"><input type="text" class="id" value="${invoiceId}" hidden></td>
                    <td style="display:none;"><input type="text" class="image" name="image[]" value="${product.image}" hidden></td>
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
            if (priceVal === '' || isNaN(priceNum)) {
                price.addClass('input-error');
            } else {
                price.removeClass('input-error');
            }
        }


        window.validateAndSubmitForm = validateAndSubmitForm;

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

                      $('#sales_form > #id').remove();
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

<script>
$(document).ready(function () {
    var debtSearchTimer = null;
    var debtSearchRequest = null;
    var debtSearchSequence = 0;
    var debtActiveIndex = -1;
    function highlightDebtSuggestion(index) {
        var items = $('#debtClientSuggestions .debt-client-suggestion');
        if (!items.length) return;
        debtActiveIndex = Math.max(0, Math.min(index, items.length - 1));
        items.removeClass('keyboard-active').attr('aria-selected', 'false');
        var active = items.eq(debtActiveIndex).addClass('keyboard-active').attr('aria-selected', 'true');
        active[0].scrollIntoView({block: 'nearest'});
    }
    $('#client_name').on('keydown', function (e) {
        var box = $('#debtClientSuggestions');
        var items = box.find('.debt-client-suggestion');
        if (e.key === 'Escape') { box.hide(); debtActiveIndex = -1; return; }
        if (!box.is(':visible') || !items.length) return;
        if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
            e.preventDefault();
            highlightDebtSuggestion(e.key === 'ArrowDown' ?
                (debtActiveIndex + 1) % items.length :
                (debtActiveIndex < 0 ? items.length - 1 : (debtActiveIndex - 1 + items.length) % items.length));
        } else if (e.key === 'Enter' && debtActiveIndex >= 0) {
            e.preventDefault();
            items.eq(debtActiveIndex).trigger('click');
        }
    });

    $('#client_name').on('input', function () {
        $('#debt_client_id').val('');
        clearTimeout(debtSearchTimer);
        debtSearchSequence++;
        if (debtSearchRequest) debtSearchRequest.abort();
        debtActiveIndex = -1;
        var requestSequence = debtSearchSequence;
        var q = $.trim($(this).val());
        if (q.length < 2) {
            $('#debtClientSuggestions').hide().empty();
            return;
        }
        debtSearchTimer = setTimeout(function () {
            debtSearchRequest = $.ajax({
                url: '<?php echo base_url("admin/invoices/search_debt_clients_invoice"); ?>',
                type: 'GET',
                dataType: 'json',
                data: {search: q},
                success: function (res) {
                    if (requestSequence !== debtSearchSequence) return;
                    debtActiveIndex = -1;
                    var box = $('#debtClientSuggestions').empty();
                    if (!res || !res.length) { box.hide(); return; }
                    $.each(res, function (_, c) {
                        $('<div class="debt-client-suggestion"></div>')
                            .attr('data-id', c.id)
                            .attr('data-name', c.name || '')
                            .attr('data-address', c.address || '')
                            .attr('data-phone', c.phone || '')
                            .html('<strong>' + $('<div>').text(c.name || '').html() + '</strong>' +
                                  '<small>' + $('<div>').text((c.address || '') + ((c.phone || '') ? ' | ' + c.phone : '')).html() + '</small>')
                            .appendTo(box);
                    });
                    box.show();
                }
            });
        }, 250);
    });

    $(document).on('click', '.debt-client-suggestion', function () {
        $('#debt_client_id').val($(this).data('id'));
        $('#client_name').val($(this).attr('data-name'));
        if ($(this).attr('data-address')) $('#address').val($(this).attr('data-address'));
        if ($(this).attr('data-phone')) $('#phone_number').val($(this).attr('data-phone'));
        debtActiveIndex = -1;
        $('#debtClientSuggestions').hide().empty();
    });

    $(document).on('click', function(e){
        if (!$(e.target).closest('#client_name,#debtClientSuggestions').length) {
            $('#debtClientSuggestions').hide();
        }
    });

    // Konfirmimi i detyrimit në faturën e hapur.
    $('#debtBtn').on('click', function(e) {
        e.preventDefault();
        $('#confirmDebtModalMessage').text('A dëshironi ta ruani faturën dhe ta regjistroni ose përditësoni shumën e mbetur si detyrim?');
        $('#confirmDebtModal').modal('show');
    });

    $('#confirmDebtAction').on('click', function() {
        var $confirm = $(this), $debt = $('#debtBtn');
        var clientId = $('#debt_client_id').val();
        var existingId = $('#sales_form > #id').val();
        if (!existingId && !clientId) {
            $('#confirmDebtModal').modal('hide');
            $('#confirmDebtModal').one('hidden.bs.modal', function() {
                showDebtNotification('Zgjidhni klientin ekzistues nga lista e borxheve.', 'Vërejtje');
            });
            return;
        }
        $confirm.prop('disabled', true).text('Duke ruajtur...');
        $debt.prop('disabled', true);
        $('#confirmDebtModal').modal('hide');
        function unlock() {
            $confirm.prop('disabled', false).text('Po, konfirmo');
            $debt.prop('disabled', false);
        }
        $(document).one('invoiceSaveFailed', unlock);
        window.validateAndSubmitForm('ruaj_faturen', true, function() {
            $(document).off('invoiceSaveFailed', unlock);
            var savedId = $('#sales_form > #id').val();
            if (!savedId) {
                unlock();
                showDebtNotification('Fatura nuk u ruajt. Detyrimi nuk u ndryshua.', 'Gabim');
                return;
            }
            $confirm.text('Duke regjistruar...');
            $.ajax({
                url: window.base_url + 'admin/invoices/invoice_to_debt',
                type: 'POST', dataType: 'json',
                data: {invoice_id: savedId, debt_client_id: clientId},
                success: function(res) {
                    if (res && res.status) {
                        if (res.client_id) $('#debt_client_id').val(res.client_id);
                        showDebtNotification(res.message || 'Detyrimi u regjistrua me sukses.', 'Sukses');
                    } else {
                        showDebtNotification((res && res.message) || 'Detyrimi nuk u regjistrua.', 'Vërejtje');
                    }
                },
                error: function(xhr) {
                    showDebtNotification((xhr.responseJSON && xhr.responseJSON.message) || 'Gabim gjatë regjistrimit të detyrimit.', 'Gabim');
                }, complete: unlock
            });
        });
    });
});
</script>


<div class="modal" id="invoiceDebtClientModal" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document"><div class="modal-content">
    <div class="modal-header"><h4 class="modal-title">Zgjidh klientin nga lista e borxheve</h4><button type="button" class="close" data-bs-dismiss="modal">&times;</button></div>
    <div class="modal-body">
      <p>Fatura: <strong id="debtInvoiceLabel"></strong></p>
      <input type="text" id="invoiceDebtClientSearch" class="form-control" placeholder="Kërko emrin, adresën ose telefonin" autocomplete="off">
      <input type="hidden" id="invoiceDebtSelectedClient" value="">
      <div id="invoiceDebtClientResults" style="max-height:260px;overflow:auto;margin-top:10px"></div>
      <p id="invoiceDebtSelectedLabel" style="margin-top:10px"></p>
    </div>
    <div class="modal-footer"><button type="button" class="btn btn-default" data-bs-dismiss="modal">ANULO</button><button type="button" id="confirmInvoiceDebt" class="btn btn-danger" disabled>KONFIRMO DETYRIMIN</button></div>
  </div></div>
</div>
<script>
$(function(){
  var pendingInvoiceId = 0, pendingInvoiceName = '', searchTimer = null;
  var modalSearchRequest = null, modalSearchSequence = 0, modalActiveIndex = -1;
  function highlightModalClient(index) {
    var items = $('#invoiceDebtClientResults .invoice-debt-client-option');
    if (!items.length) return;
    modalActiveIndex = Math.max(0, Math.min(index, items.length - 1));
    items.removeClass('keyboard-active').attr('aria-selected', 'false');
    var active = items.eq(modalActiveIndex).addClass('keyboard-active').attr('aria-selected', 'true');
    active[0].scrollIntoView({block:'nearest'});
  }
  $('#invoiceDebtClientSearch').on('keydown', function(e) {
    var items = $('#invoiceDebtClientResults .invoice-debt-client-option');
    if (e.key === 'Escape') { $('#invoiceDebtClientResults').empty(); modalActiveIndex = -1; return; }
    if (!items.length) return;
    if (e.key === 'ArrowDown' || e.key === 'ArrowUp') {
      e.preventDefault();
      highlightModalClient(e.key === 'ArrowDown' ?
        (modalActiveIndex + 1) % items.length :
        (modalActiveIndex < 0 ? items.length - 1 : (modalActiveIndex - 1 + items.length) % items.length));
    } else if (e.key === 'Enter' && modalActiveIndex >= 0) {
      e.preventDefault(); items.eq(modalActiveIndex).trigger('click');
    }
  });
  function safeText(v){ return $('<div>').text(v == null ? '' : String(v)).html(); }
  $(document).on('click', '.invoice-debt-action', function(e){
    e.preventDefault(); e.stopPropagation();
    pendingInvoiceId = parseInt($(this).attr('data-invoiceid'), 10) || 0;
    pendingInvoiceName = $(this).attr('data-clientname') || '';
    $('#debtInvoiceLabel').text('#' + pendingInvoiceId + ' — ' + pendingInvoiceName);
    $('#invoiceDebtSelectedClient').val(''); $('#invoiceDebtSelectedLabel').text('');
    $('#confirmInvoiceDebt').prop('disabled', true);
    $('#invoiceDebtClientSearch').val(pendingInvoiceName);
    modalActiveIndex = -1;
    $('#invoiceDebtClientResults').empty();
    $('#invoiceDebtClientModal').modal('show');
    $('#invoiceDebtClientSearch').trigger('input');
  });
  $('#invoiceDebtClientSearch').on('input', function(){
    clearTimeout(searchTimer);
    modalSearchSequence++;
    if (modalSearchRequest) modalSearchRequest.abort();
    modalActiveIndex = -1;
    var requestSequence = modalSearchSequence;
    $('#invoiceDebtSelectedClient').val(''); $('#confirmInvoiceDebt').prop('disabled', true);
    $('#invoiceDebtSelectedLabel').text('');
    var q = $.trim($(this).val());
    if(q.length < 2){ $('#invoiceDebtClientResults').empty(); return; }
    searchTimer = setTimeout(function(){
      modalSearchRequest = $.getJSON(window.base_url + 'admin/invoices/search_debt_clients_invoice', {search:q}, function(clients){
        if (requestSequence !== modalSearchSequence) return;
        modalActiveIndex = -1;
        var box = $('#invoiceDebtClientResults').empty();
        if(!clients || !clients.length){ box.text('Nuk u gjet klient. Regjistroje fillimisht te Borxhet e Klientëve.'); return; }
        $.each(clients, function(i, client){
          $('<button type="button" class="btn btn-default btn-block invoice-debt-client-option"></button>')
            .attr('data-clientid', client.id).attr('data-clientname', client.name || '')
            .html('<strong>'+safeText(client.name)+'</strong><br><small>'+safeText(client.address)+' | '+safeText(client.phone)+'</small>')
            .appendTo(box);
        });
      }).fail(function(xhr, status){ if (status !== 'abort' && requestSequence === modalSearchSequence) $('#invoiceDebtClientResults').text('Gabim gjatë kërkimit të klientëve.'); });
    }, 250);
  });
  $(document).on('click', '.invoice-debt-client-option', function(){
    var name = $(this).attr('data-clientname') || '';
    if(name.trim().toLocaleUpperCase() !== pendingInvoiceName.trim().toLocaleUpperCase()){
      showDebtNotification('Emri i klientit në faturë nuk përputhet me klientin e zgjedhur.', 'Vërejtje'); return;
    }
    $('#invoiceDebtSelectedClient').val($(this).attr('data-clientid'));
    $('#invoiceDebtSelectedLabel').text('Klienti i zgjedhur: '+name);
    $('#confirmInvoiceDebt').prop('disabled', false);
    $('#invoiceDebtClientResults .invoice-debt-client-option').removeClass('keyboard-active');
    modalActiveIndex = -1;
  });
  $('#confirmInvoiceDebt').on('click', function(){
    var clientId = parseInt($('#invoiceDebtSelectedClient').val(),10) || 0;
    if(!pendingInvoiceId || !clientId) return;
    $('#invoiceDebtClientModal').modal('hide');
    $('#confirmListDebtMessage').text('Konfirmon regjistrimin ose përditësimin e shumës së mbetur për faturën #' + pendingInvoiceId + '?');
    $('#confirmListDebtModal').modal('show');
  });
  $('#confirmListDebtAction').on('click', function(){
    var clientId = parseInt($('#invoiceDebtSelectedClient').val(),10) || 0;
    if(!pendingInvoiceId || !clientId) return;
    var button = $(this).prop('disabled', true);
    $('#confirmListDebtModal').modal('hide');
    $.ajax({url:window.base_url+'admin/invoices/invoice_to_debt',type:'POST',dataType:'json',
      data:{invoice_id:pendingInvoiceId,debt_client_id:clientId},
      success:function(res){
        if(res && res.status){ showDebtNotification(res.message || 'Detyrimi u regjistrua.', 'Sukses'); }
        else showDebtNotification(res && res.message ? res.message : 'Detyrimi nuk u regjistrua.', 'Vërejtje');
      },error:function(xhr){showDebtNotification((xhr.responseJSON && xhr.responseJSON.message) || 'Gabim gjatë regjistrimit të detyrimit.', 'Gabim');},
      complete:function(){button.prop('disabled', false);}
    });
  });
});
</script>
