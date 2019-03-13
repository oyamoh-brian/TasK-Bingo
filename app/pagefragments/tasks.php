
		<div class='jumbotron' style="overflow-y: scroll; height:450px;box-shadow:2px 0px rgba(0,0,7,.4)">
			<?php 
				$tasks=(!empty($yourtasks)) ? "<div><h2> Hey there $_SESSION[username]!</h2><p>Here are your jobs to do</p><hr>".$yourtasks."</div>" : "<h2 id='jobless'>Welcome $_SESSION[username], you have not added any job yet</h2><a href='index.php?r=n_task'><hr><h3>Get started by adding a new task</h3>";
				echo $tasks;
				
			 ?>
		</div>
	