<style>
    input[type="text"] {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 100%;
}
</style>
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
                    <form method="POST" action="<?php echo base_url('admin/categories/edit_category/' . $category['id']); ?>">
                        <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $category['id']; ?>">
                        <div class="form-group">
                            <label for="category_id" class="col-sm-3 control-label col-form-label">ID</label>
                            <input type="text" class="form-control" id="category_id" name="category_id" value="<?php echo $category['id']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-3 control-label col-form-label">Emri i kategoris</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Emri i kategoris" value="<?php echo htmlspecialchars($category['name']); ?>" required>
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