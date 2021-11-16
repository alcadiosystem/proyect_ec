<?php

include '../controller/VentaController.php';
include '../model/CartProductModel.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $dato="";
    $id="";
    $nombre="";
    $stock="";
    $total="";

    if(isset($_POST['dato'])){
        $dato = $_POST['dato'];
    }  

    if(isset($_POST['_id_'])){
        $id = $_POST['_id_'];
    }  

    if(isset($_POST['txtNom'])){
        $nombre = $_POST['txtNom'];
    }

    if(isset($_POST['txtCad'])){
        $stock = $_POST['txtCad'];
    }

    if(isset($_POST['txtTotal'])){
        $total = $_POST['txtTotal'];
    }

    $controller = new VentaController();
    $cartProduct = new CartProductModel($id,$nombre,$stock,$total);

    $result;

    switch ($dato) {
        case '1':
            $result = $controller->setProductToCart($cartProduct);
            break;
        case '2':
            $data = array('response' => true, 'Men'=> $controller->getProductForCart($id));
            $result = json_encode($data);
            break;
        default:
            # code...
            break;
    }

    echo $result;

}