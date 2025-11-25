<?php
require_once '../app/models/ReportModel.php';

class HomeController {
    private $reportModel;

    public function __construct() {
        $this->reportModel = new ReportModel();
    }

    public function dashboard() {
        $stats = $this->reportModel->getDashboardStats();
        require_once '../app/views/home/dashboard.php';
    }
}
?>
