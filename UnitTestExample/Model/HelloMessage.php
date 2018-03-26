<?php

namespace Magestudy\UnitTestExample\Model;

class HelloMessage
{
    /**
     * @var Config
     */
    private $config;

    private $type = 1;

    public function __construct(
        Config $config
    ) {
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return 'Test message';
    }

    public function getMessageFromConfig()
    {
        return $this->config->configMessage();
    }

    public function getMessageFromConfigByType()
    {
        return $this->config->getMessageByType($this->type);
    }

    public function setType($value)
    {
        $this->type = $value;
    }

    public function getType()
    {
        return $this->type;
    }
}