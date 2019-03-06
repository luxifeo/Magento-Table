<?php

namespace Packt\Table\Block;

use Magento\Framework\View\Element\Template\Context;
use Packt\Table\Model\ActorFactory;
/**
 * Test List block
 */
class ListActor extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        Context $context,
        ActorFactory $actor
    ) {
        $this->_actor = $actor;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Actor List'));

        return parent::_prepareLayout();
    }

    public function getActorCollection()
    {
        $actor = $this->_actor->create();
        $collection = $actor->getCollection();
        return $collection;
    }
}