<?php

session_start();

if (!isset($_SESSION["loggedin"]))
    {
    $_SESSION['redirectURL'] = $_SESSION['REQUEST_URL']; 
    header("location:accueil.php"); 

    } 


require '../database.php';

if(!empty($_GET['idPort'])) 
    {
        $idPort = checkInput($_GET['idPort']);
    }
    
    $db = Database::connect();
    $statement = $db->prepare('SELECT * FROM port LEFT JOIN bureau ON port.bureau = bureau.idbureau WHERE port.idPort = ?'); 
    $statement->execute(array($idPort));
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
        <style> 
        h1{
  font-size: 30px;
  color: #fff;
  text-transform: uppercase;
  font-weight: 300;
  text-align: center;
  margin-bottom: 15px;
  text-align: center;
}
table{
  width:100%;
  table-layout: fixed;
}
.tbl-header{
  background-color: rgba(255,255,255,0.3);
 }
.tbl-content{
  height:300px;
  overflow-x:auto;
  margin-top: 0px;
  border: 1px solid rgba(255,255,255,0.3);
}
th{
  padding: 20px 15px;
  text-align: left;
  font-weight: 500;
  font-size: 12px;
  color: #fff;
  text-transform: uppercase;
}
td{
  padding: 15px;
  text-align: left;
  vertical-align:middle;
  font-weight: 300;
  font-size: 12px;
  color: #fff;
  border-bottom: solid 1px rgba(255,255,255,0.1);
}


/* demo styles */

@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,300,700);
body{
  background: -webkit-linear-gradient(left, #25c481, #25b7c4);
  background: linear-gradient(to right, #25c481, #25b7c4);
  font-family: 'Roboto', sans-serif;
}
section{
  margin: 50px;
}


/* follow me template */
.made-with-love {
  margin-top: 40px;
  padding: 10px;
  clear: left;
  text-align: center;
  font-size: 10px;
  font-family: arial;
  color: #fff;
}
.made-with-love i {
  font-style: normal;
  color: #F50057;
  font-size: 14px;
  position: relative;
  top: 2px;
}
.made-with-love a {
  color: #fff;
  text-decoration: none;
}
.made-with-love a:hover {
  text-decoration: underline;
}


/* for custom scrollbar for webkit browser*/

::-webkit-scrollbar {
    width: 6px;
} 
::-webkit-scrollbar-track {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
} 
::-webkit-scrollbar-thumb {
    -webkit-box-shadow: inset 0 0 6px rgba(0,0,0,0.3); 
}
        </style>
    </head>
    
    <body>
        <h1 class="text-logo"><span class="glyphicon glyphicon-home"></span> Cyber Park <span class="glyphicon glyphicon-home"></span> </h1>
            <div class="container admin">
                <div class="row">
                <div class="col-lg-6 mx-auto">
                    <!--for demo wrap-->
                    <h1> <strong>   Voir Tous Les Informations  </strong> </h1>
                    <div>
                    <form>
                        <table style="text-align: left; width: 100%;" border="4">
                        <thead>
                            <tr>
                            <th style="text-align: center; width: 130px;" scope="col"> Nom bureau </th>
                            <th style="text-align: center; width: 130px;"> Etage Bureau</th>
                            <th style="text-align: center; width: 130px;"> Surface de Bureau </th>
                            <th style="text-align: center; width: 130px;"> Eclairage de Bureau  </th>
                            <th style="text-align: center; width: 130px;">Climaisation de Bureau </th>
                            <th style="text-align: center; width: 130px;"> Prise de Bureau  </th>
                            <th style="text-align: center; width: 130px;"> Numéro de Port </th>
                            <th style="text-align: center; width: 130px;"> addresse de Port </th>
                            <th style="text-align: center; width: 130px;"> Statu de Port </th>
                            </tr>
                        </thead>
                        </table>
                    </div>
                    <div>
                        <table style="text-align: left; width: 100%;" border="3">
                        <tbody>
                            <tr>
                            <td style="text-align: center; width: 130px;"> <?php echo ' ' . $item['nombureau'];  ?> </td>
                            <td style="text-align: center; width: 130px;"> <?php echo ' ' . $item['etagebureau'];  ?> </td>
                            <td style="text-align: center; width: 130px;"> <?php echo ' ' . $item['surfbureau'];  ?> </td>
                            <td style="text-align: center; width: 130px;"> <?php echo ' ' . $item['eclabureau'];  ?> </td>
                            <td style="text-align: center; width: 130px;"> <?php echo ' ' . $item['climbureau'];  ?> </td>
                            <td style="text-align: center; width: 130px;"> <?php echo ' ' . $item['prise'];  ?> </td>
                            <td style="text-align: center; width: 130px;"> <?php echo ' ' . $item['Numport'];  ?> </td>
                            <td style="text-align: center; width: 130px;"> <?php echo ' ' . $item['adresseport'];  ?> </td>
                            <td style="text-align: center; width: 130px;"> <?php echo ' ' . $item['statuport'];  ?> </td>

                            </tr>
                    </form>       
                        </tbody>
                        </table>
                        <br>
                        <br>
                    </div>
                    <div class="form-actions">
                      <a class="btn btn-primary btn-lg active" href="indexPort.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                    </div>
                
                </div>
            </div>           
    </body>
    </html>
    <script>
    // '.tbl-content' consumed little space for vertical scrollbar, scrollbar width depend on browser/os/platfrom. Here calculate the scollbar width .
$(window).on("load resize ", function() {
  var scrollWidth = $('.tbl-content').width() - $('.tbl-content table').width();
  $('.tbl-header').css({'padding-right':scrollWidth});
}).resize();
    </script>
