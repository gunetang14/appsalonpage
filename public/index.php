<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\APIController;
use Controllers\AppointmentController;
use MVC\Router;
use Controllers\LoginController;
use Controllers\ServiceController;

$router = new Router();

//home
$router->get('/', [LoginController::class, 'home']);

//login
$router->get('/login', [LoginController::class, 'login']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);

//Recuperar Password
$router->get('/forgot', [LoginController::class, 'forgot']);
$router->post('/forgot', [LoginController::class, 'forgot']);
$router->get('/reset', [LoginController::class, 'reset']);
$router->post('/reset', [LoginController::class, 'reset']);

//Crear cuenta
$router->get('/signup', [LoginController::class, 'signup']);
$router->post('/signup', [LoginController::class, 'signup']);

//Confirmar cuenta
$router->get('/confirm', [LoginController::class, 'confirm']);
$router->get('/message', [LoginController::class, 'message']);

//Pagina de Error
$router->get('/404', [LoginController::class, 'error']);

//Area Privada
$router->get('/appointment', [AppointmentController::class, 'index']);
$router->get('/admin', [AdminController::class, 'index']);

//API
$router->get('/api/servicios', [APIController::class, 'index']);
$router->post('/api/citas', [APIController::class, 'save']);
$router->post('/api/delete', [APIController::class, 'delete']);

//CRUD Servicios
$router->get('/services', [ServiceController::class, 'index']);
$router->get('/services/create', [ServiceController::class, 'create']);
$router->post('/services/create', [ServiceController::class, 'create']);
$router->get('/services/update', [ServiceController::class, 'update']);
$router->post('/services/update', [ServiceController::class, 'update']);
$router->post('/services/delete', [ServiceController::class, 'delete']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();