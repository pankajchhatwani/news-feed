<?php
namespace Demo\News\Model;

use Demo\News\Api\Data\NewsApiInterface;
use Magento\Framework\Model\AbstractModel;

class News extends AbstractModel implements NewsApiInterface
{
    const CACHE_TAG = 'demo_news';

    protected $_cacheTag = 'demo_news';

    protected function _construct()
    {
        $this->_init('Demo\News\Model\ResourceModel\News');
    }

    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }


    public function getId()
    {
        return $this->getData(NewsApiInterface::ID);
    }

    public function setId($id)
    {
        return $this->setData(NewsApiInterface::ID, $id);
    }

    public function getTitle()
    {
        return $this->getData(NewsApiInterface::TITLE);
    }

    public function setTitle($title)
    {
        return $this->setData(NewsApiInterface::TITLE, $title);
    }

    public function getImage()
    {
        return $this->getData(NewsApiInterface::IMAGE);
    }

    public function setImage($image)
    {
        return $this->setData(NewsApiInterface::IMAGE, $image);
    }

    public function getStatus()
    {
        return $this->getData(NewsApiInterface::STATUS);
    }

    public function setStatus($status)
    {
        return $this->setData(NewsApiInterface::STATUS, $status);
    }

    public function getDescription()
    {
        return $this->getData(NewsApiInterface::DESCRIPTION);
    }

    public function setDescription($description)
    {
        return $this->setData(NewsApiInterface::DESCRIPTION, $description);
    }

    public function getCreatedAt()
    {
        return $this->getData(NewsApiInterface::CREATED_AT);
    }

    public function setCreatedAt($createdAt)
    {
        return $this->setData(NewsApiInterface::CREATED_AT, $createdAt);
    }

    public function getUpdatedAt()
    {
        return $this->getData(NewsApiInterface::UPDATED_AT);
    }

    public function setUpdatedAt($updatedAt)
    {
        return $this->setData(NewsApiInterface::UPDATED_AT, $updatedAt);
    }
}