<?php
if (empty($_GET)){
    $menu01active = 'active';
}
if (isset($_GET['banners'])){
    $menu02active = 'active';
}

?>

<div class="navbar navbar-inverse navbar-fixed-top">
 <div class="navbar-inner">
   <div class="container">
     <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
       <span class="icon-bar"></span>
     </button>
     <a class="brand" href="index.php">Deník, bannery <small>administrace</small></a>
     <div class="nav-collapse collapse">
       <ul class="nav pull-left">
         <li style="display:none;"><a href="index.php" class="<?php echo $menu01active; ?>">Home</a></li>
         
       </ul>
     </div><!--/.nav-collapse -->
     <?php
        if (isset($_GET['logout'])){ 
            session_destroy();
        }else{
            if (isset($_SESSION['denikUserId'])){
                echo '<p class="logged">Přihlášen: <b>'.$_SESSION['denikUser'].'</b> | <a href="?logout">Odhlásit</a></p>';
            }  
        }
      
     ?>
   </div>
 </div>
</div>