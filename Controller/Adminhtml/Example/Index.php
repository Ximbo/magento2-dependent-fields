<?php

namespace Acme\DependentFields\Controller\Adminhtml\Example;

/**
 * Class Index
 * @package Acme\DependentFields\Controller\Adminhtml\Example
 */
class Index extends \Magento\Backend\App\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory */
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }
    /**
     * @inheritdoc
     */
    public function execute()
    {
        return  $resultPage = $this->resultPageFactory->create();
    }
}
