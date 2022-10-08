<?php
class Liga extends Conectar
{

    //Login
    public function login($user, $password)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT id FROM usuarios WHERE `user` = ? AND `password` = ?;";
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

// Partidos

    public function get_partidos()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM `vistapartido`;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'partido' => (int)$d->id, 'equipolocal' => $d->local, 'equipovisitante' => $d->visita,
                'arbitro' => $d->arbitro
            ];
        }
        return $Array;
    }

    public function get_partido_x_id($partido_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM `vistapartido` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $partido_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'partido' => (int)$resultado->id, 'equipolocal' => $resultado->local, 'equipovisitante' => $resultado->visita,
                'arbitro' => $resultado->arbitro
        ] : [];
        return $Array;
    }

    public function insert_partido($arbitro, $local, $visita)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `vistapartido`(`arbitro`, `equipolocal`, `equipovisitante`) VALUES (?,?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $arbitro);
        $sql->bindValue(2, $local);
        $sql->bindValue(3, $visita);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_partido($id,$arbitro, $local, $visita)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `vistapartido` SET `arbitro`= ?, `equipolocal`= ?, `equipovisitante`= ? WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $arbitro);
        $sql->bindValue(2, $local);
        $sql->bindValue(3, $visita);
        $sql->bindValue(4, $id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_partido($id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `vistapartido` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

// -------------------------------------------------------------------Jugador

    public function get_jugadores()
    {
        $db = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM `vistaequipo`;";
        $sql = $db->prepare($sql);
        $sql->execute();
        $resultado = $sql->fetchAll(PDO::FETCH_OBJ);
        $Array = [];
        foreach ($resultado as $d) {
            $Array[] = [
                'equipo' => (int)$d->id, 'nombre' => $d->nombre, 'jugador' => $d->jugador
            ];
        }
        return $Array;
    }

    public function get_jugador_x_id($equipo_id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "SELECT * FROM `vistaequipo` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $equipo_id);
        $sql->execute();
        $resultado = $sql->fetch(PDO::FETCH_OBJ);
        $Array = $resultado ? [
            'equipo' => (int)$resultado->id, 'nombre' => $resultado->nombre, 'jugador' => $resultado->jugador
        ] : [];
        return $Array;
    }

    public function insert_jugador($nombre, $jugador)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "INSERT INTO `vistaequipo`(`nombre`, `jugador`) VALUES (?,?);";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $jugador);
        $resultado['estatus'] =  $sql->execute();
        $lastInserId =  $conectar->lastInsertId();
        if ($lastInserId != "0") {
            $resultado['id'] = (int)$lastInserId;
        }
        return $resultado;
    }

    public function update_jugador($id,$nombre, $jugador)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "UPDATE `vistaequipo` SET `nombre`= ?, `jugador`= ? WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $nombre);
        $sql->bindValue(2, $jugador);
        $sql->bindValue(3, $id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }

    public function delete_jugador($id)
    {
        $conectar = parent::conexion();
        parent::set_names();
        $sql = "DELETE FROM `vistaequipo` WHERE id = ?;";
        $sql = $conectar->prepare($sql);
        $sql->bindValue(1, $id);
        $resultado['estatus'] = $sql->execute();
        return $resultado;
    }
}
