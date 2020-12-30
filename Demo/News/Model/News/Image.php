<?php
namespace Demo\News\Model\News;

use Magento\Framework\UrlInterface;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;
class Image
{
    
    protected $subDir = ''; 

    protected $urlBuilder;
    
    protected $fileSystem;
    
    public function __construct(
        UrlInterface $urlBuilder,
        Filesystem $fileSystem
    )
    {
        $this->urlBuilder = $urlBuilder;
        $this->fileSystem = $fileSystem;
    }

    public function getBaseUrl()
    {
        return $this->urlBuilder->getBaseUrl(['_type' => UrlInterface::URL_TYPE_MEDIA]).$this->subDir;
    }
}