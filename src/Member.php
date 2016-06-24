<?php

namespace Daydiff\AuthChain;

/**
 * Description of Member
 *
 * @author aleksandr.tabakov
 */
class Member
{
    private $id;
    private $login;
    private $name;

    function getId()
    {
        return $this->id;
    }

    function getLogin()
    {
        return $this->login;
    }

    function getName()
    {
        return $this->name;
    }

    function setId($id)
    {
        if (empty($id)) {
            throw new \yii\base\InvalidParamException;
        }
        $this->id = $id;
        return $this;
    }

    function setLogin($login)
    {
        if (empty($login)) {
            throw new \yii\base\InvalidParamException;
        }
        $this->login = $login;
        return $this;
    }

    function setName($name)
    {
        $this->name = $name;
        return $this;
    }

}
