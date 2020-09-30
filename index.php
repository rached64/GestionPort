<?php
session_start();

if (!isset($_SESSION["loggedin"]))
    {
    $_SESSION['redirectURL'] = $_SESSION['REQUEST_URL']; 
    header("location:accueil.php"); 

    } 



      // search 
 /*     if (isset($_POST['search'])) 
      {
        $valuetosearch = $_POST['valuetosearch'];
        require 'database.php';
        $db = Database::connect();
        $statement = $db->query('SELECT * FROM `bureau` WHERE CONCAT(`idbureau`,`nombureau`,`etagebureau`) LIKE '%".$valuetosearch."%' ');
        $search_result = execute($query);

      } else
       {
       $query = "SELECT * FROM `users`";
       $search_result = execute($query);
       }*/
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
    <div class="row justify-content-center">
            <?php if (isset($_SESSION['response'])) { ?>       
            <div class="alert alert-success alert-<?= $_SESSION['res_type']; ?>  alert-dismissible text-center">
            <button type="button" class="close" data-dismiss="alert">&times; </button>
           <b> <?= $_SESSION['response']; ?> </b>
            </div>
            <?php }  unset($_SESSION['response']); ?>
    </div>
        <h1 class="text-logo"><span class="glyphicon glyphicon-home"></span> Cyber Park <span class="glyphicon glyphicon-home"></span> </h1>
            <div class="container admin">
                <div class="row">
                    <h1> <strong> Liste des Bureau</strong> <a href="insert.php" class="btn btn-success btn-lg"> 
                        <span class="glyphicon glyphicon-plus"></span>Ajouter </a> </h1>
                        <!-- RECHERCHE -->
                    <form class="form-inline">
                    <input class="form-control mr-sm-2" type="text" name="valuetosearch">
                    <input type="submit" name="search" class="btn btn-outline-success" value="Filter">
                   <!--     <span class="glyphicon glyphicon-search"></span> Search   </a> </h1> -->
                    </form>
            
                  <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom bureau </th>
                        <th>Etage</th>
                        <th>Surface</th>
                        <th>Climatisation</th>
                        <th>Eclairage</th>
                        <th> Nombre de Prise</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        <?php
                            require 'database.php';
                            $db = Database::connect();
                            $statement = $db->query('SELECT * FROM bureau ');
                        //    while($row = mysqli_fetch_array($search_result)):
                            while ($item = $statement->fetch())
                            {
                              echo   '<td>' .$item['idbureau'].    '</td>';
                              echo   '<td>' .$item['nombureau'].   '</td>';
                              echo   '<td>' .$item['etagebureau']. '</td>';
                              echo   '<td>' .$item['surfbureau'].  '</td>';
                              echo   '<td>' .$item['eclabureau'].  '</td>';
                              echo   '<td>' .$item['climbureau'].  '</td>';
                              echo   '<td>' .$item['prise'].       '</td>';
                              echo  '<td width=300>'; 
                              echo '<a class="btn btn-default" href="view.php?idbureau='.$item['idbureau'].'"> <span class="glyphicon glyphicon-eye-open"></span> Voir</a>';
                              echo ' ';
                              echo '<a class="btn btn-primary" href="update.php?idbureau='.$item['idbureau'].'"> <span class="glyphicon glyphicon-pencil"></span> Modifier </a>'; 
                              echo ' ';
                              echo '<a class="btn btn-danger" href="delete.php?idbureau='.$item['idbureau'].'"> <span class="glyphicon glyphicon-remove"></span> Supprimer </a>'; 
                              echo  '</td>';
                              echo '</tr>';
                            }
                        //endwhile;
                        ?>
                    </tbody>
                </table>
                </div>
            </div>     
     </body>
    </html>