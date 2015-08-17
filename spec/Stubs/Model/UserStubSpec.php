<?php

namespace spec\DeSmart\DomainCore\Stubs\Model;

use Prophecy\Argument;
use PhpSpec\ObjectBehavior;
use Illuminate\Support\Collection;
use DeSmart\DomainCore\Stubs\CommentWrapper;
use Illuminate\Database\Eloquent\Relations\Pivot;
use DeSmart\DomainCore\Stubs\Model\UserCommentStub;
use DeSmart\DomainCore\Stubs\Entity\UserStubEntity;
use DeSmart\DomainCore\Stubs\Entity\UserCommentStubEntity;

class UserStubSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DeSmart\DomainCore\Stubs\Model\UserStub');
    }

    function it_returns_entity_class_name()
    {
        $this->getEntityClassName()->shouldReturn('DeSmart\DomainCore\Stubs\Entity\UserStubEntity');
    }

    function it_returns_entity_class_name_based_on_attribute()
    {
        $this->entityClassName = 'foo';
        $this->getEntityClassName()->shouldReturn('foo');
    }

    function it_converts_to_entity()
    {
        $this->name = 'Jon';
        $this->lastname = 'Snow';

        $entity = $this->toEntity();

        $entity->shouldHaveType(UserStubEntity::class);
        $entity->getName()->shouldReturn('Jon');
        $entity->getLastname()->shouldReturn('Snow');
    }

    function it_converts_to_entity_from_array_data()
    {
        $entity = $this->toEntity([
            'name' => 'Jon',
            'lastname' => 'Snow',
        ]);

        $entity->shouldHaveType(UserStubEntity::class);
        $entity->getName()->shouldReturn('Jon');
        $entity->getLastname()->shouldReturn('Snow');
    }

    function it_converts_one_to_one_relationship()
    {
        $this->setRelations([
            'sentMessage' => new UserCommentStub('test'),
        ]);

        $entity = $this->toEntity();
        $entity->getSentMessage()->shouldHaveType(UserCommentStubEntity::class);
        $entity->getSentMessage()->getMessage()->shouldReturn('test');
    }

    function it_converts_one_to_many_relationships()
    {
        $this->setRelations([
            'messages' => new Collection([
                new UserCommentStub('test'),
                new UserCommentStub('test1'),
            ]),
        ]);

        $entity = $this->toEntity();
        $entity->getMessages()[0]->shouldHaveType(UserCommentStubEntity::class);
        $entity->getMessages()[0]->getMessage('test');
        $entity->getMessages()[1]->shouldHaveType(UserCommentStubEntity::class);
        $entity->getMessages()[1]->getMessage('test1');
    }

    function it_converts_relationship_with_custom_mapper()
    {
        $this->setRelations([
            'wrappedComment' => $comment = new UserCommentStub('test'),
        ]);

        $entity = $this->toEntity();
        $wrappedComment = $entity->getWrappedComment();
        $wrappedComment->shouldHaveType(CommentWrapper::class);
        $wrappedComment->getComment()->shouldReturn($comment);
    }

    function it_skips_pivots(Pivot $pivot)
    {
        $this->setRelations([
            'messages' => $pivot,
        ]);

        // it's enough - Pivot shouldnt be casted to entity
        $this->toEntity();
    }
}
