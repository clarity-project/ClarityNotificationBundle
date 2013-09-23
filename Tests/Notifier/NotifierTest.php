<?php

namespace Clarity\NotificationBundle\Tests\Notifier;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class NotifierTest extends WebTestCase
{   
    /**
     * 
     */
    public function testTransportMessageSending()
    {
        $client = static::createClient();
        $notifier = $client->getContainer()->get('clarity_notification.notifier');
        $message = $client->getContainer()->get('clarity_notification.message_factory')->create('mail', array(
            'from' => 'z.aliakseyeu@gmail.com',
            'to' => 'acin91@gmail.com',
            'subject' => 'asdfasdf',
            'body' => 'hello {{ email }}',
            'body_data' => array('email' => 'acin91@gmail.com'),
        ));

        $result = $notifier->with('mail')->send($message);
    }
}