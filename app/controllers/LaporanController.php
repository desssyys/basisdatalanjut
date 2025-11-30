<?php

require_once __DIR__ . '/../controllers/LaporanController.php';
require_once __DIR__ . '/../models/LaporanModel.php';

class LaporanController extends Controller {
    private $laporanModel;

    public function __construct()
    {
        $this->laporanModel = $this->model('LaporanModel');
    }

    public function index($type = 'pasien')
    {
        switch ($type) {
            case 'pasien':
                $data = $this->laporanModel->getLaporanPasien();
                break;

            case 'janji':
                $data = $this->laporanModel->getLaporanJanji();
                break;

            case 'obat':
                $data = $this->laporanModel->getLaporanObat();
                break;

            case 'dokter':
                $data = $this->laporanModel->getLaporanDokter();
                break;

            case 'penyakit':
                $data = $this->laporanModel->getLaporanPenyakit();
                break;

            case 'statistik':
                $data = $this->laporanModel->getStatistikPasien();
                break;

            default:
                $data = [];
        }

        $this->view('laporan/laporan', [
            'type' => $type,
            'data' => $data
        ]);
    }
}
 