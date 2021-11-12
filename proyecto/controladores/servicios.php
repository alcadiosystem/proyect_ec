<?php 
	
	include '../modelos/empleado.php';
	include '../controladores/controladorempleado.php';

 if	($_SERVER["REQUEST_METHOD"] == "POST") {

 	$identificacion = $_POST['identificacion'];
 	$nombres = $_POST['nombres'];
 	$apellidos = $_POST['apellidos'];
 	$nombreUsuario = $_POST['nombreUsuario'];
 	$direccion = $_POST['direccion'];
 	$telefono = $_POST['telefono'];
 	$clave = $_POST['clave'];
 	$rol = $_POST['rol'];
 	$controlador = $_POST['controlador']; 
 	$operacion = $_POST['operacion']; 


 	if ($controlador == "empleados") {
 		
 		$controladorMVC = new ControladorEmpleado();

 		if ($operacion == "guardar") {
			$empleado = new Empleado($identificacion,$nombres,$apellidos,$nombreUsuario,$direccion,$telefono,$clave,$rol);
 			$resultado = $controladorMVC->guardar($empleado);

 			if ($resultado){

 				echo "Transacción exitosa";

 			} else {

 				echo "Error en la transacción";

 			}

 		}elseif ($operacion == "listar") {

 			$resultado = $controladorMVC->listar();
 			
 		}

	}
 }



 ?>