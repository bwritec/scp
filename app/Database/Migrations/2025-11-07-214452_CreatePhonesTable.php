<?php

    namespace App\Database\Migrations;

    use CodeIgniter\Database\Migration;


    /**
     *
     */
    class CreatePhonesTable extends Migration
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

                'phone' => [
                    'type' => 'VARCHAR',
                    'constraint' => 12,
                    'null' => true
                ],
            ]);

            $this->forge->addKey('id', true);
            $this->forge->createTable('phones');
        }

        /**
         *
         */
        public function down()
        {
            $this->forge->dropTable('phones');
        }
    }
