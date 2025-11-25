<?php
require_once '../app/db.php';

class PasienModel {
    private $conn;
    private $table = 'pasien';

    public function __construct() {
        $db = db::getInstance();
        $this->conn = $db->getConnection();
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " ORDER BY id_pasien DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_pasien = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                  (nama_pasien, jenis_kelamin, umur, alamat, no_hp) 
                  VALUES (:nama, :jenis_kelamin, :umur, :alamat, :no_hp)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':jenis_kelamin', $data['jenis_kelamin']);
        $stmt->bindParam(':umur', $data['umur']);
        $stmt->bindParam(':alamat', $data['alamat']);
        $stmt->bindParam(':no_hp', $data['no_hp']);
        
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " 
                  SET nama_pasien = :nama, jenis_kelamin = :jenis_kelamin, 
                      umur = :umur, alamat = :alamat, no_hp = :no_hp 
                  WHERE id_pasien = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama', $data['nama']);
        $stmt->bindParam(':jenis_kelamin', $data['jenis_kelamin']);
        $stmt->bindParam(':umur', $data['umur']);
        $stmt->bindParam(':alamat', $data['alamat']);
        $stmt->bindParam(':no_hp', $data['no_hp']);
        
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id_pasien = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function count() {
        $query = "SELECT COUNT(*) as total FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $result = $stmt->fetch();
        return $result['total'];
    }
}
?>