<div class="row">
	<div class='col-6'>
		<div class='jumbotron'>
			<br>
			<br>
			<h3>Hello, we noticed you lost your password. Please reset it before you do anything else.</h3>
			<p>This will make you easily log in next time</p>
		</div>
	</div>
	<div class="col-6">
		<form action="index.php" method="post">
					<h3>Now reset your password.</h3>
					<div class="form-group">
 							<label for="username" class='text-info'>Retype Username:</label><br>
 							<input type="text" class="text-success bg-faded"  name="username" id="username" required>

 						</div>
					<div class="form-group">
 							<label for="pass1" class='text-info'>Enter new Password:</label><br>
 							<input type="password" class="text-success bg-faded"  name="password1" id="pass1" required>

 						</div>
 						<div class="form-group">
 							<label for="pass" class='text-info'>Retype password:</label><br>
 							<input type="password" class="text-success bg-faded" name="password2" id="pass" required>
 						</div>
 						<input type="submit" name='reset' class="btn  bg-faded btn-outline-info btn-lg" value="Reset">
 						<?php 
 								$err_p_reset = (isset($p_reset_error)) ? $p_reset_error : "" ;
 								echo $err_p_reset;
 							 ?>
 						<br>
 						
 					</form>
	</div>
</div>
