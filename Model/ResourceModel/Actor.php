<?php
/**
 * Created by PhpStorm.
 * User: heomep
 * Date: 08/04/2017
 * Time: 00:17
 */
namespace Packt\Table\Model\ResourceModel;

class Actor extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Block grid entity table
     *
     * @var string
     */
    protected $_blockProductTable;
    /**
     * Construct
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     * @param \Magento\Store\Model\StoreManagerInterface $storeManager
     * @param string|null $resourcePrefix
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        $resourcePrefix = null
    ) {
        parent::__construct($context, $resourcePrefix);
    }
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('magenest_actor', 'actor_id');
    }
}