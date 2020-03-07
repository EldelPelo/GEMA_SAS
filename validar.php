<?php
    require_once("/opt/lampp/htdocs/GEMA/inc/usuarios.php");
    require_once("/opt/lampp/htdocs/GEMA/inc/tools.php");
    $doc = (isset($_FILES['miArchivo'])) ? $_FILES['miArchivo'] : null;
    $nombre = $doc['name'];
    if($doc){
        $ruta = "/opt/lampp/htdocs/GEMA/subidos/{$doc['name']}";
        $archivosubido = move_uploaded_file($doc['tmp_name'], $ruta);
    }
    $archivo = "/opt/lampp/htdocs/GEMA/subidos/{$nombre}";
    $fp = fopen($archivo, "r");
    $arreglo = array();
    $validador = array();
    $arreglovalido = 1;
    while(!feof($fp)){
        $linea = fgets($fp);
        $arreglo = explode(",", $linea);
        array_push($validador, $arreglo[3]);
    }
    fclose($fp);
    foreach($validador as &$valor){
        $intvalor = (int)$valor;
        if($intvalor<1 || $intvalor>3){
            $arreglovalido = 0;
            break;
        }
    }
    if($arreglovalido == 1){
        $fp = fopen($archivo, "r");
        $matrizUsuarios = array();
        while(!feof($fp)){
            $linea = fgets($fp);
            $arreglo = explode(",", $linea);
            array_push($matrizUsuarios ,$arreglo);
        }
        fclose($fp);
        $usuario = new usuarios();
        foreach($matrizUsuarios as &$valorMatriz){
            $cnslt = $usuario->insertar($valorMatriz[0], $valorMatriz[1],
            $valorMatriz[2], (int)$valorMatriz[3]);
        }
        $hrm = new tools();
        echo "<br>Activos<br>";
        $usuario->ID = 1;
        $hrm->mostarTabla($usuario->filtrar());
        echo "<br>Pasivos<br>";
        $usuario->ID = 2;
        $hrm->mostarTabla($usuario->filtrar());
        echo "<br>Por activar<br>";
        $usuario->ID = 3;
        $hrm->mostarTabla($usuario->filtrar());
        $cnslt = $usuario->eliminarInfo();
    }
?>