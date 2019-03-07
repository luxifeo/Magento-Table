<?php
/**
 * Created by PhpStorm.
 * User: hoa
 * Date: 3/7/19
 * Time: 8:25 AM
 */

namespace Packt\Table\Setup;

use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade(SchemaSetupInterface $setup,
                            ModuleContextInterface $context)
    {
        $setup->startSetup();
        if (version_compare($context->getVersion(), '1.0.2') < 0) {

            // Get module table
            $tableName = $setup->getTable('magenest_movie');

            // Check if the table already exists
            if ($setup->getConnection()->isTableExists($tableName) == true) {
                // Declare data
                $connection = $setup->getConnection();
                $connection->changeColumn(
                    $tableName,
                    'director_id',
                    'director_id',
                    ['type' => Table::TYPE_INTEGER, 'length' => 10,
                        'unsigned' => true]
                );
                $connection->addForeignKey($setup->getFkName($tableName, 'director_id',
                    $setup->getTable('magenest_director'), 'director_id'
                ), $tableName, 'director_id',
                    $setup->getTable('magenest_director'), 'director_id'
                );
            }
        }

        $setup->endSetup();
    }
}