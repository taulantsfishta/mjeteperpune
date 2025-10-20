<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lista e Përdoruesve</title>

  <!-- Nëse projekti ka Bootstrap 3 të ngarkuar, mos e dyfisho CDN -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->

  <style>
    :root{ --border:#e4e7ea; --radius:12px; }
    body{ font-family: Arial, Helvetica, sans-serif; background:#f7f8fa; }

    .panel.panel-info{ border:1px solid var(--border); border-radius: var(--radius); box-shadow:0 6px 20px rgba(0,0,0,.06); }
    .panel-body{ background:#fff; border-radius: var(--radius); }

    /* Tabela desktop */
    table{ width:100%; border-collapse: collapse; }
    thead th{ white-space: nowrap; }

    /* Butona veprimesh të rregulluar bukur */
    .actions-stack{ display:flex; flex-wrap:wrap; gap:6px; align-items:center; }

    /* Mobile-first card-like rows */
    @media (max-width: 767px){
      #example23{ border:0; }
      #example23 thead{ display:none; }
      #example23 tfoot{ display:none; }
      #example23 tbody tr{ display:block; border:1px solid var(--border); border-radius: 10px; padding:10px; margin-bottom:12px; }
      #example23 tbody td{ display:flex; justify-content: space-between; align-items:flex-start; padding:8px 6px; border:0; }
      #example23 tbody td:not(:last-child){ border-bottom:1px dashed #eef0f3; }
      #example23 tbody td::before{ content: attr(data-label); font-weight:600; margin-right:12px; }
      /* lejo që të mos detyrohet nowrap për veprimet */
      .text-nowrap{ white-space: normal !important; }
      .actions-stack{ gap:8px; }
    }

    /* Alerts */
    .alert{ border-radius:10px; }
  </style>
</head>
<body>

<div class="row">
  <div class="col-lg-12">

    <div class="panel panel-info" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">
      <div class="panel-body table-responsive">

        <?php $msg = $this->session->flashdata('msg'); ?>
        <?php if (isset($msg)) : ?>
          <div class="alert alert-success delete_msg pull" style="width: 100%"> 
            <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
              <span aria-hidden="true">×</span> 
            </button>
          </div>
        <?php endif ?>

        <?php $error_msg = $this->session->flashdata('error_msg'); ?>
        <?php if (isset($error_msg)) : ?>
          <div class="alert alert-danger delete_msg pull" style="width: 100%"> 
            <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> 
              <span aria-hidden="true">×</span> 
            </button>
          </div>
        <?php endif ?>

        <table id="example23" class="display" cellspacing="0" width="100%">
          <thead>
            <tr>
              <th>Emri</th>
              <th>Statusi</th>
              <th>Roli</th>
              <th>Data e krijimit</th>
              <th>Veprimi</th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <th>Emri</th>
              <th>Statusi</th>
              <th>Roli</th>
              <th>Data e krijimit</th>
              <th>Veprimi</th>
            </tr>
          </tfoot>
          <tbody>
            <?php foreach ($users as $user) : ?>
              <tr>
                <td data-label="Emri"><?php echo $user['first_name']; ?></td>
                <td data-label="Statusi">
                  <?php if ($user['status'] == 0) : ?>
                    <div class="label label-table label-danger">Inactive</div>
                  <?php else : ?>
                    <div class="label label-table label-success">Active</div>
                  <?php endif ?>
                </td>
                <td data-label="Roli">
                  <?php if ($user['role'] == 'admin') : ?>
                    <div class="label label-table label-info"><i class="fa fa-user"></i> admin</div>
                  <?php else : ?>
                    <div class="label label-table label-success">user</div>
                  <?php endif ?>
                </td>
                <td data-label="Data e krijimit"><?php echo my_date_show_time($user['created_at']); ?></td>

                <td data-label="Veprimi" class="actions-stack text-nowrap">

                  <?php if ($this->session->userdata('role') == 'admin') : ?>

                    <a href="<?php echo base_url('admin/user/update/' . $user['id']) ?>" class="btn btn-info btn-circle btn-xs" data-toggle="tooltip" title="Përditëso">
                      <i class="fa fa-edit"></i>
                    </a>

                    <!-- Trigger modal i fshirjes -->
                    <a href="<?php echo base_url('admin/user/all_user_list/') ?>" data-toggle="modal" data-target="#confirmDeleteModal" data-userid="<?php echo $user['id']; ?>" class="btn btn-danger btn-circle btn-xs" title="Fshi">
                      <i class="icon-trash"></i>
                    </a>

                  <?php else : ?>
                    <!-- check logged user role permissions -->
                    <?php if (check_power(2)) : ?>
                      <a href="<?php echo base_url('admin/user/update/' . $user['id']) ?>" class="btn btn-success btn-circle btn-xs" data-toggle="tooltip" title="Përditëso">
                        <i class="fa fa-edit"></i>
                      </a>
                    <?php endif; ?>

                    <?php if (check_power(3)) : ?>
                      <a href="<?php echo base_url('admin/user/delete/' . $user['id']) ?>" onClick="return doconfirm();" data-toggle="tooltip" data-original-title="Delete" class="btn btn-danger btn-circle btn-xs" title="Fshi">
                        <i class="fa fa-times"></i>
                      </a>
                    <?php endif; ?>
                  <?php endif ?>

                  <?php if ($user['status'] == 1) : ?>
                    <a href="<?php echo base_url('admin/user/deactive/' . $user['id']) ?>" data-toggle="tooltip" title="Çaktivizo" class="btn btn-danger btn-circle btn-xs">
                      <i class="fa fa-times"></i>
                    </a>
                  <?php else : ?>
                    <a href="<?php echo base_url('admin/user/active/' . $user['id']) ?>" data-toggle="tooltip" title="Aktivizo" class="btn btn-success btn-circle btn-xs">
                      <i class="fa fa-check"></i>
                    </a>
                  <?php endif ?>

                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>

<!-- Modal konfirmimi -->
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
        A jeni i sigurt që dëshironi të fshini këtë përdorues?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Jo</button>
        <a id="deleteUserLink" href="#" class="btn btn-danger">Fshije</a>
      </div>
    </div>
  </div>
</div>

<!-- jQuery & Bootstrap JS (nëse projekti yt i ka, mos i dyfisho) -->
<!-- <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> -->

<script>
  // Nëse përdor modal me data-userid, vendos href-in e sakte te butonit Fshije
  $(document).ready(function(){
    $('#confirmDeleteModal').on('show.bs.modal', function(e){
      var userid = $(e.relatedTarget).data('userid');
      var deleteBtn = $(this).find('#deleteUserLink');
      deleteBtn.attr('href', '<?php echo base_url("admin/user/delete/"); ?>' + '/' + userid);
    });
  });
</script>

</body>
</html>
