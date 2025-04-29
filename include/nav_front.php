<?php 
    session_start(); 
    $IsConn = false;
    if(isset($_SESSION['user'])){
        $IsConn = true ;
    }
?>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">RESERVATION</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <?php 
        if($IsConn){ 
            ?>
            <li class="nav-item">
            <a class="nav-link" href="index.php">Services</a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" href="../deconnexion.php">Deconnexion</a>
            </li>
            <?php
        }else{
            ?>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="index.php">Ajouter utilisateur</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="connexion.php">Connexion</a>
            </li>
            <?php
        }
        ?>
      </ul>
    </div>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
            
        
        
      </ul>
    </div>
  </div>
</nav>