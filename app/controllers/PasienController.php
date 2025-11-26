<?php
require_once '../app/models/PasienModel.php';

class PasienController {
    private $model;

    public function __construct() {
        $this->model = new PasienModel();
    }
    public function index() {
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $keyword = $_GET['search'];
            $pasien = $this->model->search($keyword);
        } else {
            $pasien = $this->model->getAll();
        }

        require_once '../app/views/pasien/list.php';
    }


    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nama' => $_POST['nama'],
                'jenis_kelamin' => $_POST['jenis_kelamin'],
                'umur' => $_POST['umur'],
                'alamat' => $_POST['alamat'],
                'no_hp' => $_POST['no_hp']
            ];
            
            if ($this->model->create($data)) {
                header('Location: ' . BASE_URL . 'index.php?page=pasien');
                exit;
            }
        }
        require_once '../app/views/pasien/form.php';
    }

    public function edit() {
        $id = $_GET['id'];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nama' => $_POST['nama'],
                'jenis_kelamin' => $_POST['jenis_kelamin'],
                'umur' => $_POST['umur'],
                'alamat' => $_POST['alamat'],
                'no_hp' => $_POST['no_hp']
            ];
            
            if ($this->model->update($id, $data)) {
                header('Location: ' . BASE_URL . 'index.php?page=pasien');
                exit;
            }
        }
        
        $pasien = $this->model->getById($id);
        require_once '../app/views/pasien/form.php';
    }

    public function delete() {
        $id = $_GET['id'];
        $this->model->delete($id);
        header('Location: ' . BASE_URL . 'index.php?page=pasien');
        exit;
    }
}
?>
