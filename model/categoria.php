<?php
require_once('model/conexion.php');

class Categoria extends Conexion
{   
    protected $codCategoria;
    protected $nombreCategoria;

    public function get_nombreCategoria()
    {
        return $this->nombreCategoria;
    }

    public function get_codCategoria(){
        return $this->codCategoria;
    }

    public function set_nombreCategoria($nombreCategoria)
    {
        $this->nombreCategoria = $nombreCategoria;
    }

    public function set_codCategoria($codCategoria)
    {
        $this->codCategoria = $codCategoria;
    }

    public function obtenerCategorias()
    {
        $co = $this->conecta();
        $co->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $p = $co->prepare("SELECT * FROM categoria");
        $p->execute();
        $r = $p->fetchAll(PDO::FETCH_ASSOC);
        return $r;
    }
}
