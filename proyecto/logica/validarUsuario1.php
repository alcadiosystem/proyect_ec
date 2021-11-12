<?php 

include '../modelos/empleado.php';
include '../controladores/controladorempleado.php';
session_start();

$nombreUsuario = $_POST['nombreUsuario'];
$clave = $_POST['clave'];
$conexion = "SELECT * from empleados where nombreUsuario='.$nombreUsuario.' and clave='.$clave.' "; 
////$querynombreUsuario = mysqli_query($conexionMySQL,"SELECT * FROM login WHERE nombreUsuario ='$nombreUsuario' and clave = '$clave'");
//$q = "SELECT COUNT(*) as contar from empleados where nombreUsuario ='$nombreUsuario' and clave = '$clave' ";
$consulta = mysqli_query($sql);
$array = mysqli_fetch_array($consulta);

if ($array['contar']>0) {
	header("location: ../Vistas/GestionarEmpleado.php");
}else{
	echo "Error";
}


?>