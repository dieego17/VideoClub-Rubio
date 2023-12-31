<?php

    //para incluir las funciones que haya en functions.php
    include '../lib/functions/functions.php';
    
    //iniciamos la sesion
    session_start();
    
    //nos conectamos al base de datos atraves de la funcion
    $bd = conexionBD();
    
    //obtemos el los datos atraves de post y get
    $id = htmlspecialchars($_GET['modificarPeli']);
    $nuevoTitulo = htmlspecialchars($_POST['tituloPelicula']);
    $nuevoGenero = htmlspecialchars($_POST['generoPelicula']);
    $nuevoPais = htmlspecialchars($_POST['paisPelicula']);
    $nuevoAnyo = htmlspecialchars($_POST['anyoPelicula']);
    $nuevoCartel = htmlspecialchars($_POST['cartelPelicula']);
    
    
    
    //llamamos a la funcion deleteReserva y le pasamos los parametros que anteriormente hemos guardado en las variables id
    modificarPelicula($id, $nuevoTitulo, $nuevoGenero, $nuevoPais, $nuevoAnyo, $nuevoCartel);

?>
