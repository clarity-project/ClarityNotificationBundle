<?php

namespace Clarity\NotificationBundle\Tests\Message;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Clarity\NotificationBundle\Message\Registry as MessageRegistry;

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
    }
}