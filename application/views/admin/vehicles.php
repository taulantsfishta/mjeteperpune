<style>
    .vehicles-box {
        background: #fff;
        border: 1px solid #e3e7eb;
        border-radius: 8px;
        padding: 20px;
    }

    .vehicles-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .vehicles-header h4 {
        margin: 0;
        font-weight: 600;
    }

    .vehicle-status {
        font-weight: 700;
    }

    .vehicle-status.ok {
        color: #28a745;
    }

    .vehicle-status.warning {
        color: #f0ad4e;
    }

    .vehicle-status.danger {
        color: #dc3545;
    }

    .vehicle-actions {
        display: flex;
        gap: 5px;
        flex-wrap: wrap;
    }

    @media (max-width: 767px) {

        .vehicles-box {
            padding: 12px;
        }

        .vehicles-header {
            align-items: stretch;
        }

        .vehicles-header .btn {
            width: 100%;
        }
    }
</style>


<div class="row">

    <div class="col-lg-12">


        <!-- ===================================================== -->
        <!-- SUCCESS MESSAGE -->
        <!-- ===================================================== -->

        <?php if ($this->session->flashdata('success')): ?>

            <div class="alert alert-success">

                <i class="fa fa-check-circle"></i>

                <?php
                echo $this->session->flashdata('success');
                ?>

            </div>

        <?php endif; ?>


        <!-- ===================================================== -->
        <!-- ERROR MESSAGE -->
        <!-- ===================================================== -->

        <?php if ($this->session->flashdata('error')): ?>

            <div class="alert alert-danger">

                <i class="fa fa-exclamation-circle"></i>

                <?php
                echo $this->session->flashdata('error');
                ?>

            </div>

        <?php endif; ?>



        <div class="vehicles-box">


            <!-- ================================================= -->
            <!-- HEADER -->
            <!-- ================================================= -->

            <div class="vehicles-header">

                <h4>

                    <i class="fa fa-car"></i>
                    Lista e veturave

                </h4>


                <a
                    href="<?php echo base_url('admin/vehicles/add'); ?>"
                    class="btn btn-success">

                    <i class="fa fa-plus"></i>

                    Shto Veturë

                </a>

            </div>



            <!-- ================================================= -->
            <!-- TABLE -->
            <!-- ================================================= -->

            <div class="table-responsive">


                <table
                    class="table table-bordered table-striped table-hover"
                    style="font-size:14px;">


                    <thead>

                        <tr>

                            <th style="width:50px;">
                                #
                            </th>

                            <th>
                                Targa
                            </th>

                            <th>
                                Marka
                            </th>

                            <th>
                                Modeli
                            </th>

                            <th>
                                Kilometrat
                            </th>

                            <th>
                                Regjistrimi deri
                            </th>

                            <th>
                                Ditë të mbetura
                            </th>

                            <th>
                                Statusi
                            </th>

                            <th style="width:120px;">
                                Veprimi
                            </th>

                        </tr>

                    </thead>



                    <tbody>


                        <?php if (!empty($vehicles)): ?>


                            <?php foreach ($vehicles as $key => $vehicle): ?>


                                <?php

                                /*
                                 * ==========================================
                                 * LLOGARIT DITËT DERI NË SKADIM
                                 * ==========================================
                                 */

                                $today = new DateTime(
                                    date('Y-m-d')
                                );


                                $expiry = new DateTime(
                                    $vehicle['registration_expiry']
                                );


                                $diff = $today->diff(
                                    $expiry
                                );


                                $daysRemaining =
                                    (int)$diff->format('%r%a');



                                /*
                                 * ==========================================
                                 * STATUSI
                                 * ==========================================
                                 */

                                if ($daysRemaining < 0) {

                                    $statusText =
                                        'KA SKADUAR';

                                    $statusClass =
                                        'danger';
                                } elseif ($daysRemaining == 0) {

                                    $statusText =
                                        'SKADON SOT';

                                    $statusClass =
                                        'danger';
                                } elseif ($daysRemaining <= 15) {

                                    $statusText =
                                        'URGJENTE';

                                    $statusClass =
                                        'danger';
                                } elseif ($daysRemaining <= 30) {

                                    $statusText =
                                        'AFATI PO AFROHET';

                                    $statusClass =
                                        'warning';
                                } else {

                                    $statusText =
                                        'NË RREGULL';

                                    $statusClass =
                                        'ok';
                                }

                                ?>



                                <tr>


                                    <!-- ID -->

                                    <td>

                                        <?php
                                        echo $key + 1;
                                        ?>

                                    </td>



                                    <!-- TARGA -->

                                    <td>

                                        <strong>

                                            <?php
                                            echo htmlspecialchars(
                                                $vehicle['plate_number']
                                            );
                                            ?>

                                        </strong>

                                    </td>



                                    <!-- MARKA -->

                                    <td>

                                        <?php

                                        if (!empty($vehicle['brand'])) {

                                            echo htmlspecialchars(
                                                $vehicle['brand']
                                            );
                                        } else {

                                            echo '-';
                                        }

                                        ?>

                                    </td>



                                    <!-- MODELI -->

                                    <td>

                                        <?php

                                        if (!empty($vehicle['model'])) {

                                            echo htmlspecialchars(
                                                $vehicle['model']
                                            );
                                        } else {

                                            echo '-';
                                        }

                                        ?>

                                    </td>



                                    <!-- KILOMETRAT -->

                                    <td>

                                        <?php

                                        if (
                                            isset($vehicle['current_km']) &&
                                            $vehicle['current_km'] !== null &&
                                            $vehicle['current_km'] !== ''
                                        ) {

                                            echo number_format(
                                                (int)$vehicle['current_km'],
                                                0,
                                                ',',
                                                '.'
                                            );

                                            echo ' km';
                                        } else {

                                            echo '-';
                                        }

                                        ?>

                                    </td>



                                    <!-- DATA E REGJISTRIMIT -->

                                    <td>

                                        <?php

                                        echo date(
                                            'd.m.Y',
                                            strtotime(
                                                $vehicle['registration_expiry']
                                            )
                                        );

                                        ?>

                                    </td>



                                    <!-- DITËT E MBETURA -->

                                    <td>


                                        <?php if ($daysRemaining < 0): ?>


                                            <span class="text-danger">

                                                <?php
                                                echo abs(
                                                    $daysRemaining
                                                );
                                                ?>

                                                ditë me vonesë

                                            </span>


                                        <?php elseif ($daysRemaining == 0): ?>


                                            <span class="text-danger">

                                                Sot

                                            </span>


                                        <?php else: ?>


                                            <?php
                                            echo $daysRemaining;
                                            ?>

                                            ditë


                                        <?php endif; ?>


                                    </td>



                                    <!-- STATUSI -->

                                    <td>

                                        <span
                                            class="vehicle-status <?php echo $statusClass; ?>">

                                            <?php
                                            echo $statusText;
                                            ?>

                                        </span>

                                    </td>



                                    <!-- VEPRIMI -->

                                    <td>


                                        <div class="vehicle-actions">


                                            <!-- NDRYSHO -->

                                            <a
                                                href="<?php echo base_url(
                                                            'admin/vehicles/edit/' .
                                                                $vehicle['id']
                                                        ); ?>"
                                                class="btn btn-sm btn-primary"
                                                title="Ndrysho">

                                                <i class="fa fa-edit"></i>

                                            </a>



                                            <!-- FSHIJE -->

                                            <a
                                                href="<?php echo base_url(
                                                            'admin/vehicles/delete/' .
                                                                $vehicle['id']
                                                        ); ?>"
                                                class="btn btn-sm btn-danger delete-vehicle"
                                                data-plate="<?php echo htmlspecialchars(
                                                                $vehicle['plate_number'],
                                                                ENT_QUOTES
                                                            ); ?>"
                                                title="Fshije">

                                                <i class="fa fa-trash"></i>

                                            </a>


                                        </div>


                                    </td>


                                </tr>


                            <?php endforeach; ?>


                        <?php else: ?>


                            <tr>

                                <td
                                    colspan="9"
                                    class="text-center"
                                    style="padding:30px;">

                                    <i
                                        class="fa fa-car"
                                        style="
                                            font-size:30px;
                                            color:#bbb;
                                            margin-bottom:10px;
                                        ">
                                    </i>

                                    <br>

                                    Nuk ka vetura të regjistruara.

                                </td>

                            </tr>


                        <?php endif; ?>


                    </tbody>


                </table>


            </div>


        </div>


    </div>

</div>



<!-- ===================================================== -->
<!-- KONFIRMIMI PËR FSHIRJE -->
<!-- ===================================================== -->

<script>
    document.addEventListener(
        'DOMContentLoaded',
        function() {

            var deleteButtons =
                document.querySelectorAll(
                    '.delete-vehicle'
                );


            deleteButtons.forEach(
                function(button) {

                    button.addEventListener(
                        'click',
                        function(event) {

                            var plate =
                                this.getAttribute(
                                    'data-plate'
                                );


                            var confirmed =
                                confirm(
                                    'A jeni i sigurt që dëshironi ta fshini veturën ' +
                                    plate +
                                    '?'
                                );


                            if (!confirmed) {

                                event.preventDefault();

                            }

                        }
                    );

                }
            );

        }
    );
</script>