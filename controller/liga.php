<?php
require_once("../config/conexion.php");
require_once("../models/Liga.php");
$liga = new Liga();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

// Partidos

    case "GetAllPartido":
        $datos = $liga->get_partidos();
        echo json_encode($datos);
        break;

    case "GetIdPartido":
        $datos = $liga->get_partido_x_id($body["partido_id"]);
        echo json_encode($datos);
        break;

    case "InsertPartido":
        $datos = $liga->insert_partido($body["arbitro"], $body["local"], $body["visita"]);
        echo json_encode($datos);
        break;

    case "UpdatePartido":
        $datos = $liga->update_partido($body["id"], $body["arbitro"], $body["local"], $body["visita"]);
        echo json_encode($datos);
        break;

    case "DeletePartido":
        $datos = $liga->delete_partido($body["id"]);
        echo json_encode($datos);
        break;

// ------------------------------------------------------ Equipo

    case "GetAllEquipo":
        $datos = $liga->get_equipos();
        echo json_encode($datos);
        break;

    case "GetIdEquipo":
        $datos = $liga->get_equipo_x_id($body["equipo_id"]);
        echo json_encode($datos);
        break;

    case "InsertEquipo":
        $datos = $liga->insert_equipo($body["nombre"], $body["jugador"]);
        echo json_encode($datos);
        break;

    case "UpdateEquipo":
        $datos = $liga->update_equipo($body["id"], $body["nombre"], $body["jugador"]);
        echo json_encode($datos);
        break;

    case "DeleteEquipo":
        $datos = $liga->delete_equipo($body["id"]);
        echo json_encode($datos);
        break;


// --------------------------------------------------------------- Login
    case "Login":
        $datos = $liga->login($body["user"], $body["password"]);
        echo json_encode($datos);
        break;
}
