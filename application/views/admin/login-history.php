<!DOCTYPE html>
<html lang="sq">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Historia e Login-eve</title>
  <style>
    :root { --border:#e4e7ea; --radius:12px; }
    body { font-family: Arial, Helvetica, sans-serif; background:#f7f8fa; }

    .white-box { background:#fff; border:1px solid var(--border); border-radius:var(--radius); padding:16px; box-shadow:0 6px 20px rgba(0,0,0,.06); }

    table { width:100%; border-collapse:collapse; }
    thead th { white-space:nowrap; }

    /* Mobile responsive: turn table rows into cards */
    @media (max-width: 767px) {
      table thead { display:none; }
      table tbody tr { display:block; border:1px solid var(--border); border-radius:10px; padding:10px; margin-bottom:12px; }
      table tbody td { display:flex; justify-content:space-between; align-items:flex-start; padding:8px 6px; border:0; }
      table tbody td:not(:last-child) { border-bottom:1px dashed #eef0f3; }
      table tbody td::before { content: attr(data-label); font-weight:600; margin-right:12px; }
    }
  </style>
</head>
<body>

<div class="row">
  <div class="col-lg-12">
    <div class="white-box" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">
      <table id="login-history-table" class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
        <thead>
          <tr>
            <th>Id</th>
            <th>Emri i Përdoruesit</th>
            <th>Pajisja e Përdoruesit</th>
            <th>Data e Krijimit</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($login_history as $key => $value) { ?>
            <tr>
              <td data-label="Id"><?php echo $value['id']; ?></td>
              <td data-label="Emri i Përdoruesit"><?php echo htmlspecialchars($value['username']); ?></td>
              <td data-label="Pajisja e Përdoruesit"><?php echo $value['device_type']; ?></td>
              <td data-label="Data e Krijimit"><?php echo $value['created_at']; ?></td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script>
    $(document).ready(function() {
        $('#login-history-table').DataTable({
            "paging": true, // Enable pagination
            "pageLength": 20, // Number of rows per page
            "order": [[3,"desc"]],
        });
    });
</script>


</body>
</html>
