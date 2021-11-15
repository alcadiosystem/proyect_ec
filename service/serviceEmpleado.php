<?php

include '../controller/AdminController.php';
include '../model/UsuarioModel.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    
    $dato="";
    $id="";
    $documento="";
    $nombre="";
    $apellido="";
    $direccion="";
    $telefono="";
    $usuario="";
    $pass="";
    $rol="";

    if(isset($_POST['dato'])){
        $dato = $_POST['dato'];
    }
    
    if(isset($_POST['id'])){
        $id = $_POST['_id_'];
    }   

    if(isset($_POST['documento'])){
        $documento = $_POST['documento'];
    }   

    if(isset($_POST['dato'])){
        $nombre = $_POST['dato'];
    }   

    if(isset($_POST['dato'])){
        $apellido = $_POST['dato'];
    }   

    if(isset($_POST['dato'])){
        $direccion = $_POST['dato'];
    }   

    if(isset($_POST['dato'])){
        $telefono = $_POST['dato'];
    }   

    if(isset($_POST['dato'])){
        $usuario = $_POST['dato'];
    }   

    if(isset($_POST['dato'])){
        $pass = $_POST['dato'];
    }   

    if(isset($_POST['dato'])){
        $rol = $_POST['dato'];
    }

    $controller = new AdminController();
    $empleado = new UsuarioModel($id,$documento,$nombre,$apellido,$direccion,$telefono,$usuario,$pass,$rol);


    $result;

    switch ($dato) {
        case '1':
            # code...
            break;
        
        case '2':
            $result = $controller->setEmpleado($empleado);
            break;
        
        case '3':
            # code...
            break;

        case '4':
            # code...
            break;
        default:
            # code...
            break;
    }


}