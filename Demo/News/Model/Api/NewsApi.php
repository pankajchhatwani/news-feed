<?php
namespace Demo\News\Model\Api;

class NewsApi implements \Demo\News\Api\NewsInterface
{

    protected $_newsFactory;

    public function __construct(
        \Demo\News\Model\ResourceModel\News $resource,
        \Demo\News\Model\NewsFactory $newsFactory

    ) {
        $this->resource = $resource;
        $this->_newsFactory = $newsFactory;
    }

    public function getById($id)
    {
        $model = $this->_newsFactory->create();
        $this->resource->load($model, $id);

        if (!$model->getNewsId()) {
            throw new \Magento\Framework\Exception\LocalizedException(
                __('no data found')
            );
        }

        return $model;

    }
}
