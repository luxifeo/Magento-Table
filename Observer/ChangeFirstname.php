<?php

namespace Packt\Table\Observer;

use Magento\Customer\Api\CustomerRepositoryInterface;

class ChangeFirstname implements \Magento\Framework\Event\ObserverInterface
{
    public function __construct(\Magento\Framework\App\Request\Http $request,
CustomerRepositoryInterface $customerRepository) {
        $this->request = $request;
        $this->customerRepo = $customerRepository;
    }

	public function execute(\Magento\Framework\Event\Observer $observer)
	{
        $customerEmail = $this->request->getPost()['email'];
        $customer = $this->customerRepo->get($customerEmail);
        $customer->setFirstname("Magenest"); //set customer First Name
        $this->customerRepo->save($customer);
	}
}
