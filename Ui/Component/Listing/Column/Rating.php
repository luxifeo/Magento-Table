<?php

namespace Packt\Table\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Rating extends Column
{
    public function __construct(ContextInterface $context, UiComponentFactory $uiComponentFactory,
                                array $components = [], array $data = [])
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $text = $item['rating'];
                $rate = $text * 10;
                $item[$this->getData('name')] = '<div class="rating-summary"><div class="rating-result" title="' . $text . '"><span style="width:'.$rate.'%"><span><span itemprop="ratingValue">100</span>% of <span itemprop="bestRating">100</span></span></span></div></div>';
//              <div class="rating-summary">
//                  <div class="rating-result" title="20%">
//                      <span style="width:50%">
//                          <span>
//                              <span itemprop="ratingValue">20</span>% of <span itemprop="bestRating">100</span>
//                          </span>
//                      </span>
//                  </div>
//              </div>
            }
        }
        return $dataSource;
    }
}