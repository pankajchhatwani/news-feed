<?php
namespace Demo\News\Model\Api;

class NewsApi implements \Demo\News\Api\NewsInterface
{

    protected $_newsFactory;

    public function __construct(
        \Demo\News\Model\NewsFactory $newsFactory

    ) {
        $this->_newsFactory = $newsFactory;
    }

    public function getById($id)
    {
        try {
            $model = $this->_newsFactory->create()->getCollection()->addFieldToFilter('news_id',$id)->getFirstItem();

            if (!$model->getNewsId()) {
                throw new \Magento\Framework\Exception\LocalizedException(
                    __('no data found')
                );
            }

            return $model;
        } catch (\Magento\Framework\Exception\LocalizedException $e) {
            $returnArray['error'] = $e->getMessage();
            $returnArray['status'] = 0;
            $this->getJsonResponse(
                $returnArray
            );
        } catch (\Exception $e) {
            $this->createLog($e);
            $returnArray['error'] = __('unable to process request');
            $returnArray['status'] = 2;
            $this->getJsonResponse(
                $returnArray
            );
        }
    }
}