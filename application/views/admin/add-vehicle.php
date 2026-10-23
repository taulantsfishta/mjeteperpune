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
                id="addVehicleForm"
                method="post"
                action="<?php echo base_url('admin/vehicles/store'); ?>">

                <?php if ($this->config->item('csrf_protection')): ?>
                    <input
                        type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">
                <?php endif; ?>


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


<style>
    .vehicle-notice-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.45);
        z-index: 99999;
        align-items: center;
        justify-content: center;
        padding: 15px;
    }

    .vehicle-notice-overlay.active {
        display: flex;
    }

    .vehicle-notice-box {
        background: #fff;
        width: 100%;
        max-width: 430px;
        border-radius: 12px;
        padding: 30px 25px;
        text-align: center;
        box-shadow: 0 12px 40px rgba(0, 0, 0, .2);
    }

    .vehicle-notice-icon {
        font-size: 48px;
        color: #dc3545;
        margin-bottom: 15px;
    }

    .vehicle-notice-message {
        font-size: 17px;
        font-weight: 700;
        margin-bottom: 25px;
        color: #333;
    }
</style>

<div id="vehicleNoticeModal"
    class="vehicle-notice-overlay"
    role="dialog"
    aria-modal="true"
    aria-labelledby="vehicleNoticeMessage">

    <div class="vehicle-notice-box">

        <div class="vehicle-notice-icon">
            <i class="fa fa-exclamation-circle"></i>
        </div>

        <div id="vehicleNoticeMessage"
            class="vehicle-notice-message"></div>

        <button type="button"
            id="closeVehicleNotice"
            class="btn btn-primary">
            OK, E KUPTOVA
        </button>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        const form = document.getElementById('addVehicleForm');
        const modal = document.getElementById('vehicleNoticeModal');
        const message = document.getElementById('vehicleNoticeMessage');
        const closeButton = document.getElementById('closeVehicleNotice');

        if (!form || !modal) return;

        function showVehicleNotice(text) {
            message.textContent = text;
            modal.classList.add('active');
            closeButton.focus();
        }

        function closeVehicleNotice() {
            modal.classList.remove('active');
        }

        closeButton.addEventListener('click', closeVehicleNotice);

        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' &&
                modal.classList.contains('active')) {
                closeVehicleNotice();
            }
        });

        form.addEventListener('submit', async function(event) {

            event.preventDefault();

            const submitButton =
                form.querySelector('button[type="submit"]');

            submitButton.disabled = true;

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });

                const result = await response.json();

                if (!response.ok || !result.status) {
                    showVehicleNotice(
                        result.message || 'Gabim gjate regjistrimit.'
                    );
                    return;
                }

                window.location.href =
                    '<?php echo base_url('admin/vehicles'); ?>';

            } catch (error) {

                showVehicleNotice(
                    'Gabim ne komunikim me serverin.'
                );

            } finally {
                submitButton.disabled = false;
            }
        });

    });
</script>