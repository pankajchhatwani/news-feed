<?php
namespace Demo\News\Controller\Adminhtml\News;

use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Controller\ResultFactory; 

class Save extends \Magento\Backend\App\Action
{
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Image\AdapterFactory $adapterFactory,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\Filesystem $filesystem,
        \Demo\News\Model\NewsFactory $newsFactory
    ) {
        parent::__construct($context);
        $this->adapterFactory = $adapterFactory;
        $this->uploaderFactory = $uploaderFactory;
        $this->filesystem = $filesystem;
        $this->newsNewsFactory = $newsFactory;
    }

    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if (!$data) {
            $this->_redirect('news/news/addnews');
            return;
        }
        try {
            $rowData = $this->newsNewsFactory->create();
            if(isset($data['image'])){
                $data['image'] =   $data['image']['value'];
            }
            $rowData->setData($data);

            if(!empty($this->getRequest()->getFiles('image'))){
                $profileImage = $this->getRequest()->getFiles('image');
                $fileName = ($profileImage && array_key_exists('name', $profileImage)) ? $profileImage['name'] : null;
                if ($profileImage && $fileName) {
                    $uploader = $this->uploaderFactory->create(['fileId' => 'image']);
                    $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);

                    $imageAdapterFactory = $this->adapterFactory->create();

                    $uploader->setAllowRenameFiles(true);
                    $uploader->setFilesDispersion(true);
                    $uploader->setAllowCreateFolders(true);
                    $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);

                    $result = $uploader->save($mediaDirectory->getAbsolutePath('Demo/News'));
                
                }
            }
            if(isset($result)){
                $image = 'Demo/News'.$result['file'];
                $rowData->setImage($image);
            }
            if ($this->getRequest()->getParam('id')) {

                $rowData->setNewsId($this->getRequest()->getParam('id'));
            }

            $rowData->save();

            $this->messageManager->addSuccess(__('News feed has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__("Attention: Something went wrong."));
        }

        return $this->resultFactory->create(ResultFactory::TYPE_REDIRECT)->setPath('*/*/index');
    }

    protected function _isAllowed()
    {
        return true;
    }
}