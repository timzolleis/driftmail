<?php

namespace App\Models\entities;

class MailSender
{
    private string $address;
    private string $name;

    /**
     * @param string $address
     * @param string $name
     */
    public function __construct(string $address, string $name)
    {
        $this->address = $address;
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }




}
