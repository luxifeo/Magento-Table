<?php
/**
 * Created by PhpStorm.
 * User: heomep
 * Date: 08/04/2017
 * Time: 00:18
 */

namespace Packt\Table\Model\ResourceModel\Movie;
class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @param \Magento\Framework\Data\Collection\EntityFactory $entityFactory
     * @param \Psr\Log\LoggerInterface $logger
     * @param \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy
     * @param \Magento\Framework\Event\ManagerInterface $eventManager
     * @param mixed $connection
     * @param \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource
     */
    public function __construct(
        \Magento\Framework\Data\Collection\EntityFactory $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    )
    {
        parent::__construct($entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource);
    }

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Packt\Table\Model\Movie', 'Packt\Table\Model\ResourceModel\Movie');
        $this->_idFieldName = 'movie_id';
    }

    /*
     * @Override \Magento\Framework\Data\Collection addItem()
     */
    public function addItem(\Magento\Framework\DataObject $item)
    {
        $itemId = $this->_getItemId($item);

        if ($itemId !== null) {
            if (isset($this->_items[$itemId])) {
                $actor = $this->_items[$itemId]->getActorName();
                $newActor = $item->getActorName();
                $this->_items[$itemId]->setActorName($actor . ',' . $newActor);
//                throw new \Exception(
//                    'Item (' . get_class($item) . ') with the same ID "' . $item->getId() . '" already exists.'
//                );
            } else
                $this->_items[$itemId] = $item;
        } else {
            $this->_addItem($item);
        }
        return $this;
    }

}