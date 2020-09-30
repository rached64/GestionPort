<?php 

session_start();

if (!isset($_SESSION["loggedin"]))
    {
    $_SESSION['redirectURL'] = $_SESSION['REQUEST_URL']; 
    header("location:../accueil.php"); 

    } 


require '../database.php';

if(!empty($_GET['idPort'])) 
    {
        $idPort = checkInput($_GET['idPort']);
    }

$bureauError = $NumportError = $adresseportError = $statuportError = $bureau = $Numport = $adresseport = $statuport = "";




if (!empty($_POST))
{
    $Numport  =   checkInput($_POST['Numport']) ;
    $adresseport = checkInput($_POST['adresseport']) ;
    $bureau = checkInput($_POST['bureau']) ;
    
$isSuccess = true ;
      
        //Num de port
        if (empty($Numport))   
        {
            $NumportError = 'Ce champ ne peut pas etre vide' ;
            $isSuccess = false ;
        } 
        // addresse de Port
        if (empty($adresseport))   
        {
            $adresseportError = 'Ce champ ne peut pas etre vide' ;
            $isSuccess = false ;
        } 
    if ($isSuccess)
    {
        $db = Database::connect();
        $check = implode(',',$_POST['statuport']);
        $statement = $db->prepare("UPDATE port set bureau= ?,Numport=?,adresseport= ?,statuport='$check' WHERE idPort= ?");
        $statement->execute(array($bureau,$Numport,$adresseport,$idPort)) ;  
        var_dump($statement->errorInfo());
        Database::disconnect();
        header("Location: indexPort.php");
    }        
}
else 
{
    $db = Database::connect();
    $statement = $db->prepare("SELECT * FROM port WHERE idPort ='$idPort'");
    $statement->execute(array($idPort));
    $tab = $statement->fetch();
    $bureau      =   $tab['bureau'];
    $Numport     =   $tab['Numport'];
    $adresseport     =  $tab['adresseport'];   
    Database::disconnect();
}    
function checkInput($data) 
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $db = Database::connect();
    $qry1=$db->query("SELECT * FROM port WHERE idPort='$idPort'" );
    $qry1->execute();
    $result = $qry1->fetchAll();
    foreach($result as $row)
    {
       $check = explode(',', $row['statuport']);

    }
    

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Modifier</title>
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
                        <h2>Modifier Port</h2>
        <form id="contact-form" method="post" action="<?php echo 'updatePort.php?idPort='.$idPort;?>" role="form">
                <!-- champ de bureau -->
                <label for="bureau">Sélectionner un bureau </label><br/>
                 <select class="form-control" name="bureau" id="bureau">
                 <option> -- Selectionner un bureau -- </option>
                    <?php
                           $db = Database::connect();
                           foreach ($db->query('SELECT * FROM bureau') as $row) 
                           {
                            if($row['idbureau'] == $bureau)
                            echo '<option selected="selected" value="'. $row['idbureau'] .'">'. $row['nombureau'] . '</option>';
                        else
                            echo '<option value="'. $row['idbureau'] .'">'. $row['nombureau'] . '</option>';;
                           }
                           Database::disconnect();
                     ?>
                 </select>
                        <span class="help-inline"><?php echo $bureauError;?></span>
                        <br/>
                <!-- Num port -->
                    <div class="form-group">
                        <label for="Numport">Numéro de port:</label>
                        <input type="text" class="form-control decimal" id="Numport" name="Numport" placeholder="Numéro de port" value="<?php echo $Numport;?>">
                        <span class="help-inline"><?php echo $NumportError;?></span>
                    </div>
                     <!-- adresse de port -->
                     <div class="form-group">
                        <label for="adresseport">adresse de port:</label>
                        <input type="text" class="form-control decimal" id="adresseport" name="adresseport" placeholder="adresse de port" value="<?php echo $adresseport;?>">
                        <span class="help-inline"><?php echo $adresseportError;?></span>
                    </div>
                <!-- chekbox statuport-->
                    <label for="statuport"> statu de port :</label><br/>
                    <div class="form-group">
                       <input type="checkbox" name="statuport[]" value="activé" <?php in_array('activé',$check) ? print "checked" : ""; ?> > activé<br/>  
                       <input type="checkbox" name="statuport[]" value="déactivé" <?php in_array('déactivé',$check) ? print "checked" : ""; ?>  > déactivé<br/> 
                        <span class="help-inline"><?php echo $statuportError;?></span>
                    </div>
                        <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier</button>
                        <a class="btn btn-primary" href="indexPort.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
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