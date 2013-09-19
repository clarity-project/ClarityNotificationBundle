<?php

namespace Clarity\NotificationBundle\Tests\Transport;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Clarity\NotificationBundle\Transport\Registry as TransportRegistry;
use Clarity\NotificationBundle\Transport\TransportInterface;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class TransportRegistryTest extends WebTestCase
{
    /**
     * 
     */
    public function testRegistryExistence()
    {
        $client = static::createClient();
        $registry = $client->getContainer()->get('clarity_notification.transport_registry');
        $this->assertTrue($registry instanceof TransportRegistry, 
            sprintf('Registry object is instance of "%s" instead "%s"', get_class($registry), 'Clarity\NotificationBundle\Transport\Registry')
        );

        $transport = $registry->get('mail');

        $this->assertTrue($transport instanceof TransportInterface,
            sprintf('Transport object is instance of "%s" instead "%s"', get_class($transport), 'Clarity\NotificationBundle\Transport\TransportInterface')
        );
    }
}