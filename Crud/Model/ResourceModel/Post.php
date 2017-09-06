<?php

namespace Magestudy\Crud\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magestudy\Crud\Api\Data\PostInterface;
use Magestudy\Crud\Model\Post as Model;
use Magento\Framework\EntityManager\EventManager;
use \Magento\Framework\Model\ResourceModel\Db\Context;

class Post extends AbstractDb
{
    /**
     * @var EventManager
     */
    private $_eventManager;

    /**
     * @param Context $context
     * @param EventManager $eventManager
     * @param null $resourcePrefix
     */
    public function __construct(
        Context $context,
        EventManager $eventManager,
        $resourcePrefix = null
    ) {
        $this->_eventManager = $eventManager;
        parent::__construct($context, $resourcePrefix);
    }

    /**
     * @return string
     */
    public static function getTableName(){
        return 'crud_post';
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::getTableName(), Model::ID);
    }

    /**
     * Perform actions after object save
     *
     * @param AbstractModel|\Magento\Framework\DataObject $object
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function _afterSave(AbstractModel $object)
    {
        $this->_eventManager->dispatch('post_update_tag',
            [Model::ID => $object->getId(), Model::TAG => $object->getData(Model::TAG)]);
        return $this;
    }

    /**
     * Perform actions before object save
     *
     * @param \Magento\Framework\Model\AbstractModel|\Magento\Framework\DataObject $object
     * @return $this
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    protected function _beforeSave(AbstractModel $object)
    {
        parent::_beforeSave($object);
        /** @var PostInterface $object */
        $storeIds = $object->getStoreIds();
        if (is_array($storeIds)) {
            $object->setStoreIds(implode(',', $storeIds));
        }
        return $this;
    }
}