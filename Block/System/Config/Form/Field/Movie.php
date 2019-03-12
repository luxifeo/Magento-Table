<?php
namespace Packt\Table\Block\System\Config\Form\Field;

use Magento\Config\Block\System\Config\Form\Field;
use Packt\Table\Model\MovieFactory;

class Movie extends Field {
    protected $_movie;

    public function __construct(\Magento\Backend\Block\Template\Context $context,
                                MovieFactory $movie,
                                array $data = [])
    {
        parent::__construct($context, $data);
        $this->_movie = $movie;
    }

    protected function _getElementHtml(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        $count = $this->_movie->create()->getCollection();

        $element->setValue(count($count));
        $element->setData('readonly', 1);
        return $element->getElementHtml();
    }
}