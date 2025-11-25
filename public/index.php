<?php
require_once '../app/config.php';

// Get page and action
$page = $_GET['page'] ?? 'login';
$action = $_GET['action'] ?? 'index';

// Route to controllers
switch ($page) {
    case 'login':
        require_once '../app/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->login();
        break;
        
    case 'logout':
        require_once '../app/controllers/AuthController.php';
        $controller = new AuthController();
        $controller->logout();
        break;
        
    case 'dashboard':
        require_once '../app/controllers/HomeController.php';
        $controller = new HomeController();
        $controller->dashboard();
        break;
        
    case 'pasien':
        require_once '../app/controllers/PasienController.php';
        $controller = new PasienController();
        
        switch ($action) {
            case 'create':
                $controller->create();
                break;
            case 'edit':
                $controller->edit();
                break;
            case 'delete':
                $controller->delete();
                break;
            default:
                $controller->index();
        }
        break;
        
    case 'dokter':
        require_once '../app/controllers/DokterController.php';
        $controller = new DokterController();
        
        switch ($action) {
            case 'create':
                $controller->create();
                break;
            case 'edit':
                $controller->edit();
                break;
            case 'delete':
                $controller->delete();
                break;
            default:
                $controller->index();
        }
        break;
        
    case 'obat':
        require_once '../app/controllers/ObatController.php';
        $controller = new ObatController();
        
        switch ($action) {
            case 'create':
                $controller->create();
                break;
            case 'edit':
                $controller->edit();
                break;
            case 'delete':
                $controller->delete();
                break;
            default:
                $controller->index();
        }
        break;
        
    case 'janji':
        require_once '../app/controllers/JanjiController.php';
        $controller = new JanjiController();
        
        switch ($action) {
            case 'create':
                $controller->create();
                break;
            case 'edit':
                $controller->edit();
                break;
            case 'delete':
                $controller->delete();
                break;
            default:
                $controller->index();
        }
        break;
        
    case 'rekam':
        require_once '../app/controllers/RekamController.php';
        $controller = new RekamController();
        
        switch ($action) {
            case 'create':
                $controller->create();
                break;
            case 'edit':
                $controller->edit();
                break;
            case 'delete':
                $controller->delete();
                break;
            default:
                $controller->index();
        }
        break;
        
    case 'matview':
        require_once '../app/controllers/DbadminController.php';
        $controller = new DbadminController();
        $controller->matview();
        break;
        
    case 'laporan':
        require_once '../app/controllers/DbadminController.php';
        $controller = new DbadminController();
        $controller->laporan();
        break;
        
    default:
        header('Location: ' . BASE_URL . 'index.php?page=login');
        exit;
}
?>
