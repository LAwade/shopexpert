<?php

/**
 * SimplesMail Class
 * 
 * EN. Doc.
 * This class facilitates the sending of bulk or single email, in addition to controlling the quantity for sending.
 * The class also allows templates in HTML formats to be sent with settings in {$value}.
 * 
 * BR Doc.
 * Esta classe facilita o envio de email em massa ou único, além de controlar a quantidade para envios.
 * A classe também Possibilita template em formatos HTML para ser enviado com configurações em {$value}.
 * 
 * @important 
 * #This class uses PHPMailer as an attribute for sending email.
 * #Esta classe utiliza o PHPMailer como atributo para o envio de email.
 * 
 * @author Lucas Awade
 * @github @LAwade
 * @version 1.0.0
 * @created 02/07/2020
 */

namespace app\core;

use PHPMailer\PHPMailer\PHPMailer;
use app\shared\Logger;

class SimplesMail {
    ########################################################################
    ##                           CONFIG. CLASS                            ##
    ########################################################################

    private $log;
    private $limit;
    private $sended = 0;
    private $mailer;
    private $mail;
    private $passwd;

    ########################################################################
    ##                           CONFIG. MAIL                             ##
    ########################################################################

    const MAIL_HOST = CONF_MAIL_HOST;
    const MAIL_PORT = CONF_MAIL_PORT;
    const MAIL_CHARSET = CONF_MAIL_OPTION_CHARSET;
    const MAIL_SMTP_AUTH = CONF_MAIL_OPTION_AUTH;
    const MAIL_SMTP_SECURE = CONF_MAIL_OPTION_SECURE;
    const MAIL_TITLE = CONF_MAIL_OPTION_TITLE;
    const MAIL_DEBUG = 0;
    const MAIL_TIMEOUT_SECONDS = 30;

    public function __construct($mail, $passwd) {
        $this->log = new Logger(CONF_MAIL_LOG, CONF_LOGGER_ATIVE);
        if ($mail && $passwd) {
            $this->mail = $mail;
            $this->passwd = $passwd;
            $this->phpMailer();
        } else {
            $this->log->error('It was not possible to instantiate the SimplesMail Class!', debug_backtrace());
        }
    }

    /**
     * Reports a bulk email limit to be sent.
     * Informa um limite de email em massa a ser enviado.
     * 
     * @param int $limit
     */
    public function limitSend($limit) {
        $this->log->debug('Limite de Email: ' . $limit, debug_backtrace());
        $this->limit = $limit;
    }

    /**
     * Message written in HTML to send an elaborate email.
     * Mensagem escrito em HTML para envio de um email elaborado.
     * 
     * The data in $data must be in array format like the example:
     * Os dados em $data devem ser em formato array como o exemplo:
     * 
     *     array("MSG_HEADER" => 'Seja Bem vindo', "MSG_FOOTER" => 'Volte Sempre');
     *    
     * @param string $path
     * @param array $data
     */
    public function pathBodyMail($path, $data) {
        $this->log->info('Path HTML Body: ' . $path, debug_backtrace());
        $contents = file_get_contents($path);
        foreach ($data as $key => $value) {
            $contents = str_replace($key, $value, $contents);
        }
        $this->mailer->Body = $contents;
    }

    /**
     * Simple message to quickly send an email.
     * Mensagem simples para o envio rapido de um email.
     * 
     * @param string $message
     */
    public function bodyMessage($message) {
        $this->mailer->Body = $message;
    }

    /**
     * Manages the sending of email to always be at the sending limit.
     * Gerencia o envio do email para estar sempre no limite de envio.
     * 
     * @return boolean
     */
    public function getSended() {
        $this->log->debug("Sended: " . $this->sended, debug_backtrace());
        if ($this->sended < $this->limit) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * This function sends bulk or single emails.
     * Esta funcao envia os email em massa ou unicos.
     * 
     * Bulk email it is necessary to pass an array with the emails your index that represents the email.
     * Email em massa e necessario passar um array com os emails seu indice que representa o email.
     * 
     * Only email is necessary to pass the email in the variable $data;
     * Email unico so e preciso passar o email na variavel $data;
     * 
     * @param array|string $data
     * @param string $indice
     * @return array|boolean
     */
    public function mailing($data, $indice = '') {
        if (is_array($data)) {
            $invalid = array();
            foreach ($data as $mail) {
                if ($this->sended <= $this->limit) {
                    $mail = $indice ? $mail[$indice] : $mail;
                    $this->setSended();
                    if (!$this->send($mail)) {
                        $invalid[] = $mail;
                    }
                }
            }
            return $invalid;
        } else {
            $this->log->debug("Send Email to {$data}.", debug_backtrace());
            if ($this->send($data)) {
                $this->setSended();
                return true;
            } else {
                return false;
            }
        }
    }

    ########################################################################
    ##                              SEND MAIL                             ##
    ########################################################################

    /**
     * Manages the amount of email being sent.
     * Gerencia a quantidade de email que esta sendo enviado.
     */
    private function setSended() {
        $this->sended++;
    }

    /**
     * Responsible method to send the email.
     * Metodo responsavel para realizar o envio do email.
     * 
     * @param string $mailFrom
     * @return boolean
     */
    private function send($mailFrom) {

        if (!$this->mailer) {
            $this->log->error("Object not created!", debug_backtrace());
            return false;
        }

        try {
            set_time_limit(self::MAIL_TIMEOUT_SECONDS);
            $this->mailer->setFrom($this->mail, self::MAIL_TITLE);
            $this->mailer->addAddress($mailFrom, self::MAIL_TITLE);
            $this->mailer->send();
            $this->mailer->clearAllRecipients();
            $this->log->success("Mail: {$mailFrom} | Send Queue: {$this->sended}", debug_backtrace());
            return true;
        } catch(\PHPMailer\PHPMailer\Exception $ex){
            $this->log->error("ErrorInfo Mail: " . $this->mailer->ErrorInfo . " | Exception Mail: {$mailFrom} >> " . $ex->getMessage(), debug_backtrace());
            return false;
        } catch (Exception $ex) {
            if ($this->mailer->ErrorInfo) {
                $this->log->error("ErrorInfo Mail: " . $this->mailer->ErrorInfo . " | Exception Mail: {$mailFrom} >> " . $ex->getMessage(), debug_backtrace());
            }
        }
        return false;
    }

    /**
     * Creates the settings and parameters to be implemented and sent emails.
     * Cria as configuracoes e parametros para ser implementado e enviado os emails.
     * 
     * @void null
     */
    private function phpMailer() {
        $this->log->debug("Instanciando objeto PHPMailer", debug_backtrace());
        $this->mailer = new PHPMailer(true);
        $this->mailer->isSMTP();
        $this->mailer->Timeout = self::MAIL_TIMEOUT_SECONDS;
        $this->mailer->Host = self::MAIL_HOST;
        $this->mailer->SMTPAuth = self::MAIL_SMTP_AUTH;
        $this->mailer->isHTML(true);

        if (self::MAIL_SMTP_AUTH) {
            $this->mailer->SMTPSecure = self::MAIL_SMTP_SECURE;
            $this->mailer->Username = $this->mail;
            $this->mailer->Password = $this->passwd;
        }

        $this->mailer->SMTPDebug = self::MAIL_DEBUG;
        $this->mailer->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        $this->mailer->CharSet = self::MAIL_CHARSET;
        $this->mailer->Port = self::MAIL_PORT;
    }

    ########################################################################
    ##                                CLASS                               ##
    ########################################################################

    function setSubject($subject): void {
        $this->mailer->Subject = $subject;
    }

}
