<?php

    include '../modelos/empleado.php';
    include '../controladores/controladorempleado.php'; 
    session_start();

    $nombreUsuario = $_POST['nombreUsuario']; 
    $clave = $_POST['clave'];
 
    $conexion = "SELECT * from empleados where nombreUsuario='.$nombreUsuario.' and clave='.$clave.' "; 
    $resultado = $PDO->query($sql);

    echo $resultado->rowCount();
    
    if ($resultado->rowCount() == 1){
        session_start();
        $_SESSION["auth"] = $nombreUsuario;
        header("Location: index.html?page=form"); 
      }
        
        else{
            echo"<script type=\"text/javascript\">alert('Error de contraseña1'); window.location='index.php?page=login';</script>";
      
        exit();
        }
    
?>