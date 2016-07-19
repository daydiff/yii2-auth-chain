<?php

namespace Daydiff\AuthChain;

use Yii;
use yii\base\Component;
use yii\web\Session;

/**
 * Description of Service
 *
 * @author aleksandr.tabakov
 */
class Service extends Component
{
    public $sessionKey;

    /**
     * Adds member to an authorization chain
     * @param MemberInterface $member
     */
    public function add(MemberInterface $member)
    {
        $chain = $this->getChain();

        if (!is_array($chain)) {
            $chain = [];
        }

        $chain[] = serialize($member);
        $this->setChain($chain);
    }

    /**
     * Returns first member
     * @return null|MemberInterface
     */
    public function first()
    {
        $chain = $this->getChain();

        if (!is_array($chain) || !count($chain)) {
            return null;
        }

        $first = unserialize($chain[0]);
        return $first;
    }

    /**
     * Returns last member
     * @return null|MemberInterface
     */
    public function last()
    {
        $chain = $this->getChain();

        if (!is_array($chain) || !count($chain)) {
            return null;
        }

        $last = unserialize(array_pop($chain));
        return $last;
    }

    /**
     * Returns the last member and remove it off the chain
     * @return null|MemberInterface
     */
    public function pop()
    {
        $chain = $this->getChain();

        if (!is_array($chain)) {
            return null;
        }

        $member = unserialize(array_pop($chain));
        $this->setChain($chain);

        return $member;
    }

    /**
     * Returns all authorization members
     * @return MemberInterface[]
     */
    public function all()
    {
        $chain = $this->getChain();

        if (!is_array($chain)) {
            return [];
        }

        foreach ($chain as $key => &$value) {
            $chain[$key] = unserialize($value);
        }

        return $chain;
    }

    /**
     * Returns count of an authorization members
     * @return integer
     */
    public function count()
    {
        $chain = $this->getChain();

        return is_array($chain) ? count($chain) : 0;
    }

    /**
     * Clears an authorization chain
     */
    public function flush()
    {
        $session = Yii::$app->get('session', false);

        if (!$session) {
            return;
        }

        $session->remove($this->sessionKey);
    }

    private function getChain()
    {
        $session = Yii::$app->get('session', false);

        if (!$session) {
            return null;
        }

        $session->get($this->sessionKey, 0);
    }

    private function setChain($chain)
    {
        $session = Yii::$app->get('session', false);

        if (!$session) {
            return;
        }

        $session->set($this->sessionKey, $chain);
    }
}
