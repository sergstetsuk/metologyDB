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
        $result->cathedraid = $row["cathedraid"];
        $result->typeid = $row["typeid"];
        $result->modelid = $row["modelid"];
        $result->serial = $row["serial"];
        $result->datemanufacture = $row["datemanufacture"];
        $result->dateaccept = $row["dateaccept"];
        $result->statusid = $row["statusid"];
        $result->lastverify = $row["lastverify"];
        $result->nextverify = $row["nextverify"];
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
        $typeid = $filter["typeid"];
        $modelid = $filter["modelid"];
        $statusid = $filter["statusid"];
        //print_r($filter);
        $sql = "SELECT *, lastverify as nextverify FROM devices";
	$sql .= " LEFT JOIN devicemodels ON devicemodels.id = devices.modelid";
	$sql .=	" WHERE serial LIKE :serial";
        if ($cathedraid != 0)
	    $sql .= " AND cathedraid = :cathedraid";
        if ($typeid != 0)
	    $sql .= " AND typeid = :typeid";
        if ($modelid != 0)
	    $sql .= " AND modelid = :modelid";
        if ($statusid != 0)
	    $sql .= " AND statusid = :statusid";

        $q = $this->db->prepare($sql);

	$q->bindParam(":serial", $serial);
        if ($cathedraid != 0)
	    $q->bindParam(":cathedraid", $cathedraid);
        if ($typeid != 0)
	    $q->bindParam(":typeid", $typeid);
        if ($modelid != 0)
	    $q->bindParam(":modelid", $modelid);
        if ($statusid != 0)
	    $q->bindParam(":statusid", $statusid);


        $q->execute();
        $rows = $q->fetchAll();

        $result = array();
        foreach($rows as $row) {
            array_push($result, $this->read($row));
        }
 //       $result["debug"] = $q->debugDumpParams();
        return $result;
    }

    public function insert($data) {
        $sql = "INSERT INTO devices (serial, statusid, cathedraid) VALUES (:serial, :statusid, :cathedraid)";
        $q = $this->db->prepare($sql);
        $q->bindParam(":serial", $data["serial"]);
        $q->bindParam(":statusid", $data["statusid"]);
        $q->bindParam(":cathedraid", $data["cathedraid"], PDO::PARAM_INT);
        $q->execute();
        return $this->getById($this->db->lastInsertId());
    }

    public function update($data) {
        $sql = "UPDATE devices SET status = :status, serial = :serial, cathedraid = :cathedraid WHERE id = :id";
        $q = $this->db->prepare($sql);
        $q->bindParam(":serial", $data["serial"]);
        $q->bindParam(":status", $data["status"]);
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
