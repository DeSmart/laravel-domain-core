<?php namespace DeSmart\DomainCore\Stubs\Entity;

class UserCommentStubEntity
{

    protected $message;

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
}
