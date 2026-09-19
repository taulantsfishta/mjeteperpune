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

                        <button type="button"
                                class="close"
                                data-dismiss="alert"
                                aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                <?php endif ?>


                <form method="post"
                      action="<?php echo base_url('admin/user/add') ?>"
                      class="form-horizontal">


                    <!-- EMRI I PERDORUESIT -->

                    <div class="form-group">

                        <label class="col-md-12" for="example-text">
                            Emri I Perdoruesit
                        </label>

                        <div class="col-sm-12">

                            <input type="text"
                                   name="first_name"
                                   class="form-control"
                                   data-validation-required-message="Kerkohet emri i perdoruesit"
                                   required>

                        </div>

                    </div>


                    <!-- FJALEKALIMI -->

                    <div class="form-group">

                        <label class="col-md-12" for="example-text">
                            Fjalekalimi
                        </label>

                        <div class="col-sm-12">

                            <input type="password"
                                   name="password"
                                   class="form-control"
                                   data-validation-required-message="Kerkohet fjalekalimi"
                                   required>

                        </div>

                    </div>


                    <!-- PREFIXI -->

                    <div id="prefixField">

                        <span>PREFIXI PER ROLET E PERDORUESIT</span>

                        <input type="text"
                               name="prefix_user"
                               id="prefix_user"
                               class="form-control"
                               placeholder="FK,PR ETC" required>

                    </div>

                    <br>


                    <!-- ROLE -->

                    <div id="formaCheckbox">


                        <!-- ADMIN -->

                        <span>ADMIN </span>

                        <input type="radio"
                               name="role"
                               id="adminCheck"
                               value="admin"
                               checked='checked'>

                        <br><br>


                        <!-- AGJENT -->

                        <span>AGJENT </span>

                        <input type="radio"
                               name="role"
                               id="salesCheck"
                               value="sales">

                        <br><br>


                        <!-- PERDORUES -->

                        <span>PËRDORUES </span>

                        <input type="radio"
                               name="role"
                               id="userCheck"
                               value="user">

                        <br><br>


                        <!-- OPSIONET PER USER -->

                        <div id="ifYes" style="display: none;">

                            <hr>

                            Zgjedh Kategorit:&nbsp;<br>


                            <input type="checkbox"
                                   value="0"
                                   name="role_action[]"
                                   id="selectAllCheckbox">

                            &nbsp;&nbsp;TE GJITHA

                            <br>


                            <?php foreach ($category as $index => $cat) : ?>

                                <input type="checkbox"
                                       value="<?php echo $cat['id']; ?>"
                                       name="role_action[]"
                                       onchange="handleOtherCheckboxChange(this)">

                                &nbsp;&nbsp;<?php echo $cat['name']; ?>

                                <br>

                            <?php endforeach ?>


                            <br>


                            Shfaq Cmimet:&nbsp;

                            <input type="checkbox"
                                   name="price_status"
                                   class="js-switch"
                                   checked='checked'>


                        </div>

                        <br>

                    </div>


                    <!-- CSRF token -->

                    <input type="hidden"
                           name="<?= $this->security->get_csrf_token_name(); ?>"
                           value="<?= $this->security->get_csrf_hash(); ?>" />


                    <!-- RUAJ -->

                    <div class="form-group">

                        <div class="col-sm-offset-3 col-sm-5">

                            <button type="submit"
                                    class="btn btn-success btn-rounded btn-sm">

                                <i class="fa fa-plus"></i>
                                &nbsp;&nbsp;Ruaj

                            </button>

                        </div>

                    </div>


                </form>

            </div>
        </div>
    </div>
</div>


<script>

$(document).ready(function () {


    // Kur ndryshohet roli
    $('input[name="role"]').on('change', function () {


        var role = $('input[name="role"]:checked').val();


        // ==========================
        // PERDORUES
        // ==========================

        if (role === 'user') {


            // Fsheh prefixin
            $('#prefixField').hide();


            // Pastron prefixin
            $('#prefix_user').val('');


            // Shfaq kategorite
            $('#ifYes').show();


        }


        // ==========================
        // ADMIN OSE AGJENT
        // ==========================

        else {


            // Shfaq prefixin
            $('#prefixField').show();


            // Fsheh kategorite
            $('#ifYes').hide();


        }


    });


    // Kontrollo rolin kur hapet faqja
    $('input[name="role"]:checked').trigger('change');


});

</script>