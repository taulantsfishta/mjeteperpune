<style>
    input[type="text"] {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 100%;
}
</style>
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
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
                    <form method="POST" action="<?php echo base_url('admin/printproduct/edit_page_dimension/' . $dimension['id']); ?>">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $dimension['id']; ?>">
                        <div class="form-group">
                            <label for="id" class="col-sm-3 control-label col-form-label">ID</label>
                            <input type="text" class="form-control" id="id" name="id" value="<?php echo $dimension['id']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="width" class="col-sm-3 control-label col-form-label">GJERESIA</label>
                            <input type="text" class="form-control" id="gjeresia" name="width" placeholder="Gjeresia" value="<?php echo $dimension['width']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="width" class="col-sm-3 control-label col-form-label">LARTESIA</label>
                            <input type="text" class="form-control" id="lartesia" name="height" placeholder="Lartesia" value="<?php echo $dimension['height']; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="width" class="col-sm-3 control-label col-form-label">MADHESIA E FONTIT TE KODIT</label>
                            <input type="text" class="form-control" id="madhesia-fontit-te-kodit" name="font_size_code" placeholder="MADHESIA E FONTIT TE KODIT" value="<?php echo $dimension['font_size_code']; ?>" required>
                        </div>
                        <div class="form-group">
                        <label for="width" class="col-sm-3 control-label col-form-label">MADHESIA E FONTIT TE EMRIT</label>
                            <input type="text" class="form-control" id="madhesia-fontit-te-emrit" name="font_size_name" placeholder="MADHESIA E FONTIT TE EMRIT" value="<?php echo $dimension['font_size_name']; ?>" required>
                        </div>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-success">Ndrysho</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>