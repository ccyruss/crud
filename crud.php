<?php
// Crud Class ------------------------------------------ 
class Crud {
    protected $conn;

    public function __construct($conn) {
        $this->conn = $database->getConnection();
    }

    // Insert ------------------------------------------
    public function insert($table, $data) {

        $keys = implode(",", array_keys($data));
        $values = ":" . implode(", :", $data);

        $sql = "INSERT INTO ($keys) VALUES ($values)";
        $stmt = $this->conn->prepare($sql);
        foreach($data as $key => $value) {
            $stmt->bindParam(":$key", $value);
        }

        return $stmt->execute();

    }

    // Select ------------------------------------------
    public function select($table, $conditions) {

        if($conditions == null) {
            $sql = "SELECT * FROM `$table`";
        }else {
            $sql .= " $conditions";
        }

        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }


    // Delete ------------------------------------------
    public function delete($table, $conditions) {
        $sql = "DELETE FROM `$table` WHERE $conditions";
        
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute();
    }

    // Update ------------------------------------------
    public function update($table, $data, $conditions) {

        $set = '';
        foreach ($data as $key => $value) {
            $set .= "$key = :$key, ";
        }
        $set = rtrim($set, ', ');

        $sql = "UPDATE $table SET $set WHERE $conditions";
        $stmt = $this->conn->prepare($sql);

        foreach ($data as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }
}

?>
