# 🚀 GraphQL Master Guide for CodeIgniter 4
### Created for the Support Ticket System Modernization

This guide explains how we replaced traditional page-refreshing PHP loops with a modern, dynamic GraphQL-style data system.

---

## 1. What is GraphQL?
GraphQL is a **Query Language** for your API. Instead of having 50 different URLs for users, tickets, and history, you have **ONE SINGLE URL**: `admin/graphql`.

### 🌟 Why we use it here:
1. **Speed**: No full page refreshes. Data loads instantly.
2. **Efficiency**: You only download the columns you need (e.g., just `subject` and `id`).
3. **Single Point of Control**: All security and data fetching happen in one file (`GraphQL.php`).

---

## 2. Key Concepts: Queries & Mutations

### 🔍 (A) Queries (READ)
A Query is used when you want to **fetch** data from the database.
* **Where we use it**: Loading the ticket table in `user_support.php` and `agent_tickets.php`.
* **Example JSON structure**:
  ```json
  {
      "operation": "query",
      "table": "support_tickets",
      "fields": ["id", "subject", "status"]
  }
  ```

### ✍️ (B) Mutations (WRITE)
A Mutation is used when you want to **create or update** data.
* **Where we use it**: Adding new records or changing status.
* **Example JSON structure**:
  ```json
  {
      "operation": "mutation",
      "table": "support_tickets",
      "variables": {
          "status": "Closed",
          "agent_remark": "Solved!"
      }
  }
  ```

---

## 3. The "Engine Room" (Backend)
The heart of our GraphQL system is: `app/Controllers/GraphQL.php`.

### 🧠 The Resolvers:
Inside the controller, we have "Resolvers". These are the functions that "resolve" (solve) the request:
1. `handleQuery()`: Communicates with the Database to get rows.
2. `handleMutation()`: Communicates with the Database to save changes.

### 🛡️ Security (The Whitelist):
To keep your site safe, I added an **Allowed Tables** list. GraphQL will REFUSE to work if someone tries to access a table not in this list (like a passwords table).
```php
$allowedTables = ['users', 'support_tickets']; // Only these are accessible!
```

---

## 4. The "Frontend" Logic (Client)
Every page that uses GraphQL needs a small bit of JavaScript (AJAX). 

### Example workflow:
1. **The Request**: JavaScript sends a POST request to `admin/graphql`.
2. **The JSON Body**: It includes the `operation`, the `table`, and the `fields`.
3. **The Success**: JavaScript receives the clean data and builds the HTML table dynamically.

---

## 5. Summary of Files:
* **Server**: [GraphQL.php](file:///c:/xampp/htdocs/ci4/app/Controllers/GraphQL.php)
* **User Support Page**: [user_support.php](file:///c:/xampp/htdocs/ci4/app/Views/admin/user_support.php)
* **Agent Tickets Page**: [agent_tickets.php](file:///c:/xampp/htdocs/ci4/app/Views/admin/agent_tickets.php)

### 👨‍🏫 Teacher's Note:
GraphQL makes your app feel like a **Single Page Application (SPA)**. It is much more professional and "Wow" than traditional techniques!
