<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;
#[\AllowDynamicProperties]
class Email{

    public $email;
    public $nombre;
    public $token;

    public function __construct($email, $nombre, $token) {

        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
        
    }
    public function enviarConfirmacion(){
        //crear el obejto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom($_ENV['EMAIL_MAIL']);
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Confirma tu Cuenta';

        //set html
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= " <p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en AppSalon, sólo debes confirmarla presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/confirm?token=" . $this->token . "'>Confirmar Cuenta</a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignonar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        //enviar email
        $mail->send();
    }

    public function enviarInstrucciones(){
        //crear el obejto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];

        $mail->setFrom($_ENV['EMAIL_MAIL']);
        $mail->addAddress($this->email, $this->nombre);
        $mail->Subject = 'Reestablece tu Password';

        //set html
        $mail->isHTML(TRUE);
        $mail->CharSet = 'UTF-8';

        $contenido = "<html>";
        $contenido .= " <p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu password, sigue el siguiente enlace para hacerlo.</p>";
        $contenido .= "<p>Presiona aquí: <a href='" . $_ENV['APP_URL'] . "/reset?token=" . $this->token . "'>Reestablece Contraseña</a> </p>";
        $contenido .= "<p>Si tu no solicitaste este cambio, puedes ignonar el mensaje</p>";
        $contenido .= "</html>";
        $mail->Body = $contenido;

        //enviar email
        $mail->send();
    }

    

}


?>