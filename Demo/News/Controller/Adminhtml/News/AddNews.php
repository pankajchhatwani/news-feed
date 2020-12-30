<?php
namespace Demo\News\Controller\Adminhtml\News;

use Magento\Framework\Controller\ResultFactory;

class AddNews extends \Magento\Backend\App\Action
{

    private $coreRegistry;

    private $gridFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \Demo\News\Model\NewsFactory $gridFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->gridFactory = $gridFactory;
    }

    public function execute()
    {
        
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->gridFactory->create();
    
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getTitle();
            if (!$rowData->getNewsId()) {
                $this->messageManager->addError(__('News no longer exist.'));
                $this->_redirect('news/news/index');
                return;
            }
        }
        
        $this->coreRegistry->register('news_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit News Feed ').$rowTitle : __('Add News Feed ');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return true;
    }
}