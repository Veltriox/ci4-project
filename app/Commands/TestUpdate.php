<?php

namespace App\Commands;

use CodeIgniter\CLI\BaseCommand;
use CodeIgniter\CLI\CLI;

class TestUpdate extends BaseCommand
{
    /**
     * The Command's Group
     *
     * @var string
     */
    protected $group = 'App';

    protected $name = 'db:testupdate';

    public function run(array $params)
    {
        $ticketModel = new \App\Models\SupportTicketModel();
        // Since my optimized select blocks attachment_data by default now, I must explicitly select it!
        $ticket = $ticketModel->select('id, attachment, attachment_data')->orderBy('id', 'DESC')->first(); 

        if (!$ticket) {
            CLI::write("No tickets found.", "yellow");
            return;
        }

        $content = $ticket['attachment_data'];
        
        CLI::write("Ticket ID: " . $ticket['id'], "cyan");
        CLI::write("Attachment name: " . $ticket['attachment'], "cyan");
        CLI::write("Type of content: " . gettype($content), "cyan");

        if (is_resource($content)) {
            CLI::write("It's a resource. Streaming contents...");
            $content = stream_get_contents($content);
        }

        CLI::write("String length: " . strlen($content));
        CLI::write("First 100 chars: " . substr($content, 0, 100));
        CLI::write("Last 100 chars: " . substr($content, -100));
        CLI::write("Is ctype_xdigit: " . (ctype_xdigit($content) ? "YES" : "NO"));

        if (strpos($content, '\x') === 0) {
            CLI::write("Starts with \\x!");
            $stripped = substr($content, 2);
            CLI::write("Stripped is ctype_xdigit: " . (ctype_xdigit($stripped) ? "YES" : "NO"));
        } else {
            CLI::write("Does not start with \\x...");
        }
    }
}
