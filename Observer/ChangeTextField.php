<?php

namespace Packt\Table\Observer;

use Magento\Framework\App\Cache\TypeListInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\App\Config\Storage\Writer;

class ChangeTextField implements ObserverInterface
{
    private $_writer;
    private $scopeConfig;
    private $cache;

    public function __construct(ScopeConfigInterface $scopeConfig,
                                Writer $config, TypeListInterface $cacheTypeList)
    {
        $this->scopeConfig = $scopeConfig;
        $this->_writer = $config;
        $this->cache = $cacheTypeList;
    }

    /**
     * @param Observer $observer
     * @return void
     */
    public function execute(Observer $observer)
    {
        $changedField = $observer->getData('changed_paths');
        if (in_array('movie/movie/textf', $changedField)) {
            $value = $this->scopeConfig->getValue('movie/movie/textf', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
            if ($value == 'Ping') {
                $this->_writer->save('movie/movie/textf', 'Pong', 'default', 0);
                //$this->cache->cleanType(\Magento\Framework\App\Cache\Type\Config::TYPE_IDENTIFIER);
                //$this->cache->cleanType(\Magento\PageCache\Model\Cache\Type::TYPE_IDENTIFIER);
            }
        }
    }
}