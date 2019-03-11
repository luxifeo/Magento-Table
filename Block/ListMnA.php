<?php

namespace Packt\Table\Block;

use Magento\Framework\View\Element\Template\Context;
use Packt\Table\Model\MnAFactory;

/**
 * Test List block
 */
class ListMnA extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        Context $context,
        MnAFactory $mna
    )
    {
        $this->_mna = $mna;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Movie And Actor List'));

        return parent::_prepareLayout();
    }

    public function getMovieAndActorCollection()
    {
        $mna = $this->_mna->create()->getCollection();
        $mna->getSelect()
            ->joinLeft(['mma' => $mna->getTable('magenest_movie_actor')],
                'main_table.movie_id = mma.movie_id')
            ->joinLeft(['ma' => $mna->getTable('magenest_actor')],
                'mma.actor_id = ma.actor_id', ['actor_name' => 'name']);
        return $mna;
    }
}