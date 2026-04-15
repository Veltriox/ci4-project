-- =============================================
-- UNIFIED DATABASE SCHEMA
-- Shared between Web (CodeIgniter 4) + Mobile App
-- PostgreSQL 18
-- Generated: 2026-04-14
-- =============================================

-- Drop existing tables (in reverse dependency order)
DROP TABLE IF EXISTS support_ticket_history CASCADE;
DROP TABLE IF EXISTS ticket_replies CASCADE;
DROP TABLE IF EXISTS support_tickets CASCADE;
DROP TABLE IF EXISTS users CASCADE;

-- =============================================
-- TABLE 1: users
-- All user accounts (students, agents, admins)
-- =============================================
CREATE TABLE IF NOT EXISTS users (
    id SERIAL PRIMARY KEY,

    -- Identity
    username VARCHAR(100) NOT NULL,
    first_name VARCHAR(255),
    last_name VARCHAR(255),
    email VARCHAR(100) NOT NULL UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,

    -- Mobile app fields
    rollno VARCHAR(50),
    course VARCHAR(100),

    -- Role management (user / agent / admin)
    role VARCHAR(20) NOT NULL DEFAULT 'user',

    -- Profile photo
    photo VARCHAR(255),                -- Filename reference
    photo_data BYTEA,                  -- Binary storage (Web)
    photo_mime VARCHAR(100),           -- MIME type

    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =============================================
-- TABLE 2: support_tickets
-- All support tickets created by users
-- =============================================
CREATE TABLE IF NOT EXISTS support_tickets (
    id SERIAL PRIMARY KEY,

    -- Who created this ticket (FK -> users)
    user_id INT NOT NULL REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,

    -- Ticket info
    title VARCHAR(255),
    subject VARCHAR(255) NOT NULL,
    category VARCHAR(100),
    priority VARCHAR(50) DEFAULT 'Medium',
    communication_medium VARCHAR(50),
    description TEXT NOT NULL,

    -- Attachment (Web: binary in DB)
    attachment VARCHAR(255),           -- Filename reference
    attachment_data BYTEA,             -- Binary storage (Web)
    attachment_mime VARCHAR(100),      -- MIME type

    -- Attachment (Mobile: external URL)
    image_url TEXT,                    -- External image URL (Mobile)

    -- Status and routing
    status VARCHAR(50) DEFAULT 'Open',
    department_id VARCHAR(100),
    assigned_to INT REFERENCES users(id) ON DELETE SET NULL,
    agent_remark TEXT,

    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    closed_at TIMESTAMP                -- When ticket was closed
);

-- =============================================
-- TABLE 3: ticket_replies
-- Chat thread messages for each ticket
-- =============================================
CREATE TABLE IF NOT EXISTS ticket_replies (
    id SERIAL PRIMARY KEY,

    -- Links to parent ticket and sender
    ticket_id INT NOT NULL REFERENCES support_tickets(id) ON DELETE CASCADE ON UPDATE CASCADE,
    user_id INT NOT NULL REFERENCES users(id) ON DELETE CASCADE ON UPDATE CASCADE,

    -- Reply content
    message TEXT NOT NULL,

    -- Attachment
    attachment VARCHAR(255),           -- Filename reference
    attachment_data BYTEA,             -- Binary storage
    attachment_mime VARCHAR(100),      -- MIME type

    -- Timestamps
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =============================================
-- TABLE 4: support_ticket_history
-- Full audit trail of every change made
-- =============================================
CREATE TABLE IF NOT EXISTS support_ticket_history (
    id SERIAL PRIMARY KEY,

    -- Links to ticket and who made the change
    ticket_id INT NOT NULL REFERENCES support_tickets(id) ON DELETE CASCADE ON UPDATE CASCADE,
    changed_by INT REFERENCES users(id) ON DELETE SET NULL,

    -- What changed
    action_type VARCHAR(100) NOT NULL,
    old_value TEXT,
    new_value TEXT,
    log_message TEXT,

    -- When it happened
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =============================================
-- INDEXES for performance
-- =============================================
CREATE INDEX idx_tickets_user_id ON support_tickets(user_id);
CREATE INDEX idx_tickets_status ON support_tickets(status);
CREATE INDEX idx_tickets_assigned_to ON support_tickets(assigned_to);
CREATE INDEX idx_replies_ticket_id ON ticket_replies(ticket_id);
CREATE INDEX idx_replies_user_id ON ticket_replies(user_id);
CREATE INDEX idx_history_ticket_id ON support_ticket_history(ticket_id);

-- =============================================
-- DONE! Your unified database is ready.
-- This schema works for BOTH Web and Mobile apps.
-- =============================================
