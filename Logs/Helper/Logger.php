<?php

namespace Magestudy\Logs\Helper;

use Magestudy\Logs\Api\LogRepositoryInterface as Repository;
use Magestudy\Logs\Model\LogFactory as Factory;
use Magestudy\Logs\Api\Data\LogInterface as ItemInterface;

class Logger
{
    /**
     * @var Factory
     */
    protected $_factory;

    /**
     * @var Repository
     */
    protected $_repository;

    /**
     * @param Factory $factory
     * @param Repository $repository
     */
    public function __construct(
        Factory $factory,
        Repository $repository
    ) {
        $this->_factory = $factory;
        $this->_repository = $repository;
    }

    /**
     * @param string $data
     *
     * @return boolean
     */
    public function addLog($data)
    {
        /** @var ItemInterface $log */
        try {
            $log = $this->_factory->create();
            $log->setContent($data);
            $this->_repository->save($log);
        } catch (\Exception $exception) {
            return false;
        }
        return true;

        //todo - how to use
        /** @var \Magestudy\Logs\Helper\Logger $logger */
        /*$logger =  ObjectManager::getInstance()->get(\Magestudy\Logs\Helper\Logger::class);
        $logger->addLog(json_encode($this->_request->getParams()));*/
    }
}