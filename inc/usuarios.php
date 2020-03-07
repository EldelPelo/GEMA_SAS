<?php

include_once '/opt/lampp/htdocs/GEMA/inc/functions.php';

class usuarios{

    public $ID = 0;

    function insertar($email, $nombre, $apellido, $estado){
        
        $tool = new tools();
        $conexion = $tool->conexionBD();
        $sql = "insert into usuarios (email,nombre,apellido,estado) values 
        ('".$email."','".$nombre."','".$apellido."','".$estado."');";
        $consulta = mysqli_query($conexion,$sql);
        if($consulta){
        }else{
            echo "No se ha podido insertar a la base de datos.";
        }
        $tool->cerrarConexion($conexion);
        return $consulta;
        
    }

    function eliminarInfo(){
        $tool = new tools();
        $conexion = $tool->conexionBD();
        $sql = "TRUNCATE TABLE usuarios;";
        $consulta = mysqli_query($conexion,$sql);
        if($consulta){
        }else{
            echo "No se ha podido borrar la base de datos.";
        }
        $tool->cerrarConexion($conexion);
        return $consulta;
    }

    function filtrar(){
        $sql = "SELECT * FROM usuarios WHERE estado = $this->ID;";
        //obtenemos el array
        $tool = new tools();
        $arreglo = $tool->obtenerArray($sql);
        return $arreglo;
    }

    function obtenerInfo(){
        $sql = "SELECT * FROM usuarios;";
        $tool = new tools();
        $arreglo = $tool->obtenerArray($sql);
        return $arreglo;
    }
    
}

?>