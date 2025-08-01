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
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url(); ?>optimum/logo.png">
    <title><?php echo $_SESSION['title_name']; ?></title>

<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>

    <!-- Bootstrap Core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-extension/css/bootstrap-extension.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Menu CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">

    <!-- animation CSS -->
    <link href="<?php echo base_url(); ?>optimum/css/animate.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url(); ?>optimum/css/style.css" rel="stylesheet">

    <!-- color CSS -->
    <link href="<?php echo base_url(); ?>optimum/css/colors/green.css" id="theme" rel="stylesheet">


    <!-- color CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>optimum/plugins/bower_components/dropify/dist/css/dropify.min.css">
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-table/dist/bootstrap-table.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>optimum/plugins/bower_components/html5-editor/bootstrap-wysihtml5.css" />

    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/custom-select/custom-select.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/switchery/dist/switchery.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />

    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/Magnific-Popup-master/dist/magnific-popup.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/icheck/skins/all.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/tablesaw-master/dist/tablesaw.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/bootstrap-switch/bootstrap-switch.min.css" rel="stylesheet">
    <!-- summernotes CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/summernote/dist/summernote.css" rel="stylesheet" />

    <!--alerts CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">

    <!-- Typehead CSS -->
    <!-- <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/typeahead.js-master/dist/typehead-min.css" rel="stylesheet"> -->


    <!-- Wizard CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/jquery-wizard-master/css/wizard.css" rel="stylesheet">

    <!-- Cropper CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/cropper/cropper.min.css" rel="stylesheet">
    <!-- Dropzone css -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/dropzone-master/dist/dropzone.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>optimum/plugins/bower_components/gallery/css/animated-masonry-gallery.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>optimum/plugins/bower_components/fancybox/ekko-lightbox.min.css" />

    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/datatables/jquery.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/calendar/dist/fullcalendar.css" rel="stylesheet" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/horizontal-timeline/css/horizontal-timeline.css" rel="stylesheet">

    <!--nestable CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/nestable/nestable.css" rel="stylesheet" type="text/css" />


    <!--Range slider CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/ion-rangeslider/css/ion.rangeSlider.skinModern.css" rel="stylesheet">

    <!-- Wizard CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/register-steps/steps.css" rel="stylesheet">

    <!--Owl carousel CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/owl.carousel/owl.carousel.min.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/owl.carousel/owl.theme.default.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url(); ?>optimum/js/jquery-1.11.0.min.js"></script>


    <!-- Editable CSS -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>optimum/plugins/bower_components/jquery-datatables-editable/datatables.css" />

    <!-- Footable CSS -->
    <link href="<?php echo base_url(); ?>optimum/plugins/bower_components/footable/css/footable.core.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">



    <!--<link href="<?php echo base_url(); ?>optimum/fullcalendar/css/style.css" rel="stylesheet">-->

    <!--Amcharts-->
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/amcharts.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/pie.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/serial.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/gauge.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/funnel.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/radar.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/amexport.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/rgbcolor.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/canvg.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/jspdf.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/filesaver.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>optimum/js/amcharts/exporting/jspdf.plugin.addimage.js" type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.2/lazysizes.min.js" async></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>