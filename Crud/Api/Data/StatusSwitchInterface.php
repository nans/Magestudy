<?php

namespace Magestudy\Crud\Api\Data;


interface StatusSwitchInterface
{
    public function activate();
    public function deactivate();

    /**
     * @return boolean
     */
    public function isActive();
}