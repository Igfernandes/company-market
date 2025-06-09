<?php

namespace App\Services\Mailer;

require_once APPPATH . 'ThirdParty/PHPMailer/src/PHPMailer.php';
require_once APPPATH . 'ThirdParty/PHPMailer/src/Exception.php';
require_once APPPATH . 'ThirdParty/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

/**
 * Classe responsável por configurar e fornecer uma instância do PHPMailer.
 */
class MailConfig
{
    /**
     * Inicializa e retorna uma instância configurada do PHPMailer.
     *
     * @return PHPMailer Instância configurada do PHPMailer.
     * @throws \RuntimeException Se houver erro ao configurar o PHPMailer.
     */
    public function load(): PHPMailer
    {
        $mail = new PHPMailer(true);

        try {
            $this->configureMailer($mail);
        } catch (Exception $e) {
            throw new \RuntimeException("Erro ao configurar o PHPMailer: " . $e->getMessage());
        }

        return $mail;
    }

    /**
     * Configura as propriedades do PHPMailer com base nas variáveis de ambiente.
     *
     * @param PHPMailer $mail Instância do PHPMailer a ser configurada.
     * @return void
     */
    private function configureMailer(PHPMailer $mail): void
    {
        $mail->setLanguage('br');
        $mail->CharSet = $this->getEnv('system.mail.charset', 'UTF-8');
        $mail->SMTPDebug = (int) $this->getEnv('system.mail.smtpdebug', SMTP::DEBUG_OFF);
        $mail->isSMTP();
        $mail->Host = $this->getEnv('system.mail.host');
        $mail->SMTPAuth = filter_var($this->getEnv('system.mail.smtpauth', true), FILTER_VALIDATE_BOOLEAN);
        $mail->Username = $this->getEnv('system.mail.username');
        $mail->Password = $this->getEnv('system.mail.password');
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = (int) $this->getEnv('system.mail.port', 587);
        $mail->From = $this->getEnv('system.mail.from');
        $mail->FromName = $this->getEnv('system.mail.author');
        $mail->isHTML(true);
    }

    /**
     * Obtém o valor de uma variável de ambiente, retornando um valor padrão caso não esteja definida.
     *
     * @param string $key Nome da variável de ambiente.
     * @param mixed $default Valor padrão caso a variável não esteja definida.
     * @return mixed Retorna o valor da variável de ambiente ou o valor padrão.
     */
    private function getEnv(string $key, $default = null)
    {
        return getenv($key) !== false ? getenv($key) : $default;
    }
}
