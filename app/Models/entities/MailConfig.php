<?php

namespace App\Models\entities;

use App\Models\ProjectConfiguration;
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

    public static function getFromProjectConfiguration(ProjectConfiguration $configuration)
    {
        $driver = 'smtp';
        $host = $configuration->mail_host;
        $port = (int)$configuration->mail_port;
        $encryption = 'tls';
        $username = $configuration->mail_user;
        $password = $configuration->mail_password;
        $from = new MailSender($configuration->mail_sending_address, 'Zolleis.net');
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
            ]];
    }


}
