<?php

include "Device.php";

class DeviceRepository {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    private function read($row) {
        $result = new Device();
        $result->id = $row["id"];
        $result->serial = $row["serial"];
        $result->cathedraid = $row["cathedraid"];
        return $result;
    }

    public function getById($id) {
        $sql = "SELECT * FROM devices WHERE id = :id";
        $q = $this->db->prepare($sql);
        $q->bindParam(":id", $id, PDO::PARAM_INT);
        $q->execute();
        $rows = $q->fetchAll();
        return $this->read($rows[0]);
    }

    public function getAll($filter) {
        $serial = "%" . $filter["serial"] . "%";
        $cathedraid = $filter["cathedraid"];
        if ($cathedraid != 0) {
            $sql = "SELECT * FROM devices WHERE serial LIKE :serial AND (:cathedraid = 0 OR cathedraid = :cathedraid)";
            $q = $this->db->prepare($sql);
            $q->bindParam(":serial", $serial);
            $q->bindParam(":cathedraid", $cathedraid);
       } else {
            $sql = "SELECT * FROM devices";
            $q = $this->db->prepare($sql);
        }

//        $q->debugDumpParams();

        $q->execute();
        $rows = $q->fetchAll();

        $result = array();
        foreach($rows as $row) {
            array_push($result, $this->read($row));
        }
        return $result;
    }

    public function insert($data) {
        $sql = "INSERT INTO devices (serial, cathedraid) VALUES (:serial, :cathedraid)";
        $q = $this->db->prepare($sql);
        $q->bindParam(":serial", $data["serial"]);
        $q->bindParam(":cathedraid", $data["cathedraid"], PDO::PARAM_INT);
        $q->execute();
        return $this->getById($this->db->lastInsertId());
    }

    public function update($data) {
        $sql = "UPDATE devices SET serial = :serial, cathedraid = :cathedraid WHERE id = :id";
        $q = $this->db->prepare($sql);
        $q->bindParam(":serial", $data["serial"]);
        $q->bindParam(":cathedraid", $data["cathedraid"], PDO::PARAM_INT);
        $q->bindParam(":id", $data["id"], PDO::PARAM_INT);
        $q->execute();
    }

    public function remove($id) {
        $sql = "DELETE FROM devices WHERE id = :id";
        $q = $this->db->prepare($sql);
        $q->bindParam(":id", $id, PDO::PARAM_INT);
        $q->execute();
    }

}

?>