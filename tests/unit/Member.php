<?php

namespace Daydiff\AuthChain\Tests\unit;

/**
 * Description of Member
 *
 * @author aleksandr.tabakov
 */
class Member implements \Daydiff\AuthChain\MemberInterface
{
    private $id;
    private $login;

    /**
     * @inheritdoc
     */
    function getId()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    function getLogin()
    {
        return $this->login;
    }

    /**
     * @inheritdoc
     */
    function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @inheritdoc
     */
    function setLogin($login)
    {
        $this->login = $login;
        return $this;
    }
}
