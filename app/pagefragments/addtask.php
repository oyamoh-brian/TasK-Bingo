<div class="row">
	<div class='col-6'>
		<div class='jumbotron'>
			<br>
			<br>
			<h3>HELLO, ADD A NEW TASK</h3>
			<p>Add a new task to your account.</p>
		</div>
	</div>
	<div class="col-6">
		<form action="index.php" method="post">
					<h3>Add New task</h3>
					<div class="form-group">
 							<label for="title" class='text-info'>Title:</label>
 							<input type="text" class="text-success bg-faded"  name="title" id="title">

 						</div>
					<div class="form-group">
 							<label for="pass1" class='text-info'>Comment:</label>
 							<textarea name="comment" class='form-control bg-success text-light' cols="30" rows="4"></textarea>

 						</div>
 						<div class="form-group">
 							<div class="row">
 								<div class='col-6'>
		 							<label for="from" class='text-info'>From:</label>
		 							<input type="time" class="form-control bg-success text-light" name="from" id="from" required>
 								</div>
 								<div class='col-6'>
		 							<label for="to" class='text-info'>To:</label>
		 							<input type="time" class="form-control bg-success text-light" name="to" id="to" required>
 								</div>
 							</div>
 						</div>
 						<div class="form-group">
 							<label for="date" class='text-info'>Date:</label>
 							<input type="date" class="form-control bg-success text-light"  name="date" id="date">

 						</div>

 						<input type="submit" name='add-task' class="btn  bg-faded btn-outline-info btn-lg" value="Add Task">
 						<?php 
 								$save_err = (isset($t_save_err)) ? $t_save_err : "" ;
 								echo $save_err;
 							 ?>
 						<br>
 						
 					</form>
	</div>
</div>
