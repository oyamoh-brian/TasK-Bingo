
  <div id="nav" class="sticky-top">
  <nav class="navbar navbar-expand-md bg-light navbar-light sticky-top">
  <a class="navbar-brand" href="index.php">TasKBingo</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse justify-content-center" id="collapsibleNavbar">
    <ul class="navbar-nav">
      <?php 

        $navitems = ($navs==1) ?  "
      <li class=\"nav-item\">
        <a class=\"nav-link\" href=\"http://$_SERVER[SERVER_NAME]/index.php?action=login\">Log in</a>
      </li>
      <li class=\"nav-item\">
        <a class=\"nav-link
        \" href=\"http://$_SERVER[SERVER_NAME]/index.php?action=register\">Sign up</a>
      </li> ":  "
      <li class=\"nav-item\">
        <a class=\"nav-link\" href=\"http://$_SERVER[SERVER_NAME]/app/?r=n_task\">Add Task</a>
      </li>
      <li class=\"nav-item\">
        <a class=\"nav-link
        \" href=\"http://$_SERVER[SERVER_NAME]/app/?r=l_out\">Log out $_SESSION[username]<img class='img-fluid' src='../images/user-avatar-80x80-bdcd44a3bfb9a5fd01eb8b86f9e033fa1a9897c3a15b33adfc2649a002dab1b6.png'></a>
      </li> ";
      echo $navitems;
      
      ?>
    </ul>
  </div>  
</nav>
</div>

