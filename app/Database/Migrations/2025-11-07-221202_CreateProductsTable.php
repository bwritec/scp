<?php

    namespace App\Database\Migrations;

    use CodeIgniter\Database\Migration;


    /**
     *
     */
    class CreateProductsTable extends Migration
    {
        /**
         *
         */
        public function up()
        {
            $this->forge->addField([
                'id' => [
                    'type' => 'INT',
                    'unsigned' => true,
                    'auto_increment' => true
                ],

                'user_id' => [
                    'type' => 'INT',
                    'unsigned' => true
                ],

                'name' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true
                ],

                'conditions' => [
                    'type' => 'VARCHAR',
                    'constraint' => 20,
                    'null' => true
                ],

                'description' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],

                'amount' => [
                    'type' => 'INT',
                    'unsigned' => true,
                    'null' => true,
                ],

                /**
                 * Produtos de demonstração não podem ser
                 * comprados, só administradores podem
                 * criar um produto de demonstração.
                 */
                'demonstration' => [
                    'type' => "BOOLEAN",
                    'default' => false
                ],

                /**
                 * Produtos pausados não podem ser comprados,
                 * qualquer um pode pausar um produto.
                 */
                'paused' => [
                    'type' => "BOOLEAN",
                    'default' => false
                ],

                /**
                 * Preço do vendedor.
                 */
                'price' => [
                    'type' => 'FLOAT',
                    'constraint' => '10,2', // Total de dígitos, casas decimais.
                    'default' => 0.00,
                ],

                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true
                ]
            ]);

            $this->forge->addKey('id', true);
            $this->forge->createTable('products');
        }

        /**
         *
         */
        public function down()
        {
            $this->forge->dropTable('products');
        }
    }
