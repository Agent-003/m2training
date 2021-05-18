<?php

namespace Training\TestCms\Controller\Page;

use Magento\Cms\Helper\Page as PageHelper;
use Magento\Framework\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Cms\Api\PageRepositoryInterface;

class View extends \Magento\Cms\Controller\Page\View
{

    /**
     * @var JsonFactory
     */
    private $resultJsonFactory;
    
    public function __construct(
        JsonFactory $resultJsonFactory,
        Context $context,
        pageHelper $pageHelper,
        ForwardFactory $resultForwardFactory,
        RequestInterface $request,
        PageRepositoryInterface $pageRepository
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->pageRepository = $pageRepository;
        parent::__construct($context, $request, $pageHelper,$resultForwardFactory);
    }

    public function execute()
    {
        if ($this->getRequest()->isAjax()) {

            $data = ['status' => 'success', 'message' => ''];
            $pageId = $this->getRequest()->getParam('page_id', $this->getRequest()->getParam('id', false));
            $resultJson = $this->resultJsonFactory->create();

            try {
                $page = $this->pageRepository->getById($pageId);
                $data['title'] = $page->getTitle();
                $data['content'] = $page->getContent();
            } catch (NoSuchEntityException $e) {
                $data['status'] = 'error';
                $data['message'] = 'Not found';
            } catch (\Exception $e) {
                $data['status'] = 'error';
                $data['message'] = 'Something wrong';
            }

            $resultJson->setData($data);
            return $resultJson;
        }

        return parent::execute();
    }
}
