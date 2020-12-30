<?php
namespace Demo\News\Model\ResourceModel;

use Magento\Framework\Model\AbstractModel;

class News extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        \Magento\Framework\Stdlib\DateTime\DateTime $date,
        $resourcePrefix = null
    )
    {
        parent::__construct($context, $resourcePrefix);
        $this->_date = $date;
    }

    protected function _construct()
    {
        $this->_init('demo_news', 'news_id');
    }

    protected function _beforeSave(AbstractModel $object)
    {

        $object->setUpdatedAt($this->_date->gmtDate());
        if ($object->isObjectNew()) {
            $object->setCreatedAt($this->_date->gmtDate());
        }
        return parent::_beforeSave($object);
    }

}