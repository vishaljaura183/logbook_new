<?php
include_once("inc/config.php");
session_start();

$root	= explode('/',$_SERVER['REQUEST_URI']);
$rootPath	= $root[1];

$documentroot	= $_SERVER['DOCUMENT_ROOT'];
 
define("LIVE_SITE",'http://'.$_SERVER['HTTP_HOST']."/$rootPath");
//echo LIVE_SITE;
define("WEBROOT","$documentroot/$rootPath");

$sess_id = $_SESSION['login_user']; 
//echo 'header-'.$sess_id;die;
if($sess_id == ''){
header("location:login.php?msg=plslogin");
}
// die;
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	
	<!-- start: Meta -->
	<meta charset="utf-8">
	<title>LogBook - Admin</title>
	<meta name="description" content="LogBook - Admin">
	<meta name="author" content="Karan">
	<meta name="keyword" content="LogBook">
	<!-- end: Meta -->
	
	<!-- start: Mobile Specific -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- end: Mobile Specific -->
	
	<!-- start: CSS -->
	<link id="bootstrap-style" href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link id="base-style" href="css/style.css" rel="stylesheet">
	<link id="base-style-responsive" href="css/style-responsive.css" rel="stylesheet">
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,cyrillic-ext,latin-ext' rel='stylesheet' type='text/css'>
	<!-- end: CSS -->
	

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link id="ie-style" href="css/ie.css" rel="stylesheet">
	<![endif]-->
	
	<!--[if IE 9]>
		<link id="ie9style" href="css/ie9.css" rel="stylesheet">
	<![endif]-->
		
	<!-- start: Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico">
	<!-- end: Favicon -->
	
		
		
		
</head>

<body>
		<!-- start: Header -->
	<div class="navbar">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="users.php"><span>LogBook</span></a>
								
				<!-- start: Header Menu -->
				<div class="nav-no-collapse header-nav">
					<ul class="nav pull-right">
						
						<!-- start: User Dropdown -->
						<li class="dropdown">
							<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
								<i class="halflings-icon white user"></i> 
								<?php
									if($_SESSION['name']!=''){
									echo $_SESSION['name'];
									}
									else{
									echo $_SESSION['login_user'];
									}
									?>
								<span class="caret"></span>
							</a>
							<ul class="dropdown-menu">
								<li class="dropdown-menu-title">
 									<span>Account Settings</span>
								</li>
								<li><a href="profile_admin.php"><i class="halflings-icon user"></i> Profile</a></li>
								<li><a href="logout.php"><i class="halflings-icon off"></i> Logout</a></li>
							</ul>
						</li>
						<!-- end: User Dropdown -->
					</ul>
				</div>
				<!-- end: Header Menu -->
				
			</div>
		</div>
	</div>
	<!-- start: Header -->
	
		<div class="container-fluid-full">
		<div class="row-fluid">
				
			<!-- start: Main Menu -->
			<div id="sidebar-left" class="span2">
				<div class="nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
					<!--	<li><a href="users.php"><i class="icon-bar-chart"></i><span class="hidden-tablet"> Dashboard</span></a></li> -->	
					
						<li><a href="users.php"><i class="icon-user"></i><span class="hidden-tablet"> Users</span></a></li>
						<li><a href="logbook_entries.php"><i class="icon-briefcase"></i><span class="hidden-tablet"> LogBook Entries</span></a></li>
						<li><a href="supervisors.php"><i class="icon-user"></i><span class="hidden-tablet"> Supervisors</span></a></li>
						<li><a href="vehicle.php"><i class="icon-align-justify"></i><span class="hidden-tablet"> Vehicles</span></a></li>
						<?php if($_SESSION['usertype'] != '2'){
						?>
						<li><a href="officers.php"><i class="icon-user"></i><span class="hidden-tablet"> Officers</span></a></li>
						<?php } ?>
						
					<!--	<li><a href="login.html"><i class="icon-lock"></i><span class="hidden-tablet"> Login Page</span></a></li> -->
					</ul>
				</div>
			</div>
			<!-- end: Main Menu -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			
<?php

define('DS', DIRECTORY_SEPARATOR);

// echo "here"; die;
// Timezone: Set it to your timezone
date_default_timezone_set("Europe/Zurich"); 

// Do not autostart session
//ini_set("session.auto_start", "Off");

// Session path: Change is according to your liking or just remove it if you are using some other session management
//ini_set("session.save_path", dirname(__DIR__) . DS . "tmp" . DS . "sessions");

// Load the compose autoload
require_once (dirname(__DIR__) . DS . 'logbook/vendor' . 	DS . 'autoload.php');
use Parse\ParseClient;
/*
$app_id ="96zu61vZ2JhRqpk89VjszyuYzU9JzcWjF36ZfwwI";

$rest_key = "aw0kJsmji9TfLZgftiQUC3kGsQ9XQNijkW92NLnu";

$master_key ="mUUEJNFNWzdYWQ7EdUSfyQxIYQPbteIPSlAwZkYv";
*/
$app_id ="F2MtgtT5F5iwLHRT8YU5iaqVSp8w4KQvCqTmpLg2";

$rest_key = "uyrJwvO885akwW7QUlpxlQH6c1yv5Tz4DDeNcvRc";

$master_key ="H92lAcFp7K2zEv35OnrJmu5UdSJxjDzMo8vm722i";

// ParseClient::initialize('z4L1HepwrtxsUeHlRhuI1sXghdYJYTXxvJqtrCcF', '98chs65eaOddM7H5XuHlv5FrX77aW7Dlia3k9OsJ', 'vxVmriTkJGYlPp49NxWSfaG6u0QlfmIEW8c1rew5');
ParseClient::initialize($app_id,$rest_key, $master_key);

// Start the session. Note the session should be started after loading the vendor/autoload.php

// session_start();


 
 //print_r($results); die;
?>
