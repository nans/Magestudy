<?php

namespace Magestudy\Event\Controller\Example;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\EntityManager\EventManager;
use Magento\Framework\View\Result\PageFactory;

class Second extends Action
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
     * @url /index.php/event/example/second
     * @return PageFactory
     */
    public function execute()
    {
        echo "Dispatch second_event_for_example <br>";
        $this->_eventManager->dispatch('second_event_for_example', ['date_time' => date('Y-m-d h:i:s')]);
        die;
    }
}