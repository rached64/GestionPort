<?php

session_start();

if (!isset($_SESSION["loggedin"]))
    {
    $_SESSION['redirectURL'] = $_SESSION['REQUEST_URL']; 
    header("location:../accueil.php"); 

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
        <link rel="stylesheet" href="../styles.css">
    </head>
    
    <body>
        <h1 class="text-logo"><span class="glyphicon glyphicon-home"></span> Cyber Park <span class="glyphicon glyphicon-home"></span> </h1>
            <div class="container admin">
                <div class="row">
                    <h1> <strong> Liste des Ports </strong> <a href="insertPort.php" class="btn btn-success btn-lg"> 
                        <span class="glyphicon glyphicon-plus"></span>Ajouter </a> </h1>
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>Nom bureau </th>
                        <th>Num Port</th>
                        <th>adresse Port</th>
                        <th>Statu de Port</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            require '../database.php';
                            $db = Database::connect();
                            $statement = $db->query('SELECT port.idPort , port.Numport ,port.adresseport ,port.statuport , bureau.nombureau 
                            FROM port LEFT JOIN bureau  ON port.bureau = bureau.idbureau'); 
                            while ($item = $statement->fetch())
                            {
                              echo '<tr>';
                              echo   '<td>' .$item['nombureau'].   '</td>';
                              echo   '<td>' .$item['Numport']. '</td>';
                              echo   '<td>' .$item['adresseport'].  '</td>';
                              echo   '<td>' .$item['statuport'].  '</td>';
                              echo  '<td width=300>'; 
                              echo '<a class="btn btn-default" href="viewPort.php?idPort='.$item['idPort'].'"> <span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                              echo ' ';
                              echo '<a class="btn btn-primary" href="updatePort.php?idPort='.$item['idPort'].'"> <span class="glyphicon glyphicon-pencil"></span> Modifier </a>'; 
                              echo ' ';
                              echo '<a class="btn btn-danger" href="deletePort.php?idPort='.$item['idPort'].'"> <span class="glyphicon glyphicon-remove"></span> Supprimer </a>'; 
                              echo  '</td>';
                              echo '</tr>';
                            }
                            Database::disconnect();

                        ?>
                    </tbody>
                </table>
                </div>
            </div>      
    </body>
    </html>