<?php
class HomeModel extends Query{

    public function __construct() {
        parent::__construct();
    }

    public function getDatos($correo)
    {
        $sql = "SELECT id_usuario,nombre,correo, clave FROM usuarios WHERE correo ='$correo' ";
        return $this->select($sql);
    }
}
?>