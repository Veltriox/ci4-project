<?php
// Simple standalone script to fix database without CI4 bootstrapping
$host = 'localhost';
$db   = 'login_system';
$user = 'postgres';
$pass = '999000';
$port = 5432;

$dsn = "pgsql:host=$host;port=$port;dbname=$db;user=$user;password=$pass";

try {
    $pdo = new PDO($dsn);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->exec("ALTER TABLE support_tickets ADD COLUMN agent_remark TEXT;");
    echo "SUCCESS: Column 'agent_remark' added successfully.\n";
} catch (PDOException $e) {
    if (strpos($e->getMessage(), 'already exists') !== false) {
        echo "INFO: Column 'agent_remark' already exists.\n";
    } else {
        echo "ERROR: " . $e->getMessage() . "\n";
    }
}
