<?php

namespace Magestudy\Event\Controller\Example;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\EntityManager\EventManager;

class Index extends Action
{
    /**
     * @var EventManager
     */
    protected $_eventManager;

    /**
     * @param Context $context
     * @param EventManager $eventManager
     */
    public function __construct(
        Context $context,
        EventManager $eventManager
    ) {

        $this->_eventManager = $eventManager;
        parent::__construct($context);
    }

    /**
     * @url /index.php/event/example/index
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        echo "Dispatch first_event_for_example <br>";
        $this->_eventManager->dispatch('first_event_for_example', ['time' => date('h-i-s')]);
        die;
    }
}