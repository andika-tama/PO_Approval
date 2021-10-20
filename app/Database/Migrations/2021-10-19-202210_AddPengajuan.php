<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPengajuan extends Migration
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
            'id_product' => [
                'type' => 'INT',
                'constraint' => 7,
                'unsigned' => true,
            ],
            'priority' => [
                'type' => 'ENUM("YES","NO")',
                'default' => 'NO',
                'null' => false
            ],
            'quantity' => [
                'type' => 'INT',
                'constraint' => 5
            ],
            'date_needed' => [
                'type' => 'DATE'
            ],

        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_product', 'product', 'id', 'CASCADE', 'NO ACTION');
        $this->forge->createTable('submission');
    }

    public function down()
    {
        $this->forge->dropTable('submission');
    }
}
