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
        if (version_compare($context->getVersion(), '1.0.3') < 0) {

            // Get module table
            $tableName = $setup->getTable('magenest_movie_actor');

            // Check if the table already exists
            if ($setup->getConnection()->isTableExists($tableName) == true) {
                // Declare data
                $connection = $setup->getConnection();
                $connection->changeColumn(
                    $tableName,
                    'movie_id',
                    'movie_id',
                    ['type' => Table::TYPE_INTEGER, 'length' => 10,
                        'unsigned' => true]
                );
                $connection->changeColumn(
                    $tableName,
                    'actor_id',
                    'actor_id',
                    ['type' => Table::TYPE_INTEGER, 'length' => 10,
                        'unsigned' => true]
                );
                $connection->addForeignKey($setup->getFkName($tableName, 'movie_id',
                    $setup->getTable('magenest_movie'), 'movie_id'
                ), $tableName, 'movie_id',
                    $setup->getTable('magenest_movie'), 'movie_id'
                );
                $connection->addForeignKey($setup->getFkName($tableName, 'actor_id',
                    $setup->getTable('magenest_actor'), 'actor_id'
                ), $tableName, 'actor_id',
                    $setup->getTable('magenest_actor'), 'actor_id'
                );
            }
        }

        $setup->endSetup();
    }
}