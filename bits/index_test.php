<?php 
  session_start();
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>BSTS WEB</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>

<script src='jquery-2.0.0.min.js'></script>
<script src='tagjs.js'></script>
    
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <!--<a href="index.html" class="logo"><b>BSTS WEB</b></a>
            <!--logo end-->
            <!--<div class="nav notify-row" id="top_menu">
            </div>
            <div class="top-menu">
            </div>-->
        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              <?php /*

                if(isset($_SESSION['userid'])){
              //  include "dbtweet/koneksi.php";
                  $sessiontojs = $_SESSION['userid'];
               ?>                     
                 <h5 class="centered"><a href="http://localhost/bsts_murni_gab/logout_data.php"><button type="button" class="btn btn-primary btn-lg">Logout</button></a></h5>
             <?php } else{
              $sessiontojs = false;
              
               ?>
               <h5 class="centered"><a href="http://localhost/bsts_murni_gab/logindata.php"><button type="button" class="btn btn-primary btn-lg">Member Login</button></a></h5>
               
               <?

              }*/
             ?>

                  <li class="sub-menu">
                  <a href="javascript:;" >
                  <i class="fa fa-desktop"></i>
                          <span><input type="checkbox" class='food'>Food</input></span>
                      </a>
                  </li>
                    <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                       <span><input type="checkbox" class='fuel'>Fuel</input></span>
                      </a>
                  </li>  
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span><input type="checkbox" class='colla'>Collage</input></span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span><input type="checkbox" class='bank'>Bank</input></span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span><input type="checkbox" class='hospital'>Hospital</input></span>
                      </a>
                  </li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span><input type="checkbox" class='bus'>Bus Station</input></span>
                      </a>
                  </li>
                   <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-desktop"></i>
                          <span> <input type="checkbox" class='showimg'>CCTV IMG</input></span>
                      </a>
                  </li>
                  

                 
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
          <div id="counter"></div>
              <?php
                include "home.php";
              ?>
              
          </section>
             <?php
                include "inputprediksi.php";
              ?>

              <?php
                include "ruteangkot.php";
               ?>
              

         
      </section>
      <!--main content end-->
      <!--footer start-->
    
      <!--footer end-->
  </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/jquery-1.8.3.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="assets/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="assets/js/jquery.scroin.js"></script>
    <script src="assets/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="assets/js/jquery.sparkline.js"></script>


    <!--common script for all pages-->
    <script src="assets/js/common-scripts.js"></script>
    
    <script type="text/javascript" src="assets/js/gritter/js/jquery.gritter.js"></script>
    <script type="text/javascript" src="assets/js/gritter-conf.js"></script>

    <!--script for this page-->
 



  </body>
   <script>
  //   var increment = 300;
  //   setInterval(function(){
  //    increment--;
  //    var el = document.getElementById('counter');
  //    el.innerHTML = "hihihih in " + increment + " seconds...";
  //   }, 1000);
  </script>
</html>
