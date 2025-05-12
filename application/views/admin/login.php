<?php
$system_name = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
$system_title = $this->db->get_where('settings', array('type' => 'system_title'))->row()->description;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="We ddevelop creative software, eye catching software. We also train to become a creative thinker">
    <meta name="author" content="OPTIMUM LINKUP COMPUTERS">
    <link rel="icon" href="<?php echo base_url(); ?>optimum/logo.png" type="image/x-icon" />
    <title><?php echo $system_name; ?></title>
    <!-- Bootstrap Core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <!-- animation CSS -->
    <link href="<?php echo base_url(); ?>optimum/css/animate.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>optimum/css/style.css" rel="stylesheet">
    <!-- color CSS -->
    <link href="<?php echo base_url(); ?>optimum/css/colors/megna.css" id="theme" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<style>
    #mainImg{
        width:120px;
        height:120px;
    }

    #alert{
        width:100%;
        color:#7396CE;
    }
    #name{
        width:100%;
    }
    #password{
        width:100%;
    }
    #submitBtn{
        width:100%;
        color:white;
        background:#7396CE;
    }
    #loading{
        align: center;
    }
    #mainDiv{
        align: center;
    }
    
    #install_progress{
        margin-left: 20px; 
        display: none;
    }
</style>

<body>
    <!-- Preloader -->
    <h1></h1>
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="login-register">
        <div class="login-box login-sidebar">
            <div class="white-box">

                <div id="mainDiv" align="center">

                    <img src="<?php echo base_url(); ?>optimum/mjete_per_puneee.jpeg" id='mainImg' alt=''>
                    <br><br>
                    Miresevini<br> <strong style="color:#7396CE">Programi MJETE PËR PUNË</strong>. Shkruaj emrin dhe fjalekalimin per te hyre ne program.
                    <br/>
                    <div align="center">
                        <?php if (isset($page) && $page == "logout") : ?>
                            <div class="alert hide_msg pull" id='alert'> <i class="fa fa-check-circle"></i> Logout Successfully &nbsp;
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                            </div>
                        <?php endif ?>
                        <?php if ($this->session->flashdata('login_error')): ?>
                        <div class="alert hide_msg pull" id='alert'> <i class="fa fa-check-circle" style="font-size:15px;"></i> <?= $this->session->flashdata('login_error'); ?> &nbsp;
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>
                        </div>
                        <?php endif; ?>
                    </div>
                    <br/>
                    <form class="form-horizontal form-material" id="login-form" action="<?php echo base_url('auth/log'); ?>" method="post">

                        <div class="form-group">

                            <div class="col-xs-12">
                                <input class="form-control" id="name" type="text" name="user_name" required="" placeholder="Emri I Perdoruesit">
                            </div>
                        </div>
                        <div class="form-group ">
                            <div class="col-xs-12">
                                <input class="form-control" type="password" id="password" name="password" required="" placeholder="Fjalekalimi">
                            </div>
                        </div>


                        <!-- CSRF token -->
                        <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />

                        <button class="btn style1 btn-lg btn-block text-uppercase waves-effect waves-light" type="button" id="submitBtn">
                            KYQU
                        </button>
                        <div id="loading"><img id="install_progress" src="<?php echo base_url() ?>optimum/images/loading.gif" alt=''/></div>

                </div>
                <br><br><br><br><br><br><br><br><br>
            </div>

            </form>

        </div>
        </div>





    </section>


    <!-- jQuery -->
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url(); ?>optimum/bootstrap/dist/js/tether.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>optimum/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-extension/js/bootstrap-extension.min.js"></script>

    <!--Custom JavaScript -->
    <script src="<?php echo base_url() ?>optimum/js/custom.min.js"></script>
    <script src="<?php echo base_url() ?>optimum/js/custom.js"></script>



    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">

    <!-- auto hide message div-->
    <script type="text/javascript">
        $(document).ready(function() {
            $('.hide_msg').delay(2000).slideUp();
        });
    </script>

    <!--slimscroll JavaScript -->
    <script src="<?php echo base_url(); ?>optimum/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url(); ?>optimum/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url(); ?>optimum/js/custom.min.js"></script>
    <!--Style Switcher -->
    <script src="<?php echo base_url(); ?>optimum/plugins/bower_components/styleswitcher/jQuery.style.switcher.js"></script>

    <script>
        $('#submitBtn').click(function() {
            // Show loading spinner
            $('#install_progress').show();
            // Disable button and change its text
            $(this).text('Logging in...').attr('disabled', 'disabled');
            
            // Manually submit the form
            $('#login-form').submit();
        });

        $(document).ready(function () {
            // Hide alerts after a delay
            $('.hide_msg').delay(2000).slideUp();

            // Trigger login on Enter key
            $('#login-form input').on('keydown', function (e) {
                if (e.key === 'Enter' || e.keyCode === 13) {
                    e.preventDefault(); // Prevent form from submitting normally
                    $('#submitBtn').click(); // Trigger your custom login logic
                }
            });
        });
    </script>

    

</body>

</html>