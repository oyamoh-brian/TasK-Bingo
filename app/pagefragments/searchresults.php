<div class='jumbotron' style="overflow-y: scroll;border-bottom:2px rgba(0,0,0,.4);max-height: 450px;">
			<?php 
				$tasks=(!empty($yourtasks_e)) ? "<h2>SEARCH RESULTS FOR $searchstr</h2><br><p>Query Took $dur Seconds</p><hr><div>".$yourtasks_e."</div>" : "<h1>No results found for <small> $searchstr</small></h1><a href='index.php?r=n_task'><h2>Add new task</h2></a></br><p class='text-info'>Query Took $dur Seconds</p>";

				echo $tasks;
			 ?>
		</div>