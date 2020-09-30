<?php

session_start();

if (!isset($_SESSION["loggedin"]))
    {
    $_SESSION['redirectURL'] = $_SESSION['REQUEST_URL']; 
    header("location:accueil.php"); 

    } 


require 'database.php';

$nombureauError = $surfbureauError = $etagebureauError = $climbureauError = $eclabureauError = $priseError = $nombureau = $surfbureau = $etagebureau = $climbureau = $eclabureau = $prise =  "" ; 

if (!empty($_POST))
{
    $nombureau   =   checkInput($_POST['nombureau']) ;
    $surfbureau  =   checkInput($_POST['surfbureau']) ;
    $etagebureau =   checkInput($_POST['etagebureau']) ;
    $prise       =   checkInput($_POST['prise']) ;
 

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
// prise
/*if (empty($prise))   
{
    $priseError = 'Ce champ ne peut pas etre vide' ;
    $isSuccess = false ;
} */
 //checkbox climatisation 
 $checkbox1=$_POST['climbureau'];  
 $chk="";  
 foreach((array) $checkbox1 as $chk1)  
 {  
    $chk .= $chk1 ;  
 } 
 //checkbox eclair  
 $checkbox2=$_POST['eclabureau'];  
 $chk1="";  
 foreach((array)$checkbox2 as $chk2)  
 {  
    $chk1 .= $chk2 ;  
 } 

if ($isSuccess)
    {
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO bureau (nombureau,surfbureau,etagebureau,climbureau,eclabureau,prise) values(?, ?, ?, ?, ?, ?)");
        $statement->execute(array($nombureau,$surfbureau,$etagebureau,$chk,$chk1,$prise)) ;
        var_dump($statement->errorInfo());

        Database::disconnect();
        //header("Location: index.php");
    }

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
        <title>Ajouter</title>
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
                        <h2>Ajouter Bureau</h2>
                    <form id="contact-form" method="post" action="insert.php" role="form">
                <!-- Nom de bureau -->
                    <div class="form-group">
                        <label for="nombureau">Nom de bureau:</label>
                        <input type="text" class="form-control" id="nombureau" name="nombureau" placeholder="Nom de bureau" value="<?php echo $nombureau;?>">
                        <span class="help-inline"><?php echo $nombureauError;?></span>
                    </div>
                <!-- surface bureau -->
                    <div class="form-group">
                        <label for="surfbureau">Surface de bureau:</label>
                        <input type="text" class="form-control decimal" id="surfbureau" name="surfbureau" placeholder="surface de bureau" value="<?php echo $surfbureau;?>">
                        <span class="help-inline"><?php echo $surfbureauError;?></span>
                    </div>
                <!-- Prise -->   
                <div class="form-group">
                        <label for="prise">Nombre de prise:</label>
                        <input type="text" class="form-control" id="prise" name="prise" placeholder="de 1 a 15" value="<?php echo $prise;?>" required>
                        <span class="help-inline"><?php echo $priseError;?></span>
                </div>
                <!-- champ de l'etage bureau -->
                    <label for="Jour">Quelle est l'etage de bureau de votre bureau ? </label><br/>
                        <select class="form-control" id="etagebureau" name="etagebureau"  value="<?= $etagebureau; ?>" >
                        <span class="help-inline"><?php echo $etagebureauError;?></span>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select><br>
                <!-- chekbox clim-->
                    <label for="climbureau"> Climatisation :</label><br/>
                            <input type="checkbox" name="climbureau[]" value="oui" value="<?= $climbureau; ?>" > oui<br/>  
                            <input type="checkbox" name="climbureau[]" value="non" value="<?= $climbureau; ?>" > non<br/> 
                        <span class="help-inline"><?php echo $climbureauError;?></span>
<br>
                <!-- eclabureau -->
                    <label for="eclabureau"> Eclairage : </label><br/>
                            <input type="checkbox" name="eclabureau[]" value="oui" value="<?= $eclabureau; ?>"  > oui<br/>  
                            <input type="checkbox" name="eclabureau[]" value="non" value="<?= $eclabureau; ?>"  > non<br/>
                        <span class="help-inline"><?php echo $eclabureauError;?></span>
                    <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
                        <a class="btn btn-primary" href="index.php"><span class="glyphicon glyphicon-arrow-left"></span> Retour</a>
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