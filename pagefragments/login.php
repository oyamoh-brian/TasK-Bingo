<form action="index.php" method="post">
					<h3>Sign In to your account</h3>
					<div class="form-group">
 							<label for="username" class='text-info'>Your username:</label><br>
 							<input type="text" class="text-success bg-faded"  name="username" id="username" required>

 						</div>
 						<div class="form-group">
 							<label for="pass" class='text-info'>Password:</label><br>
 							<input type="password" class="text-success bg-faded" name="password" id="pass" required>
 						</div>
 						<input type="submit" name='login' class="btn  bg-faded btn-outline-info btn-lg" value="Sign In">
 						<?php 
 								$err_login = (isset($login_error)) ? $login_error : "" ;
 								echo $err_login;
 							 ?>
 						<br>
 						<p><a href="index.php?action=fp" class='alert-link'>Forgot password?</a><br><a class='text-success'href="index.php?action=register">I don't have an account. Sign up</a></p>
 					</form>