<?php
namespace Packt\Table\Setup;
use Magento\Framework\DB\Ddl\Table as Table;
/**
 * DB setup script for TokenBase
 */
class InstallSchema implements \Magento\Framework\Setup\InstallSchemaInterface
{
    /**
     * DB setup code
     *
     * @param \Magento\Framework\Setup\SchemaSetupInterface $setup
     * @param \Magento\Framework\Setup\ModuleContextInterface $context
     * @return void
     */
    public function install(
        \Magento\Framework\Setup\SchemaSetupInterface $setup,
        \Magento\Framework\Setup\ModuleContextInterface $context
    ) {
        $setup->startSetup();
        /**
         * Create table 'magenest_movie'
         */
        $table = $setup->getConnection()->newTable(
            $setup->getTable('magenest_movie')
        )->addColumn(
            'movie_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Movie Id'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            null,
            [ 'nullable' => false],
            'Name'
        )->addColumn(
            'description',
            Table::TYPE_TEXT,
            null,
            [ 'nullable' => false],
            'Movie description'
        )->addColumn(
            'rating',
            Table::TYPE_INTEGER,
            null,
            [],
            'Rating'
        )->addColumn(
            'director_id',
            Table::TYPE_INTEGER,
            null,
            [ 'nullable' => false],
            'Director Id'
        )->setComment(
            'Movie information'
        );
        $setup->getConnection()->createTable($table);
        /**
         * Create table 'magenest_director'
         */
        $table = $setup->getConnection()->newTable(
            $setup->getTable('magenest_director')
        )->addColumn(
            'director_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Director Id'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            null,
            [ 'nullable' => false],
            'Director name'
        )->setComment(
            'Director information'
        );
        $setup->getConnection()->createTable($table);
        /**
         * Create table 'magenest_actor'
         */
        $table = $setup->getConnection()->newTable(
            $setup->getTable('magenest_actor')
        )->addColumn(
            'actor_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Actor Id'
        )->addColumn(
            'name',
            Table::TYPE_TEXT,
            null,
            [ 'nullable' => false],
            'Actor name'
        )->setComment(
            'Actor information'
        );
        $setup->getConnection()->createTable($table);
        /**
         * Create table 'magenest_movie_actor'
         */
        $table = $setup->getConnection()->newTable(
            $setup->getTable('magenest_movie_actor')
        )->addColumn(
            'movie_id',
            Table::TYPE_INTEGER,
            null,
            ['identity' => true, 'unsigned' => true, 'nullable' => false, 'primary' => true],
            'Movie Id'
        )->addColumn(
            'actor_id',
            Table::TYPE_INTEGER,
            null,
            [ 'nullable' => false],
            'Actor Id'
        )->setComment(
            'Movie\'s Actor information'
        );
        $setup->getConnection()->createTable($table);
        /**
         * Add index(es)
         */
        $setup->getConnection()->addIndex(
            $setup->getTable('packt_test_product'),
            $setup->getIdxName(
                $setup->getTable('packt_test_product'),
                ['id'],
                \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
            ),
            ['id'],
            \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_UNIQUE
        );
    }
}