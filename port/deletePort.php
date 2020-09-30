<?php
session_start();

if (!isset($_SESSION["loggedin"]))
    {
    $_SESSION['redirectURL'] = $_SESSION['REQUEST_URL']; 
    header("location:../accueil.php"); 

    } 

require '../database.php';

if (!empty($_GET['idPort']))
{
    $idPort = checkInput($_GET['idPort']);
}

if (!empty($_POST))
{
    $idPort = checkInput($_POST['idPort']);
    $db =  Database::connect();
    $statement = $db->prepare("DELETE FROM port WHERE idPort = ?");
    $statement->execute(array($idPort));
    Database::disconnect();
    header("Location:indexPort.php");
}




function checkInput($data) 
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <title>delete</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="../styles.css">
        <script src="js/script.js"></script>
    </head>
    
    
    <body>         
            <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Cyber Park <span class="glyphicon glyphicon-cutlery"></span></h1>
            <div class="container admin">
            <div class="row">
            <div class="col-sm-6">
                        <h2>supprimer Port</h2>
                    <form id="contact-form" method="post" action="deletePort.php" role="form">
                    <input type="hidden" name="idPort" value="<?php echo $idPort;?>" />
                    <p class="alert alert-warning">Etes vous sur de vouloir supprimer ?</p>
<br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning"> oui</button>
                        <a class="btn btn-default" href="indexPort.php"> non</a>
                   </div>
                </form>
                </div>
           </div>
        </div>
        
    </body>
<!-- script n'accepte pas les caracteres -->
<script>
$('.decimal').keyup(function(){
    var val = $(this).val();
    if(isNaN(val)){
         val = val.replace(/[^0-9\.]/g,'');
         if(val.split('.').length>2) 
             val =val.replace(/\.+$/,"");
    }
    $(this).val(val); 
});
</script>


</html>