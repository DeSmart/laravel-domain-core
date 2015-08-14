<?php namespace DeSmart\DomainCore\Stubs\Entity;

class UserStubEntity
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $lastname;

    /**
     * @var UserCommentStubEntity[]
     */
    protected $messages = [];

    /**
     * @var UserCommentStubEntity
     */
    protected $sentMessage;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    public function setMessages(UserCommentStubEntity ...$messages)
    {
        $this->messages = $messages;
    }

    /**
     * @return UserCommentStubEntity[]
     */
    public function getMessages()
    {
        return $this->messages;
    }

    /**
     * @param UserCommentStubEntity $sentMessage
     */
    public function setSentMessage(UserCommentStubEntity $sentMessage)
    {
        $this->sentMessage = $sentMessage;
    }

    /**
     * @return UserCommentStubEntity
     */
    public function getSentMessage()
    {
        return $this->sentMessage;
    }
}
