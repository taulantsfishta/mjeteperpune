<style>
    input[type="text"] {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 100%;
    }

    #product-submit.product-saved {
        background-color: #eeeeee !important;
        border-color: #dddddd !important;
        color: #777777 !important;
        opacity: 1 !important;
        cursor: default;
        box-shadow: none;
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
                <div class="col-sm-12 col-xs-12">
                    <form method="post" action="<?php echo base_url('admin/products/edit'); ?>" enctype="multipart/form-data">
                        <input type="hidden" class="form-control" id="kodi" name="id" value="<?php echo $product['id']; ?>">
                        <div class="form-group">
                            <label for="kodi" class="col-sm-3 control-label col-form-label">Kodi</label>
                            <input type="text" class="form-control" id="kodi" name="code" value="<?php echo $product['code']; ?>" disabled>
                        </div>
                        <div class="form-group">
                            <label for="pershkrimi" class="col-sm-3 control-label col-form-label">Pershkrimi</label>
                            <input type="text" class="form-control" id="pershkrimi" name="name" placeholder="Pershkrimi" value="<?php echo htmlspecialchars($product['name']); ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="cmimi" class="col-sm-3 control-label col-form-label">Çmimi</label>
                            <input type="text" class="form-control" id="cmimi" name="price" placeholder="Çmimi" value="<?php echo $product['price']; ?>" required>
                        </div>
                        <div class="form-group">
                            <h3 class="box-title">Ndrysho Imazhin</h3>
                            <input type="file" id="input-file-now" name="product_image" class="dropify" />
                        </div>
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <div class="form-group">
                            <?php
                            $editedProductId = $this->session->flashdata('edited_product_id');

                            $productSaved = $editedProductId !== null
                                && (int) $editedProductId === (int) $product['id'];
                            ?>

                            <button type="submit"
                                id="product-submit"
                                class="btn btn-block btn-success<?= $productSaved ? ' product-saved' : ''; ?>"
                                data-default-text="Ndrysho"
                                <?= $productSaved ? 'disabled' : ''; ?>>
                                <?= $productSaved ? 'U ndryshua ✓' : 'Ndrysho'; ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function() {
        document.addEventListener('paste', function(event) {
            const clipboard = event.clipboardData;

            if (!clipboard || !clipboard.items) {
                return;
            }

            const imageItem = Array.from(clipboard.items).find(function(item) {
                return item.kind === 'file' && item.type.startsWith('image/');
            });

            if (!imageItem) {
                return;
            }

            const imageFile = imageItem.getAsFile();
            const input = document.getElementById('input-file-now');

            if (!imageFile || !input) {
                return;
            }

            event.preventDefault();

            let transfer;

            try {
                transfer = new DataTransfer();
                transfer.items.add(imageFile);
            } catch (error) {
                alert('Shfletuesi nuk e mbështet ngjitjen e fotos. Përdor ngarkimin manual.');
                return;
            }

            const $input = $(input);
            const dropify = $input.data('dropify');

            if (dropify) {
                dropify.resetPreview();
                dropify.clearElement();
            }

            try {
                input.files = transfer.files;
            } catch (error) {
                alert('Shfletuesi nuk e mbështet ngjitjen e fotos. Përdor ngarkimin manual.');
                return;
            }

            $input.trigger('change');
        });
    });
</script>
<script>
    $(function() {
        const button = document.getElementById('product-submit');

        if (!button) {
            return;
        }

        const form = button.form;

        // Aktivizo butonin kur përdoruesi ndryshon një fushë ose foton.
        $(form).on(
            'input change',
            'input:not([type="hidden"]), textarea, select',
            function() {
                if (!button.classList.contains('product-saved')) {
                    return;
                }

                button.disabled = false;
                button.classList.remove('product-saved');
                button.textContent = button.dataset.defaultText;
            }
        );
    });
</script>