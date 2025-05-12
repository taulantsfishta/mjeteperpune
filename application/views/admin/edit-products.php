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
                    <?php $error_msg = $this->session->flashdata('error_msg'); ?>
                    <?php if ($error_msg != '') : ?>
                        <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        </div>
                         <?php unset($_SESSION['error_msg']); ?>
                    <?php endif ?>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <form method="post" action="<?php echo base_url('admin/products/edit'); ?>" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" id="kodi" name="id" value="<?php echo $product['id']; ?>">
                        <div class="form-group">
                            <label for="kodi" class="col-sm-3 control-label col-form-label">Kodi</label>
                            <input type="text" class="form-control" id="kodi" name="code" value="<?php echo $product['code']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="pershkrimi" class="col-sm-3 control-label col-form-label">Pershkrimi</label>
                            <input type="text" class="form-control" id="pershkrimi" name="name" placeholder="Pershkrimi" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="cmimi" class="col-sm-3 control-label col-form-label">Çmimi</label>
                            <input type="text" class="form-control" id="cmimi" name="price" placeholder="Çmimi" value="<?php echo $product['price']; ?>" required>
                        </div>
                        <div class="form-group">
                            <h3 class="box-title">Ndrysho Imazhin</h3>
                            <input type="file" id="input-file-now" name="product_image" class="dropify" />
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