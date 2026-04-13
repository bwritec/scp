<?php

    namespace App\Database\Migrations;

    use CodeIgniter\Database\Migration;


    /**
     *
     */
    class CreateProductThumbnailsTable extends Migration
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

                'product_id' => [
                    'type' => 'INT',
                    'unsigned' => true
                ],

                'name' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true
                ]
            ]);

            $this->forge->addKey('id', true);
            $this->forge->createTable('product_thumbnails');
        }

        /**
         *
         */
        public function down()
        {
            $this->forge->dropTable('product_thumbnails');
        }
    }
