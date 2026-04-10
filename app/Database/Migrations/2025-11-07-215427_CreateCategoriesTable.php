<?php

    namespace App\Database\Migrations;

    use CodeIgniter\Database\Migration;


    /**
     *
     */
    class CreateCategoriesTable extends Migration
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

                'parent' => [
                    'type' => 'INT',
                    'unsigned' => true
                ],

                'name' => [
                    'type' => 'VARCHAR',
                    'constraint' => 30,
                    'null' => true
                ],

                'slogan' => [
                    'type' => 'VARCHAR',
                    'constraint' => 30,
                    'null' => true
                ],

                'description' => [
                    'type' => 'TEXT',
                    'null' => true,
                ],

                'created_at' => [
                    'type' => 'DATETIME',
                    'null' => true
                ]
            ]);

            $this->forge->addKey('id', true);
            $this->forge->createTable('categories');
        }

        /**
         *
         */
        public function down()
        {
            $this->forge->dropTable('categories');
        }
    }
