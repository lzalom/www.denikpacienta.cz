<div class="row">
	<div class="span6">
		<h1>Login</h1>
	</div>
	<!--<div class="span6 text-right">
		<a href="?cars&action=newItem" class="btn">Přidat pozici</a>
		<a href="?news&action=newCategory" class="btn">Založit kategorii</a>
		<a href="?cars" class="btn">Zpět na přehled</a>
	</div>-->
</div>

<hr />
<div class="row">
<?php
    if (!isset($_SESSION['autobazarUserId'])){
        echo '<form action="?login" method="post" id="formLogin">
        <div class="span8">
                <label for="username">Uživatelské jméno</label>
                <input type="text" name="username" id="username">
                <br>
                <label for="password">Heslo</label>
                <input type="password" name="password" id="password">
                <br>
                <button name="loginSubmit" id="loginSubmit" class="btn btn-large btn-primary">Log in</button>
        </div>
        <div class="span4 formPaddingTop">';
        if (isset($_GET['logout'])){ 
            echo 'Uživatel byl odhlášen';
            session_destroy();
        }
        echo $loginMessage;        
        echo '</div>
        </form>';
    }else if ((isset($_SESSION['autobazarUserId']))&&(!isset($_GET['logout']))){ 
        echo '<div class="span8"><p class="logged">Přihlášen: <b>'.$_SESSION['autobazarUser'].'</b> | <a href="?logout">Odhlásit</a></p></span>';
        /* a třeba dashboard, načíst tpl */
    }else{
        echo '<div class="span8">Uživatel odhlášen.</span>';
    }
      

 

?>
</div>