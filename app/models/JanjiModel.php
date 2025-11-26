<?php
require_once '../app/db.php';

class JanjiModel {
    private $conn;
    private $table = 'janji_temu';

    public function __construct() {
        $db = db::getInstance();
        $this->conn = $db->getConnection();
    }

    public function getAll() {
        $query = "SELECT j.*, p.nama_pasien, d.nama_dokter, s.nama_spesialisasi
                  FROM " . $this->table . " j
                  LEFT JOIN pasien p ON j.id_pasien = p.id_pasien
                  LEFT JOIN dokter d ON j.id_dokter = d.id_dokter
                  LEFT JOIN spesialisasi s ON d.id_spesialisasi = s.id_spesialisasi
                  ORDER BY j.tanggal ASC, j.jam ASC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    public function search($keyword) {
        $query = "SELECT 
                    j.id_janji_temu,
                    j.tanggal,
                    j.jam,
                    p.nama_pasien,
                    d.nama_dokter,
                    s.nama_spesialisasi
                FROM " . $this->table . " j
                LEFT JOIN pasien p ON j.id_pasien = p.id_pasien
                LEFT JOIN dokter d ON j.id_dokter = d.id_dokter
                LEFT JOIN spesialisasi s ON d.id_spesialisasi = s.id_spesialisasi
                WHERE 
                    LOWER(CAST(j.tanggal AS TEXT)) LIKE LOWER(:keyword)
                OR LOWER(CAST(j.jam AS TEXT)) LIKE LOWER(:keyword)
                OR LOWER(COALESCE(p.nama_pasien, '')) LIKE LOWER(:keyword)
                OR LOWER(COALESCE(d.nama_dokter, '')) LIKE LOWER(:keyword)
                OR LOWER(COALESCE(s.nama_spesialisasi, '')) LIKE LOWER(:keyword)
                ORDER BY j.id_janji_temu ASC";

        $stmt = $this->conn->prepare($query);
        $keyword = "%".$keyword."%";
        $stmt->bindParam(':keyword', $keyword);
        $stmt->execute();

        return $stmt->fetchAll();
    }


    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id_janji_temu = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch();
    }

    public function create($data) {
        $query = "INSERT INTO " . $this->table . " 
                  (id_pasien, id_dokter, tanggal, jam) 
                  VALUES (:pasien, :dokter, :tanggal, :jam)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':pasien', $data['pasien_id']);
        $stmt->bindParam(':dokter', $data['dokter_id']);
        $stmt->bindParam(':tanggal', $data['tanggal']);
        $stmt->bindParam(':jam', $data['jam']);
        
        return $stmt->execute();
    }

    public function update($id, $data) {
        $query = "UPDATE " . $this->table . " 
                  SET id_pasien = :pasien, id_dokter = :dokter, 
                      tanggal = :tanggal, jam = :jam 
                  WHERE id_janji_temu = :id";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':pasien', $data['pasien_id']);
        $stmt->bindParam(':dokter', $data['dokter_id']);
        $stmt->bindParam(':tanggal', $data['tanggal']);
        $stmt->bindParam(':jam', $data['jam']);
        
        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id_janji_temu = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
?>
