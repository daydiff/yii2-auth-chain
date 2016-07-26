<?php

namespace Daydiff\AuthChain\Tests\unit;

use Yii;
use Codeception\TestCase\Test;
use Codeception\Specify;
use Daydiff\AuthChain\Service;

/**
 * Description of ServiceTest
 *
 * @author aleksandr.tabakov
 */
class ServiceTest extends Test
{
    use Specify;

    public function testService()
    {
        (new \yii\web\Application([
            'id' => 'test',
            'basePath' => __DIR__,
            'components' => [
                'session' => 'yii\web\Session',
            ]
        ]));

        /* @var Service $service */
        $service = Yii::createObject(Service::className(), ['key' => 'chain']);
        $member = (new Member())->setId(1)->setLogin('Bob');
        $service->add($member);

        
        //$this->assertEquals(1, $service->count());
        //$this->assertInternalType('array', $service->last());

//        $this->specify('', function () use ($service) {
//            expe
//        });
    }
}
