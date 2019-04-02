<?php
class Message{

    private $username;
    private $message;

    public function __construct(string $username, string $message, ?DateTime $date = null)
    {
        $this->username = $username;
        $this->message = $message;
    }

    public function isValid(): bool
    {
        return strlen($this->username) >= 3 && strlen($this->message) >= 10;
    }
}