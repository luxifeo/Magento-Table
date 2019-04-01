<?php
/**
 * InlineEdit.php
 *
 * @copyright Copyright © 2019 DrinkiesLocal. All rights reserved.
 * @author    cuongnv@magenest.com
 */
namespace Packt\Table\Controller\Adminhtml\Movie;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Packt\Table\Model\ResourceModel\Movie\Collection;

/**
 * Grid inline edit controller
 *
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class InlineSave extends Action
{

    /** @var JsonFactory $jsonFactory */
    protected $jsonFactory;

    /**
     * @var Collection
     */
    protected $objectCollection;

    /**
     * @param Context $context
     * @param Collection $objectCollection
     * @param JsonFactory $jsonFactory
     */
    public function __construct(
        Context $context,
        Collection $objectCollection,
        JsonFactory $jsonFactory
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->objectCollection = $objectCollection;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Framework\Controller\Result\Json $resultJson */
        $resultJson = $this->jsonFactory->create();
        $error = false;
        $messages = [];

//        $postItems = $this->getRequest()->getParam('items', []);
//        if (!($this->getRequest()->getParam('isAjax') && count($postItems))) {
//            return $resultJson->setData([
//                'messages' => [__('Please correct the data sent.')],
//                'error' => true,
//            ]);
//        }
//
//        try {
//            $this->objectCollection
//                ->addFieldToFilter('movie_id', array('in' => array_keys($postItems)))
//                ->walk('saveCollection', array($postItems));
//        } catch (\Exception $e) {
//            $messages[] = __('There was an error saving the data: ') . $e->getMessage();
//            $error = true;
//        }
//
//        return $resultJson->setData([
//            'messages' => $messages,
//            'error' => $error
//        ]);
        if ($this->getRequest()->getParam('isAjax')) {
            $postItems = $this->getRequest()->getParam('items', []);
            if (!count($postItems)) {
                $messages[] = __('Please correct the data sent.');
                $error = true;
            } else {
                foreach (array_keys($postItems) as $entityId) {
                    /** load your model to update the data */
                    $model = $this->_objectManager->create('Packt\Table\Model\Movie')->load($entityId);
                    try {
                        $model->setData(array_merge($model->getData(), $postItems[$entityId]));
                        $model->save();
                    } catch (\Exception $e) {
                        $messages[] = "[Error:]  {$e->getMessage()}";
                        $error = true;
                    }
                }
            }
        }

        return $resultJson->setData([
            'messages' => $messages,
            'error' => $error
        ]);
    }
}
