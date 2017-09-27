<?php

namespace Magestudy\PluginExample\Plugin\Model;


use Magestudy\PluginExample\Model\Product;

class ProductPlugin
{
    public function beforeSetTitle(Product $subject, $title)
    {
        return ['prefix ' . $title];
    }

    public function afterGetPrice(Product $subject, $result)
    {
        return $result / 100;
    }

    public function aroundSave(Product $subject, callable $proceed)
    {
        $this->_createBackupCopy($subject);
        $returnValue = $proceed();
        if ($returnValue) {
            $this->_logChanges($subject);
        }
        return $returnValue;
    }

    /**
     * @param Product $subject
     */
    private function _createBackupCopy(& $subject)
    {
        $subject->setBackup();
    }

    /**
     * @param Product $subject
     */
    private function _logChanges(& $subject)
    {
        $subject->setLog(date('Y-m-d h:s') . ' product save;');
    }
}