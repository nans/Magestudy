<?php
namespace Magestudy\Test\Test\Unit\Model;

use Magento\Framework\TestFramework\Unit\Helper\ObjectManager;
use PHPUnit_Framework_TestCase;
use Magestudy\Test\Model\HelloMessage;

class HelloMessageTest extends PHPUnit_Framework_TestCase{
    /**
     * @var HelloMessage
     */
    protected $helloMessage;

    /**
     * @var string
     */
    protected $expectedMessage;

    public function setUp(){
        $objectManager = new ObjectManager($this);
        $this->helloMessage = $objectManager->getObject(HelloMessage::class);
        $this->expectedMessage = 'Test message';
    }

    public function testGetMessage(){
        $this->assertEquals($this->expectedMessage, $this->helloMessage->getMessage());
    }

    //todo to use
    //add: <directory suffix="Test.php">../../../app/code/Magestudy/Test/Test/Unit</directory> to \dev\tests\unit\phpunit.xml.dist
}