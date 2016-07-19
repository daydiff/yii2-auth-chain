<?php

namespace Daydiff\AuthChain;

/**
 * Description of Member
 *
 * @author aleksandr.tabakov
 */
class MemberInterface
{

    function getId();

    function getLogin();

    function setId($id);

    function setLogin($login);

}
