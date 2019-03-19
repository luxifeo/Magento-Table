<?php
/**
 * Webkul Grid Row Save Controller
 *
 * @category    Webkul
 * @package     Webkul_Grid
 * @author      Webkul Software Private Limited
 *
 */
namespace Packt\Table\Controller\Adminhtml\Movie;
use Magento\Backend\App\Action;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function __construct(Action\Context $context, \Packt\Table\Model\MovieFactory $movieFactory)
    {
        parent::__construct($context);
        $this->movieFactory = $movieFactory;
    }
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        if (!$data) {
            $this->_redirect('*/*/');
            return;
        }
        if (!$data['movie_id']) {
            unset($data['movie_id']);
        }
        $objData = new \Magento\Framework\DataObject($data);
        $this->_eventManager->dispatch('packt_table_save_movie', ['movie'=>$objData]);
        $data['rating'] = $objData->getRating();
        if(array_key_exists('actor', $data))
            $data['actor'] = implode(",", $data['actor']); // Cường chữa
        try {
            $rowData = $this->movieFactory->create();
            $rowData->addData($data);
            $rowData->save();
            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('*/*/');
    }

    /**
     * Check Category Map permission.
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Packt_Table::save');
    }
}