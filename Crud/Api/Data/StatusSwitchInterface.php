<?php

namespace Magestudy\Crud\Api\Data;


interface StatusSwitchInterface
{
    const ENABLED_STATUS = 1;
    const DISABLED_STATUS = 0;

    const IS_ACTIVE = 'is_active';

    public function activate();
    public function deactivate();

    /**
     * @return int
     */
    public function getIsActive();

    /**
     * @param int
     */
    public function setIsActive($isActive);

    /**
     * @return boolean
     */
    public function isActive();
}