<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <div class="white-box">

            <h3>Shto klient</h3>

            <form method="post">

                <div class="form-group">

                    <label>Emri i klientit</label>

                    <input
                        type="text"
                        name="name"
                        class="form-control"
                        required>

                </div>


                <div class="form-group">

                    <label>Adresa</label>

                    <input
                        type="text"
                        name="address"
                        class="form-control">

                </div>


                <div class="form-group">

                    <label>Telefoni</label>

                    <input
                        type="text"
                        name="phone"
                        class="form-control">

                </div>


                <div class="form-group">

                    <label>Detyrimi fillestar</label>

                    <input
                        type="number"
                        name="initial_debt"
                        class="form-control"
                        step="0.01"
                        min="0"
                        value="0">

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