<?php

include_once '/opt/lampp/htdocs/GEMA/inc/functions.php';
include_once '/opt/lampp/htdocs/GEMA/inc/config.php';
class tools{
    
    function conexionBD(){
        $conexion = mysqli_connect(SERVER, USER, PASS, DB);
        if($conexion){
        }else{
            echo 'Ha ocurrido un error al conectar';
        }
        return $conexion;
    }
    
    function cerrarConexion($conexion){
        $close = mysqli_close($conexion);
        if($close){
        }else{
            echo 'No se ha podido cerrar la conexion';
        }
        return $close;
    }

    function obtenerArray($sql){
        $conexion = $this->conexionBD();
        if(!$resultado = mysqli_query($conexion, $sql)) die(mysqli_error($conexion));
        $rawdata = array();
        $i=0;
        while($row = mysqli_fetch_array($resultado)){
            $rawdata[$i] = $row;
            $i++;
        }
        $this->cerrarConexion($conexion);
        return $rawdata;
    }

    function mostarTabla($rawdata){
        echo '<table class="table table-striped table-bordered table-condensed">';
        $columnas = count($rawdata[0])/2;
        $filas = count($rawdata);
        echo "<br>".$filas."<br>";
        for($i=1;$i<count($rawdata[0]);$i=$i+2){
            next($rawdata[0]);
            echo "<th><b>".key($rawdata[0])."</b></th>";
            next($rawdata[0]);
        }
        for($i=0;$i<$filas;$i++){
            echo "<tr>";
            for($j=0;$j<$columnas;$j++){
                echo "<td>".$rawdata[$i][$j]."</td>";
            }
            echo "</tr>";
        }      
        echo '</table>';
    }
}
?>