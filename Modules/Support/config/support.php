<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Support Module Configuration
    |--------------------------------------------------------------------------
    |
    | This file contains configuration options for the Support module.
    |
    */

    // Default department for new tickets
    'default_department_id' => env('SUPPORT_DEFAULT_DEPARTMENT_ID', 1),
    
    // Ticket number prefix
    'ticket_number_prefix' => env('SUPPORT_TICKET_PREFIX', 'TKT-'),
    
    // Ticket statuses
    'ticket_statuses' => [
        'open' => 'Open',
        'in_progress' => 'In Progress',
        'waiting' => 'Waiting on Customer',
        'resolved' => 'Resolved',
        'closed' => 'Closed',
    ],
    
    // Ticket priorities
    'ticket_priorities' => [
        'low' => 'Low',
        'medium' => 'Medium',
        'high' => 'High',
        'urgent' => 'Urgent',
    ],
    
    // Auto-assign tickets to agents
    'auto_assign' => [
        'enabled' => env('SUPPORT_AUTO_ASSIGN_ENABLED', true),
        'algorithm' => 'round_robin', // Options: round_robin, least_tickets, random
    ],
    
    // Email notifications
    'email_notifications' => [
        'enabled' => env('SUPPORT_EMAIL_NOTIFICATIONS_ENABLED', true),
        'notify_customer_on_ticket_creation' => true,
        'notify_customer_on_agent_reply' => true,
        'notify_agent_on_new_ticket' => true,
        'notify_agent_on_customer_reply' => true,
        'cc_agents' => [], // Array of email addresses to CC on all ticket notifications
    ],
    
    // Attachments
    'attachments' => [
        'enabled' => env('SUPPORT_ATTACHMENTS_ENABLED', true),
        'allowed_file_types' => [
            'image/jpeg',
            'image/png',
            'image/gif',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'text/plain',
            'application/zip',
        ],
        'max_file_size' => env('SUPPORT_MAX_ATTACHMENT_SIZE', 10240), // in KB (10MB default)
        'max_files_per_ticket' => env('SUPPORT_MAX_ATTACHMENTS_PER_TICKET', 5),
        'storage_disk' => env('SUPPORT_ATTACHMENT_DISK', 'public'),
        'storage_path' => env('SUPPORT_ATTACHMENT_PATH', 'support/attachments'),
    ],
    
    // Ticket auto-closing
    'auto_close' => [
        'enabled' => env('SUPPORT_AUTO_CLOSE_ENABLED', true),
        'days_until_auto_close' => env('SUPPORT_AUTO_CLOSE_DAYS', 7), // Days after last response
    ],
    
    // FAQ settings
    'faq' => [
        'enabled' => env('SUPPORT_FAQ_ENABLED', true),
        'items_per_page' => 10,
        'show_views_count' => true,
        'suggest_faqs_for_new_tickets' => true,
    ],
    
    // Contact form settings
    'contact_form' => [
        'enabled' => env('SUPPORT_CONTACT_FORM_ENABLED', true),
        'require_captcha' => env('SUPPORT_CONTACT_FORM_CAPTCHA', true),
        'auto_create_ticket' => env('SUPPORT_AUTO_CREATE_TICKET', true),
    ],
]; 