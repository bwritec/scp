<?php

    namespace App\Database\Migrations;

    use CodeIgniter\Database\Migration;


    /**
     *
     */
    class CreateAddressesTable extends Migration
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

                'address' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true
                ],

                'neighborhood' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true
                ],

                'city' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true
                ],

                'state' => [
                    'type' => 'VARCHAR',
                    'constraint' => 255,
                    'null' => true
                ],

                'cep' => [
                    'type' => 'VARCHAR',
                    'constraint' => 9,
                    'null' => true
                ],
            ]);


            $this->forge->addKey('id', true);
            $this->forge->createTable('addresses');
        }

        /**
         *
         */
        public function down()
        {
            $this->forge->dropTable('addresses');
        }
    }
