<?php
require_once '../app/models/ObatModel.php';

class ObatController {
    private $model;

    public function __construct() {
        $this->model = new ObatModel();
    }

    public function index() {
        $obat = $this->model->getAll();
        require_once '../app/views/obat/list.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nama' => $_POST['nama'],
                'harga' => $_POST['harga'],
                'stok' => $_POST['stok']
            ];
            
            if ($this->model->create($data)) {
                header('Location: ' . BASE_URL . 'index.php?page=obat');
                exit;
            }
        }
        require_once '../app/views/obat/form.php';
    }

    public function edit() {
        $id = $_GET['id'];
        
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'nama' => $_POST['nama'],
                'harga' => $_POST['harga'],
                'stok' => $_POST['stok']
            ];
            
            if ($this->model->update($id, $data)) {
                header('Location: ' . BASE_URL . 'index.php?page=obat');
                exit;
            }
        }
        
        $obat = $this->model->getById($id);
        require_once '../app/views/obat/form.php';
    }

    public function delete() {
        $id = $_GET['id'];
        $this->model->delete($id);
        header('Location: ' . BASE_URL . 'index.php?page=obat');
        exit;
    }
}
?>