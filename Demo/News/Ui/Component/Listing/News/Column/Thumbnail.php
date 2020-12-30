<?php
namespace Demo\News\Ui\Component\Listing\News\Column;

use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;

class Thumbnail extends \Magento\Ui\Component\Listing\Columns\Column
{
    const NAME = 'thumbnail';

    const ALT_FIELD = 'name';


    private $_getModel;
    
    private $editUrl;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        \Demo\News\Model\News\Image $imageHelper,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->imageHelper = $imageHelper;
        $this->urlBuilder = $urlBuilder;
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $fieldName = $this->getData('name');
            foreach ($dataSource['data']['items'] as & $item) {
                $filename = $item['image'];
                $item[$fieldName . '_src'] = $this->imageHelper->getBaseUrl().$filename;
                $item[$fieldName . '_orig_src'] = $this->imageHelper->getBaseUrl().$filename;
                $item[$fieldName . '_link'] = $this->urlBuilder->getUrl(
                    'news/news/addnews',
                    ['id' => $item['news_id'], 'store' => $this->context->getRequestParam('store')]
                );
            }
        }
        return $dataSource;
    }
    protected function getAlt($row)
    {
        $altField = $this->getData('config/altField') ?: self::ALT_FIELD;
        return isset($row[$altField]) ? $row[$altField] : null;
    }
}