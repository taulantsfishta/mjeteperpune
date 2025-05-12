<style>
  #date {
    width: 100%; /* Makes the input span the entire container width */
    height: 40px; /* Adjust height as needed */
    cursor: pointer; /* Ensures the cursor changes to pointer for better UX */
    text-align: center; /* Centers the text inside the input */
    font-size: 16px; /* Adjust font size for better usability */
  }
</style>
<div class="row">
    <div class="col-md-12">
        <?php $msg = $this->session->flashdata('msg'); ?>
        <?php $error_msg = $this->session->flashdata('error_msg'); ?>
        <?php if (isset($msg)) : ?>
            <div class="alert alert-success" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <?php unset($_SESSION['msg']);?>                
        <?php endif ?>
        <?php if (isset($error_msg)) : ?>
            <div class="alert alert-danger delete_msg pull" style="width: 100%"> <i class="fa fa-times"></i> <?php echo $error_msg; ?> &nbsp;
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
            </div>
            <?php unset($_SESSION['error_msg']);?>                
        <?php endif ?>
    </div>
    <div class="col-md-12">
        <div class="white-box" style="font-size:15px;font-family: Arial, Helvetica, sans-serif;">
            <div class="row">
                <div class="col-sm-9 col-xs-9">
                    <form method="post" action="<?php echo base_url('admin/employee/add/'); ?>">
                        <div class="form-group">
                            <label for="pershkrimi" class="col-sm-3 control-label col-form-label"><b>Emri I Punëtorit:</b></label>
                            <input type="text" class="form-control" id="pershkrimi" name="name" placeholder="" required style='font-size:15px;'>
                        </div>
                        <div class="form-group">
                            <label for="pershkrimi" class="col-sm-3 control-label col-form-label"><b>Rroga Mujore:</b></label>
                            <input type="text" class="form-control" id="pershkrimi" name="salary" placeholder="" required style='font-size:15px;'>
                        </div>
                        <div class="form-group">
                            <label for="date"><b>Fillimi I Punës:</b></label><br/>
                            <input type="date" id="date" name="month_year" value="<?= date('Y-m-d') ?>"  class="col-sm-12 col-xs-12" required>
                        </div>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                        <br><br>
                        <div class="form-group">
                            <button type="submit" class="col-sm-12 col-xs-12 btn btn-block btn-info">Ruaj</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>