<div class="row">

    <div class="col-md-6 col-md-offset-3">

        <div class="white-box">

            <h3>Edito klientin</h3>

            <form
                method="post"
                action="<?php echo base_url(
                            'admin/invoices/edit_debt_client/' . $client['id']
                        ); ?>">

                <div class="form-group">

                    <label>Emri i klientit</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="<?php echo htmlspecialchars(
                                    $client['name'],
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>"
                        required>

                </div>


                <div class="form-group">

                    <label>Adresa</label>

                    <input
                        type="text"
                        name="address"
                        class="form-control"
                        value="<?php echo htmlspecialchars(
                                    $client['address'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>">

                </div>


                <div class="form-group">

                    <label>Telefoni</label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control"
                        value="<?php echo htmlspecialchars(
                                    $client['phone'] ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>">

                </div>

                <?php if ($this->config->item('csrf_protection')): ?>

                    <input
                        type="hidden"
                        name="<?php echo $this->security->get_csrf_token_name(); ?>"
                        value="<?php echo $this->security->get_csrf_hash(); ?>">

                <?php endif; ?>


                <button
                    type="submit"
                    class="btn btn-success">

                    <i class="fa fa-check"></i>
                    Ruaj ndryshimet

                </button>


                <!-- <a
                    href="<?php echo base_url(
                                'admin/invoices/debt_invoices'
                            ); ?>"
                    class="btn btn-default">

                    Anulo

                </a> -->

            </form>

        </div>

    </div>

</div>