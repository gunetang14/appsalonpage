<?php

namespace Controllers;

use MVC\Router;

#[\AllowDynamicProperties]
class AppointmentController{

    public static function index(Router $router){
        
        isAuth();

        $router->render('/citas/index',[
            'nombre' => $_SESSION['nombre'],
            'id' => $_SESSION['id']
        ]);
    }

}




?>