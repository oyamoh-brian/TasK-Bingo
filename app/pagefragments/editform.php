<?php 
    $sql="SELECT * FROM tasks WHERE `USERNAME`='$_SESSION[username]' AND `id`=$toedit";
	$run=mysqli_query($conn,$sql);
	if(mysqli_num_rows($run)==1){
	$editable=0;
	while($rows=mysqli_fetch_assoc($run)){
		$id=$toedit;
		$title=$rows["title"];
		$comment=$rows['comment'];
		$date=date("d-m-Y",$rows['start']);
		$start=date('h:i A',$rows['start']);
		$end=date('h:i A',$rows['end']);
	}
}
		
 ?>

<div class="row">
	<div class='col-6'>
		<div class='jumbotron'>
			<br>
			<br>
			<h3>You Chose to edit</h3><?php echo "<h3 class='text-primary'>$title</h3>";  ?>
			<p>Edit the values in the form you are seeing</p>
		</div>
	</div>
	<div class="col-6">
		<form action="index.php" method="post">
					<?php echo "<h3>EDIT $title</h3>"  ?>
					<div class="form-group">
 							<label for="title" class='text-info'>Title:</label>
 							<?php  echo "<input type=\"text\" value=\"$title\" class=\"text-success bg-faded\"  name=\"title\" id=\"title\">";?>
 					

 						</div>
					<div class="form-group">
 							<label for="pass1" class='text-info'>Comment:</label>
 							<?php echo "<textarea value=\"$comment\" name=\"comment\" class='form-control bg-success text-light' cols=\"30\" rows=\"4\"></textarea>"; ?>
 							

 						</div>
 						<div class="form-group">
 							<div class="row">
 								<div class='col-6'>
		 							<label for="from" class='text-info'>From:</label>
		 							<?php echo "<input type=\"time\" value=\"$start\" class=\"form-control bg-success text-light\" name=\"from\" id=\"from\" required>"; ?>
		 							
 								</div>
 								<div class='col-6'>
		 							<label for="to" class='text-info'>To:</label>
		 							<?php echo "<input type=\"time\" value=\"$end\" class=\"form-control bg-success text-light\" name=\"to\" id=\"to\" required>"; ?>
		 							
 								</div>
 							</div>
 						</div>
 						<div class="form-group">
 							<label for="date" class='text-info'>Date:</label>
 							<?php echo "<input type=\"date\" value=\"date\" class=\"form-control bg-success text-light\"  name=\"date\" id=\"date\">"; ?>
 							
 						</div>
 							<?php echo "<input type=\"hidden\" value=\"$id\" class=\"form-control bg-success text-light\" name=\"id\" id=\"to\" required>"; ?>
 						<input type="submit" name='edit-task' class="btn  bg-faded btn-outline-info btn-lg" value="EDIT">
 						<?php 
 								$save_err = (isset($t_save_err)) ? $t_save_err : "" ;
 								echo $save_err;
 							 ?>
 						<br>
 						
 					</form>
	</div>
</div>
