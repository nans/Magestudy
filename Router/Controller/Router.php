<?php

namespace Magestudy\Router\Controller;

use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\Request\Http;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ResponseInterface;

class Router implements RouterInterface
{
    const NEW_ROUTE      = 'sample';
    const CURRENT_ROUTER = 'customrouter';

    /**
     * @var ActionFactory
     */
    private $actionFactory;

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @param ActionFactory $actionFactory
     * @param ResponseInterface $response
     */
    public function __construct(
        ActionFactory $actionFactory,
        ResponseInterface $response
    ) {
        $this->actionFactory = $actionFactory;
        $this->response = $response;
    }

    /**
     * @param RequestInterface|Http $request
     * @return ActionInterface
     */
    public function match(RequestInterface $request)
    {
        if ($request->getModuleName() === self::CURRENT_ROUTER) {
            return null;
        }

        $identifier = trim($request->getPathInfo(), '/');
        if (strpos($identifier, self::NEW_ROUTE) !== false) {
            $request->setModuleName(self::CURRENT_ROUTER);
            $request->setControllerName('index');
            $request->setActionName('index');

            return $this->actionFactory->create(Forward::class);
        }

        return null;
    }
}