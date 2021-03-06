<?php

namespace Packt\Table\Model;
class Movie extends \Magento\Framework\Model\AbstractModel
{
    const CACHE_TAG = 'packt_table';
    /**
     * @var string
     */
    protected $_cacheTag = 'packt_table';
    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'packt_table';
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource =
        null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection =
        null,
        array $data = []
    )
    {
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    public function _construct()
    {
        $this->_init('Packt\Table\Model\ResourceModel\Movie');
    }
}