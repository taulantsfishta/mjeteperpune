<style>
    input[type="text"] {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 100%;
}
</style>
<!-- .row -->
<div class="row">
    <div class="col-md-12">
        <div class="white-box" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">
            <div class="row">
                <div class="col-md-12">
                    <?php $msg = $this->session->flashdata('msg'); ?>
                    <?php if (isset($msg)) : ?>
                        <div class="alert alert-success delete_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        </div>
                        <?php unset($_SESSION['msg']);?>
                    <?php endif ?>

                    <?php $error_msg = $this->session->flashdata('error_msg'); ?>
                    <?php if (isset($error_msg)) : ?>
                        <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        </div>
                        <?php unset($_SESSION['error_msg']);?>
                    <?php endif ?>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <form method="post" action="<?php echo base_url('admin/printproduct/add_page_dimension/'); ?>">
                        <div class="form-group">
                            <label for="gjeresia" class="col-sm-3 control-label col-form-label">GJERESIA</label>
                            <input type="text" class="form-control" id="gjeresia" name="width" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="gjatesia" class="col-sm-3 control-label col-form-label">GJATESIA</label>
                            <input type="text" class="form-control" id="gjatesia" name="height" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="madhesia-fontit-te-kodit" class="col-sm-3 control-label col-form-label">MADHESIA E FONTIT TE KODIT</label>
                            <input type="text" class="form-control" id="madhesia-fontit-te-kodit" name="font_size_code" placeholder="" required>
                        </div>
                        <div class="form-group">
                            <label for="madhesia-fontit-te-emrit" class="col-sm-3 control-label col-form-label">MADHESIA E FONTIT TE EMRIT</label>
                            <input type="text" class="form-control" id="madhesia-fontit-te-emrit" name="font_size_name" placeholder="" required>
                        </div>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-info">Ruaj</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>