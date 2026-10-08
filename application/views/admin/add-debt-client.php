<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <div class="white-box">

            <h3>Shto klient</h3>


            <?php
            $error = $this->session->flashdata('error');

            // Pastro mesazhin pasi është lexuar.
            $this->session->unset_userdata('error');
            ?>

            <?php if (!empty($error)): ?>

                <div class="alert alert-danger" style="margin-top:15px;">

                    <i class="fa fa-times-circle"></i>

                    <?php echo htmlspecialchars(
                        $error,
                        ENT_QUOTES,
                        'UTF-8'
                    ); ?>

                </div>

            <?php endif; ?>


            <?php
            $error = $this->session->flashdata('error');
            ?>

            <?php if (!empty($error)) : ?>

                <div
                    class="alert alert-danger"
                    style="margin-top:15px;">

                    <i class="fa fa-times-circle"></i>

                    <?php echo htmlspecialchars(
                        $error,
                        ENT_QUOTES,
                        'UTF-8'
                    ); ?>

                </div>

            <?php endif; ?>


            <form method="post">

                <div class="form-group">

                    <label>Emri i klientit</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        value="<?php echo htmlspecialchars(
                                    $this->session->flashdata('old_name') ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>">

                </div>


                <div class="form-group">

                    <label>Adresa</label>

                    <input
                        type="text"
                        name="address"
                        class="form-control"
                        value="<?php echo htmlspecialchars(
                                    $this->session->flashdata('old_address') ?? '',
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
                                    $this->session->flashdata('old_phone') ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>">

                </div>


                <div class="form-group">

                    <label>Detyrimi fillestar</label>

                    <input
                        type="number"
                        step="0.01"
                        name="initial_debt"
                        class="form-control"
                        value="<?php echo htmlspecialchars(
                                    $this->session->flashdata('old_initial_debt') ?? '',
                                    ENT_QUOTES,
                                    'UTF-8'
                                ); ?>">

                </div>


                <button
                    type="submit"
                    class="btn btn-success">
                    Ruaj klientin
                </button>

            </form>

        </div>

    </div>
</div>