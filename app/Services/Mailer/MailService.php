<?php

namespace App\Services\Mailer;

use PHPMailer\PHPMailer\Exception;

/**
 * Classe responsável pelo envio de e-mails utilizando PHPMailer.
 */
class MailService extends MailConfig
{
    /**
     * Envia um e-mail utilizando PHPMailer.
     *
     * @param IOptionsMail $options Opções do e-mail (destinatários, título, corpo, etc.).
     * @return bool Retorna true se o e-mail for enviado com sucesso, false em caso de erro.
     */
    public function send(OptionsMail $options): bool
    {
        try {
            helper('url');

            $mail = $this->load();

            // Adiciona os destinatários
            foreach ($options->recipients as $recipient) {
                $mail->addAddress($recipient['email'], $recipient['name']);
            }

            // Configura assunto e corpo do e-mail
            $mail->Subject = $options->title;
            $mail->Body = $options->html;

            if (!empty($options->textHtml)) {
                $mail->AltBody = $options->textHtml;
            }

            // Envia o e-mail
            if (!$mail->send()) {
                error_log('Erro ao enviar e-mail: ' . $mail->ErrorInfo);
                return false;
            }

            return true;
        } catch (Exception $e) {
            error_log('Exceção ao enviar e-mail: ' . $e->getMessage());
            return false;
        }
    }
}
