<style>
    input[type="text"] {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 100%;
}
</style>
<!-- Start Page Content -->

<div class="row">
    <div class="col-lg-12">


        <div class="panel panel-info" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">

            <div class="panel-body table-responsive">

                <?php $msg = $this->session->flashdata('msg'); ?>
                <?php if (isset($msg)) : ?>
                    <div class="alert alert-success delete_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>
                <?php endif ?>

                <?php $error_msg = $this->session->flashdata('error_msg'); ?>
                <?php if (isset($error_msg)) : ?>
                    <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>
                <?php endif ?>
                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
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

                                <td><?php echo $user['first_name']; ?></td>
                                <td>
                                    <?php if ($user['status'] == 0) : ?>
                                        <div class="label label-table label-danger">Inactive</div>
                                    <?php else : ?>
                                        <div class="label label-table label-success">Active</div>
                                    <?php endif ?>
                                </td>
                                <td width="10%">
                                    <?php if ($user['role'] == 'admin') : ?>
                                        <div class="label label-table label-info"><i class="fa fa-user"></i> admin</div>
                                    <?php else : ?>
                                        <div class="label label-table label-success">user</div>
                                    <?php endif ?>
                                </td>

                                <td><?php echo my_date_show_time($user['created_at']); ?></td>
                                <td class="text-nowrap">

                                    <?php if ($this->session->userdata('role') == 'admin') : ?>

                                        <a href="<?php echo base_url('admin/user/update/' . $user['id']) ?>"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></button></a>

                                        <a href="<?php echo base_url('admin/user/all_user_list/') ?>" data-toggle="modal" data-target="#confirmDeleteModal" data-userid="<?php echo $user['id']; ?>"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="icon-trash"></i></button></a>


                                    <?php else : ?>

                                        <!-- check logged user role permissions -->

                                        <?php if (check_power(2)) : ?>

                                            <a href="<?php echo base_url('admin/user/update/' . $user['id']) ?>"><button type="button" class="btn btn-success btn-circle btn-xs"><i class="fa fa-edit"></i></button></a>

                                        <?php endif; ?>

                                        <?php if (check_power(3)) : ?>


                                            <a href="<?php echo base_url('admin/user/delete/' . $user['id']) ?>" onClick="return doconfirm();" data-toggle="tooltip" data-original-title="Delete"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>

                                        <?php endif; ?>

                                    <?php endif ?>



                                    <?php if ($user['status'] == 1) : ?>

                                        <a href="<?php echo base_url('admin/user/deactive/' . $user['id']) ?>" data-toggle="tooltip" data-original-title="Deactive"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>


                                    <?php else : ?>

                                        <a href="<?php echo base_url('admin/user/active/' . $user['id']) ?>" data-toggle="tooltip" data-original-title="Activate"><button type="button" class="btn btn-success btn-circle btn-xs"><i class="fa fa-check"></i></button></a>
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
            var userid = $(e.relatedTarget).data('userid'); // Get the product ID
            var deleteButton = $(this).find('#deleteProductLink'); // Get the "Delete" button in the modal

            // Update the "Delete" button link with the appropriate product ID
            deleteButton.attr('href', '<?php echo base_url("admin/user/delete/"); ?>' + '/' + userid);
        });
    });
</script>

<!-- End Page Content -->