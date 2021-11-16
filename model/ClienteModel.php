<?php


class ClienteModel
{
    public $id;
    public $nombre;
    public $apellido;
    public $documento;
    public $vendedor;

    public function __construct($id,$nom,$ape,$doc,$ven)
    {
        $this->id = $id;
        $this->nombre = $nom;
        $this->apellido = $ape; 
        $this->documento = $doc;
        $this->vendedor = $ven;
    }    
}
