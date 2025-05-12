<div class="row">
    <div class="col-lg-5"></div>
    <div class="col-lg-4"></div>
    <div class="col-lg-3">
        <a href="<?php echo base_url('admin/categories/add/'); ?>" style="color:white;"> <button type="submit" class="btn btn-block" style="background:#ffcd35;"> <i class="fa fa-plus"></i>&nbsp;&nbsp;Shto Kategorin</button></a>
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
                        <th>Emri I Kategoris</th>
                        <th>Data E Krijimit</th>
                        <th>Veprimi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($category as $key => $value) { ?>
                        <tr>
                            <td><?php echo $value['id']; ?></td>
                            <td><?php echo htmlspecialchars($value['name']); ?></td>
                            <td><?php echo $value['created_at']; ?></td>
                            <td>
                                <a href="<?php echo base_url('admin/categories/edit_category/' . $value['id']); ?>"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></button></a>
                                <a href="<?php echo base_url('admin/categories/delete/' . $value['id']); ?>" data-toggle="modal" data-target="#confirmDeleteModal" data-categoryid="<?php echo $value['id']; ?>"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="icon-trash"></i></button></a>
                            </td>
                        </tr>
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
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                A jeni i sigurt qe deshironi te fshini kete kategori?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Jo</button>
                <a id="deleteProductLink" href="#" class="btn btn-danger">Fshije</a>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Listen for the modal's "Delete" button click event
        $('#confirmDeleteModal').on('show.bs.modal', function(e) {
            var categoryID = $(e.relatedTarget).data('categoryid'); // Get the product ID
            var deleteButton = $(this).find('#deleteProductLink'); // Get the "Delete" button in the modal

            // Update the "Delete" button link with the appropriate product ID
            deleteButton.attr('href', '<?php echo base_url("admin/categories/delete_category/"); ?>' + categoryID);
        });
    });
</script>