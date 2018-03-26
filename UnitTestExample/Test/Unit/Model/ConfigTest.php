<?php

namespace Magestudy\UnitTestExample\Test\Unit\Model;

use PHPUnit_Framework_TestCase;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magestudy\UnitTestExample\Model\Config;


class ConfigTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Config
     */
    protected $config;

    public function setUp()
    {
        $objectManager = new ObjectManager($this);
        $this->config = $objectManager->getObject(Config::class);
    }

    public function testConfigMessage()
    {
        $this->assertEquals('Message from config.', $this->config->configMessage());
    }

    public function testGetMessageFromConfig()
    {
        $this->assertEquals('one', $this->config->getMessageByType(1));
    }

    //todo to use
    //add: <directory suffix="Test.php">../../../app/code/Magestudy/UnitTestExample/Test/Unit</directory> to \dev\tests\unit\phpunit.xml (remove .dist)
}