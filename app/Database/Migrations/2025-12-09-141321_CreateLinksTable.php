<?php

    namespace App\Database\Migrations;

    use CodeIgniter\Database\Migration;


    /**
     *
     */
    class CreateLinksTable extends Migration
    {
        /**
         *
         */
        public function up()
        {
            $this->forge->addField([
                'id' => [
                    'type' => 'INT',
                    'constraint' => 11,
                    'unsigned' => true,
                    'auto_increment' => true
                ],

                'name' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true
                ],

                'url' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true
                ],

                'open_in_new_window' => [
                    'type' => "BOOLEAN",
                    'default' => false
                ],
            ]);

            $this->forge->addKey('id', true);
            $this->forge->createTable('links');
        }

        /**
         *
         */
        public function down()
        {
            $this->forge->dropTable('links');
        }
    }
