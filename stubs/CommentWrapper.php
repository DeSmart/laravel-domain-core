<?php namespace DeSmart\DomainCore\Stubs;

use DeSmart\DomainCore\Stubs\Model\UserCommentStub;

class CommentWrapper
{
    /**
     * @var UserCommentStub
     */
    protected $comment;

    public function __construct(UserCommentStub $comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return UserCommentStub
     */
    public function getComment()
    {
        return $this->comment;
    }
}
