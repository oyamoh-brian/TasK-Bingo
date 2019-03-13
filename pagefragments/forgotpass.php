<form action="index.php" method="post">
					<h3>We will Help you recover your acccount</h3>
					<h4>Just try if you can remember your username and phone number</h4>
					<div class="form-group">
 							<label for="username" class='text-info'>Enter your username:</label><br>
 							<input type="text" class="text-success bg-faded"  name="username" id="username" required>

 						</div>
 						<div class="form-group">
 							<label for="phone" class='text-info'>The Phone you registered with:</label><br>
 							<input type="telephone" class="text-success bg-faded" name="phone" id="phone" required>
 						</div>
 						<input type="submit" name='recover' class="btn  bg-faded btn-outline-info btn-lg" value="Next">
 						<?php 
 								$err_recover = (isset($recover_error)) ? $recover_error : "We will inform you here" ;
 								echo $err_recover;
 							 ?>
 						<br>
 						<p><a class='text-success'href="index.php?action=register">I don't have an account. Sign up</a></p>
 					</form>