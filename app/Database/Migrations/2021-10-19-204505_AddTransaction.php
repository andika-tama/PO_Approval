<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddTransaction extends Migration
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
            'id_purchasing' => [
                'type' => 'INT',
                'constraint' => 7,
                'unsigned' => true,
            ],
            'id_submission' => [
                'type' => 'INT',
                'constraint' => 7,
                'unsigned' => true,
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 5
            ]

        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_purchasing', 'purchasing_list', 'id', 'CASCADE', 'NO ACTION');
        $this->forge->addForeignKey('id_submission', 'submission', 'id', 'CASCADE', 'NO ACTION');
        $this->forge->createTable('transaction');
    }

    public function down()
    {
        $this->forge->dropTable('transaction');
    }
}
