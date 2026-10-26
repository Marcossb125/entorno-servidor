<?php 

    function mostrar () {
    $combinacion = $_SESSION['combinacion'];
    
    foreach ($combinacion as $circulo):

    print('<svg width="120" height="120">      
        <circle cx="60" cy="60" r="50" fill="' . $circulo . '"/></circle>
        </svg>');

    endforeach;

    

    }

    


?>