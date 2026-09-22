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
                    <div class="alert alert-danger delete_msg pull" style="width: 100%">
                        <i class="fa fa-times"></i>
                        <?php echo $error_msg; ?>
                        &nbsp;

                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php endif ?>


                <form method="post"
                    action="<?php echo base_url('admin/user/update/' . $user->id) ?>"
                    class="form-horizontal">


                    <!-- EMRI I PERDORUESIT -->

                    <div class="form-group">
                        <label class="col-md-4" for="example-text">
                            First Name
                        </label>

                        <div class="col-sm-4">
                            <input type="text"
                                name="first_name"
                                class="form-control"
                                value="<?php echo $user->first_name; ?>"
                                data-validation-required-message="Kerkohet emri i perdoruesit"
                                disabled>
                        </div>
                    </div>


                    <!-- FJALEKALIMI -->

                    <div class="form-group">

                        <label class="col-md-4" for="passwordInput">
                            Fjalekalimi
                        </label>

                        <div class="col-sm-4">

                            <div class="input-group">

                                <input
                                    type="password"
                                    value="<?php echo $user->password; ?>"
                                    name="password"
                                    id="passwordInput"
                                    class="form-control"
                                    data-validation-required-message="Kerkohet fjalekalimi"
                                    required>

                                <span class="input-group-addon"
                                    id="togglePassword"
                                    style="cursor:pointer;">

                                    <i class="fa fa-eye" aria-hidden="true"></i>

                                </span>

                            </div>

                        </div>

                    </div>


                    <!-- PREFIXI -->

                    <div id="prefixField">

                        <div class="form-group">

                            <label class="col-md-4" for="prefix_user">
                                PREFIXI I PERDORUESIT
                            </label>

                            <div class="col-sm-4">

                                <div class="input-group">

                                    <input type="text"
                                        name="prefix_user"
                                        id="prefix_user"
                                        class="form-control"
                                        value="<?php echo $prefix_user->prefix_user; ?>"
                                        placeholder="FK,PR">

                                </div>

                            </div>

                        </div>

                    </div>

                    <br>


                    <!-- ROLE -->

                    <div id="useradmindiV">


                        <!-- ADMIN -->

                        <span>ADMIN </span>

                        <input
                            <?php if ($user->role == "admin") {
                                echo "checked";
                            } ?>
                            type="radio"
                            name="role"
                            id="adminCheck"
                            value="admin">

                        <br><br>


                        <!-- AGJENT -->

                        <span>AGJENT </span>

                        <input
                            <?php if ($user->role == "sales") {
                                echo "checked";
                            } ?>
                            type="radio"
                            name="role"
                            id="salesCheck"
                            value="sales">

                        <br><br>


                        <!-- PERDORUES -->

                        <span>PËRDORUES </span>

                        <input
                            <?php if ($user->role == "user") {
                                echo "checked";
                            } ?>
                            type="radio"
                            name="role"
                            id="userCheck"
                            value="user">

                        <br>

                    </div>


                    <!-- OPSIONET E PERDORUESIT -->

                    <div id="ifYes" style="display: none">

                        <hr>

                        Zgjedh Kategorit:&nbsp;<br>


                        <input type="checkbox"
                            value="0"
                            name="role_action[]"
                            id="selectAllCheckbox"
                            <?php
                            if ($view_category[0] == 0) {
                                echo 'checked';
                            } else {
                                echo 'disabled';
                            }
                            ?>>

                        &nbsp;&nbsp;TE GJITHA

                        <br>


                        <?php foreach ($category as $cat) : ?>

                            <input type="checkbox"
                                value="<?php echo $cat['id']; ?>"
                                name="role_action[]"

                                <?php
                                if ($view_category[0] == 0) {

                                    echo 'disabled';
                                } else {

                                    if (in_array($cat['id'], $view_category)) {
                                        echo 'checked';
                                    }
                                }
                                ?>

                                onchange="handleOtherCheckboxChange(this)">

                            &nbsp;&nbsp;<?php echo $cat['name']; ?>

                            <br>

                        <?php endforeach ?>


                        <br>


                        Shfaq Cmimet:&nbsp;

                        <input type="checkbox"
                            name="price_status"
                            class="js-switch"
                            <?php
                            if ($user->price_status == 1) {
                                echo 'checked';
                            }
                            ?>>

                    </div>


                    <hr>


                    <!-- CSRF token -->

                    <input type="hidden"
                        name="<?= $this->security->get_csrf_token_name(); ?>"
                        value="<?= $this->security->get_csrf_hash(); ?>" />


                    <!-- SAVE -->

                    <div class="form-group">

                        <div class="col-sm-offset-3 col-sm-5">

                            <button type="submit"
                                class="btn btn-success btn-rounded btn-sm">

                                <i class="fa fa-plus"></i>
                                &nbsp;&nbsp;Save

                            </button>

                        </div>

                    </div>


                </form>

            </div>
        </div>
    </div>
</div>


<!-- ROLE LOGIC -->

<script>
    document.addEventListener("DOMContentLoaded", function() {

        var roleRadios = document.querySelectorAll('input[name="role"]');

        var prefixField = document.getElementById("prefixField");
        var prefixInput = document.getElementById("prefix_user");

        var ifYesDiv = document.getElementById("ifYes");


        function updateRoleFields() {

            var checkedRole = document.querySelector('input[name="role"]:checked');

            if (!checkedRole) {
                return;
            }

            var role = checkedRole.value;


            // =========================
            // USER
            // =========================

            if (role === "user") {

                // Fsheh prefixin
                prefixField.style.display = "none";

                // Prefix nuk eshte required
                prefixInput.required = false;

                // Shfaq kategorite
                ifYesDiv.style.display = "block";

            }


            // =========================
            // ADMIN OSE SALES
            // =========================
            else {

                // Shfaq prefixin
                prefixField.style.display = "block";

                // Prefix duhet te plotesohet
                prefixInput.required = true;

                // Fsheh kategorite
                ifYesDiv.style.display = "none";

            }

        }


        // Kur ndryshohet roli
        roleRadios.forEach(function(radio) {

            radio.addEventListener("change", function() {
                updateRoleFields();
            });

        });


        // Kur hapet faqja e editimit
        updateRoleFields();

    });
</script>


<!-- PASSWORD SHOW / HIDE -->

<script>
    document.addEventListener("DOMContentLoaded", function() {

        var toggle = document.getElementById("togglePassword");
        var input = document.getElementById("passwordInput");

        toggle.addEventListener("click", function() {

            var isPassword = input.type === "password";

            input.type = isPassword ? "text" : "password";

            var icon = this.querySelector("i");

            icon.classList.toggle("fa-eye", !isPassword);
            icon.classList.toggle("fa-eye-slash", isPassword);

            this.setAttribute(
                "aria-label",
                isPassword ? "Hide password" : "Show password"
            );

            this.setAttribute(
                "title",
                isPassword ? "Hide password" : "Show password"
            );

        });

    });
</script>

<!-- End Page Content -->