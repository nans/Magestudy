<?php

namespace Magestudy\Customjs\Block\Test;

use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Simple extends Template
{
    /**
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getExampleData()
    {
        return \Zend_Json_Encoder::encode(['Apple', 'Car']);
    }

    /**
     * @return string
     */
    public function getUserData()
    {
        $users = [];
        $users[] = ['id' => 11, 'name' => 'Alex', 'role' => 'User', 'email' => 'AlexUser@mail.com'];
        $users[] = [
            'id' => 12,
            'name' => 'Andrew',
            'role' => 'Administrator',
            'email' => 'AndrewAdmin@mail.com'
        ];
        $users[] = ['id' => 13, 'name' => 'Bob', 'role' => 'Moderator', 'email' => 'BobModerator@mail.com'];

        return \Zend_Json_Encoder::encode($users);
    }
}