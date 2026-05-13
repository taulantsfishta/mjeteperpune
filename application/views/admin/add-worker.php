
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
                <div class="col-sm-4 col-xs-4">
                    <form method="post" action="<?php echo base_url('admin/workers/add_worker'); ?>">
                        <div class="form-group">
                            <label for="pershkrimi" class="col-sm-3 control-label col-form-label">Emri i punëtorit</label>
                            <input type="text" class="form-control" id="pershkrimi" name="worker_name" placeholder="" required>
                            <label for="base_salary" class="col-sm-3 control-label col-form-label">Paga bazë</label>
                            <input type="number" class="form-control" id="base_salary" style="font-size: 100%;" name="base_salary" placeholder="" required>
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
