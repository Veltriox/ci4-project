<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class CheckDatabaseColumns extends BaseCommand
{
    protected $group       = 'Database';
    protected $name        = 'db:check_columns';
    protected $description = 'Displays all columns of support_tickets table.';

    public function run(array $params)
    {
        $db = \Config\Database::connect();
        
        if (in_array('drop', $params)) {
             $db->query("DROP TABLE IF EXISTS support_tickets");
             CLI::write("Table 'support_tickets' dropped.", 'red');
             return;
        }

        $query = $db->query("SELECT column_name FROM information_schema.columns WHERE table_name = 'support_tickets'");
        $results = $query->getResult();

        if (empty($results)) {
            CLI::error("Table 'support_tickets' NOT FOUND or no columns in information_schema.");
            return;
        }

        CLI::write("Columns in 'support_tickets':", 'yellow');
        foreach ($results as $row) {
            CLI::write("- " . $row->column_name, 'green');
        }
    }
}
