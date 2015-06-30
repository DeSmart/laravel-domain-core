<?php namespace DeSmart\DomainCore\Stubs; 

class RegisterUserCommand 
{
    protected $email;

    public function getEmail()
    {
        return $this->email;
    }
}
