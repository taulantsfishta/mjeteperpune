<style>
    input[type="text"] {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 100%;
}
</style>
<!-- .row -->
<div class="row">
    <div class="col-md-12">
        <div class="white-box" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">
            <div class="row">
                <div class="col-md-12">
                    <?php $msg = $this->session->flashdata('msg'); ?>
                    <?php $error_msg = $this->session->flashdata('error_msg'); ?>
                    <?php if ($error_msg != '') : ?>
                        <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        </div>
                         <?php unset($_SESSION['error_msg']); ?>
                    <?php endif ?>
                </div>
                <div class="col-sm-12 col-xs-12" style="font-size:15px;">
                    <form method="post" action="<?php echo base_url('admin/products/add/'. $category_id); ?>" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" class="form-control" id="code" name="code" value=<?php echo $codeId; ?> placeholder="Kodi" readonly>
                        </div>
                        <div class="form-group">
                            <label for="pershkrimi" class="col-sm-3 control-label col-form-label">Pershkrimi</label>
                            <input type="text" class="form-control" id="pershkrimi" name="name" placeholder="Pershkrimi" required>
                        </div>
                        <div class="form-group">
                            <label for="cmimi" class="col-sm-3 control-label col-form-label">Çmimi</label>
                            <input type="text" class="form-control" id="cmimi" name="price" placeholder="Çmimi" required>
                        </div>


                        <!-- OPSIONAL - INFORMATA PRODUKTI -->
                        <div class="form-group">
                            <button
                                class="btn btn-default btn-block text-left"
                                type="button"
                                data-toggle="collapse"
                                data-target="#optionalProductInfo"
                                aria-expanded="false"
                                aria-controls="optionalProductInfo"
                                style="border:1px solid #ddd; background:#f7f7f7;">
                                Opsional(INFORMATA SHTESE MBI PRODUKTIN)
                                <span class="pull-right">
                                    <i class="fa fa-chevron-down"></i>
                                </span>
                            </button>
                        </div>

                        <div class="collapse" id="optionalProductInfo">
                            <div class="well" style="background:#fafafa; border:1px solid #ddd;">

                                <div class="form-group">
                                    <label for="shop_name">Emri i Dyqanit</label>
                                    <input type="text" class="form-control" id="shop_name" name="shop_name" placeholder="Emri i Dyqanit">
                                </div>

                                <div class="form-group">
                                    <label for="product_quantity">Sasia</label>
                                    <input type="text" class="form-control" id="product_quantity" name="product_quantity" placeholder="Sasia">
                                </div>

                                <div class="form-group">
                                    <label for="product_buying_price">Çmimi i Blerjes</label>
                                    <input type="text" class="form-control" id="product_buying_price" name="product_buying_price" placeholder="Çmimi i Blerjes">
                                </div>

                                <div class="form-group">
                                    <label for="invoice_number">Numri i Faturës</label>
                                    <input type="text" class="form-control" id="invoice_number" name="invoice_number" placeholder="Numri i Faturës">
                                </div>

                            </div>
                        </div>

                        <div class="form-group">
                        <h3 class="box-title">Ngarko Imazhin</h3>
                        <input type="file" id="input-file-now" name="product_image" class="dropify" / required>
                        </div>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-info">Ruaj</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    $('form').on('submit', function(e) {

        let shopName = $('#shop_name').val().trim();
        let quantity = $('#product_quantity').val().trim();
        let buyingPrice = $('#product_buying_price').val().trim();

        let optionalFields = [shopName, quantity, buyingPrice];

        let hasAnyOptional = optionalFields.some(value => value !== '');
        let hasEmptyOptional = optionalFields.some(value => value === '');

        if (hasAnyOptional && hasEmptyOptional) {
            e.preventDefault();

            $('#optionalProductInfo').collapse('show');

            alert('Nëse plotëson një fushë te Opsional, duhet t’i plotësosh se paku tri fushat e para.');

            return false;
        }
    });
</script>