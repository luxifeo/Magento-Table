<?php

namespace Packt\Table\Controller\Adminhtml\System\Config;
use Magento\Config\Block\System\Config\Form\Field\Notification;
use \Magento\Catalog\Model\Product\Visibility;

class Button extends \Magento\Backend\App\Action
{
    protected $_logger;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Psr\Log\LoggerInterface $logger
    )
    {
        $this->_logger = $logger;
        parent::__construct($context);
    }

    public function execute()
    {
    }
}