# Yii2 extension implementing authorization chain

## What it is for?

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

In your action used to authorize as client:

``` php
    public function actionAuthAs($id)
    {
        $user = \Yii::$app->getIdentity()->getUser();
        $member = new Daydiff\AuthChain\Member();
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