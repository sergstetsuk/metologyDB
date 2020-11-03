<?php

include "status.php";

class statusRepository {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    private function read($row) {
        $result = new status();
        $result->id = $row["id"];
        $result->name = $row["name"];
        return $result;
    }

    public function getAll() {
        $sql = "SELECT * FROM statuses";
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
