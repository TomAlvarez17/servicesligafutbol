<?php
class Liga extends Conectar
{

    //------------------------------------------------------------- Login --------------------------------------------------------------------------
    public function login($user, $password)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT id FROM login WHERE `user` = ? AND `password` = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $user);
        $sql->bindValue(2, $password);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'id' => (int)$resultado->id
        ] : ['id' => 0];
        return $Array;
    }

    // ------------------------------------------------------------------- Jugador ----------------------------------------------------------------------------------------

    public function get_jugadores()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM `vistaequipo`;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }


    // ------------------------------------------------------------------- Partidos ----------------------------------------------------------------------------------------

    public function get_partidos()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM `vistapartido`;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        return $resultado;
    }

    // ------------------------------------------------------------------- Arbitro ----------------------------------------------------------------------------------------

    public function get_arbitros()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM `arbitro`;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'id' => (int)$d->id, 'nombre' => $d->nombre, 'apellidos' => $d->apellidos, 'contacto' => $d->contacto, 'email' => $d->email,
                 'fecha' => $d->fecha, 'posicion' => $d->posicion
            ];
        }
        return $Array;
    }

    public function get_arbitro_x_id($arbitro_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM `arbitro` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $arbitro_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'id' => (int)$resultado->id, 'nombre' => $resultado->nombre, 'apellidos' => $resultado->apellidos, 'contacto' => $resultado->contacto, 'email' => $resultado->email,
                 'fecha' => $resultado->fecha, 'posicion' => $resultado->posicion
        ] : [];
        return $resultado;
    }

    public function insert_arbitro($nombre, $apellidos, $contacto, $email, $fecha, $posicion)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `arbitro`(`nombre`, `apellidos`, `contacto`, `email`, `fecha`, `posicion`) VALUES (?,?,?,?,?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $apellidos);
        $sql->bindValue(3, $contacto);
        $sql->bindValue(4, $email);
        $sql->bindValue(5, $fecha);
        $sql->bindValue(6, $posicion);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_arbitro($id, $nombre, $apellidos, $contacto, $email, $fecha, $posicion)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `arbitro` SET `nombre`= ?, `apellidos`= ?, `contacto`= ?, `email`= ?, `fecha`= ?, `posicion`= ? WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $apellidos);
        $sql->bindValue(3, $contacto);
        $sql->bindValue(4, $email);
        $sql->bindValue(5, $fecha);
        $sql->bindValue(6, $posicion);
        $sql->bindValue(7, $id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_arbitro($id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `arbitro` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    // ------------------------------------------------------------------- Torneo ----------------------------------------------------------------------------------------

    public function get_torneos()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM `torneo`;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'id' => (int)$d->id, 'nombre' => $d->nombre, 'fechai' => $d->fechai, 'fechaf' => $d->fechaf
            ];
        }
        return $Array;
    }

    public function get_torneo_x_id($torneo_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM `torneo` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $torneo_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'id' => (int)$resultado->id, 'nombre' => $resultado->nombre, 'fechai' => $resultado->fechai, 'fechaf' => $resultado->fechaf
        ] : [];
        return $resultado;
    }

    public function insert_torneo($nombre, $fechai, $fechaf)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `torneo`(`nombre`, `fechai`,`fechaf`) VALUES (?,?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $fechai);
        $sql->bindValue(3, $fechaf);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_torneo($id,$nombre, $fechai, $fechaf)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `torneo` SET `nombre`= ?, `fechai`= ?, `fechaf`= ? WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $fechai);
        $sql->bindValue(3, $fechaf);
        $sql->bindValue(4, $id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_torneo($id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `torneo` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }
    // ------------------------------------------------------------------- Equipos ----------------------------------------------------------------------------------------

    public function get_equipos()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM `equipo`;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'id' => (int)$d->id, 'nombre' => $d->nombre, 'logo' => $d->logo
            ];
        }
        return $Array;
    }

    public function get_equipo_x_id($equipo_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM `equipo` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $equipo_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'id' => (int)$resultado->id, 'nombre' => $resultado->nombre, 'logo' => $resultado->logo
        ] : [];
        return $resultado;
    }

    public function insert_equipo($nombre, $logo)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `equipo`(`nombre`, `logo`) VALUES (?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $logo);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_equipo($id,$nombre, $logo)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `equipo` SET `nombre`= ?, `logo`= ? WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $logo);
        $sql->bindValue(3, $id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_equipo($id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `equipo` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }
}
