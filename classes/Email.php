<?php 

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;


class Email{

    public $nombre;
    public $email;
    public $token;


    public function __construct($nombre, $email, $token)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }

    public function enviarConfirmacion(){
        //Crear el objeto de email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = $_ENV['EMAIL_HOST'];
        $mail->SMTPAuth = true;
        $mail->Port = $_ENV['EMAIL_PORT'];
        $mail->Username = $_ENV['EMAIL_USER'];
        $mail->Password = $_ENV['EMAIL_PASS'];


        $mail->setFrom('cuentas@correo.com');
        $mail->addAddress('cuentas@correo.com', 'Essalud.com');
        $mail->Subject = 'Confirma tu cuenta';


        //SET HTML
        $mail->isHTML(true);
        $mail->CharSet = 'UTF-8'; 

        $contenido = "<html>";
        $contenido .= "<p><strong>Hola ". $this->nombre . "</strong> Has creado tu cuenta en 
        Essalud, solo debes confirmarla presionando el siguiente enlace</p>";

        $contenido .= "<p>Presiona aqui: <a href='" . $_ENV['APP_URL'] . "/confirmar-cuenta?token=" 
        . $this->token . "'>Confirmar Cuenta</a> </p>";
        $contenido .= "<p>Si tu no solicitastes esta cuenta, puedes ignorar el mensaje</p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar el mail
        $mail->send();

    }

    public function enviarInstrucciones(){
         //Crear el objeto de email
         $mail = new PHPMailer();
         $mail->isSMTP();
         $mail->Host = $_ENV['EMAIL_HOST'];
         $mail->SMTPAuth = true;
         $mail->Port = $_ENV['EMAIL_PORT'];
         $mail->Username = $_ENV['EMAIL_USER'];
         $mail->Password = $_ENV['EMAIL_PASS'];
 
 
         $mail->setFrom('cuentas@correo.com');
         $mail->addAddress('cuentas@correo.com', 'Essalud.com');
         $mail->Subject = 'Reestablece tu password';
 
 
         //SET HTML
         $mail->isHTML(true);
         $mail->CharSet = 'UTF-8'; 
 
         $contenido = "<html>";
         $contenido .= "<p><strong>Hola ". $this->nombre . "</strong> Has solicitado reestablecer tu password, sigue
         el siguiente enlace para hacerlo</p>";
 
         $contenido .= "<p>Presiona aqui: <a href='" . $_ENV['APP_URL'] . "/recuperar?token=" 
         . $this->token . "'>Reestablecer Password</a> </p>";
         $contenido .= "<p>Si tu no solicitastes esta cuenta, puedes ignorar el mensaje</p>";
         $contenido .= "</html>";
 
         $mail->Body = $contenido;
 
         //Enviar el mail
         $mail->send();
 
    }
}