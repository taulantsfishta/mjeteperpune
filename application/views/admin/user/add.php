
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
                <?php $error_msg = $this->session->flashdata('error_msg'); ?>
                <?php if (isset($error_msg)) : ?>
                    <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                    </div>
                <?php endif ?>
                <form method="post" action="<?php echo base_url('admin/user/add') ?>" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">
                            Emri I Perdoruesit
                        </label>
                        <div class="col-sm-12">
                            <input type="text" name="first_name" class="form-control" data-validation-required-message="Kerkohet emri i perdoruesit" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-12" for="example-text">Fjalekalimi</label>
                        <div class="col-sm-12">
                            <input type="password" name="password" class="form-control" data-validation-required-message="Kerkohet fjalekalimi" required>
                        </div>
                    </div>
                    <div id="formaCheckbox">
                        <span>ADMIN </span> <input type="radio" onclick="yesnoCheck();" name="role" id="noCheck" value="admin" checked='checked'><br><br>
                        <span>PËRDORUES </span><input type="radio" onclick="yesnoCheck();" name="role" id="yesCheck" value="user"><br>
                        <div id="ifYes" style="display: none;"> <!-- Set display to none -->
                            <hr>
                            Zgjedh Kategorit:&nbsp;<br>
                            <input type="checkbox" value="0" name="role_action[]" id="selectAllCheckbox">&nbsp;&nbsp;TE GJITHA
                            <br>
                            <?php foreach ($category as $index => $cat) : ?>
                                <input type="checkbox" value="<?php echo $cat['id']; ?>" name="role_action[]" onchange="handleOtherCheckboxChange(this)">&nbsp;&nbsp;<?php echo $cat['name']; ?>
                                <br>
                            <?php endforeach ?>
                            <br>
                            Shfaq Cmimet:&nbsp;
                            <input type="checkbox" name="price_status" class="js-switch" checked='checked'>
                        </div>
                        <br>
                    </div>
                    <!-- CSRF token -->
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-success btn-rounded btn-sm"> <i class="fa fa-plus"></i>&nbsp;&nbsp;Ruaj</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End Page Content -->