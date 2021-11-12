<?php
include('../conexion/ConexionMySQLPHP.php');

$nombreUsuario    = $_POST["nombreUsuario"];
$clave   = $_POST["clave"];
$rol    = $_POST["rol"];


 $conexion = "INSERT INTO empleados(identifacion,nombres,apellidos,nombreUsuario,direccion,telefono,clave,rol) VALUES ('$identificacion','$nombres','apellidos','$nombreUsuario','$direccion','$telefono','$clave','$rol')";

            $resultado = mysqli_query($con, $conexion) or die ('Error: '. mysqli_error($con));

            header ('Location: index.html');

///$queryusuario = mysqli_query($conexionMySQL,"SELECT * FROM Login WHERE nombreUsuario ='$nombreUsuario' and clave = '$clave' and rol = '$rol'");
  
    
if ($nr == 1 )  
    { 
        if($rol=="empleado")
            {   
                header("Location: pag_user.php");
            }
        else if ($rol=="administrador")
            {
                header("Location: pag_admin.php");
            }
    }
else
    {
    echo "<script> alert('Usuario, clave o rol incorrecto.');window.location= 'index.html' </script>";
    }

/*VaidrollTeam*/
?>
