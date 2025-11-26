<?php
require_once '../app/models/DokterModel.php';

class DokterController {
    private $model;

    public function __construct() {
        $this->model = new DokterModel();
    }

    public function index() {

        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $keyword = $_GET['search'];
            $dokter = $this->model->search($keyword);
        } else {
            $dokter = $this->model->getAll();
        }

        require_once '../app/views/dokter/list.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nama' => $_POST['nama'],
                'no_hp' => $_POST['no_hp'],
                'spesialisasi' => $_POST['spesialisasi'],
                'email' => $_POST['email']
            ];
            
            if ($this->model->create($data)) {
                header('Location: ' . BASE_URL . 'index.php?page=dokter');
                exit;
            }
        }
        
        $spesialisasi = $this->model->getSpesialisasi();
        require_once '../app/views/dokter/form.php';
    }

    public function edit() {
        $id = $_GET['id'];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nama' => $_POST['nama'],
                'no_hp' => $_POST['no_hp'],
                'spesialisasi' => $_POST['spesialisasi'],
                'email' => $_POST['email']
            ];
            
            if ($this->model->update($id, $data)) {
                header('Location: ' . BASE_URL . 'index.php?page=dokter');
                exit;
            }
        }
        
        $dokter = $this->model->getById($id);
        $spesialisasi = $this->model->getSpesialisasi();
        require_once '../app/views/dokter/form.php';
    }

    public function delete() {
        $id = $_GET['id'];
        $this->model->delete($id);
        header('Location: ' . BASE_URL . 'index.php?page=dokter');
        exit;
    }
}
?>
