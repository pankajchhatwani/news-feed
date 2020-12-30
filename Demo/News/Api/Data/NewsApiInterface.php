<?php
namespace Demo\News\Api\Data;

interface NewsApiInterface
{
    const ID           = 'news_id';
    const TITLE        = 'title';
    const IMAGE  = 'image';
    const STATUS  = 'status';
    const DESCRIPTION  = 'description';
    const CREATED_AT        = 'created_at';
    const UPDATED_AT        = 'updated_at';


    public function getId();

    public function setId($id);

    public function getTitle();

    public function setTitle($title);

    public function getImage();

    public function setImage($image);

    public function getStatus();

    public function setStatus($status);

    public function getDescription();

    public function setDescription($description);

    public function getCreatedAt();

    public function setCreatedAt($createdAt);

    public function getUpdatedAt();

    public function setUpdatedAt($updatedAt);
}
