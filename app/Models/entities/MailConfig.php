<?php

namespace App\Models\entities;

use App\Models\ProjectConfiguration;
use App\Models\ProjectSettings;
use Illuminate\Support\Facades\Mail;

class MailConfig
{
    private string $driver;
    private string $host;
    private int $port;
    private string $encryption;
    private string $username;
    private string $password;
    private MailSender $from;

    /**
     * @param string $driver
     * @param string $host
     * @param int $port
     * @param string $encryption
     * @param string $username
     * @param string $password
     * @param MailSender $from
     */
    public function __construct(string $driver, string $host, int $port, string $encryption, string $username, string $password, MailSender $from)
    {
        $this->driver = $driver;
        $this->host = $host;
        $this->port = $port;
        $this->encryption = $encryption;
        $this->username = $username;
        $this->password = $password;
        $this->from = $from;
    }


    public static function getFromConfigurationArray(array $configurationArray)
    {
        $driver = $configurationArray['driver'];
        $host = $configurationArray['host'];
        $port = $configurationArray['port'];
        $encryption = $configurationArray['encryption'];
        $username = $configurationArray['username'];
        $password = $configurationArray['password'];
        $from = new MailSender($configurationArray['from']['address'], $configurationArray['from']['name']);
        return new MailConfig($driver, $host, $port, $encryption, $username, $password, $from);
    }

    public static function getFromProjectConfiguration(ProjectSettings $settings)
    {
        $driver = 'smtp';
        $host = $settings->mail_host;
        $port = (int)$settings->mail_port;
        $encryption = 'tls';
        $username = $settings->mail_user;
        $password = $settings->mail_password;
        $from = new MailSender($settings->mail_sending_address, $settings->mail_sending_name);
        return new MailConfig($driver, $host, $port, $encryption, $username, $password, $from);
    }

    public function getConfigurationArray(): array
    {
        return [
            'driver' => $this->driver,
            'host' => $this->host,
            'port' => $this->port,
            'encryption' => $this->encryption,
            'username' => $this->username,
            'password' => $this->password,
            'from' => [
                'address' => $this->from->getAddress(),
                'name' => $this->from->getName()
            ],
            'markdown' => [
                'theme' => 'default',

                'paths' => [
                    resource_path('views/vendor/mail'),
                ],
            ]];

    }

    public function getSendingName(){
        return $this->from->getName();
    }

    public function getSendingAddress(){
        return $this->from->getAddress();
    }

    /**
     * @return string
     */
    public function getDriver(): string
    {
        return $this->driver;
    }

    /**
     * @return string
     */
    public function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return int
     */
    public function getPort(): int
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getEncryption(): string
    {
        return $this->encryption;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return MailSender
     */
    public function getFrom(): MailSender
    {
        return $this->from;
    }





}
