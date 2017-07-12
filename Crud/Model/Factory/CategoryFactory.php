<?php

namespace Magestudy\Crud\Model\Factory;

use Magestudy\Crud\Api\FactoryInterface;
use Magento\Framework\ObjectManagerInterface;
use Magestudy\Crud\Api\Data\CategoryInterface;

class CategoryFactory implements FactoryInterface
{
    /**
     * Object Manager instance
     *
     * @var ObjectManagerInterface
     */
    protected $_objectManager = null;

    /**
     * Instance name to create
     *
     * @var string
     */
    protected $_instanceName = null;

    /**
     * Factory constructor
     *
     * @param ObjectManagerInterface $objectManager
     * @param string $instanceName
     */
    public function __construct(ObjectManagerInterface $objectManager, $instanceName = CategoryInterface::class)
    {
        $this->_objectManager = $objectManager;
        $this->_instanceName = $instanceName;
    }

    /**
     * Create class instance with specified parameters
     *
     * @param array $data
     * @return CategoryInterface
     */
    public function create(array $data = [])
    {
        return $this->_objectManager->create($this->_instanceName, $data);
    }
}