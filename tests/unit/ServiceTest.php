<?php

namespace Daydiff\AuthChain\Tests\unit;

use Yii;
use Codeception\TestCase\Test;
use Codeception\Specify;

/**
 * Description of ServiceTest
 *
 * @author aleksandr.tabakov
 */
class ServiceTest extends Test
{
    use Specify;

    public function setUp()
    {
        parent::setUp();
        $this->mockWebApp();
    }

    public function testService()
    {
        /* @var Daydiff\AuthChain\Service $service */
        $service = Yii::createObject(['class' => 'Daydiff\AuthChain\Service', 'sessionKey' => 'test-chain']);

        //add
        $this->specify('check adding members', function () use ($service) {
            $member = (new Member())->setId(1)->setLogin('Bob');
            $service->add($member);
            expect('count equals', $service->count())->equals(1);

            $member = (new Member())->setId(2)->setLogin('Alice');
            $service->add($member);
            expect('count equals', $service->count())->equals(2);
        });


        //first
        $this->specify('check if first member is really one added first', function () use ($service) {
            expect('result is instance of Member', $service->first())->isInstanceOf('Daydiff\AuthChain\Tests\unit\Member');
            expect('id equals setted', $service->first()->getId())->equals(1);
        });

        //last
        $this->specify('check if last member is really one added last', function () use ($service) {
            expect('result is instance of Member', $service->last())->isInstanceOf('Daydiff\AuthChain\Tests\unit\Member');
            expect('id equals setted', $service->last()->getId())->equals(2);
            expect('login equals setted', $service->last()->getLogin())->equals('Alice');
        });

        //pop
        $this->specify('check if pop returns last member and take it off the chain', function () use ($service) {
            $member = (new Member())->setId(3)->setLogin('Alex');
            $service->add($member);
            $member = $service->pop();
            expect('id equals setted', $member->getId())->equals(3);
            expect('login equals setted', $member->getLogin())->equals('Alex');
            expect('count equals', $service->count())->equals(2);
        });

        //all
        $this->specify('check if all returns all of members', function () use ($service) {
            $members = $service->all();
            expect('count equals', count($members))->equals(2);
            expect('count equals count', $service->count())->equals(count($members));
        });

        //flush
        $this->specify('check flush method flushes', function () use ($service) {
            $service->flush();
            expect('count equals zero', $service->count())->equals(0);
        });
    }

    protected function mockWebApp()
    {
        return (new \yii\web\Application([
            'id' => 'test',
            'basePath' => __DIR__,
            'components' => [
                'session' => 'yii\web\Session',
            ]
        ]));
    }
}
