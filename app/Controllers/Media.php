<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

use App\Models\MediaModel;

class Media extends BaseController
{
    public function view($filename)
    {
        // Check users table first
        $userModel = new \App\Models\UserModel();
        $user = $userModel->where('photo', $filename)->first();

        // Check tickets table next
        $ticketModel = new \App\Models\SupportTicketModel();
        $ticket = $ticketModel->where('attachment', $filename)->first();

        // Check ticket_replies table last
        $replyModel = new \App\Models\TicketReplyModel();
        $reply = $replyModel->where('attachment', $filename)->first();

        $content = null;
        $mime_type = 'application/octet-stream';

        if ($user && !empty($user['photo_data'])) {
            $content = $user['photo_data'];
            $mime_type = $user['photo_mime'] ?: $mime_type;
        } elseif ($ticket && !empty($ticket['attachment_data'])) {
            $content = $ticket['attachment_data'];
            $mime_type = $ticket['attachment_mime'] ?: $mime_type;
        } elseif ($reply && !empty($reply['attachment_data'])) {
            $content = $reply['attachment_data'];
            $mime_type = $reply['attachment_mime'] ?: $mime_type;
        } else {
            return $this->response->setStatusCode(404)->setBody('File not found');
        }

        if (is_resource($content)) {
            $content = stream_get_contents($content);
        }

        // 1. Strip PostgreSQL's \x prefix if it exists
        if (is_string($content) && strpos($content, '\x') === 0) {
            $content = substr($content, 2);
        }

        // 2. Decode the first layer (Postgres Hex -> Our Literal String)
        if (is_string($content) && ctype_xdigit($content)) {
            $decoded1 = @hex2bin($content);
            if ($decoded1 !== false) {
                $content = $decoded1;
            }
        }

        // 3. Decode the second layer (Our Literal String bin2hex -> Raw Image Bytes)
        if (is_string($content) && ctype_xdigit($content)) {
            $decoded2 = @hex2bin($content);
            if ($decoded2 !== false) {
                $content = $decoded2;
            }
        }

        // Set the correct Content-Type and deliver the binary data
        return $this->response
            ->setHeader('Content-Type', $mime_type)
            ->setHeader('Content-Length', strlen($content))
            ->setHeader('Cache-Control', 'public, max-age=31536000') // Cache for 1 year
            ->setBody($content);
    }
}
