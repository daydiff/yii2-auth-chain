<?php

namespace Daydiff\AuthChain;

/**
 * Description of Member
 *
 * @author aleksandr.tabakov
 */
interface MemberInterface
{
    /**
     * Returns member's id
     */
    function getId();

    /**
     * Returns member's login
     */
    function getLogin();

    /**
     * Sets member's id
     */
    function setId($id);

    /**
     * Sets member's login
     */
    function setLogin($login);

}
