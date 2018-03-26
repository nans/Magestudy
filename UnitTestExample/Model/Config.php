<?php

namespace Magestudy\UnitTestExample\Model;

class Config
{
    public function configMessage()
    {
        return 'Message from config.';
    }

    public function getMessageByType($type)
    {
        switch ($type) {
            case 1:
                return 'one';
            case 2:
                return 'two';
            case 3:
                return 'three';
            default:
                return 'no message';
        }
    }
}