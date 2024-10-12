<!-- Start Page Content -->
<div class="row">
    <div class="col-lg-5"></div>
    <div class="col-lg-4"></div>
    <div class="col-lg-3">
        <a href="<?php echo base_url('admin/printproduct/add_page_dimension'); ?>" style="color:white;"> <button type="submit" class="btn btn-block" style="background:#ffcd35;"> <i class="fa fa-plus"></i>&nbsp;&nbsp;Shto Dimensionin</button></a>
    </div>
</div>
<br>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-info" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">
            <div class="panel-body table-responsive">
                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>GJERESIA</th>
                            <th>LARTESIA</th>
                            <th>MADHESIA E FONTIT TE KODIT</th>
                            <th>MADHESIA E FONTIT TE EMRIT</th>
                            <th>VEPRIMI</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                        </tr>
                    </tfoot>

                    <tbody>
                        <?php foreach ($page_dimension as $dimension) : ?>

                            <tr>
                                <td><?php echo $dimension['id'] ?></td>
                                <td><?php echo $dimension['width'] ?></td>
                                <td><?php echo $dimension['height'] ?></td>
                                <td><?php echo $dimension['font_size_code'] ?></td>
                                <td><?php echo $dimension['font_size_name'] ?></td>
                                <td>
                                <a href="<?php echo base_url('admin/printproduct/edit_page_dimension/' . $dimension['id']); ?>"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></button></a>
                                <a href="<?php echo base_url('admin/printproduct/delete_page_dimension/' . $dimension['id']); ?>" data-toggle="modal" data-target="#confirmDeleteModal" data-dimensionid="<?php echo $dimension['id']; ?>"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="icon-trash"></i></button></a>
                            </td>
                            </tr>

                        <?php endforeach ?>

                    </tbody>


                </table>
            </div>


        </div>
    </div>
</div>

</div>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="confirmDeleteModalLabel">Konfirmo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                A jeni i sigurt qe deshironi te fshini kete dimension?
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
            var dimensionid = $(e.relatedTarget).data('dimensionid'); // Get the product ID
            var deleteButton = $(this).find('#deleteProductLink'); // Get the "Delete" button in the modal

            // Update the "Delete" button link with the appropriate product ID
            deleteButton.attr('href', '<?php echo base_url("admin/printproduct/delete_page_dimension/"); ?>' + '/' + dimensionid);
        });
    });
</script>

<!-- End Page Content -->