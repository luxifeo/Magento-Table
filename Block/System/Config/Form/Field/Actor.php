<?php
namespace Packt\Table\Block\System\Config\Form\Field;

use Magento\Config\Block\System\Config\Form\Field;
use Packt\Table\Model\ActorFactory;

class Actor extends Field {
    protected $_actor;

    public function __construct(\Magento\Backend\Block\Template\Context $context,
                                ActorFactory $actor,
                                array $data = [])
    {
        parent::__construct($context, $data);
        $this->_actor = $actor;
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $count = count($this->_actor->create()->getCollection());

        $element->setValue($count);
        $element->setData('readonly', 1);
        return $element->getElementHtml();
    }
}