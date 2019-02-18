<?php 
namespace Mobilyte\Customtab\Setup;
 
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Adapter\AdapterInterface;
use Magento\Framework\DB\Ddl\Table;
 
class InstallSchema implements InstallSchemaInterface 
{ 
public function install( SchemaSetupInterface $setup, ModuleContextInterface $context )
 { 
      $installer = $setup; $installer->startSetup();
 
        /**
         * Create table 'posts'
         */
        $table = $installer->getConnection()->newTable(
            $installer->getTable( 'customtab' )
        )->addColumn(
            'id',
            Table::TYPE_INTEGER,
            null,
            [ 'identity' => true, 'nullable' => false, 'primary' => true ],
            'ID'
        )->addColumn(
            'product_id',
            Table::TYPE_INTEGER,
            255,
            [ 'nullable' => false ],
            'Product Id'
        )->addColumn(
            'created_time',
            Table::TYPE_TIMESTAMP,
            null,
            [ 'nullable' => false, 'default' => Table::TIMESTAMP_INIT_UPDATE ],
            'Creation Time'
        )->setComment(
            'Custom Tab Table'
        );
 
        $installer->getConnection()->createTable( $table );
 
        $installer->endSetup();
 
    }
}