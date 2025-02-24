<?php include 'layout/css.php'; ?>

<!-- Preloader -->
<h1></h1>
<div class="preloader">
    <div class="cssload-speeding-wheel"></div>
</div>
<div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top navbar-fixed-top m-b-0">
        <div class="navbar-header">
            <a class="navbar-toggle hidden-sm hidden-md hidden-lg " href="javascript:void(0)" data-toggle="collapse" data-target=".navbar-collapse"><i class="icon-menu"></i></a>
            <!-- <div class="top-left-part"><a class="logo" href="<?php echo base_url('admin/dashboard/') ?>"><b>
                    </b><span class="hidden-xs">MJETE PER PUNE</span></a></div> -->
            <ul class="nav navbar-top-links navbar-left hidden-xs">
                <li><a href="javascript:void(0)" class="open-close hidden-xs"><i class="icon-menu"></i></a></li>

            </ul>

            <ul class="nav navbar-top-links navbar-right pull-right">
                <!-- <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-fax"></i>
					
          <div class=""><span class=""></span><span class="point"></span></div>
          </a>
		  -->
                <!-- <ul class="dropdown-menu  animated bounceInDown"> -->


                <!-- calculator-->
                <!-- <style>
                .calculator_button{
                    border : 1px solid #303641;
                    width: 50px;
                    background-color: #5A606C;
                    color: #F5FAFC;
                    cursor:auto;
                }
                .calculator_button:hover{
                    border : 1px solid #303641;
                    background-color: #5A606C;
                    color: #F5FAFC;
                }
                .calculator_button:focus{
                    border : 1px solid #303641;
                    background-color: #5A606C;
                    color: #F5FAFC;
                }
            </style>     -->
                <!-- <form name="form1" onsubmit="return false">
            <table style="">
                <tr>
                    <td colspan="4"><input type="text" id="display" style="width:100%; border:0px; background-color:#303641;text-align: right;  font-size: 24px;  font-weight: 100;  color: #fff;" readonly placeholder="0" /></td>
                </tr>
                <tr>
                    <td colspan="4"><button type="button" class="btn btn-default calculator_button" style="width:100%;"  onclick="reset()">Clear</button></td>
                </tr>
                <tr>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(7)">7</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(8)" >8</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(9)" >9</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="operator(&quot;+&quot;)">+</button></td>
                </tr>
                <tr>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(4)">4</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(5)" >5</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(6)" >6</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="operator(&quot;-&quot;)" >-</button></td>
                </tr>
                <tr>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(1)">1</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(2)" >2</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(3)" >3</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="operator(&quot;*&quot;)" >&times;</button></td>
                </tr>
                <tr>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(0)">0</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="displaynum(&quot;.&quot;)" >.</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="equals()" >=</button></td>
                    <td><button type="button" class="btn btn-default calculator_button" onclick="operator(&quot;/&quot;)" >&divide;</button></td>
                </tr>
            </table>
            </form>
                    -->
                <!-- </ul> -->



                <!-- /.dropdown-messages -->
                <!-- </li> -->
                <!-- /.dropdown -->




                <ul class="nav navbar-top-links navbar-right pull-right">
                    <!-- <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-language"></i>
					
          <div class=""><span class=""></span><span class="point"></span></div>
          </a>
		 
           <ul class="dropdown-menu  animated bounceInDown">
		   
                         
                            <li class="active">
                                <a href="">
                                    <img src="<?php echo base_url(); ?>optimum/flag/english.png" style="width:16px; height:16px;" />	
                                    <span>English</span>
                                </a>
                            </li>
							<li class="">
                                <a href="">
                                    <img src="<?php echo base_url(); ?>optimum/flag/arabic.png" style="width:16px; height:16px;" />	
                                    <span>Arabic</span>
                                </a>
                            </li>
							
							<li class="">
                                <a href="">
                                    <img src="<?php echo base_url(); ?>optimum/flag/german.png" style="width:16px; height:16px;" />	
                                    <span>German</span>
                                </a>
                            </li>
							
							<li class="">
                                <a href="">
                                    <img src="<?php echo base_url(); ?>optimum/flag/dutch.png" style="width:16px; height:16px;" />	
                                    <span>Dutch</span>
                                </a>
                            </li>
							
							<li class="">
                                <a href="">
                                    <img src="<?php echo base_url(); ?>optimum/flag/french.png" style="width:16px; height:16px;" />	
                                    <span>French</span>
                                </a>
                            </li>
							
							<li class="">
                                <a href="">
                                    <img src="<?php echo base_url(); ?>optimum/flag/bengali.png" style="width:16px; height:16px;" />	
                                    <span>Bengali</span>
                                </a>
                            </li>
							
							<li class="">
                                <a href="">
                                    <img src="<?php echo base_url(); ?>optimum/flag/italian.png" style="width:16px; height:16px;" />	
                                    <span>Italian</span>
                                </a>
                            </li>
							
							<li class="">
                                <a href="">
                                    <img src="<?php echo base_url(); ?>optimum/flag/russian.png" style="width:16px; height:16px;" />	
                                    <span>Russian</span>
                                </a>
                            </li>
							
							<li class="">
                                <a href="">
                                    <img src="<?php echo base_url(); ?>optimum/flag/spanish.png" style="width:16px; height:16px;" />	
                                    <span>Spanish</span>
                                </a>
                            </li>
							
							<li class="">
                                <a href="">
                                    <img src="<?php echo base_url(); ?>optimum/flag/thai.png" style="width:16px; height:16px;" />	
                                    <span>Thai</span>
                                </a>
                            </li>
							
							<li class="">
                                <a href="">
                                    <img src="<?php echo base_url(); ?>optimum/flag/turkish.png" style="width:16px; height:16px;" />	
                                    <span>Turkish</span>
                                </a>
                            </li>
							
								<li class="">
                                <a href="">
                                    <img src="<?php echo base_url(); ?>optimum/flag/greek.png" style="width:16px; height:16px;" />	
                                    <span>Greek</span>
                                </a>
                            </li>
							
							<li class="">
                                <a href="">
                                    <img src="<?php echo base_url(); ?>optimum/flag/urdu.png" style="width:16px; height:16px;" />	
                                    <span>Urdu</span>
                                </a>
                            </li>
							
							<li class="">
                                <a href="">
                                    <img src="<?php echo base_url(); ?>optimum/flag/indonesian.png" style="width:16px; height:16px;" />	
                                    <span>Indonesian</span>
                                </a>
                            </li>
							
							<li class="">
                                <a href="">
                                    <img src="<?php echo base_url(); ?>optimum/flag/hungarian.png" style="width:16px; height:16px;" />	
                                    <span>Hungarian</span>
                                </a>
                            </li>
							
							<li class="">
                                <a href="">
                                    <img src="<?php echo base_url(); ?>optimum/flag/hindi.png" style="width:16px; height:16px;" />	
                                    <span>Hindi</span>
                                </a>
                            </li>
                   
                    </ul>
										
						
						
                    </li> -->
                    <!-- /.dropdown -->





                    <ul class="nav navbar-top-links navbar-right pull-right">
                        <!-- <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-screen-desktop"></i>
          <div class="notify"><span class=""></span><span class=""></span></div>
          </a>
                        <ul class="dropdown-menu mailbox animated bounceInRight">
                            <li>
                                <div class="drop-title">You have 4 new messages</div>
                            </li>
                            <li>
                                <div class="message-center">
                                    <a href="#">
                                        <div class="user-img"> <img src="<?php echo base_url(); ?>optimum/plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"> <span class="profile-status online pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:30 AM</span> </div>
                                    </a>
                                    <a href="#">
                                        <div class="user-img"> <img src="<?php echo base_url(); ?>optimum/plugins/images/users/sonu.jpg" alt="user" class="img-circle"> <span class="profile-status busy pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Sonu Nigam</h5> <span class="mail-desc">I've sung a song! See you at</span> <span class="time">9:10 AM</span> </div>
                                    </a>
                                    <a href="#">
                                        <div class="user-img"> <img src="<?php echo base_url(); ?>optimum/plugins/images/users/arijit.jpg" alt="user" class="img-circle"> <span class="profile-status away pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Arijit Sinh</h5> <span class="mail-desc">I am a singer!</span> <span class="time">9:08 AM</span> </div>
                                    </a>
                                    <a href="#">
                                        <div class="user-img"> <img src="<?php echo base_url(); ?>optimum/plugins/images/users/pawandeep.jpg" alt="user" class="img-circle"> <span class="profile-status offline pull-right"></span> </div>
                                        <div class="mail-contnet">
                                            <h5>Pavan kumar</h5> <span class="mail-desc">Just see the my admin!</span> <span class="time">9:02 AM</span> </div>
                                    </a>
                                </div>
                            </li>
                            <li>
                                <a class="text-center" href="javascript:void(0);"> <strong>See all notifications</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </li> -->
                        <!-- /.dropdown -->

                        <!-- <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-feed"></i>
          <div class="notify"><span class=""></span><span class=""></span></div>
          </a>
                        <ul class="dropdown-menu dropdown-tasks animated bounceInRight">
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 1</strong> <span class="pull-right text-muted">40% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%"> <span class="sr-only">40% Complete (success)</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 2</strong> <span class="pull-right text-muted">20% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%"> <span class="sr-only">20% Complete</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 3</strong> <span class="pull-right text-muted">60% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"> <span class="sr-only">60% Complete (warning)</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a href="#">
                                    <div>
                                        <p> <strong>Task 4</strong> <span class="pull-right text-muted">80% Complete</span> </p>
                                        <div class="progress progress-striped active">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"> <span class="sr-only">80% Complete (danger)</span> </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <a class="text-center" href="#"> <strong>See All Tasks</strong> <i class="fa fa-angle-right"></i> </a>
                            </li>
                        </ul>
                    </li> -->
                        <!-- /.dropdown -->
                        <!--<li class="dropdown">-->
                        <!--    <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"> <img src="<?php echo base_url(); ?>optimum/images/profile-icon1.png" alt="user-img" width="38" class="img-circle"><b class="hidden-xs" style="font-size:13px;"><?php echo $this->session->userdata('name'); ?></b> </a>-->
                        <!--    <ul class="dropdown-menu dropdown-user animated flipInY" style="width:117px;font-size:12px">-->
                        <!--        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-power-off"></i> Logout</a></li>-->
                        <!--    </ul>-->
                            <!-- /.dropdown-user -->
                        <!--</li>-->
                        
                        <div class="dropdown">
                            <button class="btn dropdown-toggle shadow-none" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="border:none;box-shadow:none;">
                                <a><img src="<?php echo base_url(); ?>optimum/images/profile-icon1.png" alt="user-img" width="40" class="img-circle"><b class="hidden-xs" style="border-right:0px;font-size:13px;color:black;"> <?php echo $this->session->userdata('name'); ?></b> </a>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1" style="width:110px;font-size:12px">
                                <li><a href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-power-off"></i> Logout</a></li>
                            </ul>
                        </div>
                        <!--<li class="right-side-toggle"> <a class="waves-effect waves-light" href="javascript:void(0)"><i class="ti-settings"></i></a></li>-->
                        <!-- /.dropdown -->
                    </ul>
        </div>
        <!-- /.navbar-header -->
        <!-- /.navbar-top-links -->
        <!-- /.navbar-static-side -->
    </nav>
    <!-- Left navbar-header -->
    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse slimscrollsidebar">
            <ul class="nav" id="side-menu">
                <!-- <li class="sidebar-search hidden-sm hidden-md hidden-lg">
                    <div class="input-group custom-search-form">
                        <input type="text" class="form-control" placeholder="Search<?php echo base_url(); ?>optimum."> <span class="input-group-btn">
                            <button class="btn btn-default" type="button"> <i class="fa fa-search"></i> </button>
                        </span>
                    </div>
                </li> -->
                <!-- <li class="user-pro">
                    <a href="#" class="waves-effect"><img src="<?php echo base_url(); ?>optimum/images/admin.jpg" alt="user-img" class="img-circle"> <span class="hide-menu"><?php echo $this->session->userdata('name'); ?><span class="fa arrow"></span></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li><a href="javascript:void(0)"><i class="ti-user"></i> My Profile</a></li>
                        <li><a href="javascript:void(0)"><i class="ti-email"></i> Inbox</a></li>
                        <li><a href="javascript:void(0)"><i class="ti-settings"></i> Account Setting</a></li>
                        <li><a href="<?php echo base_url('auth/logout') ?>"><i class="fa fa-power-off"></i> Logout</a></li>
                    </ul>
                </li> -->
                <li> <a href="javascript:void(0);" class="waves-effect"><i class="ti-dashboard p-r-10"></i> <span class="hide-menu" style="font-family: Verdana, sans-serif;font-size:13px;font-weight: bold;" >PRODUKTET<span class="fa arrow"></span><span class="label label-rouded label-danger pull-right"><?php echo count($this->session->userdata('category')) + 1; ?></span></span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="<?php echo base_url('admin/dashboard') ?>"><i class="fa fa-wrench"></i><span class="hide-menu"  style="font-family: Verdana, sans-serif;font-size:13px;font-weight: bold;"> TË GJITHA PRODUKTET</span></a></li>
                        <?php foreach ($this->session->userdata('category') as $key => $value) { ?>
                            <li><a href="<?php echo base_url('admin/dashboard/get_category/' . $value['id']) ?>"><i class="fa fa-wrench"></i><span style="font-family: Verdana, sans-serif;font-size:12px;font-weight: bold;" class="hide-menu"><?php echo ' '.$value['id']; ?>. <?php echo $value['name']; ?></span></a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php if ($this->session->userdata('role') == 'admin') : ?>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-user p-r-10"></i> <span class="hide-menu"style="font-family: Verdana, sans-serif;font-size:13px;font-weight: bold;">KRIJO<span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">4</span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('admin/user') ?>"><i class="fa fa-plus p-r-10"></i><span class="hide-menu" style="font-family: Verdana, sans-serif;font-size:12px;font-weight: bold;" >PËRDORUES I RI</span></a></li>
                            <li><a href="<?php echo base_url('admin/user/all_user_list') ?>"><i class="fa fa-list p-r-10"></i><span class="hide-menu" style="font-family: Verdana, sans-serif;font-size:12px;font-weight: bold;">LISTA E TË GJITHË PËRDORUESVE</span></a></li>
                            <li><a href="<?php echo base_url('admin/categories') ?>"><i class="fa fa-list p-r-10"></i><span class="hide-menu" style="font-family: Verdana, sans-serif;font-size:12px;font-weight: bold;">KATEGORIT</span></a></li>
                            <li><a href="<?php echo base_url('admin/user/login_history') ?>"><i class="fa fa-list p-r-10"></i><span class="hide-menu" style="font-family: Verdana, sans-serif;font-size:12px;font-weight: bold;">HISTORIKU I PËRDORUESVE</span></a></li>
                        </ul>
                    </li>
                <?php endif ?>
                <?php if ($this->session->userdata('role') == 'admin') : ?>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-print p-r-10"></i> <span class="hide-menu"style="font-family: Verdana, sans-serif;font-size:13px;font-weight: bold;">PRINTO<span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">2</span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('admin/printproduct') ?>"><i class="fa fa-print p-r-10"></i><span class="hide-menu" style="font-family: Verdana, sans-serif;font-size:12px;font-weight: bold;" >PRINTO PRODUKTET</span></a></li>
                            <li> <a href="<?php echo base_url('admin/printproduct/page_dimension') ?>"><i class="fa fa-paper-plane p-r-10"></i><span class="hide-menu" style="font-family: Verdana, sans-serif;font-size:12px;font-weight: bold;" >DIMENSIONET E FLETËS</span></a></li>
                        </ul>
                    </li>
                    <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-file p-r-10" aria-hidden="true"></i> <span class="hide-menu"style="font-family: Verdana, sans-serif;font-size:13px;font-weight: bold;">FATURAT<span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">2</span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('admin/invoices/') ?>"><i class="fa fa-plus p-r-10" aria-hidden="true"></i><span class="hide-menu" style="font-family: Verdana, sans-serif;font-size:12px;font-weight: bold;" >KRIJO FATURËN</span></a></li>
                            <li> <a href="<?php echo base_url('admin/invoices/created') ?>"><i class="fa fa-file p-r-10" aria-hidden="true"></i><span class="hide-menu" style="font-family: Verdana, sans-serif;font-size:12px;font-weight: bold;" >FATURAT E KRIJUARA</span></a></li>
                        </ul>
                    </li>
                    <!-- <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-truck p-r-12" aria-hidden="true"></i> <span class="hide-menu"style="font-family: Verdana, sans-serif;font-size:13px;font-weight: bold;">POSTA<span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">2</span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('admin/expresspostaapi/') ?>"><i class="fa fa-plus p-r-10" aria-hidden="true"></i><span class="hide-menu" style="font-family: Verdana, sans-serif;font-size:12px;font-weight: bold;" >KRIJO POROSINË NË EXPRESS POSTË</span></a></li>
                            <li> <a href="<?php echo base_url('admin/expresspostaapi/order_list') ?>"><i class="fa fa-file p-r-10" aria-hidden="true"></i><span class="hide-menu" style="font-family: Verdana, sans-serif;font-size:12px;font-weight: bold;" >POROSITË E KRIJUARA NË EXPRESS POSTË</span></a></li>
                        </ul>
                    </li> -->
                    <!-- <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-file p-r-10" aria-hidden="true"></i> <span class="hide-menu"style="font-family: Verdana, sans-serif;font-size:13px;font-weight: bold;">PUNËTORËT<span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">2</span></span></a>
                        <ul class="nav nav-second-level">
                            <li> <a href="<?php echo base_url('admin/employee/') ?>"><i class="fa fa-plus p-r-10" aria-hidden="true"></i><span class="hide-menu" style="font-family: Verdana, sans-serif;font-size:12px;font-weight: bold;" >KRIJO PUNËTORIN</span></a></li>
                            <li> <a href="<?php echo base_url('admin/employee/created') ?>"><i class="fa fa-file p-r-10" aria-hidden="true"></i><span class="hide-menu" style="font-family: Verdana, sans-serif;font-size:12px;font-weight: bold;" >LISTA E PUNËTORËVE</span></a></li>
                        </ul>
                    </li> -->
                <?php endif ?>
                <!-- <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-envelope p-r-10"></i> <span class="hide-menu"> Mailbox <span class="fa arrow"></span><span class="label label-rouded label-danger pull-right">6</span></span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="<?php echo base_url('admin/mail/inbox') ?>">Inbox</a></li>
                        <li> <a href="<?php echo base_url('admin/mail/inbox_details') ?>">Inbox detail</a></li>
                        <li> <a href="<?php echo base_url('admin/mail/compose_message') ?>">Compose mail</a></li>
                    </ul>
                </li> -->

                <!-- <li> <a href="#" class="waves-effect"><i data-icon="/" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">UI Elements<span class="fa arrow"></span> <span class="label label-rouded label-info pull-right">25</span> </span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo base_url('admin/ui/card') ?>">Cards</a></li>
                        <li><a href="<?php echo base_url('admin/ui/panel_well') ?>">Panels and Wells</a></li>
                        <li><a href="<?php echo base_url('admin/ui/panel_block') ?>">Panels With BlockUI</a></li>
                        <li><a href="<?php echo base_url('admin/ui/drag_panel') ?>">Draggable Panel</a></li>
                        <li><a href="<?php echo base_url('admin/ui/dragPortlet') ?>">Draggable Portlet</a></li>
                        <li><a href="<?php echo base_url('admin/ui/buttons') ?>">Buttons</a></li>
                        <li><a href="<?php echo base_url('admin/ui/bootsrap_switch') ?>">Bootstrap Switch</a></li>
                        <li><a href="<?php echo base_url('admin/ui/date_pagination') ?>">Date Paginator</a></li>
                        <li><a href="<?php echo base_url('admin/ui/sweet_alert') ?>">Sweat alert</a></li>
                        <li><a href="<?php echo base_url('admin/ui/typography') ?>">Typography</a></li>
                        <li><a href="<?php echo base_url('admin/ui/grid') ?>">Grid</a></li>
                        <li><a href="<?php echo base_url('admin/ui/tabs') ?>">Tabs</a></li>
                        <li><a href="<?php echo base_url('admin/ui/stylish') ?>">Stylish Tabs</a></li>
                        <li><a href="<?php echo base_url('admin/ui/modals') ?>">Modals</a></li>
                        <li><a href="<?php echo base_url('admin/ui/progressbar') ?>">Progress Bars</a></li>
                        <li><a href="<?php echo base_url('admin/ui/notification') ?>">Notifications</a></li>
                        <li><a href="<?php echo base_url('admin/ui/carousel') ?>">Carousel</a></li>
                        <li><a href="<?php echo base_url('admin/ui/list_media') ?>">List & Media object</a></li>
                        <li><a href="<?php echo base_url('admin/ui/user_card') ?>">User Cards</a></li>
                        <li><a href="<?php echo base_url('admin/ui/timeline') ?>">Timeline</a></li>
                        <li><a href="<?php echo base_url('admin/ui/horizontal_timeline') ?>">Horizontal Timeline</a></li>
                        <li><a href="<?php echo base_url('admin/ui/nestable') ?>">Nesteble</a></li>
                        <li><a href="<?php echo base_url('admin/ui/range_slider') ?>">Range Slider</a></li>
                        <li><a href="<?php echo base_url('admin/ui/ribbon') ?>">Ribbons</a></li>
                        <li><a href="<?php echo base_url('admin/ui/steps') ?>">Steps</a></li>
                    </ul>
                </li> -->

                <!-- <li> <a href="javascript:void(0);" class="waves-effect"><i class="icon-chart p-r-10"></i> <span class="hide-menu"> Reports <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="<?php echo base_url('admin/report/payment_report') ?>">Payment Report</a></li>
                        <li> <a href="<?php echo base_url('admin/report/income_report') ?>">Income Report</a></li>
                        <li> <a href="<?php echo base_url('admin/report/sales_report') ?>">Sales Report</a></li>
                    </ul>
                </li>
                <li> <a href="javascript:void(0);" class="waves-effect"><i class="fa fa-inr p-r-10"></i> <span class="hide-menu"> Payments <span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="<?php echo base_url('admin/payment/all_payments') ?>">All Payments</a></li>
                        <li> <a href="<?php echo base_url('admin/payment/create_payment') ?>">Create Payment</a></li>
                        <li> <a href="<?php echo base_url('admin/payment/payment_invoice') ?>">Payment Invoice</a></li>
                    </ul>
                </li> -->

                <!-- <li> <a href="forms.html" class="waves-effect"><i data-icon="&#xe00b;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Forms<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo base_url('admin/form/form_basic') ?>">Basic Forms</a></li>
                        <li><a href="<?php echo base_url('admin/form/form_layout') ?>">Form Layout</a></li>
                        <li><a href="<?php echo base_url('admin/form/form_addon') ?>">Form Addons</a></li>
                        <li><a href="<?php echo base_url('admin/form/form_material') ?>">Form Material</a></li>
                        <li><a href="<?php echo base_url('admin/form/form_float') ?>">Form Float Input</a></li>
                        <li><a href="<?php echo base_url('admin/form/file_upload') ?>">File Upload</a></li>
                        <li><a href="<?php echo base_url('admin/form/form_mask') ?>">Form Mask</a></li>
                        <li><a href="<?php echo base_url('admin/form/form_validation') ?>">Form Validation</a></li>
                        <li><a href="<?php echo base_url('admin/form/form_dropzone') ?>">File Dropzone</a></li>
                        <li><a href="<?php echo base_url('admin/form/form_picker') ?>">Form-pickers</a></li>
                        <li><a href="<?php echo base_url('admin/form/form_icheck') ?>">Icheck Form Controls</a></li>
                        <li><a href="<?php echo base_url('admin/form/form_wizard') ?>">Form-wizards</a></li>
                        <li><a href="<?php echo base_url('admin/form/form_typehead') ?>">Typehead</a></li>
                        <li><a href="<?php echo base_url('admin/form/form_editable') ?>">X-editable</a></li>
                        <li><a href="<?php echo base_url('admin/form/form_summernote') ?>">Summernote</a></li>
                        <li><a href="<?php echo base_url('admin/form/form_wysihtml5') ?>">Bootstrap wysihtml5</a></li>
                        <li><a href="<?php echo base_url('admin/form/form_tinymyce') ?>">Tinymce wysihtml5</a></li>
                    </ul>
                </li> -->
                <!-- <li> <a href="<?php echo base_url('admin/dashboard/backup') ?>" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Backup Database</span></a> </li>

                <li> <a href="<?php echo base_url('admin/widget/widget') ?>" class="waves-effect"><i data-icon="P" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Widgets</span></a> </li> -->
                <!-- <li> <a href="#" class="waves-effect"><i data-icon="7" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Icons<span class="fa arrow"></span></span></a>
                    <ul class="nav nav-second-level">
                        <li> <a href="<?php echo base_url('admin/icon/font_awesome') ?>">Font awesome</a> </li>
                        <li> <a href="<?php echo base_url('admin/icon/themifyIcon') ?>">Themify Icons</a> </li>
                        <li> <a href="<?php echo base_url('admin/icon/simpleLineIcon') ?>">Simple line Icons</a> </li>
                        <li><a href="<?php echo base_url('admin/icon/lineIcon') ?>">Linea Icons</a></li>
                        <li><a href="<?php echo base_url('admin/icon/weatherIcon') ?>">Weather Icons</a></li>
                    </ul>
                </li> -->

                <!-- <li> <a href="#" class="waves-effect"><i data-icon="&#xe008;" class="linea-icon linea-basic fa-fw"></i> <span class="hide-menu">Sample Pages<span class="fa arrow"></span><span class="label label-rouded label-purple pull-right">29</span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo base_url('admin/page/starter') ?>">Starter Page</a></li>
                        <li><a href="<?php echo base_url('admin/page/blank') ?>">Blank Page</a></li>
                        <li><a href="javascript:void(0)" class="waves-effect">Email Templates
                                <span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
                                <li><a href="<?php echo base_url('admin/page/email_basic') ?>">Basic</a></li>
                                <li><a href="<?php echo base_url('admin/page/email_alert') ?>">Alert</a></li>
                                <li><a href="<?php echo base_url('admin/page/email_billing') ?>">Billing</a></li>
                                <li><a href="<?php echo base_url('admin/page/reset_password') ?>">Reset Password</a></li>
                            </ul>
                        </li>
                        <li><a href="<?php echo base_url('admin/page/lightBox') ?>">Lightbox Popup</a></li>
                        <li><a href="<?php echo base_url('admin/page/treeview') ?>">Treeview</a></li>
                        <li><a href="<?php echo base_url('admin/page/search_result') ?>">Search Result</a></li>
                        <li><a href="<?php echo base_url('admin/page/utility_class') ?>">Utility Classes</a></li>
                        <li><a href="<?php echo base_url('admin/page/custom_scroll') ?>">Custom Scrolls</a></li>
                        <li><a href="<?php echo base_url('admin/page/login_page') ?>">Login Page</a></li>
                        <li><a href="<?php echo base_url('admin/page/second_login') ?>">Login v2</a></li>
                        <li><a href="<?php echo base_url('admin/page/animation') ?>">Animations</a></li>
                        <li><a href="<?php echo base_url('admin/page/profile') ?>">Profile</a></li>
                        <li><a href="<?php echo base_url('admin/page/invoice') ?>">Invoice</a></li>
                        <li><a href="<?php echo base_url('admin/page/faq') ?>">FAQ</a></li>
                        <li><a href="<?php echo base_url('admin/page/gallery') ?>">Gallery</a></li>
                        <li><a href="<?php echo base_url('admin/page/pricing') ?>">Pricing</a></li>
                        <li><a href="<?php echo base_url('admin/page/register') ?>">Register</a></li>
                        <li><a href="<?php echo base_url('admin/page/second_register') ?>">Register v2</a></li>
                        <li><a href="<?php echo base_url('admin/page/step_registration') ?>">3 Step Registration</a></li>
                        <li><a href="<?php echo base_url('admin/page/recover_password') ?>">Recover Password</a></li>
                    </ul>
                </li> -->

                <!-- <li> <a href="tables.html" class="waves-effect"><i data-icon="O" class="linea-icon linea-software fa-fw"></i> <span class="hide-menu">Tables<span class="fa arrow"></span><span class="label label-rouded label-info pull-right">7</span></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="<?php echo base_url('admin/table/basic_table') ?>">Basic Tables</a></li>
                        <li><a href="<?php echo base_url('admin/table/table_layout') ?>">Table Layouts</a></li>
                        <li><a href="<?php echo base_url('admin/table/data_table') ?>">Data Table</a></li>
                        <li><a href="<?php echo base_url('admin/table/bootsrap_table') ?>">Bootstrap Tables</a></li>
                        <li><a href="<?php echo base_url('admin/table/responsive_table') ?>">Responsive Tables</a></li>
                        <li><a href="<?php echo base_url('admin/table/editable_table') ?>">Editable Tables</a></li>
                        <li><a href="<?php echo base_url('admin/table/footable') ?>">FooTables</a></li>
                    </ul>
                </li> -->

                <li><a href="<?php echo base_url('auth/logout') ?>" class="waves-effect"><i class="icon-logout fa-fw"></i> <span class="hide-menu" style="font-family: Verdana, sans-serif;font-size:13px;font-weight: bold;">DIL NGA PROGRAMI</span></a></li>
            </ul>
        </div>
    </div>
    <!-- Left navbar-header end -->


    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">

            <div class="row bg-title">
                <!-- <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12"> -->
                <h4 class="page-title"><?php echo $page_title; ?></h4>
                <!-- </div> -->
            </div>

            <?php echo $main_content; ?>

        </div>
        <?php include 'layout/footer.php'; ?>
    </div>
    <!-- /#page-wrapper -->
</div>
<!-- /#wrapper -->
<!-- jQuery -->
<script>
    $(document).ready(
        $('.navbar-collapse').on('show.bs.collapse hide.bs.collapse', function(e) {
            e.preventDefault();
        }),
        $('[data-toggle="collapse"]').on('click', function(e) {
            e.preventDefault();
            $($(this).data('target')).toggleClass('in');
        })
    );
</script>
<?php include 'layout/js.php'; ?>