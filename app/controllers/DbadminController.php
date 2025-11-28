<?php
require_once '../app/models/ReportModel.php';

class DbadminController {
    private $model;

    public function __construct() {
        $this->model = new ReportModel();
    }

    public function matview() {
        $data = $this->model->getMatViewData();
        require_once '../app/views/matview/list.php';
    }

    public function laporan() {
        $type = $_GET['type'] ?? 'pasien';
        $data = [];
        
        switch($type) {
            case 'pasien':
                $data = $this->model->getLaporanPasien();
                break;
            case 'janji':
                $data = $this->model->getLaporanJanji();
                break;
            case 'obat':
                $data = $this->model->getLaporanObat();
                break;
            case 'dokter':
            $data = $this->model->getLaporanDokter();
                break;
            case 'penyakit':
                $data = $this->model->getLaporanPenyakit();
                break;
            case 'statistik':
                $data = $this->model->getStatistikPasien();
                break;
            default:
                $data = []; 
        }
        
        require_once '../app/views/laporan/index.php';
    }
}
?>