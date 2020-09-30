<?php

session_start();

if (!isset($_SESSION["loggedin"]))
    {
    $_SESSION['redirectURL'] = $_SESSION['REQUEST_URL']; 
    header("location:accueil.php"); 

    } 


require 'database.php';

if(!empty($_GET['idbureau'])) 
    {
        $idbureau = checkInput($_GET['idbureau']);
    }
    
    $db = Database::connect();
    $statement = $db->prepare('SELECT bureau.idbureau ,bureau.nombureau , port.Numport as Numport  , port.adresseport as adresseport
    FROM bureau LEFT JOIN port  ON port.bureau = bureau.idbureau WHERE bureau.idbureau = ?'); 
    $statement->execute(array($idbureau));
   // var_dump($statement->errorInfo());

    $item= $statement->fetch();

    
    Database::disconnect();



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
        <title>CYBER PARK</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Holtwood+One+SC' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="styles.css">
    </head>
    
    <body>
        <h1 class="text-logo"><span class="glyphicon glyphicon-home"></span> Cyber Park <span class="glyphicon glyphicon-home"></span> </h1>
            <div class="container admin">
                <div class="row">
                <div class="col-lg-6 mx-auto">
                    <h1> <strong> Voir les Ports</strong> </h1>
                    <from>
                        <div class="form-group">
                            <label> Nom bureau :  </label> <?php echo ' ' . $item['nombureau'];  ?>
                        </div>
                        <div class="form-group">
                            <label> Numéro de Port :  </label> <?php echo ' ' . $item['Numport'];  ?>
                        </div>
                        <div class="form-group">
                            <label> addresse de Port :  </label> <?php echo ' ' . $item['adresseport'];  ?>
                        </div>
                    </from>
                    <div class="form-actions">
                      <a class="btn btn-primary btn-lg active" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                      <button onclick="window.location.href = 'port/indexPort.php';" type="button" class="btn btn-primary btn-lg active">
                      <span class="glyphicon glyphicon-arrow-right"></span>Page de Ports </button>                    

                    </div>
                
                </div>
            </div>           
    </body>
    </html>