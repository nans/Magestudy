<?php

namespace Magestudy\Crud\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magestudy\Crud\Model\PostTag as Model;

class PostTag extends AbstractDb
{
    const MAIN_TABLE = 'crud_post_tag';

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init(self::MAIN_TABLE, Model::ID);
    }

    /**
     * @param int $postId
     * @param int $tagId
     * @return int
     */
    public function getIdByParams($postId, $tagId)
    {
        $select = $this->getConnection()
            ->select()
            ->from(['main_table' => $this->getConnection()->getTableName(self::MAIN_TABLE)],Model::ID)
            ->where('main_table.' . Model::POST_ID . ' = ?', $postId)
            ->where('main_table.' . Model::TAG_ID . ' = ?', $tagId);
        return $this->getConnection()->fetchOne($select);
    }
}