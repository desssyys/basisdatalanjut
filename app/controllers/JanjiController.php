<?php
require_once '../app/models/JanjiModel.php';
require_once '../app/models/PasienModel.php';
require_once '../app/models/DokterModel.php';

class JanjiController {
    private $model;
    private $pasienModel;
    private $dokterModel;

    public function __construct() {
        $this->model = new JanjiModel();
        $this->pasienModel = new PasienModel();
        $this->dokterModel = new DokterModel();
    }

   public function index() {
        if (isset($_GET['search']) && !empty($_GET['search'])) {
            $keyword = $_GET['search'];
            $janji = $this->model->search($keyword);
        } else {
            $janji = $this->model->getAll();
        }

        require_once '../app/views/janji/list.php';
    }

    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'pasien_id' => $_POST['pasien_id'],
                'dokter_id' => $_POST['dokter_id'],
                'tanggal'   => $_POST['tanggal'],
                'jam'       => $_POST['jam']
            ];

            if ($this->model->create($data)) {
                header('Location: ' . BASE_URL . 'index.php?page=janji');
                exit;
            }
        }

        $pasien = $this->pasienModel->getAll();
        $dokter = $this->dokterModel->getAll();
        require_once '../app/views/janji/form.php';
    }

    public function edit() {
        $id = $_GET['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'pasien_id' => $_POST['pasien_id'],
                'dokter_id' => $_POST['dokter_id'],
                'tanggal'   => $_POST['tanggal'],
                'jam'       => $_POST['jam']
            ];

            if ($this->model->update($id, $data)) {
                header('Location: ' . BASE_URL . 'index.php?page=janji');
                exit;
            }
        }

        $janji = $this->model->getById($id);
        $pasien = $this->pasienModel->getAll();
        $dokter = $this->dokterModel->getAll();
        require_once '../app/views/janji/form.php';
    }

    public function delete() {
        $id = $_GET['id'];
        $this->model->delete($id);
        header('Location: ' . BASE_URL . 'index.php?page=janji');
        exit;
    }
}
?>
