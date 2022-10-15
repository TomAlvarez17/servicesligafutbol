<?php
require_once("../config/conexion.php");
require_once("../models/Liga.php");
$liga = new Liga();

$body = json_decode(file_get_contents("php://input"), true);

switch ($_GET["opcion"]) {

        // --------------------------------------------------------- Jugadores ----------------------------------------------------------------------------
    case "GetAllJugador":
        $datos = $liga->get_jugadores();
        echo json_encode($datos);
        break;

        // --------------------------------------------------------- Partidos ----------------------------------------------------------------------------
    case "GetAllPartido":
        $datos = $liga->get_partidos();
        echo json_encode($datos);
        break;

        // --------------------------------------------------------- Arbitros ----------------------------------------------------------------------------
    case "GetAllArbitro":
        $datos = $liga->get_arbitros();
        echo json_encode($datos);
        break;

    case "GetIdArbitro":
        $datos = $liga->get_arbitro_x_id($body["arbitro_id"]);
        echo json_encode($datos);
        break;

    case "InsertArbitro":
        $datos = $liga->insert_arbitro($body["nombre"], $body["apellidos"], $body["contacto"], $body["email"], $body["fecha"], $body["posicion"]);
        echo json_encode($datos);
        break;

    case "UpdateArbitro":
        $datos = $liga->update_arbitro($body["id"],$body["nombre"], $body["apellidos"], $body["contacto"], $body["email"], $body["fecha"], $body["posicion"]);
        echo json_encode($datos);
        break;

    case "DeleteArbitro":
        $datos = $liga->delete_arbitro($body["id"]);
        echo json_encode($datos);
        break;

        // --------------------------------------------------------- Torneos ----------------------------------------------------------------------------
    case "GetAllTorneo":
        $datos = $liga->get_torneos();
        echo json_encode($datos);
        break;

    case "GetIdTorneo":
        $datos = $liga->get_torneo_x_id($body["torneo_id"]);
        echo json_encode($datos);
        break;

    case "InsertTorneo":
        $datos = $liga->insert_torneo($body["nombre"], $body["fechai"], $body["fechaf"]);
        echo json_encode($datos);
        break;

    case "UpdateTorneo":
        $datos = $liga->update_torneo($body["id"], $body["nombre"], $body["fechai"], $body["fechaf"]);
        echo json_encode($datos);
        break;

    case "DeleteTorneo":
        $datos = $liga->delete_torneo($body["id"]);
        echo json_encode($datos);
        break;

        // --------------------------------------------------------- Equipos ----------------------------------------------------------------------------
    case "GetAllEquipo":
        $datos = $liga->get_equipos();
        echo json_encode($datos);
        break;

    case "GetIdEquipo":
        $datos = $liga->get_equipo_x_id($body["equipo_id"]);
        echo json_encode($datos);
        break;

    case "InsertEquipo":
        $datos = $liga->insert_equipo($body["nombre"], $body["logo"]);
        echo json_encode($datos);
        break;

    case "UpdateEquipo":
        $datos = $liga->update_equipo($body["id"], $body["nombre"], $body["logo"]);
        echo json_encode($datos);
        break;

    case "DeleteEquipo":
        $datos = $liga->delete_equipo($body["id"]);
        echo json_encode($datos);
        break;


        // --------------------------------------------------------------- Login ----------------------------------------------------------------------------------
    case "Login":
        $datos = $liga->login($body["user"], $body["password"]);
        echo json_encode($datos);
        break;
}
