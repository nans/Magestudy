<?php

namespace Magestudy\LogRepository\Helper;

use Magestudy\LogRepository\Api\LogRepositoryInterface as Repository;
use Magestudy\LogRepository\Model\LogFactory as Factory;
use Magestudy\LogRepository\Api\Data\LogInterface as ItemInterface;

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
    }
}