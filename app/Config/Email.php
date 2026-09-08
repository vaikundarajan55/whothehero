<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    /**
     * Email Address
     */
    public string $fromEmail = '';

    /**
     * Sender Name
     */
    public string $fromName = 'Music Heal';

    /**
     * Recipients
     */
    public string $recipients = '';

    /**
     * User Agent
     */
    public string $userAgent = 'CodeIgniter';

    /**
     * Mail Protocol
     */
    public string $protocol = 'smtp';

    /**
     * Sendmail Path
     */
    public string $mailPath = '/usr/sbin/sendmail';

    /**
     * SMTP Host
     */
    public string $SMTPHost = 'smtp.gmail.com';

    /**
     * SMTP Authentication Method
     */
    public string $SMTPAuthMethod = 'login';

    /**
     * SMTP Username
     */
    public string $SMTPUser = '';

    /**
     * SMTP Password
     */
    public string $SMTPPass = '';

    /**
     * SMTP Port
     */
    public int $SMTPPort = 587;

    /**
     * SMTP Timeout
     */
    public int $SMTPTimeout = 30;

    /**
     * Keep Alive
     */
    public bool $SMTPKeepAlive = false;

    /**
     * SMTP Encryption
     */
    public string $SMTPCrypto = 'tls';

    /**
     * Word Wrap
     */
    public bool $wordWrap = true;

    /**
     * Wrap Characters
     */
    public int $wrapChars = 76;

    /**
     * Mail Type
     */
    public string $mailType = 'html';

    /**
     * Charset
     */
    public string $charset = 'UTF-8';

    /**
     * Validate Email
     */
    public bool $validate = false;

    /**
     * Priority
     */
    public int $priority = 3;

    /**
     * CRLF
     */
    public string $CRLF = "\r\n";

    /**
     * New Line
     */
    public string $newline = "\r\n";

    /**
     * BCC Batch Mode
     */
    public bool $BCCBatchMode = false;

    /**
     * BCC Batch Size
     */
    public int $BCCBatchSize = 200;

    /**
     * Delivery Status Notification
     */
    public bool $DSN = false;
    

    public function __construct()
    {
        parent::__construct();

        // ── Pulled from .env — same code works on localhost and server,
        //    only the .env file content differs per machine ──
        $this->fromEmail  = env('email.fromEmail', 'no-reply@musicheal.com');
        $this->fromName   = env('email.fromName', 'Music Heal');
        $this->SMTPHost   = env('email.SMTPHost', 'smtp.gmail.com');
        //$this->SMTPUser   = env('email.SMTPUser', 'adminmusic1234@gmail.com');
        //$this->SMTPPass   = env('email.SMTPPass', 'Admin@123');
        $this->SMTPUser   = env('email.SMTPUser', 'vaikundarajanaz1988@gmail.com');
        $this->SMTPPass   = env('email.SMTPPass', 'zdpy uhaa jjtc gaqp');
        $this->SMTPPort   = (int) env('email.SMTPPort', 587);
        $this->SMTPCrypto = env('email.SMTPCrypto', 'tls');
    }
}