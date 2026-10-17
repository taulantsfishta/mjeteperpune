<div class="row">

    <div class="col-lg-12">

        <div
            class="white-box"
            style="
                max-width:700px;
                margin:0 auto;
                padding:25px;
            ">

            <h4 style="margin-bottom:25px;">
                <i class="fa fa-car"></i>
                Shto Veturë
            </h4>


            <?php if ($this->session->flashdata('error')): ?>

                <div class="alert alert-danger">

                    <?php
                    echo $this->session->flashdata('error');
                    ?>

                </div>

            <?php endif; ?>


            <form
                method="post"
                action="<?php echo base_url('admin/vehicles/store'); ?>">


                <div class="form-group mb-3">

                    <label>
                        Targa *
                    </label>

                    <input
                        type="text"
                        name="plate_number"
                        class="form-control"
                        placeholder="01-123-AB"
                        required>

                </div>


                <div class="form-group mb-3">

                    <label>
                        Marka
                    </label>

                    <input
                        type="text"
                        name="brand"
                        class="form-control"
                        placeholder="Mercedes">

                </div>


                <div class="form-group mb-3">

                    <label>
                        Modeli
                    </label>

                    <input
                        type="text"
                        name="model"
                        class="form-control"
                        placeholder="GLE 400">

                </div>


                <div class="form-group mb-3">

                    <label>
                        Regjistrimi vlen deri më *
                    </label>

                    <input
                        type="date"
                        name="registration_expiry"
                        class="form-control"
                        required>

                </div>


                <div class="form-group mb-3">

                    <label>
                        Kilometrat aktualë
                    </label>

                    <input
                        type="number"
                        name="current_km"
                        class="form-control"
                        min="0"
                        step="1"
                        placeholder="Opsionale">

                </div>


                <div style="margin-top:25px;">

                    <button
                        type="submit"
                        class="btn btn-success">

                        <i class="fa fa-save"></i>
                        Ruaj

                    </button>


                    <a
                        href="<?php echo base_url('admin/vehicles'); ?>"
                        class="btn btn-secondary">

                        Anulo

                    </a>

                </div>


            </form>

        </div>

    </div>

</div>