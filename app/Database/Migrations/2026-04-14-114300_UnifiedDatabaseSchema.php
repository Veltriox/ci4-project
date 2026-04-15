<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UnifiedDatabaseSchema extends Migration
{
    public function up()
    {
        // =============================================
        // TABLE 1: users
        // Shared between Web + Mobile
        // =============================================
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'username' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'first_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'last_name' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
            ],
            'phone' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true,
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            // --- Mobile app fields ---
            'rollno' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'course' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            // --- Role management ---
            'role' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'default'    => 'user',
                'null'       => false,
            ],
            // --- Profile photo (filename) ---
            'photo' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            // --- Profile photo binary storage (Web) ---
            'photo_data' => [
                'type' => 'BYTEA',
                'null' => true,
            ],
            'photo_mime' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            // --- Timestamps ---
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->createTable('users', true);

        // =============================================
        // TABLE 2: support_tickets
        // Shared between Web + Mobile
        // =============================================
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'null'       => false,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'subject' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => false,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'priority' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'Medium',
            ],
            'communication_medium' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'null'       => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            // --- Web attachment (binary in DB) ---
            'attachment' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'attachment_data' => [
                'type' => 'BYTEA',
                'null' => true,
            ],
            'attachment_mime' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            // --- Mobile attachment (external URL) ---
            'image_url' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            // --- Ticket status and routing ---
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'Open',
            ],
            'department_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'assigned_to' => [
                'type' => 'INT',
                'null' => true,
            ],
            'agent_remark' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            // --- Timestamps ---
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'closed_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('support_tickets', true);

        // =============================================
        // TABLE 3: ticket_replies
        // Chat thread linked to ticket + user
        // =============================================
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'ticket_id' => [
                'type' => 'INT',
                'null' => false,
            ],
            'user_id' => [
                'type' => 'INT',
                'null' => false,
            ],
            'message' => [
                'type' => 'TEXT',
                'null' => false,
            ],
            'attachment' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
                'null'       => true,
            ],
            'attachment_data' => [
                'type' => 'BYTEA',
                'null' => true,
            ],
            'attachment_mime' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('ticket_id', 'support_tickets', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('ticket_replies', true);

        // =============================================
        // TABLE 4: support_ticket_history
        // Audit trail for every change
        // =============================================
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'auto_increment' => true,
            ],
            'ticket_id' => [
                'type' => 'INT',
                'null' => false,
            ],
            'changed_by' => [
                'type' => 'INT',
                'null' => true,
            ],
            'action_type' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'       => false,
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
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('ticket_id', 'support_tickets', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('support_ticket_history', true);
    }

    public function down()
    {
        // Drop in reverse dependency order
        $this->forge->dropTable('support_ticket_history', true);
        $this->forge->dropTable('ticket_replies', true);
        $this->forge->dropTable('support_tickets', true);
        $this->forge->dropTable('users', true);
    }
}
