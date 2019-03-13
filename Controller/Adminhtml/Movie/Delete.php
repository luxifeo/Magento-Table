<?php
namespace Packt\Table\Controller\Adminhtml\Movie;

use Magento\Backend\App\Action;

class Delete extends Action
{
    protected $_model;

    public function __construct(
        Action\Context $context,
        \Packt\Table\Model\Movie $model
    ) {
        parent::__construct($context);
        $this->_model = $model;
    }

    /**
     * {@inheritdoc}
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Packt_Table::delete');
    }

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($id) {
            try {
                $model = $this->_model;
                $model->load($id);
                $model->delete();
                $this->messageManager->addSuccess(__('Record deleted'));
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                $this->messageManager->addError($e->getMessage());
                return $resultRedirect->setPath('*/*/add', ['id' => $id]);
            }
        }
        $this->messageManager->addError(__('Record không found'));
        return $resultRedirect->setPath('*/*/');
    }
}