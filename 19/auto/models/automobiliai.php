<?php

require_once $dir . '/models/db.php';

class Automobilis {
    public $id;
    public $numeris;
    public $greitis;
    public $vairuotojoId;


    static function all($limit, $offset) {
        $conn = connectDB();
        $sql = 'SELECT * FROM automobiliai ORDER BY numeris, data DESC';

        $result = $conn->query($sql);

        $automobiliai = [];
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $a = new Automobilis();
                $a->id = $row['id'];
                $a->numeris = $row['numeris'];
                $a->greitis = $row['greitis'];
                $a->vairuotojoId = $row['vairuotojoId'];
                $automobiliai[] = $a;
            }
        }
        return $automobiliai;
    }

    static function get($id) {
        if (!is_numeric($id)) return null;
        
        $conn = connectDB();
        $sql = 'SELECT * FROM automobiliai WHERE id = '.$id;
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            $a = new Automobilis();
            $a->id = $row['id'];
            $a->numeris = $row['numeris'];
            $a->greitis = $row['greitis'];
            $a->vairuotojoId = $row['vairuotojoId'];
            
            return $a;
        }
        return null;
    }
}

