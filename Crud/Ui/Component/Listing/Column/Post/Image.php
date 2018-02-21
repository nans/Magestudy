<?php

namespace Magestudy\Crud\Ui\Component\Listing\Column\Post;

use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\Component\Listing\Columns\Column;
use Magestudy\Crud\Api\Data\PostInterface;
use Magestudy\Crud\Helper\Data;
use Magestudy\Crud\Ui\Component\Listing\Column\PostAction;

class Image extends Column
{
    const DEFAULT_IMG = 'thumbnail_empty.jpg';
    const UPLOAD_FOLDER = 'magestudy';

    /**
     * @var \Magento\Store\Api\Data\StoreInterface
     */
    protected $_store;

    /**
     * @var UrlInterface;
     */
    protected $_urlBuilder;

    /**
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param UrlInterface $urlBuilder
     * @param StoreManagerInterface $storeManager
     * @param array $components
     * @param array $data
     */
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        StoreManagerInterface $storeManager,
        array $components = [],
        array $data = []
    ) {
        $this->_store = $storeManager->getStore();
        $this->_urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                $baseUrl = $this->_store->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);

                if ($item[$fieldName] != '') {
                    $url = $baseUrl . $item[$fieldName];
                } else {
                    $url = $baseUrl . self::UPLOAD_FOLDER . '/' . strtolower(PostInterface::ENTITY_TITLE) . '/' . self::DEFAULT_IMG;
                }

                $item[$fieldName . '_src'] = $url;
                $item[$fieldName . '_alt'] = $this->getAlt($item) ?: '';
                $item[$fieldName . '_link'] = $this->_urlBuilder->getUrl(PostAction::PATH_EDIT,
                    [Data::FRONTEND_ID => $item[PostInterface::ID]]
                );
                $item[$fieldName . '_orig_src'] = $url;
            }
        }
        return $dataSource;
    }

    /**
     * @param array $row
     *
     * @return null|string
     */
    protected function getAlt($row)
    {
        $altField = $this->getData('config/altField') ?: PostInterface::TITLE;
        return isset($row[$altField]) ? $row[$altField] : null;
    }
}