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
    
$nombureauError = $surfbureauError = $priseError = $etagebureauError = $climbureauError = $eclabureauError = $nombureau = $surfbureau = $etagebureau = $climbureau = $eclabureau = $prise = "" ; 

if (!empty($_POST))
{
    $nombureau   =   checkInput($_POST['nombureau']) ;
    $surfbureau  =   checkInput($_POST['surfbureau']) ;
    $prise  =   checkInput($_POST['prise']) ;

$isSuccess = true ;
    // nom de bureau
    if (empty($nombureau))   
    {
        $nombureauError = 'Ce champ ne peut pas etre vide' ;
        $isSuccess = false ;
    } 
    //surface de bureau
    if (empty($surfbureau))   
    {
        $surfbureauError = 'Ce champ ne peut pas etre vide' ;
        $isSuccess = false ;
    } 

    if ($isSuccess)
        {
            $db = Database::connect();
            $check = implode(',',$_POST['climbureau']);
            $check2 = implode(',',$_POST['eclabureau']);
            $etage = $_POST['etagebureau'];
            $statement = $db->prepare("UPDATE bureau  set nombureau = '$nombureau' , surfbureau = '$surfbureau', climbureau = '$check', eclabureau = '$check2', etagebureau = '$etage',prise ='$prise'  WHERE idbureau = '$idbureau'");
            $statement->execute(array($nombureau,$surfbureau,$climbureau,$eclabureau,$etagebureau,$prise,$idbureau)) ;  
            Database::disconnect();
            header("Location: index.php");
        }
}
else 
{
    $db = Database::connect();
    $statement = $db->prepare("SELECT nombureau,surfbureau,prise FROM bureau WHERE idbureau = ?");
    $statement->execute(array($idbureau));
    $tab = $statement->fetch();
    $nombureau      =   $tab['nombureau']  ;
    $surfbureau     =   $tab['surfbureau'] ;
    $prise          =   $tab['prise'];
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

    $qry1=$db->query("SELECT * FROM bureau WHERE idbureau='$idbureau'" );
    $qry1->execute();
    $result = $qry1->fetchAll();
    foreach($result as $row)
    {
       $check = explode(',', $row['climbureau']);
       $check2 = explode(',',$row['eclabureau']);

    }
  
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Modifier</title>
        <meta charset="utf-8"/>
        <meta nombureau="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="styles.css">
    </head>
    
    <body>         
    <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span>Cyber Park <span class="glyphicon glyphicon-cutlery"></span></h1>
         <div class="container admin">
            <div class="row">
                <div class="col-sm-6">
                    <h1><strong>Modifier un bureau </strong></h1>
                    <br>
                    <form class="form" action="<?php echo 'update.php?idbureau='.$idbureau;?>" role="form" method="post">
                <!-- Nom de bureau -->       
                    <div class="form-group">
                        <label for="nombureau">Nom de bureau:</label>
                        <input type="text" class="form-control" id="nombureau" name="nombureau" placeholder="Nom" value="<?php echo $nombureau;?>">
                        <span class="help-inline"><?php echo $nombureauError;?></span>
                    </div>
                <!-- surface bureau -->
                    <div class="form-group">
                        <label for="surfbureau">Surface de bureau:</label>
                        <input type="text" class="form-control" id="surfbureau" name="surfbureau" placeholder="surfbureau" value="<?php echo $surfbureau;?>">
                        <span class="help-inline"><?php echo $surfbureauError;?></span>
                    </div>
                      <!-- Prise -->   
                <div class="form-group">
                        <label for="prise">Nombre de prise:</label>
                        <input type="text" class="form-control" id="prise" name="prise" placeholder="de 1 a 15" value="<?php echo $prise;?>" required>
                        <span class="help-inline"><?php echo $priseError;?></span>
                </div>
                <!-- champ de l'etage bureau -->
                <div class="form-group">
                    <label for="etagebureau">Quelle est l'etage de bureau de votre bureau ? </label><br/>
                        <select class="form-control"  name="etagebureau">
<option <?php $row['etagebureau'] == 'Select etagebureau' ? print "selected" : ""; ?> > selectionner un etage  </option>
     <option value="1" <?php $row['etagebureau']== 1  ? print "selected" : "";?>  > 1 </option>
     <option value="2" <?php $row['etagebureau']== 2  ? print "selected" : "";?>  >2</option>
     <option value="3" <?php $row['etagebureau']== 3  ? print "selected" : "";?> >3</option> 
 </select><br>
                   <span class="help-inline"><?php echo $etagebureauError;?></span>
                </div>
                <!-- chekbox clim-->
                <div class="form-group">
                    <label for="climbureau"> Climatisation :</label><br/>
<input type="checkbox" name="climbureau[]" value="oui" <?php in_array('oui',$check) ? print "checked" : ""; ?> > oui<br/>                  
<input type="checkbox" name="climbureau[]" value="non" <?php in_array('non',$check) ? print "checked" : ""; ?> > non<br/>       
                          
                        <span class="help-inline"><?php echo $climbureauError;?> </span> <br>
                </div>        
                <!-- eclabureau -->
                <div class="form-group">
                    <label for="eclabureau"> Eclairage : </label><br/>
<input type="checkbox" name="eclabureau[]" value="oui" <?php in_array('oui',$check2) ? print "checked" : ""; ?> > oui<br/>                  
<input type="checkbox" name="eclabureau[]" value="non" <?php in_array('non',$check2) ? print "checked" : ""; ?> > non<br/>       

                        <span class="help-inline"><?php echo $eclabureauError;?></span>
                    <br>
                </div>        
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Modifier </button>
                        <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
                   </div>
                </form>                    
            </div>
                </div>
           </div>
        </div>
    </body>
</html>