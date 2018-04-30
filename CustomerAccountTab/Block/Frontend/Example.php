<?php

namespace Magestudy\CustomerAccountTab\Block\Frontend;

use Magento\Framework\ObjectManagerInterface;
use Magento\Framework\View\Element\Template;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\App\ResourceConnection;

/**
 * Code in this class is not good, because it is very simple and don't use best practise
 */
class Example extends Template
{
    /**
     * @var ObjectManagerInterface
     */
    private $objectManager;

    /**
     * @var ResourceConnection
     */
    protected $resource;

    /**
     * @var AdapterInterface
     */
    protected $connection;

    /**
     * Example constructor.
     * @param Template\Context $context
     * @param ObjectManagerInterface $objectManager
     * @param array $data
     */
    public function __construct(
        Template\Context $context,
        ObjectManagerInterface $objectManager,
        array $data = []
    ) {
        $this->objectManager = $objectManager;
        $this->resource = $this->objectManager->get(ResourceConnection::class);
        $this->connection = $this->resource->getConnection(ResourceConnection::DEFAULT_CONNECTION);
        parent::__construct($context, $data);
    }


    /**
     * @return string
     */
    public function getFormAction()
    {
        return $this->getUrl('custom/example/post', ['_secure' => true]);
    }

    /**
     * @return string
     */
    public function getValue()
    {
        $select = $this->connection
            ->select()
            ->from($this->connection->getTableName('core_config_data'))
            ->where('path = ?', 'custom/example/value');

        $data = $this->connection->fetchRow($select);
        if ($data) {
            return $data['value'];
        }
        return '';
    }
}