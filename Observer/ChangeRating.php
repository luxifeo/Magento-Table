<?php

namespace Packt\Table\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class ChangeRating implements ObserverInterface {

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $movie = $observer->getData('movie');
        $movie->setRating(0);
        return $this;
    }
}