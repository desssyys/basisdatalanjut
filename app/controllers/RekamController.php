<?php
require_once '../app/models/RekamModel.php';
require_once '../app/models/PasienModel.php';
require_once '../app/models/DokterModel.php';
require_once '../app/models/ObatModel.php';

class RekamController {
    private $model;
    private $pasienModel;
    private $dokterModel;
    private $obatModel;

    public function __construct() {
        $this->model = new RekamModel();
        $this->pasienModel = new PasienModel();
        $this->dokterModel = new DokterModel();
        $this->obatModel = new ObatModel();
    }

    public function index() {
        $rekam = $this->model->getAll();
        require_once '../app/views/rekam/list.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'pasien_id' => $_POST['pasien_id'],
                'dokter_id' => $_POST['dokter_id'],
                'obat_id' => $_POST['obat_id'],
                'diagnosis' => $_POST['diagnosis'],
                'tanggal' => $_POST['tanggal']
            ];
            
            if ($this->model->create($data)) {
                header('Location: ' . BASE_URL . 'index.php?page=rekam');
                exit;
            }
        }
        
        $pasien = $this->pasienModel->getAll();
        $dokter = $this->dokterModel->getAll();
        $obat = $this->obatModel->getAll();
        require_once '../app/views/rekam/form.php';
    }

    public function edit() {
        $id = $_GET['id'];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'pasien_id' => $_POST['pasien_id'],
                'dokter_id' => $_POST['dokter_id'],
                'obat_id' => $_POST['obat_id'],
                'diagnosis' => $_POST['diagnosis'],
                'tanggal' => $_POST['tanggal']
            ];
            
            if ($this->model->update($id, $data)) {
                header('Location: ' . BASE_URL . 'index.php?page=rekam');
                exit;
            }
        }
        
        $rekam = $this->model->getById($id);
        $pasien = $this->pasienModel->getAll();
        $dokter = $this->dokterModel->getAll();
        $obat = $this->obatModel->getAll();
        require_once '../app/views/rekam/form.php';
    }

    public function delete() {
        $id = $_GET['id'];
        $this->model->delete($id);
        header('Location: ' . BASE_URL . 'index.php?page=rekam');
        exit;
    }
}
?>