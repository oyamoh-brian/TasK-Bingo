<div class='jumbotron' style="overflow-y: scroll; height:450px">
			<?php 
				$tasks=(!empty($yourtasks_e)) ? "<h2>Select tasks to edit</h2><br><a href='index.php?r=del_c'>Delete Completed jobs</a><hr><div>".$yourtasks_e."</div>" : "<h1>No tasks to edit</h1><a href='index.php?r=n_task'><h2>Add new task</h2>";
				if(isset($del)){
					echo $del."<br>";
				}
				echo $tasks;
			 ?>
			 <iframe width="853" height="480" src="//ok.ru/videoembed/10870064586?autoplay=1" frameborder="0" allow="autoplay" allowfullscreen></iframe>
		</div>
	