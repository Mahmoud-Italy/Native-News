<?php
include "config.php";



?>
<!DOCTYPE HTML>
<html lang="en">
<head>
	<title>Newsbit</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="UTF-8">
	
	<!-- Font -->
	<link href="https://fonts.googleapis.com/css?family=Encode+Sans+Expanded:400,600,700" rel="stylesheet">
	
	<!-- Stylesheets -->
	<link href="assets/plugin-frameworks/bootstrap.css" rel="stylesheet">
	<link href="assets/fonts/ionicons.css" rel="stylesheet">
	<link href="assets/common/styles.css" rel="stylesheet">
</head>
<body>
	
	<header>
		<div class="bg-191">
			<div class="container">	
				<div class="oflow-hidden color-ash font-9 text-sm-center ptb-sm-5">
				
					<ul class="float-left float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-10">

                    <?php
                      if(isset($_SESSION['user_id'])){
                     ?>
                       <li><img src="<?php echo $_SESSION['avatar']; ?>" style="width:30px;height:30px;border-radius:50%"></li>
                       <li><a class="pl-0 pl-sm-10" href="profile.php">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_SESSION['name'] ?></a></li>
					   <li><a href="logout.php">Logout</a></li>
                     <?php 
                     } else {
                     ?>
						<li><a class="pl-0 pl-sm-10" href="login.php">Login</a></li>
						<li><a href="signup.php">Signup</a></li>
                    <?php } ?>

					</ul>
					<ul class="float-right float-sm-none list-a-plr-10 list-a-plr-sm-5 list-a-ptb-15 list-a-ptb-sm-5">
						<li><a class="pl-0 pl-sm-10" href="#"><i class="ion-social-facebook"></i></a></li>
						<li><a href="#"><i class="ion-social-twitter"></i></a></li>
						<li><a href="#"><i class="ion-social-google"></i></a></li>
						<li><a href="#"><i class="ion-social-instagram"></i></a></li>
						<li><a href="#"><i class="ion-social-bitcoin"></i></a></li>
					</ul>
					
				</div><!-- top-menu -->
			</div><!-- container -->
		</div><!-- bg-191 -->
		


		<div class="container">
			<a class="logo" href="index.php">
				<img src="assets/images/logo-black.png" alt="Logo"></a>
			
			<a class="right-area src-btn" href="#" >
				<i class="active src-icn ion-search"></i>
				<i class="close-icn ion-close"></i>
			</a>
			<div class="src-form">
				<form action="search.php">
					<input type="text" name="q" placeholder="Search here">
					<button type="submit"><i class="ion-search"></i></a></button>
				</form>
			</div><!-- src-form -->
			
			<a class="menu-nav-icon" data-menu="#main-menu" href="#"><i class="ion-navicon"></i></a>
			
			<ul class="main-menu" id="main-menu">
				<li><a href="index.php">Home</a></li>
				<li class="drop-down"><a href="javascript:void(0);">Categories<i class="ion-arrow-down-b"></i></a>
					<ul class="drop-down-menu drop-down-inner">
                     
                     <?php 
                        $cat = $conn->prepare("SELECT * FROM `categories`  WHERE deleted = 0");
                        $cat->execute();
                        while ($row = $cat->fetch()) {
                        	echo '<li><a href="category.php?id='.$row['id'].'">'.$row['name'].'</a></li>';
                        }
                     ?>
					
					</ul>
				</li>
				<li><a href="faq.php">FAQs</a></li>
				<li><a href="about.php">About</a></li>
				<li><a href="contact_us.php">Contact us</a></li>
			</ul>
			<div class="clearfix"></div>
		</div><!-- container -->
	</header>
