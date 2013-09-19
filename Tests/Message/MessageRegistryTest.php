<?php

namespace Clarity\NotificationBundle\Tests\Message;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Clarity\NotificationBundle\Message\Registry as MessageRegistry;
use Clarity\NotificationBundle\Message\MessageInterface;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class MessageRegistryTest extends WebTestCase
{
    /**
     * Test for factory existence and creation of the simple message
     * 
     */
    public function testRegistryExistence()
    {
        $client = static::createClient();
        $registry = $client->getContainer()->get('clarity_notification.message_registry');
        $this->assertTrue($registry instanceof MessageRegistry, 
            sprintf('Registry object is instance of "%s" instead "%s"', get_class($registry), 'Clarity\NotificationBundle\Message\Registry')
        );

        $type = $registry->get('mail', array('to' => 'z.aliakseyeu@gmail.com', 'from' => 'z.aliakseyeu@gmail.com', 'body' => 'asdfasdf'));

        $this->assertTrue($type instanceof MessageInterface,
            sprintf('Mail type object is instance of "%s" instead "%s"', get_class($type), 'Clarity\NotificationBundle\Message\MessageInterface')
        );
    }
}