<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url() ?>assets/images/pendukung/logo_.png"> -->
    <title>Yayasan Mentari Ilmu</title>
    <!-- ===== Bootstrap CSS ===== -->
    <link href="<?php echo base_url() ?>assets/default/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- ===== Plugin CSS ===== -->   
    <!-- ===== Animation CSS ===== -->
    <link href="<?php echo base_url() ?>assets/default/css/animate.css" rel="stylesheet">
    <!-- ===== Custom CSS ===== -->
    <link href="<?php echo base_url() ?>assets/default/css/style.css" rel="stylesheet">
    <!-- ===== Color CSS ===== -->
    <link href="<?php echo base_url() ?>assets/default/css/colors/default.css" id="theme" rel="stylesheet">
    <!-- ===== Sal CSS ===== -->
   <!--  <link href="<?php echo base_url() ?>assets/css/sal/sal.css" id="theme" rel="stylesheet">
    <link href="<?php echo base_url() ?>assets/css/sal/sweetalert2.min.css" id="theme" rel="stylesheet"> -->
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body class="mini-sidebar">
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <section id="wrapper" class="login-register">
        <div class="login-box" data-sal="slide-right"
            data-sal-duration="300" data-sal-delay="100" data-sal-easing="ease-out-bounce">
<?php echo $this->session->flashdata('msg'); ?>
            <div class="white-box">
                <form class="form-horizontal form-material" id="loginform" method="post" action="<?php echo base_url() ?>Login/data_get">
                <center>
                    <img src="<?php echo base_url() ?>assets/plugins/images/logomentariilmu.png" style="height:45%;width:45%">                    
                </center>
                    <h3 class="box-title m-b-20">Log In</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" name="username" type="text" required="" placeholder="Username">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control" name="password" type="password" required="" placeholder="Password">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>
            <!--         <div class="form-group m-b-0">
                        <div class="col-sm-12 text-center">
                            <p>Belum Punya Akun? <a href="<?php echo base_url() ?>Login/cek_nik" class="text-primary m-l-5"><b>Daftar</b></a></p>
                        </div>
                    </div> -->
                </form>
                <form class="form-horizontal" id="recoverform" action="index.html">
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Recover Password</h3>
                            <p class="text-muted">Enter your Email and instructions will be sent to you! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input class="form-control" type="text" required="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Reset</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- jQuery -->
    <script src="<?php echo base_url() ?>assets/plugins/components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() ?>assets/default/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- Menu Plugin JavaScript -->
    <script src="<?php echo base_url() ?>assets/default/js/sidebarmenu.js"></script>
    <!--slimscroll JavaScript -->
    <script src="<?php echo base_url() ?>assets/default/js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?php echo base_url() ?>assets/default/js/waves.js"></script>
    <!-- Custom Theme JavaScript -->
     <script src="<?php echo base_url() ?>assets/default/js/custom.js"></script>
    <!--Style Switcher -->
    <script src="<?php echo base_url() ?>assets/plugins/components/styleswitcher/jQuery.style.switcher.js"></script>



</body>

</html>
