<?php

namespace Magestudy\Event\Controller\Example;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\EntityManager\EventManager;

class Index extends Action
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