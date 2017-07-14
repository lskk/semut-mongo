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
	<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.7.3/leaflet.css" />
	<link rel="stylesheet" href="leaflet-routing-machine.css" />
	<script src='jquery-2.0.0.min.js'></script>
	<script src='tagjs.js'></script>
    <script src='leaflet-src.js'></script>
d<script src='leaflet-routing-machine.js'></script>
<script src='script.js'></script>
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
            <a href="index.php" class="logo"><b>BSTS - MAPS</b></a>
            <!--logo end-->
          
            <div class="top-menu">
              <ul class="nav pull-right top-menu">
                    <li>
                        <?php 

                              if(isset($_SESSION['userid'])){
                            //  include "dbtweet/koneksi.php";
                                $sessiontojs = $_SESSION['userid'];
                                $leveltojs = $_SESSION['level'];

                             ?>                     
                              <a class="logout" href="http://localhost/bsts_murni_gab/logout_data.php">Logout</a>
                           <?php } else{
                            $sessiontojs = false;
                            $leveltojs = false;
                             ?>
                             <a class="logout" href="#" data-toggle="modal" data-target="#login">Member Login</a>
                             
                             <?

                            }
                           ?>
                           


                    </li>
              </ul>
            </div>
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
              
                  <p class="centered"><a href="profile.html"><img src="img/logo_large.png" class="img" width="60"></a></p>

                   <?php 

                              if(isset($_SESSION['userid'])){
                                echo "<h5 class='centered'>".$sessiontojs."</h5>";
                              }
                              else {


                              }
        

                    ?>
                    
                  <li class="mt">
                      <a class="active" href="index.php">
                          <i class="fa fa-dashboard"></i>
                          <span>Home</span>
                      </a>
                  </li>

                  <li class="sub-menu">
                      <a href="#" data-toggle="modal" data-target="#myModal">
                           <i class="glyphicon glyphicon-stats"></i>
                          <span>Prediksi</span>
                      </a>
                     <!--  <ul class="sub">
                          <li><a  href="general.html">General</a></li>
                          <li><a  href="buttons.html">Buttons</a></li>
                          <li><a  href="panels.html">Panels</a></li>
                      </ul> -->
                  </li>

                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="glyphicon glyphicon-road"></i> 
                          <span>Routing</span>
                      </a>
                      <ul class="sub">
                          <!--<li><a  href="calendar.html">ON</a></li>
                          <li><a  href="gallery.html">OFF</a></li>
						    --> <li><a id="buttonOn" onclick="routeOn()">Turn ON</a></li>
                          <li><a href="index.php" id="buttonOff" onclick="routeOff()">Turn OFF</a></li>

							<!--<button id="buttonOn" onclick="routeOn()">Turn On Route</button>
							<button id="buttonOff" onclick="routeOff()">Turn Off Route</button>
                      --></ul>
                  </li>
                  <li class="sub-menu">
                      <a href="#" data-toggle="modal" data-target="#ruteangkot" >
                          <i class="glyphicon glyphicon-sort"></i>
                          <span>Angkot</span>
                      </a>
                      <!-- <ul class="sub">
                          <li><a  href="blank.html">Blank Page</a></li>
                          <li><a  href="login.html">Login</a></li>
                          <li><a  href="lock_screen.html">Lock Screen</a></li>
                      </ul> -->
                  </li>
                  <li class="sub-menu">
                      <a href="http://bf-s.cloudapp.net:12145/">
                          <i class="glyphicon glyphicon-comment"></i>
                          <span>Chat</span>
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

              <div class="row">
                  <div class="col-lg-9 main-chart">
                  
                  <?php
                        include "home.php";
                   ?>
          
                  </div><!-- /col-lg-9 END SECTION MIDDLE -->

                  
                  
      <!-- **********************************************************************************************************************************************************
      RIGHT SIDEBAR CONTENT
      *********************************************************************************************************************************************************** -->                  
                  
                  <div class="col-lg-3 ds">
                    
                     <h3>Map Item</h3>
                                        
                         <div class="desc">
                        <div class="thumb">
                          <span class="badge bg-theme"><i class="glyphicon glyphicon-map-marker"></i></span>
                        </div>
                        <div class="details">
                          <input type="checkbox" class='member'>Semut Member</input>
                        </div>
                      </div>

                      <div class="desc">
                        <div class="thumb">
                          <span class="badge bg-theme"><i class="glyphicon glyphicon-map-marker"></i></span>
                        </div>
                        <div class="details">
                          <input type="checkbox" class='showimg'>CCTV</input>
                        </div>
                      </div>

                       <div class="desc">
                        <div class="thumb">
                          <span class="badge bg-theme"><i class="glyphicon glyphicon-map-marker"></i></span>
                        </div>
                        <div class="details">
                          <input type="checkbox" class='angkot'>Angkot</input>
                        </div>
                      </div>

                       <div class="desc">
                        <div class="thumb">
                          <span class="badge bg-theme"><i class="glyphicon glyphicon-map-marker"></i></span>
                        </div>
                        <div class="details">
                          <input type="checkbox" class='train'>Commuter Train</input>
                        </div>
                      </div>
                     
                    
            <h3>Place Item</h3>
                      
                    <div class="desc">
                        <div class="thumb">
                          <span class="badge bg-theme"><i class="glyphicon glyphicon-map-marker"></i></span>
                        </div>
                        <div class="details">
                          <input type="checkbox" class='food'>Food</input>
                        </div>
                      </div>

                     <div class="desc">
                        <div class="thumb">
                          <span class="badge bg-theme"><i class="glyphicon glyphicon-map-marker"></i></span>
                        </div>
                        <div class="details">
                         <input type="checkbox" class='fuel'>Fuel</input>
                        </div>
                      </div>

                     <div class="desc">
                        <div class="thumb">
                          <span class="badge bg-theme"><i class="glyphicon glyphicon-map-marker"></i></span>
                        </div>
                        <div class="details">
                          <input type="checkbox" class='colla'>Collage</input>
                        </div>
                      </div>

                     <div class="desc">
                        <div class="thumb">
                          <span class="badge bg-theme"><i class="glyphicon glyphicon-map-marker"></i></span>
                        </div>
                        <div class="details">
                          <input type="checkbox" class='bank'>Bank</input>
                        </div>
                      </div>

                     <div class="desc">
                        <div class="thumb">
                          <span class="badge bg-theme"><i class="glyphicon glyphicon-map-marker"></i></span>
                        </div>
                        <div class="det