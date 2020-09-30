<!-- Les Ports actifes ou non -->
<?php
session_start();

if (!isset($_SESSION["loggedin"]))
    {
    $_SESSION['redirectURL'] = $_SESSION['REQUEST_URL']; 
    header("location:../accueil.php"); 

    } 

require '../database.php';
$bureauError = $priseError = $NumportError = $adresseportError = $statuportError = $bureau = $prise = $Numport = $adresseport = $statuport = "";

if (!empty($_POST))
{
    $bureau   =     $_POST['bureau'] ;
    $Numport  =      checkInput($_POST['Numport']) ;
    $adresseport =   checkInput($_POST['adresseport']) ;
 
$isSuccess = true ;
        // nom de bureau
        if (empty($bureau))   
        {
            $bureauError = 'Ce champ ne peut pas etre vide' ;
            $isSuccess = false ;
        } 
        //Num de port
        if (empty($Numport))   
        {
            $NumportError = 'Ce champ ne peut pas etre vide' ;
            $isSuccess = false ;
        } 
        // addresse de PortS
        if (empty($adresseport))   
        {
            $adresseportError = 'Ce champ ne peut pas etre vide' ;
            $isSuccess = false ;
        } 
        //checkbox statu de port 
        $checkbox1=$_POST['statuport'];  
        $chk="";  
        foreach((array) $checkbox1 as $chk1)  
        {  
        $chk .= $chk1 ;  
        } 
    if ($isSuccess)
    {
        $db = Database::connect();
        $statement = $db->prepare("INSERT INTO port (bureau,Numport,adresseport,statuport) values(?, ?, ?, ?)");
        $statement->execute(array($bureau,$Numport,$adresseport,$chk)) ;
        var_dump($statement->errorInfo());

        Database::disconnect();
        header("Location: indexPort.php");
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
        <link rel="stylesheet" href="../styles.css">
    </head>
    
    
    <body>         
            <h1 class="text-logo"><span class="glyphicon glyphicon-cutlery"></span> Cyber Park <span class="glyphicon glyphicon-cutlery"></span></h1>
            <div class="container admin">
            <div class="row">
            <div class="col-sm-6">
                        <h2>Ajouter Port</h2>
        <form id="contact-form" method="post" action="insertPort.php" role="form">
                <!-- champ de bureau -->
                 <select class="form-control" name="bureau" id="bureau">
                 <option> Sélectionner un bureau </option>
                    <?php
                           $db = Database::connect();
                           foreach ($db->query('SELECT * FROM bureau') as $row) 
                           {
                                echo '<option value="'. $row['idbureau'] .'">'. $row['nombureau'] . '</option>';
                           }
                           Database::disconnect();
                     ?>
                 </select>
                        <span class="help-inline"><?php echo $bureauError;?></span>
                        <br/>
                        <!-- nombre de prise -->
                        <label> Les nombre de Prise de ce bureau est de :</label>
                 <select class="form-control" name="select2" id="select2">
                          <option value="" disabled selected>  select prise  </option>
                        <?php
                           $db = Database::connect();
                           foreach ($db->query('SELECT * FROM bureau') as $row) 
                           {
                                echo '<option value="'. $row['idbureau'] .'">'. $row['prise'] . '</option>';
                           }
                           Database::disconnect();
                        ?>
                     </select>
                        <br/>
                        <br>
                              <!-- nombre de Numport -->
                              <label> Les  Ports de ce bureau déja utiliser est :</label>
                          <select name="Numport" id="Numport" class="form-control" size="4">
                          <option>Select Numport</option>
                                <?php
                                    $db = Database::connect();
                                    foreach ($db->query('SELECT port.Numport , bureau.idbureau FROM port LEFT JOIN bureau  ON port.bureau = bureau.idbureau') as $row) 
                                    {
                                            echo '<option value="'. $row['idbureau'] .'">'. $row['Numport'] . '</option>';
                                    }
                                    Database::disconnect();
                                ?>
                           </select>
                        <br/>
                        <br>
                        
                         <!-- Num port -->
                    <div class="form-group">
                        <label for="Numport">Numéro de port:</label>
                        <input type="text" class="form-control" id="Numport" name="Numport" placeholder="Numéro de port" value="<?php echo $Numport;?>">
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
                       <input type="checkbox" name="statuport[]" value="activé" value="<?= $statuport; ?>" > activé<br/>  
                       <input type="checkbox" name="statuport[]" value="déactivé" value="<?= $statuport; ?>" > déactivé<br/> 
                        <span class="help-inline"><?php echo $statuportError;?></span>
                    </div>
                        <br>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-pencil"></span> Ajouter</button>
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

<style>
        option
        {
        margin: 0.5em;
        }
</style>
<script>
    //Reference: https://jsfiddle.net/fwv18zo1/
    var $bureau = $( '#bureau' ),
            $select2 = $( '#select2' ),
        $options = $select2.find( 'option' );
        
    $bureau.on( 'change', function() {
        $select2.html( $options.filter( '[value="' + this.value + '"]' ) );
    } ).trigger( 'change' );

</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.0.0/jquery.min.js"></script>
<script>
    $("#bureau").change(function() {
    if ($(this).data('options') === undefined) {
        /*Taking an array of all options-2 and kind of embedding it on the select1*/
        $(this).data('options', $('#Numport option').clone());
    }
    var id = $(this).val();
    var options = $(this).data('options').filter('[value=' + id + ']');
    $('#Numport').html(options);
    });
</script>