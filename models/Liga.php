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

//     public function get_heroe_x_id($heroe_id)
//     {
//         $conectar = parent::conexion();
//         parent::set_names();
//         $sql = "SELECT * FROM `heroes` WHERE id = ?;";
//         $sql = $conectar->prepare($sql);
//         $sql->bindValue(1, $heroe_id);
//         $sql->execute();
//         $resultado = $sql->fetch(PDO::FETCH_OBJ);
//         $Array = $resultado ? [
//             'id' => (int)$resultado->id, 'nombre' => $resultado->nombre,
//             'imagen' => $resultado->imagen, 'descripcion' => $resultado->descripcion,
//             'categoria' => $resultado->categoria, 'genero' => $resultado->genero,
//             'fecha' => $resultado->fecha
//         ] : [];
//         return $Array;
//     }

//     public function insert_heroe($nombre, $imagen, $descripcion, $categoria, $genero)
//     {
//         $conectar = parent::conexion();
//         parent::set_names();
//         $sql = "INSERT INTO `heroes`(`nombre`, `imagen`, `descripcion`,`categoria`,`genero`) VALUES (?,?,?,?,?);";
//         $sql = $conectar->prepare($sql);
//         $sql->bindValue(1, $nombre);
//         $sql->bindValue(2, $imagen);
//         $sql->bindValue(3, $descripcion);
//         $sql->bindValue(4, $categoria);
//         $sql->bindValue(5, $genero);
//         $resultado['estatus'] =  $sql->execute();
//         $lastInserId =  $conectar->lastInsertId();
//         if ($lastInserId != "0") {
//             $resultado['id'] = (int)$lastInserId;
//         }
//         return $resultado;
//     }

//     public function update_heroe($id, $nombre, $imagen, $descripcion, $categoria, $genero)
//     {
//         $conectar = parent::conexion();
//         parent::set_names();
//         $sql = "UPDATE `heroes` SET `nombre`= ?, `imagen`= ?, `descripcion`= ?, `categoria`= ?, `genero`= ? WHERE id = ?;";
//         $sql = $conectar->prepare($sql);
//         $sql->bindValue(1, $nombre);
//         $sql->bindValue(2, $imagen);
//         $sql->bindValue(3, $descripcion);
//         $sql->bindValue(4, $categoria);
//         $sql->bindValue(5, $genero);
//         $sql->bindValue(6, $id);
//         $resultado['estatus'] = $sql->execute();
//         return $resultado;
//     }

//     public function delete_heroe($id)
//     {
//         $conectar = parent::conexion();
//         parent::set_names();
//         $sql = "DELETE FROM `heroes` WHERE id = ?;";
//         $sql = $conectar->prepare($sql);
//         $sql->bindValue(1, $id);
//         $resultado['estatus'] = $sql->execute();
//         return $resultado;
//     }
}
