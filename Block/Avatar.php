<?php
namespace Packt\Table\Block;
use Magento\Framework\View\Element\Template\Context;
class Avatar extends \Magento\Framework\View\Element\Template
{
    protected $_customerFactory;

    public function __construct(
        Context $context,
        \Magento\Customer\Model\ResourceModel\Customer\CollectionFactory $customerFactory)
    {
        $this->_customerFactory = $customerFactory;
        parent::__construct($context);
    }

    /**
     * Get customer collection
     */
    public
    function getCustomerCollection()
    {
        return $this->_customerFactory->create()->addAttributeToSelect('test_attribute');
    }
}