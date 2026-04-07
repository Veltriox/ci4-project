<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSupportTicketHistoryTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'ticket_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'changed_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'action_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 100,
            ],
            'old_value' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'new_value' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'log_message' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('ticket_id', 'support_tickets', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('support_ticket_history');
    }

    public function down()
    {
        $this->forge->dropTable('support_ticket_history');
    }
}
