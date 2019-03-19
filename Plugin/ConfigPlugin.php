<?php

namespace Packt\Table\Plugin;

class ConfigPlugin
{
    public function aroundSave(\Magento\Config\Model\Config $subject, \Closure $proceed)
    {
        $s = $subject->getData('groups');//['groups']['movie']['fields']['textf'];
        if ($s['movie']['fields']['textf']['value'] == 'Ping') {
            $s['movie']['fields']['textf']['value'] = 'Pong';
            $subject->setData('groups', $s);
        }
        return $proceed();
    }
}