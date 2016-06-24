# Yii2 extension implementing authorization chain

## What it is for?

For applications with hierarhical access roles system.

## Any examples? It's not clear

You have an application - API. You have two roles here:
    - admin - they can watch statistics and edit clients;
    - client - they can see own statistics and set settings.

You need to allow admins to authorize as clients without knowing their passwords just from admin interface. 
And you need to allow admins to get back to their account without re-logining. And of course you need to log all changes made admins as clients.

## Install

Via git

``` bash
$ git clone https://github.com/daydiff/yii2-auth-chain
```

## Usage

