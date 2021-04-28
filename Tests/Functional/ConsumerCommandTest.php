<?php

namespace OldSound\RabbitMqBundle\Tests\Functional;

use OldSound\RabbitMqBundle\Tests\TestApp\Callbacks\MyCallbackClass;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

class ConsumerCommandTest extends KernelTestCase
{
    public function testConsume(): void
    {
        $application = new Application($this->bootKernel());

        $producer = self::$container->get('old_sound_rabbit_mq.test.dummy_producer');
        $producer->setContentType('application/json');
        $producer->publish(\json_encode(['test' => 'ok']));

        $command = $application->find('rabbitmq:consumer');
        $commandTester = new CommandTester($command);
        $commandTester->execute(
            [
                'name' => 'dummy_consumer',
                '-m' => 1,
            ]
        );

        $this->assertSame(MyCallbackClass::$counter, 1);
    }
}
