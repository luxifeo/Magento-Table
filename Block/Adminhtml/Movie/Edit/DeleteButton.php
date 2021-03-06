<?php

namespace Packt\Table\Block\Adminhtml\Movie\Edit;

use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface {

    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Reset'),
            'on_click' => 'javascript: location.reload();',
            'class' => 'reset',
            'sort_order' => 30
        ];
    }
}