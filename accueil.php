<?php
session_start();

if (isset($_POST['submit']))
{
$_SESSION['loggedin'] = TRUE ;
header('location'.$_SESSION['redirectURL']);
}

$update= false ;

define('LOGIN','admin');  // Login correct
define('PASSWORD','admin');  // Mot de passe correct
$message = '';      // Message à afficher à l'utilisateur

if(!empty($_POST))
{
  // Le login est-il rempli ?
  if(empty($_POST['login']))
  { ?>
    <div class="alert alert-danger center-block" style="width: 80%;" role="alert"> 
        <?php   echo " <p><center> Veuillez indiquer votre login svp ! </center></p>" ?>
    </div>
  <?php 
  }
    // Le mot de passe est-il rempli ?
    elseif(empty($_POST['motDePasse']))
  { ?>
    <div class="alert alert-danger center-block" style="width: 80%;" role="alert"> 
          <?php   echo "<p><center> Veuillez indiquer votre mot de passe svp !</center></p>" ?>
    </div>
  <?php
  }
    // Le login est-il correct ?
    elseif($_POST['login'] !== LOGIN)
  { ?>
   <div class="alert alert-danger center-block" style="width: 80%;" role="alert"> 
          <?php   echo "<p><center> Votre login est faux !</center></p>" ?>
    </div>
  <?php
  }
    // Le mot de passe est-il correct ?
    elseif($_POST['motDePasse'] !== PASSWORD)
  { ?>
   <div class="alert alert-danger center-block" style="width: 80%;" role="alert"> 
          <?php   echo "<p><center> Votre mot de passe est faux !! </center></p>" ?>
    </div>
<?php
  }
    else
  {
?>
        <?php   
          $_SESSION['response']=" Successfully LOGIN  !";
          header('location:bienvenu.php'); 
        ?>
<?php 

  } 
} 
?>

<?php if(!empty($message)) : ?>
      <p><?php echo $message; ?></p>
    <?php endif; ?>

    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" >
<script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

<body>
<div class="login-box">
  <h2>Login</h2>
  <form action="<?php echo htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES); ?>" method="post">
    <div class="user-box">
    <input type="text" name="login" id="login" value="<?php if(!empty($_POST['login'])) { echo htmlspecialchars($_POST['login'], ENT_QUOTES); } ?>" />
      <label>Username</label>
    </div>
    <div class="user-box">
    <input type="password" name="motDePasse" id="password" value="" /> 
      <label>Password</label>
    </div>
    <a href="#">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      <input type="submit" name="submit" value="Identification" />
    </a>

  </form>
</div>
</body>
</html>
<!-- CSS -->
<style>
   html {
  height: 100%;
}
body {
  margin:0;
  padding:0;
  font-family: sans-serif;
  background: radial-gradient(#ffffff, #030303);
}

.login-box {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 400px;
  padding: 40px;
  transform: translate(-50%, -50%);
  background: rgba(0,0,0,.2);
  box-sizing: border-box;
  box-shadow: 0 15px 25px rgba(0,0,0,.6);
  border-radius: 10px;
}

.login-box h2 {
  margin: 0 0 30px;
  padding: 0;
  color: #fff;
  text-align: center;
}

.login-box .user-box {
  position: relative;
}

.login-box .user-box input {
  width: 100%;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  margin-bottom: 30px;
  border: none;
  border-bottom: 1px solid #fff;
  outline: none;
  background: transparent;
}
.login-box .user-box label {
  position: absolute;
  top:0;
  left: 0;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  pointer-events: none;
  transition: .5s;
}

.login-box .user-box input:focus ~ label,
.login-box .user-box input:valid ~ label {
  top: -20px;
  left: 0;
  color: #0f336e;
  font-size: 12px;
}

.login-box form a {
  position: relative;
  display: inline-block;
  padding: 10px 20px;
  color: #01080d;
  font-size: 16px;
  text-decoration: none;
  text-transform: uppercase;
  overflow: hidden;
  transition: .5s;
  margin-top: 40px;
  letter-spacing: 4px
}

.login-box a:hover {
  background: #01080d;
  color: #fff;
  border-radius: 5px;
  box-shadow: 0 0 5px #01080d,
              0 0 25px #01080d,
              0 0 50px #01080d,
              0 0 100px #01080d;
}

.login-box a span {
  position: absolute;
  display: block;
}

.login-box a span:nth-child(1) {
  top: 0;
  left: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(90deg, transparent, #01080d);
  animation: btn-anim1 1s linear infinite;
}

@keyframes btn-anim1 {
  0% {
    left: -100%;
  }
  50%,100% {
    left: 100%;
  }
}

.login-box a span:nth-child(2) {
  top: -100%;
  right: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(180deg, transparent, #01080d);
  animation: btn-anim2 1s linear infinite;
  animation-delay: .25s
}

@keyframes btn-anim2 {
  0% {
    top: -100%;
  }
  50%,100% {
    top: 100%;
  }
}

.login-box a span:nth-child(3) {
  bottom: 0;
  right: -100%;
  width: 100%;
  height: 2px;
  background: linear-gradient(270deg, transparent, #01080d);
  animation: btn-anim3 1s linear infinite;
  animation-delay: .5s
}

@keyframes btn-anim3 {
  0% {
    right: -100%;
  }
  50%,100% {
    right: 100%;
  }
}

.login-box a span:nth-child(4) {
  bottom: -100%;
  left: 0;
  width: 2px;
  height: 100%;
  background: linear-gradient(360deg, transparent, #01080d);
  animation: btn-anim4 1s linear infinite;
  animation-delay: .75s
}

@keyframes btn-anim4 {
  0% {
    bottom: -100%;
  }
  50%,100% {
    bottom: 100%;
  }
}

</style>

