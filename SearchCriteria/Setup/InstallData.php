<?php

namespace Magestudy\SearchCriteria\Setup;

use Magento\Customer\Api\CustomerRepositoryInterface;
use Magento\Framework\App\State;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Customer\Model\CustomerFactory;

class InstallData implements InstallDataInterface
{
    /**
     * @var CustomerFactory
     */
    private $customerFactory;

    /**
     * @var CustomerRepositoryInterface
     */
    private $customerRepository;

    /**
     * @param CustomerFactory $customerFactory
     * @param CustomerRepositoryInterface $customerRepository
     * @param State $appState
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function __construct(
        CustomerFactory $customerFactory,
        CustomerRepositoryInterface $customerRepository,
        State $appState
    ) {
        $appState->setAreaCode('frontend');
        $this->customerFactory = $customerFactory;
        $this->customerRepository = $customerRepository;
    }

    /**
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @throws \Magento\Framework\Exception\InputException
     * @throws \Magento\Framework\Exception\LocalizedException
     * @throws \Magento\Framework\Exception\State\InputMismatchException
     */
    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();

        $customer = $this->customerFactory->create()->getDataModel();
        $customer->setFirstname('First');
        $customer->setLastname('First');
        $customer->setEmail('FirstFirstSample@email.com');
        $customer->setGender(1);
        $this->customerRepository->save($customer);

        $customer = $this->customerFactory->create()->getDataModel();
        $customer->setFirstname('Second');
        $customer->setLastname('Second');
        $customer->setEmail('SecondSecondSample@email.com');
        $customer->setGender(2);
        $this->customerRepository->save($customer);

        $setup->endSetup();
    }
}