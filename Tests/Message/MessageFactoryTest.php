<?php

namespace Clarity\NotificationBundle\Tests\Message;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Clarity\NotificationBundle\Message\Factory as MessageFactory;
use Clarity\NotificationBundle\Message\Type\MailType;
use Clarity\NotificationBundle\Message\MessageInterface;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class MessageFactoryTest extends WebTestCase
{
    /**
     * Test for factory existence and creation of the simple message
     * 
     */
    public function testFactoryExistence()
    {
        $client = static::createClient();
        $factory = $client->getContainer()->get('clarity_notification.message_factory');
        $this->assertTrue($factory instanceof MessageFactory, 
            sprintf('Factory object is instance of "%s" instead "%s"', get_class($factory), 'Clarity\NotificationBundle\Message\Factory')
        );

        $message = $factory->create(new MailType());
        $this->assertTrue($message instanceof MessageInterface, 
            sprintf('Message object is instance of "%s" instead "%s"', get_class($factory), 'Clarity\NotificationBundle\Message\Message')
        );
    }
}