<?php
namespace Packt\Table\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Director implements ArrayInterface {
    protected $_director;

    public function __construct(\Packt\Table\Model\DirectorFactory $director)
    {
        $this->_director = $director;
    }

    public function toOptionArray()
    {
        $director = $this->_director->create()->getCollection();
        $array = [];
        foreach ($director as $key=> $data) {
            $array[] = [
                'value' => $data->getDirectorId(),
                'label' => $data->getName()
            ];
        }

        return $array;
    }

}