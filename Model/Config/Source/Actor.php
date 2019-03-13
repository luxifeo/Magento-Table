<?php
namespace Packt\Table\Model\Config\Source;

use Magento\Framework\Option\ArrayInterface;

class Actor implements ArrayInterface {
    protected $_actor;

    public function __construct(\Packt\Table\Model\ActorFactory $actor)
    {
        $this->_actor = $actor;
    }

    public function toOptionArray()
    {
        $director = $this->_actor->create()->getCollection();
        $array = [];
        foreach ($director as $key=> $data) {
            $array[] = [
                'value' => $data->getName(),
                'label' => $data->getName()
            ];
        }

        return $array;
    }

}