<?php
    
    namespace Amasty\FrdljModule\Setup;
    
    use Magento\Framework\Setup\InstallSchemaInterface;
    use Magento\Framework\Setup\ModuleContextInterface;
    use Magento\Framework\Setup\SchemaSetupInterface;
    use Magento\Framework\DB\Ddl\Table;
    
    class InstallSchema implements InstallSchemaInterface
    {
        public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
        {
            $setup->startSetup();
            $table = $setup->getConnection()
                ->newTable($setup->getTable('Amasty_FrdljModule_blacklist'))
                ->addColumn(
                    'product_id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,                                           // размер (для числовых значений можно null)
                    [                                               // дополнительные параметры
                        'identity' => true,                         // AUTO_INCREMENT
                        'unsigned' => true,                         // только положительные значения
                        'nullable' => false,                        // NOT NULL
                        'primary' => true                           // PRIMARY KEY
                    ],                                              //
                    'Product ID'                                       // Хороший тон (Описание колонки)
                )
                ->addColumn(
                    'product_sku',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    [
                        'nullable' => false,
                        'default' => ''],
                    'Product SKU'
                )
                ->addColumn(
                    'product_qty',
                    \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    null,
                    [
                        'nullable' => false,
                        'unsigned' => true,
                        ],
                    'Product QTY'
                )
                ->setComment('Blacklist Table');                     // Хороший тон (Описание таблицы)
            $setup->getConnection()->createTable($table);
            $setup->endSetup();
        }
    }