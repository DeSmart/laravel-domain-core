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
}
