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

                <i class="fa fa-edit"></i>
                Ndrysho Veturën

            </h4>


            <?php if ($this->session->flashdata('error')): ?>

                <div class="alert alert-danger">

                    <i class="fa fa-exclamation-circle"></i>

                    <?php
                    echo $this->session->flashdata('error');
                    ?>

                </div>

            <?php endif; ?>


            <form
                method="post"
                action="<?php echo base_url(
                            'admin/vehicles/update/' . $vehicle['id']
                        ); ?>">


                <!-- TARGA -->

                <div class="form-group mb-3">

                    <label>
                        Targa *
                    </label>

                    <input
                        type="text"
                        name="plate_number"
                        class="form-control"
                        value="<?php echo htmlspecialchars(
                                    $vehicle['plate_number']
                                ); ?>"
                        required>

                </div>


                <!-- MARKA -->

                <div class="form-group mb-3">

                    <label>
                        Marka
                    </label>

                    <input
                        type="text"
                        name="brand"
                        class="form-control"
                        value="<?php echo htmlspecialchars(
                                    isset($vehicle['brand'])
                                        ? $vehicle['brand']
                                        : ''
                                ); ?>">

                </div>


                <!-- MODELI -->

                <div class="form-group mb-3">

                    <label>
                        Modeli
                    </label>

                    <input
                        type="text"
                        name="model"
                        class="form-control"
                        value="<?php echo htmlspecialchars(
                                    isset($vehicle['model'])
                                        ? $vehicle['model']
                                        : ''
                                ); ?>">

                </div>


                <!-- REGJISTRIMI -->

                <div class="form-group mb-3">

                    <label>
                        Regjistrimi vlen deri më *
                    </label>

                    <input
                        type="date"
                        name="registration_expiry"
                        class="form-control"
                        value="<?php echo htmlspecialchars(
                                    $vehicle['registration_expiry']
                                ); ?>"
                        required>

                </div>


                <!-- KILOMETRAT -->

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
                        value="<?php
                                echo (
                                    isset($vehicle['current_km']) &&
                                    $vehicle['current_km'] !== null
                                )
                                    ? (int)$vehicle['current_km']
                                    : '';
                                ?>"
                        placeholder="Opsionale">

                    <small class="text-muted">
                        Kjo fushë është opsionale.
                    </small>

                </div>


                <hr style="margin-top:25px; margin-bottom:20px;">


                <div
                    style="
                        display:flex;
                        gap:10px;
                        flex-wrap:wrap;
                    ">


                    <!-- RUAJ -->

                    <button
                        type="submit"
                        class="btn btn-success">

                        <i class="fa fa-save"></i>
                        Ruaj Ndryshimet

                    </button>


                    <!-- KTHEHU -->

                    <a
                        href="<?php echo base_url('admin/vehicles'); ?>"
                        class="btn btn-secondary">

                        <i class="fa fa-arrow-left"></i>
                        Kthehu

                    </a>


                </div>


            </form>

        </div>

    </div>

</div>