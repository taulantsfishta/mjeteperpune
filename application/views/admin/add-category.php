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
                <div class="col-sm-12 col-xs-12">
                    <form method="post" action="<?php echo base_url('admin/categories/add/'); ?>">
                        <div class="form-group">
                            <label for="pershkrimi" class="col-sm-3 control-label col-form-label">Emri i kategoris</label>
                            <input type="text" class="form-control" id="pershkrimi" name="name" placeholder="" required>
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