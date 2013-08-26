<?php

namespace Clarity\NotificationBundle;

/**
 * @author Zmicier Aliakseyeu <z.aliakseyeu@gmail.com>
 */
class Notifier
{
    /**
     * Transports collection
     * 
     * @var array
     */
    private $transports;

    /**
     * Templates of default options for different types of messages
     * 
     * @var array $options 
     */
    private $templates;

    /**
     * @param array $transports
     * @param array $messages
     * @param array $templates
     */
    public function __construct(array $transports, array $templates)
    {
        $this->transports = $transports;
        $this->templates = $templates;
    }

    /**
     * @param string $transport
     * @return \Clarity\NotificationBundle\Message\Builder
     */
    public function createMessageBuilder($transport)
    {
        return new Message\Builder($this->transports[$transport], $this->templates);
    }

    /**
     * @param string $transport Alias name of the notification transport
     * @return \Clarity\NotificationBundle\Message\Builder
     */
    public function compose($transport)
    {
        if (!isset($this->transports[$transport])) {
            throw new Transport\Exception\NotFoundException(sprintf('Transport with name "%s" was not found in configured list.', $name));
        }
        
        $builder = $this->createMessageBuilder($transport);

        // super hardcode for fast solution
        $builder->create(new Message\Type\MailType());

        // some actions of composing message

        return $builder;
    }
}