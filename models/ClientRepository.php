<?php

include "Client.php";

class ClientRepository {

    protected $db;

    public function __construct(PDO $db) {
        $this->db = $db;
    }

    private function read($row) {
        $result = new Device();
        $result->id = $row["id"];
        $result->name = $row["name"];
        $result->age = $row["age"];
        $result->date = $row["date"];
        $result->married = $row["married"] == 1 ? true : false;
        $result->cathedra_id = $row["cathedra_id"];
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
        $name = "%" . $filter["name"] . "%";
        $address = "%" . $filter["date"] . "%";
        $cathedra_id = $filter["cathedra_id"];

        $sql = "SELECT * FROM devices WHERE name LIKE :name AND date LIKE :date AND (:cathedra_id = 0 OR cathedra_id = :cathedra_id)";
        $q = $this->db->prepare($sql);
        $q->bindParam(":name", $name);
        $q->bindParam(":date", $date);
        $q->bindParam(":cathedra_id", $cathedra_id);
        $q->execute();
        $rows = $q->fetchAll();

        $result = array();
        foreach($rows as $row) {
            array_push($result, $this->read($row));
        }
        return $result;
    }

    public function insert($data) {
        $sql = "INSERT INTO devices (name, age, date, married, cathedra_id) VALUES (:name, :age, :date, :married, :cathedra_id)";
        $q = $this->db->prepare($sql);
        $q->bindParam(":name", $data["name"]);
        $q->bindParam(":age", $data["age"], PDO::PARAM_INT);
        $q->bindParam(":date", $data["date"]);
        $q->bindParam(":married", $data["married"], PDO::PARAM_INT);
        $q->bindParam(":cathedra_id", $data["cathedra_id"], PDO::PARAM_INT);
        $q->execute();
        return $this->getById($this->db->lastInsertId());
    }

    public function update($data) {
        $sql = "UPDATE devices SET name = :name, age = :age, date = :date, married = :married, cathedra_id = :cathedra_id WHERE id = :id";
        $q = $this->db->prepare($sql);
        $q->bindParam(":name", $data["name"]);
        $q->bindParam(":age", $data["age"], PDO::PARAM_INT);
        $q->bindParam(":date", $data["date"]);
        $q->bindParam(":married", $data["married"], PDO::PARAM_INT);
        $q->bindParam(":cathedra_id", $data["cathedra_id"], PDO::PARAM_INT);
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