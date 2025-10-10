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
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">�</span> </button>
                    </div>
                <?php endif ?>
                <form method="post" action="<?php echo base_url('admin/user/update/' . $user->id) ?>" class="form-horizontal">
                    <div class="form-group">
                        <label class="col-md-4" for="example-text">First Name</label>
                        <div class="col-sm-4">
                            <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>" data-validation-required-message="Kerkohet emri i perdoruesit" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-4" for="passwordInput">Fjalekalimi</label>
                        <div class="col-sm-4">
                            <div class="input-group">
                            <input
                                type="password"
                                value="<?php echo $user->password; ?>"
                                name="password"
                                id="passwordInput"
                                class="form-control"
                                data-validation-required-message="Kerkohet fjalekalimi"
                                required
                            >
                            <span class="input-group-addon" id="togglePassword" style="cursor:pointer;">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </span>
                            </div>
                        </div>
                    </div>
                    <div id="useradmindiV">
                        <span>ADMIN </span><input <?php if ($user->role == "admin") { echo "checked"; }; ?> type="radio" onclick="javascript:yesnoCheck();" name="role" id="noCheck" value="admin"><br><br>
                        <span>PËRDORUES </span> <input <?php if ($user->role == "user") { echo "checked";}; ?> type="radio" onclick="javascript:yesnoCheck();" name="role" id="yesCheck" value="user"><br>
                    </div>
                    <div id="ifYes" style="display: none">
                        <hr>
                        Zgjedh Kategorit:&nbsp;<br>
                        <input type="checkbox" value="0" name="role_action[]" id="selectAllCheckbox" <?php if ($view_category[0] == 0) { echo 'checked';} else {    echo 'disabled';} ?>>&nbsp;&nbsp;TE GJITHA
                        <br>
                        <?php foreach ($category as $cat) : ?>
                            <input type="checkbox" value="<?php echo $cat['id']; ?>" name="role_action[]" <?php if ($view_category[0] == 0) {    echo 'disabled';} else {    if (in_array($cat['id'], $view_category)) {        echo 'checked';    } else {        echo '';    }} ?> onchange="handleOtherCheckboxChange(this)">&nbsp;&nbsp;<?php echo $cat['name']; ?>
                            <br>
                        <?php endforeach ?>
                        <br>
                        Shfaq Cmimet:&nbsp;
                        <input type="checkbox" name="price_status" class="js-switch" <?php if ($user->price_status == 1) {    echo 'checked';} else {    echo '';} ?>>
                    </div>
                    <hr>
                    <!-- CSRF token -->
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                    <div class="form-group">
                        <div class="col-sm-offset-3 col-sm-5">
                            <button type="submit" class="btn btn-success btn-rounded btn-sm"> <i class="fa fa-plus"></i>&nbsp;&nbsp;Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var yesCheck = document.getElementById("yesCheck");
        var ifYesDiv = document.getElementById("ifYes");

        if (yesCheck.checked) {
            ifYesDiv.style.display = "block";
        }

        yesCheck.addEventListener("change", function() {
            if (yesCheck.checked) {
                ifYesDiv.style.display = "block";
            } else {
                ifYesDiv.style.display = "none";
            }
        });
    });
</script>

<script>
document.addEventListener("DOMContentLoaded", function () {
  var toggle = document.getElementById("togglePassword");
  var input  = document.getElementById("passwordInput");
  toggle.addEventListener("click", function () {
    var isPassword = input.type === "password";
    input.type = isPassword ? "text" : "password";
    var icon = this.querySelector("i");
    icon.classList.toggle("fa-eye", !isPassword);
    icon.classList.toggle("fa-eye-slash", isPassword);
    this.setAttribute("aria-label", isPassword ? "Hide password" : "Show password");
    this.setAttribute("title", isPassword ? "Hide password" : "Show password");
  });
});
</script>





<!-- End Page Content -->