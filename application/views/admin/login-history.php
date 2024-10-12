<div class="row">
    <div class="col-lg-12">
        <div class="white-box" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">
            <table id="login-history-table" class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Emri I Perdoruesit</th>
                        <th>Paisja E Perdoruesit</th>
                        <th>Data E Krijimit</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($login_history as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo htmlspecialchars($value['username']); ?></td>
                            <td><?php echo $value['device_type']; ?></td>
                            <td><?php echo $value['created_at']; ?></td>
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