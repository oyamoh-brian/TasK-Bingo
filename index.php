<!DOCTYPE html>
<html>
<head>
	<title>TaskBingo</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
</head>
<body>
<?php
	session_start();
	$navs=1;
	 include "pagefragments/pageheader.php";

	 
	 include "includes/connection.php";
	 
	 $_SESSION['last_action']=0;
	 if(isset($_POST['register'])){
	 	extract($_POST);
	 	if($password1!=$password2){
	 		$pass_error="Passwords do not match";
	 	}
	   if(strlen($password1)<6 && strlen($password2)<6){
	 		$pass_error="Passwords should be more than six chars";
	 	}

	 	if(strlen($phone)<9){
	 		$phone_error="Phone number invalid. i.e should be ten digits";
	 	}
	 	if(strlen($phone)>10){
	 		$phone_error="Phone number invalid. i.e should be ten digits";
	 	}
	 	if(preg_match("~[^0-9]+~",$phone)){
	 		$phone_error="Invalid number";

	 	}
	 	$sql="SELECT * FROM 6470users WHERE `PHONE`='$phone'";
	 	$run=mysqli_query($conn,$sql);
	 	if(!$run){
	 		echo "run".mysqli_error($conn);
	 	}
	 	if(mysqli_num_rows($run)!=0){
	 		$phone_error="Phone Number already registered";
	 	}


	 	if(strlen($username)<2){
	 		$username_error="illegal length of username";
	 	}
	 	if(preg_match("/~[^a-zA-Z]+~/", $username)){
	 		$username_error="Illegal characters not accepted";
	 	}
	 	$sql="SELECT * FROM 6470users WHERE `USERNAME`='$username'";
	 	$run=mysqli_query($conn,$sql);
	 	if(!$run){
	 		echo "run".mysqli_error($conn);
	 	}
	 	if(mysqli_num_rows($run)!=0){
	 		$username_error="Username Exists";
	 	}

	 	if(!(isset($username_error) || isset($phone_error) || isset($pass_error))){
	 		$encpass=sha1($password2);
	 		$sql="INSERT INTO 6470users(USERNAME,PASSWORD_HASH,PHONE) VALUES('$username','$encpass','$phone')";
	 		$run=mysqli_query($conn,$sql);
	 		if($run){
	 		$_SESSION['username']=$username;
	 		header('location:app/');
	 	}
	 	else{
	 		echo "Application Error".mysqli_error($conn);
	 	}


	 	}
	 	$_SESSION['last-action']=1;
	 	

	}

 ?>
 <?php 
	if(isset($_POST['login'])){
		extract($_POST);
		$_SESSION['triedlogin']=true;
		if(strlen($username)<1 || strlen($password)<1){
			$login_error="No field should be empty";

		}
		if(!isset($login_error)){
		$sql="SELECT * FROM 6470users WHERE `USERNAME`='$username' AND `PASSWORD_HASH`='".sha1($password)."'";
	 	$run=mysqli_query($conn,$sql);
	 	if(!$run){
	 		echo "run".mysqli_error($conn);
	 	}
	 	if(mysqli_num_rows($run)==0){

	 		$login_error="Login Incorrect. Details provided not correct";
	 	}
	 	else{
	 		$_SESSION['username']=$username;
	 		header("location:app/");
	 	}
	 	$_SESSION['last-action']=2;
		}
	}
	if(isset($_POST['recover'])){
		extract($_POST);
		$_SESSION['triedrecover']=true;
		if(strlen($phone)<1 || strlen($username)<1){
			$recover_error="No field should be empty";

		}
		if(!isset($recover_error)){
		$sql="SELECT * FROM 6470users WHERE `USERNAME`='$username' AND `PHONE`='".$phone."'";
	 	$run=mysqli_query($conn,$sql);
	 	if(!$run){
	 		echo "run".mysqli_error($conn);
	 		die();
	 	}
	 	if(mysqli_num_rows($run)==0){

	 		$recover_error="We did not find any matches. Please remember and re-try later";
	 	}
	 	else{
	 		while($row=mysqli_fetch_assoc($run)){
	 			$password=$row['PASSWORD_HASH'];
	 		}
	 		$_SESSION['username']=$username;
	 		$_SESSION['secret_est_hash']=sha1(sha1(sha1(random_int(1, 1000000))));
	 		$recover_error="<br> Congratulations! You recovered your account. Your password hash is $password<br>Crack it if you can <br>Click <a href=\"app/?r=reset&Authkey=".$_SESSION['secret_est_hash']."\">Here</a>_ To log in<br>";
	 	}
		}
		$_SESSION['last-action']=3;
	}

 ?>

<div class='contantainer-fluid'>
	<div class="row">
		<div class="col-1"></div>
		<div class="col-lg-5 col-md-5 bg-image">
			<div class='move-down'>
				<h5 class='text-info'>
					GET AN ASSISTANT WHO WILL HELP YOU REMEMBER YOUR IMPORTANTS TASKS
				</h5>
				<p class='text-light'>We will help you manage your tasks. You can access them from anywhere in the world whenever you want.</p>
			</div>
		</div>
		<div class='col-lg-4 col-md-4 form'>
			<!-- ROUTER  -->
			<?php 
			if(!isset($_SESSION['last-action'])){
				$_SESSION['last-action']=0;
			}
			if(isset($_REQUEST['action']) && $_SERVER["REQUEST_METHOD"] == "GET"){
				
						 if($_REQUEST["action"]=="login"){

							include "pagefragments/login.php";
							$loginopen=true;
						}
						if($_REQUEST['action']=="register"){
							$registeropen=true;
							include "pagefragments/registration.php";
						}
						
						if($_REQUEST['action']=="fp"){
							include "pagefragments/forgotpass.php";
							$forgotpass=true;
						}

			}
				
			elseif(isset($_SESSION['last-action']))
			{
			
					{
						switch($_SESSION['last-action']){
							case 0:if(!isset($loginopen)){ include "pagefragments/login.php";}
							break;
							case 1: if(!isset($registeropen)){ include "pagefragments/registration.php";}
							break;
							case 2: if(!isset($loginopen)){include "pagefragments/login.php";}
							break;
							case 3: include "pagefragments/forgotpass.php";
							break;
							default:
							include "pagefragments/login.php";
						}
					}
			

				}
				
			 ?>
		</div>
		<div class="col-md-2 col-lg-2"></div>
	</div>
</div>

<script type="text/javascript" src="bootstrap/js/jquery.js"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$(".bg-image").css('height', screen.height*.5);
	});
</script>
</body>
</html>