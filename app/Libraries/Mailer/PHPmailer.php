<?php

namespace App\Libraries\Mailer;

use PHPMailer\PHPMailer\PHPMailer as lib;

class PHPmailer
{
    public function load()
    {
        require_once APPPATH . '/ThirdParty/Mailer/src/PHPMailer.php';
        require_once APPPATH . '/ThirdParty/Mailer/src/Exception.php';
        require_once APPPATH . '/ThirdParty/Mailer/src/SMTP.php';

        $mail = new lib;

        $mail->setLanguage('br');                             // Habilita as saídas de erro em Português
        $mail->CharSet = getenv('MAIL_CHARSET');                               // Habilita o envio do email como 'UTF-8'

        $mail->SMTPDebug = getenv('MAIL_SMTPDEBUG');;                               // Habilita a saída do tipo "verbose"

        $mail->isSMTP();                                      // Configura o disparo como SMTP
        $mail->Host = getenv('MAIL_HOST');   // Especifica o enderço do servidor SMTP da Locaweb
        $mail->SMTPAuth = getenv('MAIL_SMTPAUTH');                               // Habilita a autenticação SMTP
        $mail->Username = getenv('MAIL_USERNAME');                        // Usuário do SMTP
        //$mail->Username = 'sistema@teste.cbtarco.org.br';                        // Usuário do SMTP
        //$mail->Password = 'Cbtarco1992@';                          // Senha do SMTP
        $mail->Password = getenv('MAIL_PASSWORD');                          // Senha do SMTP
        $mail->SMTPSecure = getenv('MAIL_SMTPSECURE');                           // Habilita criptografia TLS | 'ssl' também é possível
        $mail->Port = getenv('MAIL_PORT');                                   // Porta TCP para a conexão

        $mail->From = getenv('MAIL_FROM');                 // Endereço previamente verificado no painel do SMTP
        $mail->FromName = getenv('MAIL_FROM_NAME');                      // Nome no remetente
        $mail->isHTML(true);                                  // Configura o formato do email como HTML

        return $mail;
    }
}
