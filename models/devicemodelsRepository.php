<?php

include "devicemodels.php";

class devicemodelsRepository {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    private function read($row) {
        $result = new devicemodels();
        $result->id = $row["id"];
        $result->name = $row["name"];
        return $result;
    }

    public function getAll() {
        $sql = "SELECT * FROM devicemodels";
        $q = $this->db->prepare($sql);
        $q->execute([]);
        $rows = $q->fetchAll();

        $result = array();
        foreach($rows as $row) {
            array_push($result, $this->read($row));
        }
        return $result;
    }

}

?>
