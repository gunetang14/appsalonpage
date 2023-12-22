<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

#[\AllowDynamicProperties]
class LoginController{
    public static function home(router $router) {
        
        
        $router->render('/auth/home');
    }

    public static function login(router $router) {
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarLogin();
            if(empty($alertas)){
                //comprobar que exista el usuario
                $usuario = Usuario::where('email', $auth->email);
                if($usuario){
                    //verificar usuario
                    if($usuario->comprobarPasswordAndVerificado($auth->password)){
                        session_start();
                        $_SESSION['id'] = $usuario->id;
                        $_SESSION['nombre'] = $usuario->nombre . " ". $usuario->apellido;
                        $_SESSION['email'] = $usuario->email;
                        $_SESSION['login'] = true;

                        //redireccionamiento
                        if($usuario->admin === "1"){
                            $_SESSION['admin'] = $usuario->admin ?? null;
                            header('Location: /admin');
                        } else {
                            header('Location: /appointment');
                        }

                    }
                } else {
                    Usuario::setAlerta('error', 'Usuario no Encontrado');
                }
            }
        }
        $alertas = Usuario::getAlertas();
        $router->render('/auth/login', [
            'alertas' => $alertas
        ]);
    }

    public static function logout() {
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    public static function forgot(router $router) {
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validarEmail();
            if(empty($alertas)){
                $usuario = Usuario::where('email', $auth->email);
                if($usuario && $usuario->confirmado === "1"){
                    //generar token
                    $usuario->crearToken();
                    $usuario->guardar();
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarInstrucciones();
                    //alerta
                    Usuario::setAlerta('exito', 'Revisa tu email');
                    
                    
                } else {
                    Usuario::setAlerta('error', 'El Usuario no existe o no está confirmado');
                    
                }
            }

        }

        $alertas = Usuario::getAlertas();
        $router->render('/auth/forgot',[
            'alertas' => $alertas

        ]);
    }

    public static function reset(router $router) {
        $alertas = [];
        $error = false;
        $token = s($_GET['token']);
        //buscar usuario por token
        $usuario = Usuario::where('token', $token);
        if(empty($usuario)){
            Usuario::setAlerta('error', 'Token No Válido');
            $error = true;
        }
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //leer el nuevo password y guardarlo
            $password = new Usuario($_POST);
            $password->validarPassword();
            if(empty($alertas)){
                $usuario->password = null;
                $usuario->password = $password->password;
                $usuario->hashPassword();
                $usuario->token = null;
                $resultado = $usuario->guardar();
                if($resultado){
                    header('Location: /login');
                }
            }
        }
        
        $alertas = Usuario::getAlertas();
        $router->render('/auth/reset',[
            'alertas' => $alertas,
            'error' => $error

        ]);
    }

    public static function signup(router $router) {

        $usuario = new Usuario;
        //Alertas vacias
        $alertas  =[];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $usuario->sincronizar($_POST);
            $alertas= $usuario->validarNuevaCuenta();
            
            //revisar que alerta este vacio
            if(empty($alertas)){
                //verificar que el usuario no este registrado
                $resultado = $usuario->existeUsuario();
                if($resultado->num_rows){
                    $alertas = Usuario::getAlertas();
                } else {
                    //hashear password
                    $usuario->hashPassword();
                    //generar un token unico
                    $usuario->crearToken();
                    //Enviar el mail con el token
                    $email = new Email($usuario->email, $usuario->nombre, $usuario->token);
                    $email->enviarConfirmacion();
                    $resultado = $usuario->guardar();

                    if($resultado){
                        header('Location: /message');
                    }
                }
            }
            

        }

        $router->render('/auth/signup',[
            'usuario' => $usuario,
            'alertas' => $alertas

        ]);
    }
    public static function message(router $router) {


        $router->render('/auth/message');
    }
    public static function confirm(router $router){
        $alertas = [];
        $token = s($_GET['token']);
        $usuario = Usuario::where('token',$token);
        if(empty($usuario)) {
            //mostrar mensaje de erro
            Usuario::setAlerta('error', 'Token no Válido');
        } else {
            //modificar el usuario confirmado
            $usuario->confirmado = "1";
            $usuario->token = null;
            $usuario->guardar();
            Usuario::setAlerta('exito', 'Cuenta Confirmada Correctamente');
        }
        //obtener alertas
        $alertas = Usuario::getAlertas();
        //renderizar vista
        $router->render('/auth/confirm', [
            'alertas' => $alertas

        ]);
    }
    public static function error (router $router){
        
        $router->render('/auth/error');
    }
}

?>