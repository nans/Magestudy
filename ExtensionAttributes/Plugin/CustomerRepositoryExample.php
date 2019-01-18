<?php

namespace Magestudy\ExtensionAttributes\Plugin;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Framework\App\ObjectManager;
use Magestudy\ExtensionAttributes\Api\Data\ExampleInterface;

class CustomerRepositoryExample
{
    /**
     * @param CustomerRepositoryInterface $subject
     * @param CustomerInterface $customer
     * @return CustomerInterface
     */
    public function afterGet(CustomerRepositoryInterface $subject, CustomerInterface $customer)
    {
        $this->loadExtensionAttributes($customer);

        return $customer;
    }

    /**
     * @param CustomerRepositoryInterface $subject
     * @param CustomerInterface $customer
     * @return CustomerInterface
     */
    public function afterGetById(CustomerRepositoryInterface $subject, CustomerInterface $customer)
    {
        $this->loadExtensionAttributes($customer);

        return $customer;
    }

    /**
     * @param CustomerInterface $customer
     */
    protected function loadExtensionAttributes(CustomerInterface &$customer)
    {
        /** @var ExampleInterface $exampleObject */
        $exampleObject = $this->getExampleObject();
        $exampleObject->setValue('999');

        $extensionAttributes = $customer->getExtensionAttributes();
        if (is_object($extensionAttributes)) {
            $extensionAttributes->setData('example_text', 'someText');
            $extensionAttributes->setData('example_object', $exampleObject);
            $customer->setExtensionAttributes($extensionAttributes);
        }
    }

    /**
     * @return ExampleInterface
     */
    protected function getExampleObject()
    {
        return ObjectManager::getInstance()->create(ExampleInterface::class); //bad practice. used only for sample
    }
}