
    
<!-- .row -->
<div class="row">
    <div class="col-md-12">
        <div class="white-box">
            <div class="row">
                <div class="col-md-12">
                    <?php $msg = $this->session->flashdata('msg'); ?>
                    <?php if ($msg != '') : ?>
                        <div class="alert alert-success delete_msg pull" style="width: 100%"> <i class="fa fa-check-circle"></i> <?php echo $msg; ?> &nbsp;
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        </div>
                        <?php unset($_SESSION['msg']); ?>
                    <?php endif ?>
                    <?php $error_msg = $this->session->flashdata('error_msg'); ?>
                    <?php if ($error_msg != '') : ?>
                        <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        </div>
                         <?php unset($_SESSION['error_msg']); ?>
                    <?php endif ?>
                </div>
                <div class="col-sm-12 col-xs-12">
                    <form method="post" action="<?php echo base_url('admin/printproduct/print_one_product/'.$product['id']); ?>">
                            <input type="hidden" class="form-control" id="kodi" name="id" value="<?php echo $product['id']; ?>">
                            <div class="form-group">
                                <label for="kodi" class="col-sm-3 control-label col-form-label">Kodi</label>
                                <input type="text" class="form-control" id="kodi" name="code" value="<?php echo $product['code']; ?>" readonly>
                            </div>
                            <div class="form-group">
                                <label for="pershkrimi" class="col-sm-3 control-label col-form-label">Pershkrimi</label>
                                <input type="text" class="form-control" id="pershkrimi" name="name" placeholder="Pershkrimi" value="<?php echo htmlspecialchars($product['name']); ?>" readonly>
                            </div>
                            <div class="form-group">
                                <h3 class="box-title">CAKTO DIMENSIONET E FLETES SE PRINTERIT</h3>
                                <select class="form-select form-select-lg mb-12" style="width:100%;height:40px;" aria-label=".form-select-lg example" name="label_dimension" id="label_dimension" required>
                                <?php foreach($page_dimension as $index => $dimension){ ?>
                                    <?php if($index === 0): ?>
                                        <option value="<?php echo $dimension['id']; ?>" selected><span>W: <?php echo $dimension['width']; ?> - H: <?php echo $dimension['height']; ?></span></option>
                                    <?php else: ?>
                                        <option value="<?php echo $dimension['id']; ?>"><span>W: <?php echo $dimension['width']; ?> - H: <?php echo $dimension['height']; ?></span></option>
                                    <?php endif; ?>
                                <?php } ?>
                                </select>
                            </div>    
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <div class="form-group">
                                <button type="submit" class="btn btn-block btn-info">PRINTO</button>
                            </div>
                    </form>  
                </div>    
            </div>        
        </div>
    </div>
</div>
