<?php

session_start();

if (!isset($_SESSION["loggedin"]))
    {
    $_SESSION['redirectURL'] = $_SESSION['REQUEST_URL']; 
    header("location:accueil.php"); 

    } 


require 'database.php';

if (!empty($_GET['idbureau']))
{
    $idbureau = checkInput($_GET['idbureau']);
}

if (!empty($_POST))
{
    $idbureau = checkInput($_POST['idbureau']);
    $db =  Database::connect();
    $statement = $db->prepare("DELETE FROM bureau WHERE idbureau = ?");
    $statement->execute(array($idbureau));
    Database::disconnect();
    header("Location:index.php");
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
        <title>Supprimer</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="styles.css">
        <script src="js/script.js"></script>
    </head>
    <body>         
            <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Cyber Park <span class="glyphicon glyphicon-cutlery"></span></h1>
            <div class="container admin">
            <div class="row">
            <div class="col-sm-6">
                        <h2>Supprimer Bureau</h2>
                    <form id="contact-form" method="post" action="delete.php" role="form">
                        <input type="hidden" name="idbureau" value="<?php echo $idbureau; ?>" />
                        <p class="btn btn-info">Etes vous sur de vouloir supprimer ?</p>
                            <div class="form-actions">
                                <br>
                                <button type="submit" class="btn btn-warning">Oui</button>
                                <a class="btn btn-default" href="index.php">Non </a>
                            </div>
                </form>
                </div>
           </div>
        </div>
    </body>

</html>