<?php

namespace Packt\Table\Block;

use Magento\Framework\View\Element\Template\Context;
use Packt\Table\Model\MovieFactory;

/**
 * Test List block
 */
class ListMovie extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        Context $context,
        MovieFactory $movie
    )
    {
        $this->_movie = $movie;
        parent::__construct($context);
    }

    public function _prepareLayout()
    {
        $this->pageConfig->getTitle()->set(__('Movie List'));

        return parent::_prepareLayout();
    }

    public function getMovieCollection()
    {
        $movie = $this->_movie->create();
        $collection = $movie->getCollection();
        return $collection;
    }

    public function getMovieAndActorCollection()
    {
        $movie = $this->_movie->create()->getCollection();
        $movie->getSelect()
            ->joinLeft(['mma' => $movie->getTable('magenest_movie_actor')],
                'main_table.movie_id = mma.movie_id')
            ->joinLeft(['ma' => $movie->getTable('magenest_actor')],
                'mma.actor_id = ma.actor_id', ['actor_name' => 'name']);
        return $movie;
    }
}