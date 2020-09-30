<!DOCTYPE html>
<html>
    <head>
        <title>welcome</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="style.css">
    </head>
    
    
<body>       
<div id="wrapper">
  <h1><strong>CyberPark</strong> Application Gestion des Ports</h1>
  <nav role="navigation" id="access">
    <a class="skip-link icon-reorder" title="Accéder au menu" href="#menu">Menu</a>
    <ul id="menu">
      <li class="active"><a class="icon-home" href="#accueil">Home</a></li><!-- whitespace
                --><li><a class="icon-group" href="#quisommesnous">About Us</a></li><!-- whitespace
                --><li><a class="icon-leaf" href="index.php">Bureau</a></li><!-- whitespace
                --><li><a class="icon-picture" href="port/indexPort.php">Port</a></li><!-- whitespace
                --><li><a class="icon-envelope-alt" href="#contact">Contact</a></li>
          </ul>
      </nav>
</div>

</body>
</html>
<script>
    ;(function($) {
        "use strict";
        $(document).ready(function() {
            $('#access').on('touchstart click', '.skip-link', function(event) {
                $(this).toggleClass('focus');
                $($(this).attr('href')).toggleClass('target');
                event.preventDefault();
            }).find('.skip-link').append('<span>'+$('#menu .active').text()+'</span>');
        });
    })(jQuery);
 </script>