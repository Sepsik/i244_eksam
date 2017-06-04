<?php
require_once('function.php');
session_start();
connect_db();


$page="start";
if (isset($_GET['page']) && $_GET['page']!=""){
    $page=htmlspecialchars($_GET['page']);
}


switch($page){
    case "logout":
        logout();
        toIndexPage();
        break;
    default:
        include_once($page . '.php');
        break;
}

?>