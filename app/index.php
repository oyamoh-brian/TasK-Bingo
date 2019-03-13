
<!DOCTYPE html>
<html>
<head>
	<title>TaskBingo</title>
	<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="../css/custom.css">
	<link rel="stylesheet" type="text/css" href="../fontawsome/css/all.css">
	<style type="text/css">
		.x-menu{
			border-right: rgba(0,0,0,.5) solid 2px;
			border-top: rgba(0,0,0,.5) solid 2px;
			border-top-right-radius: 5px;
			height:100%;
			
		}
		
		.x-menu ul{
			list-style: none;
		}
		.x-menu li{
			padding: 5px 0px 5px 5px;
			margin-right: 10px;
			border-bottom: rgba(0,0,0,.2) 2px solid;
			width: 70%;
		}
		.paper{
			width:90%;
			margin-left:5%;
			box-shadow: 2px 4px 8px 3px  rgba(0,0,0,.03), 4px 6px 10px 6px rgba(0,0,0,.02),0px 8px rgba(0,0,7,.06);
			height:auto;
		}
		@keyframes branimation {
		  0%   {opacity:0.25;transform: scale(.25,.25);margin:1px;}
		  25%  {opacity:0.5;transform: scale(.5,.5);}
		  50%  {opacity:0.75;transform: scale(.75,.75);}
		  100% {opacity:1;transform: scale(1,1);margin:5px;}
		}
		#taskbox{
			margin:5px;
			animation: branimation .8s;
			border-radius: 10px;
			border: 1.5px rgba(0,0,0,.2) solid;
			max-height: 200px;
			height:150px;
			float:left;

		}
		#taskbox:hover{
			box-shadow: 2px 4px 8px 3px  rgba(0,0,0,.1), 4px 6px 10px 6px rgba(0,0,0,.08);
			opacity:.8;
			 filter: grayscale(20%);
			
			 transform: rotate(3deg) scale(1.1,1.1);
			  transition: .7s;
			  cursor:grab;


		}
		
		#descr{
			font-size: 10px;
			height: 50px;
			overflow-y: hidden;
			background:linear-gradient(to right rgba(0,0,0,.22), rgba(0,0,0,.19));
		}
		#descr:hover{
			overflow-y: all;
		}
		#duration,#top{
			font-size: 12px;

		}
		#top{
			width:99%;
			margin: 1px;
			border-top-right-radius: 5px;
			border-top-left-radius: 5px;
		}
		#duration{
			width:99%;
			margin: 1px;
			border-bottom-right-radius: 5px;
			border-bottom-left-radius: 5px;
		}
		#top input{
			margin: 5px;
			cursor: pointer;
		}
		#top input:hover{
			border:2px green solid;
			transition:.5s;
		}
		#title{
			font-size: 17px;
			font-weight: bolder;
		}

		li img{
			width: 20px;
			height:20px;
			margin-left: 20px;
		}
		#jobless:first-letter{
			color:green;
			font-weight: bolder;
		}
		#top,#duration{
			padding-left:5px;
		}

		footer{
			padding:10px;
			box-shadow: 0px 0px 0px 2px rgba(0,0,0,.19), 0px 0px 0px 4px rgba(0,0,0,.2);
		}
		footer p:first-letter{
			font-weight: bolder;
			color:green;
			font-size: 20px;
		}
		#edit-buttons{
			margin-left: 5px;
		}
		#edit-buttons a{
			cursor: pointer;
			margin:3px 5px 3px 5px;
		}
	</style>
</head>
<body>


<?php
	session_start();
	$_SESSION['last-action']=0;
	 if(!isset($_SESSION['username'])){
	 	header("location: http://$_SERVER[SERVER_NAME]?action=login");

	} 
	$navs=2;
	 include($_SERVER['DOCUMENT_ROOT']."/pagefragments/pageheader.php");
	 include($_SERVER['DOCUMENT_ROOT']."/includes/connection.php");


	  if(isset($_POST['reset'])){
		 	extract($_POST);
		 	if(!($username==$_SESSION['username'])){
		 		$p_reset_error="<br><p class='text-danger'>Username Error</P>";	
		 	}
		 	if($password1!=$password2){
		 			$p_reset_error="<br><p class='text-danger'>Passwords do not match</p>";
		 	}
		   if(strlen($password1)<6 && strlen($password2)<6){
		 			$p_reset_error="<br><p class='text-danger'>Passwords should be more than six chars</p>";
		 	}
		 	$_SESSION['last-action']=1;
		 	if(!isset($p_reset_error)){
		 		$encpass=sha1($password2);
		 		//UPDATE `6470users` SET `ID`=[value-1],`USERNAME`=[value-2],`PASSWORD_HASH`=[value-3],`PHONE`=[value-4] WHERE 1
		 		$sql="UPDATE `6470users` SET `PASSWORD_HASH`='$encpass' WHERE `USERNAME`='$_SESSION[username]'";
		 		$run=mysqli_query($conn,$sql);
		 		if(!$run){
		 			die("Errror".mysqli_error($conn));
		 		}
		 		else{
		 			$p_reset_error="<br><p class='text-success'>Password Reset Successfully</p>";
		 		}
		 	}
	}
	if(isset($_POST['add-task'])){
		extract($_POST);
		if(strlen($title)>50){
			$t_save_err="<p class='text-danger'>Title should be less than 51 characters</a></p>";
		}
		$Date_start=strtotime("$from $date");
		$Date_end=strtotime("$to $date");
		if(($Date_start-$Date_end)>=0){
			$t_save_err="<p class='text-danger'>Error Check your timespan</a></p>";
		}
		if(!isset($t_save_err)){
			$sql="INSERT INTO tasks(title,comment,start,end,USERNAME,completed) VALUES('$title','$comment','$Date_start','$Date_end','$_SESSION[username]','No')";
			$run=mysqli_query($conn,$sql);
			if($run){
				$t_save_err="<p class='text-success'>Task added Successfully<a href='index.php?r=n_task'>Add another task</a></p>";

			}
		}

		$_SESSION['last-action']=2;
	}

	if(isset($_POST['edit-task'])){
		extract($_POST);
		$Date_start=strtotime("$from $date");
		$Date_end=strtotime("$to $date");
		if(($Date_start-$Date_end)>=0){
			$t_save_err="<p class='text-danger'>Error Check your timespan</a></p>";
		}
		if(!isset($t_save_err)){
			$sql="UPDATE `tasks`
			 SET `title`='$title',
			 `comment`='$comment',
			 `start`='$Date_start',
			 `end`=$Date_end 
			 WHERE `id`=$id AND `USERNAME`='$_SESSION[username]'";
			$run=mysqli_query($conn,$sql);
			if($run){
				$t_save_err="<p class='text-success'>Task Editted Successfully<a href='index.php?r=n_task'>Add another ask</a></p>";

			}
		}

		$_SESSION['last-action']=3;
		$toedit=$id;
	}


	///view tasks

	$sql="SELECT * FROM tasks WHERE `USERNAME`='$_SESSION[username]'";
	$run=mysqli_query($conn,$sql);
	$yourtasks="";
	$yourtasks_e="";
	if(mysqli_num_rows($run)!=0){
	$editable=0;
	while($rows=mysqli_fetch_assoc($run)){
		if($rows['completed']=="Yes"){
			$bg="bg-success";
			$checked="checked";
			$disabled="disabled";
		}
		else{
			$bg="bg-primary";
			$checked="";
			$disabled="";
		}
		$date=date("d-m-y",$rows['start']);
		$start=date('h:ia',$rows['start']);
		$end=date('h:ia',$rows['end']);
		$yourtasks=$yourtasks."<div id='taskbox' style='width:250px;margin:10px;border-top-right-radius:5px;' title='$rows[comment]'>
				<div id='top' class='$bg' style='display:flex;'>
					<span id='date' class='text-light text-right'>Date $date</span>
					<span id='completed' style='width:50%;' class='text-right text-light'>Done<input type='checkbox' name='completed' onclick='done($rows[id])' $checked $disabled></a></span>
				</div>
				<div id='title' class='bg-light' style=\"border-bottom:rgba(0,0,0,.5) solid 1px;\">
					<p>$rows[title]</p>
					
				</div>
				<div id='descr' class='bg-light'>
					<p>
						$rows[comment]
					</p>
				</div>
				<div id='duration' class=\"bg-primary\" style='display:flex;'>
					<span class='text-light text-left'>From $start</span>
					<span style='width:50%;' class='text-light text-right'>To $end</span>
				</div>
					
			</div>";
		if($rows["completed"]=="No"){
			$yourtasks_e=$yourtasks_e."<div id='taskbox' style='float:left;width:300px;margin:10px;border-top-right-radius:5px;border-right:white 1px solid;'  title='$rows[comment]'>
				<div id='top' class='$bg' style='display:flex;'>
					<span id='date' class='text-light text-right'>Date $date</span>
					<span id='completed' style='width:50%;' class='text-right text-light'>Done<input type='checkbox' name='completed' onclick='done($rows[id])' $checked $disabled></a></span>
				</div>
				<div id='title' class='bg-light' style=\"border-bottom:rgba(0,0,0,.5) solid 1px;\">
					<h5>$rows[title]</h5>
					
				</div>
				<div id='descr' class='bg-light'>
					<p>
						$rows[comment]
					</p>
				</div>
				<div id='duration' class=\"bg-primary\" style='display:flex;'>
					<span class='text-light text-left'>From $start</span>
					<span class='text-light text-right'>To $end</span>
					<span class='text-right' id='edit-buttons'>
						<a href='index.php?r=del&tid=$rows[id]' class='btn btn-sm btn-danger'>Del</a>
						<a  href='index.php?r=edit&tid=$rows[id]' id='edit'  class='btn btn-sm btn-warning'>Edit</a>
					</span>
				</div>
					
			</div>";
		}
		}
		
		
	}
	if(isset($_GET["q"])){
	$_SESSION['last-action']=4;
	$start=microtime(true);
	extract($_GET);
	$searchstr=$q;
	$sql="SELECT * FROM tasks WHERE `USERNAME`='$_SESSION[username]' AND `title` like '%$q%' OR `comment` like '%$q%'";
	$run=mysqli_query($conn,$sql);
	$end=microtime(true);
	$dur=floatval(($end-$start));

	$yourtasks_e="";
	if (mysqli_num_rows($run)>0){
	while($rows=mysqli_fetch_assoc($run)){
		if($rows['completed']=="Yes"){
			$bg="bg-success";
			$checked="checked";
			$disabled="disabled";
		}
		else{
			$bg="bg-primary";
			$checked="";
			$disabled="";
		}
		$date=date("d-m-y",$rows['start']);
		$start=date('h:ia',$rows['start']);
		$end=date('h:ia',$rows['end']);
		$yourtasks_e=$yourtasks_e."<div id='taskbox' style='width:250px;margin:10px;border-top-right-radius:5px;'  title='$rows[comment]'>
				<div id='top' class='$bg' style='display:flex;'>
					<span id='date' class='text-light text-right'>Date $date</span>
					<span id='completed' style='width:50%;' class='text-right text-light'>Done<input type='checkbox' name='completed' onclick='done($rows[id])' $checked $disabled></a></span>
				</div>
				<div id='title' class='bg-light' style=\"border-bottom:rgba(0,0,0,.5) solid 1px;\">
					<h5>$rows[title]</h5>
					
				</div>
				<div id='descr' class='bg-light'>
					<p>
						$rows[comment]
					</p>
				</div>
				<div id='duration' class=\"bg-primary\" style='display:flex;'>
					<span class='text-light text-left'>From $start</span>
					<span style='width:50%;' class='text-light text-right'>To $end</span>
				</div>
			</div>";
	
		}

			}

}


?>
<div class='row x-container'>
	<div class='col-lg-3 col-md-3 x-menu'>
		<form method="get" action="index.php" id='search-container'>
		  <input id="search" type="search" required class='text-info justify-content-end' name="q" placeholder="Search tasks"><i class='fa fa-search link'></i>
		</form>
		<br><br><br>
       <ul style="list-style: none">
       		<li>
       			<a href="index.php">Home</a>
       		</li>
       		<li>
       			<a href="index.php?r=n_task">Add New</a>
       		</li>
       		<li>
       			<a href="index.php">View tasks</a>
       		</li>
       		<li>
       			<a href="index.php?r=t_edit">Edit Tasks</a>
       		</li>
       		<li>
       			<a href="index.php?r=help">Help</a>
       		</li>


       </ul>
	</div>
	<div class='col-lg-9 col-md-8'>
		<script type="text/javascript">
			function done(id){
			document.location.href="index.php?r=done&tid="+id;
		}
		function del(id){
			document.location.href="index.php?r=del&tid="+id;
		}
		function edit(id){
			document.location.href="index.php?r=edit&tid="+id;
		}
		</script>
		<div class='paper'>
			<?php 
			if(!isset($_SESSION['last-action'])){
				$_SESSION['last-action']=0;
			}
			if(isset($_REQUEST['r']) && $_SERVER["REQUEST_METHOD"] == "GET"){
				
						 if($_REQUEST["r"]=="reset"){
							 	if($_REQUEST['Authkey']==$_SESSION['secret_est_hash']){
								include "pagefragments/reset.php";
								$resetopen=true;
							}
						}
						if($_REQUEST['r']=="l_out"){
							session_destroy();
							header("location:index.php");
						}
						if($_REQUEST['r']=="del_c"){
							$sql="DELETE FROM tasks WHERE `USERNAME`='$_SESSION[username]' AND `completed`='Yes'";
							$run=mysqli_query($conn,$sql);
							if($run){
								$del="<p class='text-success'>Tasks Deleted sucessfully</p>";
								include "pagefragments/edit.php";

							}
						}
						if($_REQUEST['r']=="help"){
							include "pagefragments/help.php";
						}
						if($_REQUEST["r"]=="n_task"){
							include "pagefragments/addtask.php";
						}
						if($_REQUEST["r"]=="t_edit"){
							include "pagefragments/edit.php";
						}
						if($_REQUEST["r"]=="done"){
							if(isset($_REQUEST['tid'])){
								if(!empty($_REQUEST['tid'])){
									$sql="UPDATE tasks SET `completed`='Yes' WHERE `USERNAME`='$_SESSION[username]' AND `id`='$_REQUEST[tid]'";
									$run=mysqli_query($conn,$sql);
									if($run){
										include "pagefragments/tasks.php";
									}
									else{
										echo "<script>alert(\"Operation failed try later\")</script>";
										include "pagefragments/tasks.php";
									}
								}
							}
					
						}

			
						if($_REQUEST["r"]=="del"){
							if(isset($_REQUEST['tid'])){
								if(!empty($_REQUEST['tid'])){
									$sql="DELETE FROM tasks WHERE `USERNAME`='$_SESSION[username]' AND `id`='$_REQUEST[tid]'";
									$run=mysqli_query($conn,$sql);
									if($run){
										echo "<script>alert(\"Operation Success!\")</script>";
										include "pagefragments/edit.php";
									}
									else{
										echo "<script>alert(\"Operation failed try later\")</script>";
										die("".mysqli_error($conn));
										include "pagefragments/edit.php";
									}
								}
							}
							
					
						}
						if($_REQUEST["r"]=="edit"){
							if(isset($_REQUEST['tid'])){
								if(!empty($_REQUEST['tid'])){
									
									$toedit=$_REQUEST['tid'];
									include "pagefragments/editform.php";
								}
							}
							
					
						}
						
						
			}
				
			elseif(isset($_SESSION['last-action']))
			{
			
					{
						switch($_SESSION['last-action']){
							case 0:if(!isset($tasksopen)){ include "pagefragments/tasks.php";}
							break;
							case 1:if(!isset($resetopen)){ include "pagefragments/reset.php";}
							break;
							case 2:if(!isset($resetopen)){ include "pagefragments/addtask.php";}
							break;
							case 3:if(!isset($resetopen)){ include "pagefragments/editform.php";}
							break;
							case 4:if(!isset($resetopen)){ include "pagefragments/searchresults.php";}
							break;
							default:
							include "pagefragments/tasks.php";
						}
					}
			

				}
			 ?>
		</div>
	</div>
</div>
<footer class="bg-light fixed-bottom text-center">
	<p class="text-secondary"> TasKBingo is powered with L0V3 by Brayoh</p>
</footer>
<script type="text/javascript" src="../bootstrap/js/jquery.js"></script>
<script type="text/javascript" src="../bootstrap/js/bootstrap.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		
		$(".bg-image").css('height', screen.height*.5);
	    $(".x-menu").height(screen.height);
	    $(".done").click(function() {
	    	document.location.href="index.php?r=completed&task="+$(".x-done").val();
	    });

		// $(".x-menu").css("height",screen.height);
	});
</script>
</body>
</html>