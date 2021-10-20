<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddProduct extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 7,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'name_product' => [
                'type' => 'VARCHAR',
                'constraint' => 50
            ],
            'price' => [
                'type' => 'INT',
                'constraint' => 50
            ],

        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('product');
    }

    public function down()
    {
        $this->forge->dropTable('product');
    }
}
