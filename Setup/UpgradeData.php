<?php

namespace Packt\Table\Setup;

use Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Eav\Setup\EavSetupFactory;
use Magento\Eav\Model\Config;
use Magento\Customer\Model\Customer;
use Magento\Eav\Model\Entity\Attribute\SetFactory;

class UpgradeData implements UpgradeDataInterface
{
    private $eavSetupFactory;
    private $config;

    public function __construct(EavSetupFactory $eavSetupFactory, Config $config, SetFactory $attributeSetFactory)
    {
        $this->eavSetupFactory = $eavSetupFactory;
        $this->config = $config;
        $this->attributeSetFactory = $attributeSetFactory;
    }

    /**
     * Upgrades data for a module
     *
     * @param ModuleDataSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $eavSetup = $this->eavSetupFactory->create(['setup' => $setup]);
        if (version_compare($context->getVersion(), '1.0.4') < 0) {
            $this->upgradeDataV1_0_4($context, $eavSetup);
        }
    }

    /**
     * @param ModuleContextInterface $context
     * @param \Magento\Eav\Setup\EavSetup $eavSetup
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    private function upgradeDataV1_0_4(ModuleContextInterface $context, \Magento\Eav\Setup\EavSetup $eavSetup)
    {
//        $eavSetup->addAttribute(
//            Customer::ENTITY,
//            'test_attribute',
//            [
//                'type' => 'text',
//                'label' => 'Imagee',
//                'input' => 'image',
//                'backend' => '',
//                'position' => 300,
//                'required' => false,
//                'default' => '',
//                'global' => ScopedAttributeInterface::SCOPE_STORE,
//                'user_defined' => false,
//                'system' => false,
//                'visible' => true,
//                'is_used_in_grid' => false,
//                'is_visible_in_grid' => false,
//                'is_filterable_in_grid' => false
//            ]
//        );
        $eavSetup->updateAttribute(
            Customer::ENTITY,
            'test_attribute',
            'frontend_label',
            'Imagee'
        );
        $sampleAttribute = $this->config->getAttribute(Customer::ENTITY, 'test_attribute');

        // more used_in_forms ['adminhtml_checkout','adminhtml_customer','adminhtml_customer_address','customer_account_edit','customer_address_edit','customer_register_address']
        $sampleAttribute->setData(
            'used_in_forms',
            ['adminhtml_customer', 'customer_account_edit','customer_address_edit']

        );
        $sampleAttribute->save();
        $customerEntity = $this->config->getEntityType('customer');
        $attributeSetId = $customerEntity->getDefaultAttributeSetId();

        $attributeSet = $this->attributeSetFactory->create();
        $attributeGroupId = $attributeSet->getDefaultGroupId($attributeSetId);

        $attribute = $this->config->getAttribute(Customer::ENTITY, 'test_attribute')
            ->addData(
                [        'attribute_set_id' => $attributeSetId,
                    'attribute_group_id' => $attributeGroupId,]
            );
        $attribute->save();
    }
}