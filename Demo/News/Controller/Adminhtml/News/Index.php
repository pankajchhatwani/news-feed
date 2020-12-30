<?php
namespace Demo\News\Controller\Adminhtml\News;

class Index extends \Magento\Backend\App\Action
{
    
    protected $_resultPageFactory;
 
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) 
    {
        parent::__construct($context);
        $this->_resultPageFactory = $resultPageFactory;
    }
 
    public function execute()
    {
 
        $resultPage = $this->_resultPageFactory->create();
        $resultPage->setActiveMenu('Demo_News::news_news_list');
        $resultPage->getConfig()->getTitle()->prepend(__('News Feed'));
 
        return $resultPage;
    }
 
    protected function _isAllowed()
    {
        return true;
    }
}