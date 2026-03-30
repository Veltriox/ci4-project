<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Initialize CodeIgniter 4 environment
require_once __DIR__ . '/public/index.php';

$db = \Config\Database::connect();
try {
    $db->query("ALTER TABLE support_tickets ADD COLUMN agent_remark TEXT;");
    echo "SUCCESS: Column 'agent_remark' added to 'support_tickets' table.";
} catch (\Exception $e) {
    echo "ERROR: " . $e->getMessage();
}
