<?php

declare(strict_types=1);

namespace OldSound\RabbitMqBundle\Tests\TestApp\Callbacks;

use PhpAmqpLib\Message\AMQPMessage;

class MyCallbackClass
{
    public static $counter = 0;
    public static $messageHistory = [];

    public function execute(AMQPMessage $message): bool
    {
        self::$messageHistory[] = $message;
        self::$counter++;
        return true;
    }
}
