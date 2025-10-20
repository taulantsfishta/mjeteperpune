<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Kategoritë</title>
  <style>
    :root{ --border:#e4e7ea; --radius:12px; }
    body{ font-family: Arial, Helvetica, sans-serif; background:#f7f8fa; }

    .white-box{ background:#fff; border:1px solid var(--border); border-radius: var(--radius); padding:16px; box-shadow:0 6px 20px rgba(0,0,0,.06); }

    /* Desktop defaults */
    table{ width:100%; border-collapse: collapse; }
    thead th{ white-space: nowrap; }

    /* Make action buttons wrap nicely */
    .actions{ display:flex; flex-wrap:wrap; gap:6px; align-items:center; }

    /* Mobile card view */
    @media (max-width: 767px){
      table thead{ display:none; }
      table tbody tr{ display:block; border:1px solid var(--border); border-radius:10px; padding:10px; margin-bottom:12px; }
      table tbody td{ display:flex; justify-content:space-between; align-items:flex-start; padding:8px 6px; border:0; }
      table tbody td:not(:last-child){ border-bottom:1px dashed #eef0f3; }
      table tbody td::before{ content: attr(data-label); font-weight:600; margin-right:12px; }
    }
  </style>
</head>
<body>

<!-- Header row with button aligned nicely on all sizes -->
<div class="row">
  <div class="col-xs-12 col-sm-6 col-md-5"></div>
  <div class="col-xs-12 col-sm-6 col-md-4"></div>
  <div class="col-xs-12 col-md-3">
    <a href="<?php echo base_url('admin/categories/add/'); ?>" class="btn btn-block" style="background:#ffcd35;color:#1a1a1a;">
      <i class="fa fa-plus"></i>&nbsp;&nbsp;Shto Kategorinë
    </a>
  </div>
</div>
<br>

<div class="row">
  <div class="col-lg-12">
    <div class="white-box">
      <table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">
        <thead style="font-weight: bold;">
          <tr>
            <th>Id</th>
            <th>Emri i Kategorisë</th>
            <th>Data e Krijimit</th>
            <th>Veprimi</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($category as $key => $value) { ?>
            <tr>
              <td data-label="Id"><?php echo $value['id']; ?></td>
              <td data-label="Emri i Kategorisë"><?php echo htmlspecialchars($value['name']); ?></td>
              <td data-label="Data e Krijimit"><?php echo $value['created_at']; ?></td>
              <td data-label="Veprimi">
                <div class="actions">
                  <a href="<?php echo base_url('admin/categories/edit_category/' . $value['id']); ?>" class="btn btn-info btn-circle btn-xs" title="Përditëso">
                    <i class="fa fa-edit"></i>
                  </a>
                  <a href="<?php echo base_url('admin/categories/delete/' . $value['id']); ?>" data-toggle="modal" data-target="#confirmDeleteModal" data-categoryid="<?php echo $value['id']; ?>" class="btn btn-danger btn-circle btn-xs" title="Fshi">
                    <i class="icon-trash"></i>
                  </a>
                </div>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<!-- Modal -->
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
        A jeni i sigurt që dëshironi të fshini këtë kategori?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Jo</button>
        <a id="deleteCategoryLink" href="#" class="btn btn-danger">Fshije</a>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function(){
    // Vendos href-in e sakte te butonit Fshije brenda modal-it
    $('#confirmDeleteModal').on('show.bs.modal', function(e){
      var categoryID = $(e.relatedTarget).data('categoryid');
      var deleteButton = $(this).find('#deleteCategoryLink');
      deleteButton.attr('href', '<?php echo base_url("admin/categories/delete_category/"); ?>' + categoryID);
    });
  });
</script>

</body>
</html>
