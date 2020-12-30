<?php
namespace Demo\News\Block\Adminhtml\News\Edit;

class Form extends \Magento\Backend\Block\Widget\Form\Generic
{
    protected $_systemStore;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig,
        \Demo\News\Model\NewsStatus $options,
        array $data = []
    ) 
    {
        $this->_wysiwygConfig = $wysiwygConfig;
        $this->_options = $options;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
        $dateFormat = $this->_localeDate->getDateFormat(\IntlDateFormatter::SHORT);
        $model = $this->_coreRegistry->registry('news_data');

        $form = $this->_formFactory->create(
            ['data' => [
                'id' => 'edit_form', 
                'enctype' => 'multipart/form-data', 
                'action' => $this->getData('action'), 
                'method' => 'post'
                ]
            ]
        );

        $form->setHtmlIdPrefix('news_template_news_');

        if ($model->getNewsId()) {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('General Information'), 'class' => 'fieldset-wide']
            );
            $fieldset->addField('news_id', 'hidden', ['name' => 'news_id']);
        } else {
            $fieldset = $form->addFieldset(
                'base_fieldset',
                ['legend' => __('General Information'), 'class' => 'fieldset-wide']
            );
        }

        $fieldset->addField(
            'title',
            'text',
            [
                'name' => 'title',
                'label' => __('Title'),
                'id' => 'title',
                'title' => __('Title'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $wysiwygConfig = $this->_wysiwygConfig->getConfig(['tab_id' => $this->getTabId()]);

        $fieldset->addField(
            'image',
            'image',
            [
                'name' => 'image',
                'label' => __('Image'),
                'title' => __('Image'),
                'required'  => true

            ]
        )->setAfterElementHtml('
            <script>
            require([
            "jquery",
            ], function($){
            $(document).ready(function () {
            if($(".small-image-preview").length){
            $("#news_template_news_image").removeClass("required-file");
            }else{
            $("#news_template_news_image").addClass("required-file");
            }
            $( "#news_template_news_image" ).attr( "accept", "image/x-png,image/gif,image/jpeg,image/jpg,image/png" );
            });
            });
            </script>
        ');

        $fieldset->addField(
            'description',
            'text',
            [
                'name' => 'description',
                'label' => __('Description'),
                'id' => 'description',
                'title' => __('Description'),
                'class' => 'required-entry',
                'required' => true,
            ]
        );

        $fieldset->addField(
            'status',
            'select',
            [
                'name' => 'status',
                'label' => __('Status'),
                'id' => 'status',
                'title' => __('Status'),
                'values' => $this->_options->getOptionArray(),
                'class' => 'status',
                'required' => true,
            ]
        );

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}