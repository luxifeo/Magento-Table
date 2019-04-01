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
            $this->upgradeV1_0_2($setup);
        }
        if (version_compare($context->getVersion(), '1.0.3') < 0) {
            // Get module table
            $this->upgradeV1_0_3($setup);
        }
        if (version_compare($context->getVersion(), '1.0.4' < 0)) {
            $this->upgradev1_0_4($setup);
        }
        $setup->endSetup();
    }

    /**
     * @param SchemaSetupInterface $setup
     */
    private function upgradeV1_0_2(SchemaSetupInterface $setup): void
    {
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

    private function upgradeV1_0_3(SchemaSetupInterface $setup)
    {
        $tableName = $setup->getTable('magenest_movie');
        if ($setup->getConnection()->isTableExists($tableName) == true) {
            // Declare data
            $connection = $setup->getConnection();
            $connection->addColumn(
                $tableName,
                'actor',
                ['type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'nullable' => true,
                    'comment' => 'Multiselect Testing']);
        }
    }

    private function upgradeV1_0_4(SchemaSetupInterface $setup)
    {
        $table = $setup->getTable('magenest_movie');
        $setup->getConnection()
            ->addIndex(
                $table,
                $setup->getIdxName(
                    $table,
                    ['name', 'description'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT),
                ['name', 'description'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
            );
    }
}