<?php

namespace App\Libraries\Mailer;

use App\Libraries\Mailer\PHPmailer;

class MailService extends PHPmailer
{

    public function send(OptionsMail $options)
    {
        try {
            helper('url');

            $phpmailer = new PHPmailer();

            $mail = $phpmailer->load();
            foreach ($options->froms as $destinatary) {
                $mail->addAddress($destinatary['email'], $destinatary['name']); // Acrescente um destinatário
            }

            $mail->Subject = $options->title; // 'BrasilArco  - Token de Autorização'

            $mail->Body  = $options->html;
            if (isset($options->textHtml))
                $mail->AltBody = $options->textHtml;

    
            if (!$mail->send()) {
                echo 'A mensagem não pode ser enviada';
                echo 'Mensagem de erro: ' . $mail->ErrorInfo;
            } else {
                // echo 'Mensagem enviada com sucesso';
            }
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }
}
