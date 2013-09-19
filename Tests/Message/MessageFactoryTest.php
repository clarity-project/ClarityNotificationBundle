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

        $mail = $factory->create('mail', array('from' => 'z.aliakseyeu@gmail.com', 'to' => 'z.aliakseyeu@gmail.com', 'body' => 'test=test'));

        $this->assertTrue($mail->getData() instanceof \Swift_Message,
            'Factory method "get" doesen\'t properly get Message from registry.'
        );
    }
}