<?php
namespace Packt\Table\Block\Adminhtml\Custom;

use Magento\Backend\Block\Template;

class Index extends Template {
    protected $creditMemo;
    protected $order;
    protected $customer;
    protected $invoice;
    protected $product;
    protected $module;
    public function __construct(Template\Context $context,
                                \Magento\Sales\Model\ResourceModel\Order\Creditmemo\Collection $creditMemo,
                                \Magento\Sales\Model\ResourceModel\Order\Collection $order,
                                \Magento\Sales\Model\ResourceModel\Order\Customer\Collection $customer,
                                \Magento\Catalog\Model\ResourceModel\Product\Collection $product,
                                \Magento\Sales\Model\ResourceModel\Order\Invoice\Collection $invoice,
                                \Magento\Framework\Module\FullModuleList $moduleList,
                                array $data = [])
    {
        $this->module = $moduleList;
        $this->invoice = $invoice;
        $this->product = $product;
        $this->creditMemo = $creditMemo;
        $this->order = $order;
        $this->customer = $customer;
        parent::__construct($context, $data);
    }

    public function getCreditMemoCount() {
        return $this->creditMemo->getTotalCount();
    }

    public function getOrderCount() {
        return $this->order->getTotalCount();
    }

    public function getCustomerCount() {
        return $this->customer->count();
    }

    public function getProductCount() {
        return $this->product->count();
    }

    public function getInvoiceCount() {
        return $this->invoice->count();
    }

    public function getModuleCount() {
        return count($this->module->getAll());
    }

    public function getCustomModuleCount() {
        $num = $this->module->getAll();
        return count(array_filter($num, function ($module) {
            if(preg_match('/Magento/', $module['name']))
                return false;
            return true;
        }));
    }
}