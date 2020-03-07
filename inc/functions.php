<meta charset="UTF-8">
<?php               

require_once("/opt/lampp/htdocs/GEMA/inc/config.php");

if(DEBUG == "true"){
    ini_set('display_errors', 1);
}else{
    ini_set('display_errors', 0);
}

require_once("tools.php");
require_once("usuarios.php");
?>