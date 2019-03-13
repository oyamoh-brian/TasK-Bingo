<form action="index.php" method="post">
					<h3>Register to get started</h3>
					<div class="form-group">
 							<label for="email" class='text-info'>Pick a Username:</label><br>
 							<input type="text" class="text-success bg-faded"  name="username" id="email" required>
 							<?php
 							$err_username = (isset($username_error)) ? $username_error : "" ;
 								echo $err_username; 
 								?>
 						</div>
 						<div class="form-group">
 							<label for="email" class='text-info'>Phone:</label><br>
 							<input type="telephone" class="text-success bg-faded"  name="phone" id="email" required>
 							<?php  
 								$err_phone = (isset($phone_error)) ? $phone_error : "" ;
 								echo $err_phone;
 							?>
 						</div>
 						<div class="form-group">
 							<label for="pass" class='text-info'>Password:</label><br>
 							<input type="password" class="text-success bg-faded" name="password1" id="pass" required>
 							<?php 
 								$err_pass = (isset($pass_error)) ? $pass_error : "" ;
 								echo $err_pass;
 							 ?>
 						</div>
 						<div class="form-group">
 							<label for="pass" class='text-info'>Confirm password:</label><br>
 							<input type="password" class="text-success bg-faded" name="password2" id="pass" required>
 						</div>
 						<input type="submit" name='register' class="btn  bg-faded btn-outline-info btn-lg" value="Sign Up">
 						<br>
 						<a href="index.php?action=login" class="text-success">I have an account. Login</a>
 					</form>