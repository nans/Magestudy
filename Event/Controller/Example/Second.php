<?php

namespace Magestudy\Event\Controller\Example;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\EntityManager\EventManager;

class Second extends Action
{
    /**
     * @var ForwardFactory
     */
    protected $_resultForwardFactory;

    /**
     * @var EventManager
     */
    protected $__eventManager;

    /**
     * @param Context $context
     * @param ForwardFactory $resultForwardFactory
     * @param EventManager $eventManager
     */
    public function __construct(
        Context $context,
        ForwardFactory $resultForwardFactory,
        EventManager $eventManager
    ) {
        $this->_resultForwardFactory = $resultForwardFactory;
        $this->_eventManager = $eventManager;
        parent::__construct($context);
    }

    /**
     * @url /index.php/event/example/second
     * @return \Magento\Framework\View\Result\PageFactory
     */
    public function execute()
    {
        echo "Dispatch second_event_for_example <br>";
        $this->_eventManager->dispatch('second_event_for_example', ['date_time' => date('Y-m-d h:i:s')]);
        die;
    }
}