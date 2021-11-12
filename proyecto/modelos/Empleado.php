<?php 

	class Empleado {

		public $identificacion;
		public $nombres;
		public $apellidos;
		public $nombreUsuario;
		public $direccion;
		public $telefono;
		public $clave;
		public $rol;

		function __construct($identificacion,$nombres,$apellidos,$nombreUsuario,$direccion,$telefono,$clave,$rol) {

			$this->identificacion = $identificacion;
			$this->nombres = $nombres;
			$this->apellidos = $apellidos;
			$this->nombreUsuario = $nombreUsuario;
			$this->direccion = $direccion;
			$this->telefono = $telefono;
			$this->clave = $clave;
			$this->rol = $rol;

		}


		function __construct1($identificacion) {

			$this->identificacion = $identificacion;
			
		}

		

	}




 ?>