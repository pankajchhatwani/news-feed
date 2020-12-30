<?php
namespace Demo\News\Block;

class NewsList extends \Magento\Framework\View\Element\Template
{

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Demo\News\Model\ResourceModel\News\CollectionFactory $collectionFactory,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \Demo\News\Model\NewsStatus $options,
        array $data = []
    ) {
        parent::__construct($context,$data);
        $this->collection = $collectionFactory;
        $this->_storeManager = $storeManager;
        $this->_options = $options;
    }

    public function getNewsListCollection(){
        return $this->collection->create()/*->addFieldToFilter('status','1')*/;
    }

    public function getMediaUrl(){
        return $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    }

    public function getStatusLabel($status){
        return $this->_options->getOptionArray()[$status];
    }

}

