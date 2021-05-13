<?php

namespace Training\RedirectToMain\App\Router;

use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\Router\NoRouteHandlerInterface;
use Psr\Log\LoggerInterface;

class NoRouteHandler implements NoRouteHandlerInterface
{
    private $logger;



    public function process(RequestInterface $request)
    {
        $moduleName = 'cms';
        $controllerPath = 'index';
        $controllerName = 'index';
        
        $request->setModuleName($moduleName)->setControllerName($controllerPath)->setActionName($controllerName);

        return true;
    }
}
