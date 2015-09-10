<?php namespace DeSmart\DomainCore\Stubs\Entity;

use DeSmart\DomainCore\Stubs\CommentWrapper;
use DeSmart\DomainCore\Events\EventGenerator;

class UserStubEntity
{

    use EventGenerator;

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
     * @var CommentWrapper
     */
    protected $wrappedComment;

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
        $this->raise('Name changed');
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

    /**
     * @return CommentWrapper
     */
    public function getWrappedComment()
    {
        return $this->wrappedComment;
    }
    
    /**
     * @param CommentWrapper $wrappedComment
     */
    public function setWrappedComment(CommentWrapper $wrappedComment)
    {
        $this->wrappedComment = $wrappedComment;
    }
}
