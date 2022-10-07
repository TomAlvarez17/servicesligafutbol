<?php
require_once("../config/conexion.php");
require_once("../models/Liga.php");
$liga = new Liga();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

    case "GetAllPartido":
        $datos = $liga->get_partidos();
        echo json_encode($datos);
        break;

    // case "GetId":
    //     $datos = $liga->get_heroe_x_id($body["heroe_id"]);
    //     echo json_encode($datos);
    //     break;

    case "InsertPartido":
        $datos = $liga->insert_partido($body["arbitro"], $body["local"], $body["visita"]);
        echo json_encode($datos);
        break;

    // case "Update":
    //     $datos = $liga->update_heroe($body["id"], $body["nombre"], $body["imagen"], $body["descripcion"], $body["categoria"], $body["genero"]);
    //     echo json_encode($datos);
    //     break;

    // case "Delete":
    //     $datos = $liga->delete_heroe($body["id"]);
    //     echo json_encode($datos);
    //     break;

    case "Login":
        $datos = $liga->login($body["user"], $body["password"]);
        echo json_encode($datos);
        break;
}
