<?php
namespace Packt\Table\Block\Adminhtml;
class Grid extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_controller = 'adminhtml_grid';
        $this->_blockGroup = 'Packt_Table';
        $this->_headerText = __('Movie');
        parent::_construct();
        if ($this->_isAllowedAction('Packt_Table::save')) {
            $this->buttonList->update('add', 'label', __('Add New Movie'));
        } else {
            $this->buttonList->remove('add');
        }
    }
    protected function _isAllowedAction($resourceId)
    {
        return $this->_authorization->isAllowed($resourceId);
    }
}