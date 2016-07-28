# Yii2 extension implementing authorization chain

[![Latest Version on Packagist](https://img.shields.io/packagist/v/daydiff/yii2-auth-chain.svg?style=flat-square)](https://packagist.org/packages/yii2-auth-chain)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)
[![Build Status](https://img.shields.io/travis/daydiff/yii2-auth-chain/master.svg?style=flat-square)](https://travis-ci.org/daydiff/yii2-auth-chain)

## What is it for?

For applications with hierarhical access roles system.

## Any examples? It's not clear

You have an application - API. You have two roles here:
 - admin - they can watch statistics and edit clients;
 - client - they can see own statistics and set settings.

You need to allow admins to authorize as clients without knowing their passwords 
just from admin interface. And you need to allow admins to get back to their own 
privilegis/account without re-logining. And of course you need to log all changes 
made by admins as clients properly, so you always knew who actually made some changes.

## Install

``` bash
$ composer require daydiff/yii2-auth-chain
```

## Usage

Register application component:

``` php
    'components' => [
        'authChain' => [
            'class' => 'Daydiff\AuthChain\Service'
        ],
    ]
```

You need to declare a member class implementing \Daydiff\AuthChain\MemberInterface

```php
    //Member.php
    namespace app\foo\bar;

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
```

In your action used to authorize as client:

``` php
    public function actionAuthAs($id)
    {
        $user = \Yii::$app->getIdentity()->getUser();
        $member = new app\foo\bar\Member();
        $member->setId($user->id)
            ->setLogin($user->login)
            ->setName($user->name);
        \Yii::$app->authChain->add($member);

        //and then you do authorization work
    }
```

When you need to know who user actually is:

``` php
    $member = \Yii::$app->authChain->last();
    $realUserId = $member->getId();
```