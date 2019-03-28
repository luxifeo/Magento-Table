<?php

namespace Packt\Table\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class OddEven extends Column {
    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory,
                                array $components = [], array $data = [])
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $text = $item['increment_id'] % 2 ?
                    '<span class="grid-severity-critical">Odd</span>' :
                    '<span class="grid-severity-notice"> Even</span>';
                $item[$this->getData('name')] = $text;
            }
        }
        return $dataSource;
    }
}