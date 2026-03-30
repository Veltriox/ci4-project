<?php

namespace App\Models;

use CodeIgniter\Model;

class SupportTicketHistoryModel extends Model
{
    protected $table            = 'support_ticket_history';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $allowedFields    = [
        'ticket_id',
        'changed_by',
        'action_type',
        'old_value',
        'new_value',
        'log_message',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = ''; // No updated_at for logst
}
