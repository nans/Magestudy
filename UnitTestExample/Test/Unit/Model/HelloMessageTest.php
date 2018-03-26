<?php

namespace Magestudy\UnitTestExample\Test\Unit\Model;

use PHPUnit_Framework_TestCase;
use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use Magestudy\UnitTestExample\Model\Config;
use Magestudy\UnitTestExample\Model\HelloMessage;

class HelloMessageTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var HelloMessage
     */
    protected $helloMessage;

    /**
     * @var string
     */
    protected $expectedMessage;

    /**
     * @var Config
     */
    protected $config;

    /**
     * @var string
     */
    protected $configMessageText;

    /**
     * @var array
     */
    private $map = array(
        array(1, 'one'),
        array(2, 'two')
    );

    public function setUp()
    {
        $this->configMessageText = 'some example text';
        $this->expectedMessage = 'Test message';

        $this->config = $this->getMockBuilder(Config::class)->disableOriginalConstructor()->getMock();
        $this->config->expects($this->any())->method('configMessage')->willReturn($this->configMessageText);
        $this->config->expects($this->any())->method('getMessageByType')->will($this->returnValueMap($this->map));

        $objectManager = new ObjectManager($this);
        $this->helloMessage = $objectManager->getObject(HelloMessage::class, ['config' => $this->config]);

    }

    public function testGetMessage()
    {
        $this->assertEquals($this->expectedMessage, $this->helloMessage->getMessage());
    }

    public function testGetMessageFromConfig()
    {
        $this->assertEquals($this->configMessageText, $this->helloMessage->getMessageFromConfig());
    }

    public function testGetterAndSetter()
    {
        $value = 4;
        $this->helloMessage->setType($value);
        $this->assertEquals($value, $this->helloMessage->getType());
    }

    public function testGetMessageFromConfigByTypeOne()
    {
        $this->helloMessage->setType(1);
        $this->assertEquals('one', $this->helloMessage->getMessageFromConfigByType());
    }

    public function testGetMessageFromConfigByTypeTwo()
    {
        $this->helloMessage->setType(2);
        $this->assertEquals('two', $this->helloMessage->getMessageFromConfigByType());
    }

    //todo to use
    //add: <directory suffix="Test.php">../../../app/code/Magestudy/UnitTestExample/Test/Unit</directory> to \dev\tests\unit\phpunit.xml (remove .dist)
}