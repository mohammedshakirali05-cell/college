# Database Schema - College Portal

## Required Tables

### 1. Users Table
```sql
CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'student', 'faculty') DEFAULT 'student',
    status ENUM('active', 'pending') DEFAULT 'pending',
    login_attempts INT DEFAULT 0,
    lock_until DATETIME NULL,
    reset_token VARCHAR(255) NULL,
    reset_expiry DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_role (role),
    INDEX idx_status (status)
);
```

**Column Descriptions:**
- `id` - Unique user identifier
- `name` - User's full name
- `email` - Email address (unique, used for login)
- `password` - Bcrypt hashed password
- `role` - User type (admin, student, faculty)
- `status` - Account status (active or pending approval)
- `login_attempts` - Failed login count (resets on success)
- `lock_until` - DateTime when account unlock is allowed
- `reset_token` - Token for password reset (hex)
- `reset_expiry` - When reset token expires
- `created_at` - Account creation timestamp
- `updated_at` - Last update timestamp

---

### 2. Activity Logs Table
```sql
CREATE TABLE IF NOT EXISTS activity_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    activity VARCHAR(255) NOT NULL,
    module VARCHAR(100),
    ip_address VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_created_at (created_at),
    INDEX idx_module (module)
);
```

**Column Descriptions:**
- `id` - Log entry identifier
- `user_id` - Who performed the action (foreign key to users)
- `activity` - Description of what was done
- `module` - System module (General, Authentication, User Management, etc.)
- `ip_address` - IP address of user
- `created_at` - When action occurred

---

### 3. Notices Table (Optional but referenced in code)
```sql
CREATE TABLE IF NOT EXISTS notices (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT,
    is_active BOOLEAN DEFAULT 1,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

---

## Sample Data

### Creating First Admin
```sql
INSERT INTO users (name, email, password, role, status) 
VALUES (
    'System Administrator',
    'admin@college.edu',
    '$2y$10$...',  -- bcrypt hash of password
    'admin',
    'active'
);
```

### Sample Student Added by Admin
```sql
INSERT INTO users (name, email, password, role, status) 
VALUES (
    'John Doe',
    'john.doe@college.edu',
    '$2y$10$...',  -- bcrypt hash of auto-generated password
    'student',
    'active'
);
```

### Sample Faculty Added by Admin
```sql
INSERT INTO users (name, email, password, role, status) 
VALUES (
    'Prof. Jane Smith',
    'jane.smith@college.edu',
    '$2y$10$...',  -- bcrypt hash of auto-generated password
    'faculty',
    'active'
);
```

### Sample Activity Log Entry
```sql
INSERT INTO activity_logs (user_id, activity, module, ip_address) 
VALUES (
    1,
    'Admin added new Student: John Doe',
    'User Management',
    '192.168.1.100'
);
```

---

## Useful SQL Queries

### Get all admins
```sql
SELECT id, name, email, status FROM users WHERE role = 'admin';
```

### Get all students
```sql
SELECT id, name, email, status FROM users WHERE role = 'student';
```

### Get all faculty
```sql
SELECT id, name, email, status FROM users WHERE role = 'faculty';
```

### Get active users count
```sql
SELECT COUNT(*) as active_count FROM users WHERE status = 'active';
```

### Get pending users (awaiting approval)
```sql
SELECT id, name, email, role FROM users WHERE status = 'pending';
```

### Get locked user accounts
```sql
SELECT id, name, email, lock_until FROM users WHERE lock_until IS NOT NULL AND lock_until > NOW();
```

### Get admin activity logs
```sql
SELECT u.name, a.activity, a.module, a.ip_address, a.created_at 
FROM activity_logs a
JOIN users u ON a.user_id = u.id
WHERE u.role = 'admin'
ORDER BY a.created_at DESC
LIMIT 50;
```

### Get recent activities for a user
```sql
SELECT activity, module, ip_address, created_at 
FROM activity_logs
WHERE user_id = 5
ORDER BY created_at DESC
LIMIT 10;
```

### Unlock a locked account
```sql
UPDATE users SET lock_until = NULL, login_attempts = 0 WHERE id = 123;
```

### Reset a user's login attempts
```sql
UPDATE users SET login_attempts = 0 WHERE email = 'user@college.edu';
```

### Clear expired password reset tokens
```sql
DELETE FROM users WHERE reset_token IS NOT NULL AND reset_expiry < NOW();
```

### Delete a user and their activity logs
```sql
DELETE FROM user_id WHERE id = 123;  -- Activity logs auto delete due to CASCADE
```

### Get user login history
```sql
SELECT u.name, COUNT(*) as login_count, MAX(a.created_at) as last_login
FROM users u
LEFT JOIN activity_logs a ON u.id = a.user_id AND a.activity LIKE '%logged in%'
GROUP BY u.id
ORDER BY last_login DESC;
```

---

## Data Migration (If Converting from Old System)

### Step 1: Backup existing database
```bash
mysqldump -u root college > backup_$(date +%Y%m%d).sql
```

### Step 2: Add new columns if missing
```sql
ALTER TABLE users 
ADD COLUMN IF NOT EXISTS lock_until DATETIME NULL,
ADD COLUMN IF NOT EXISTS login_attempts INT DEFAULT 0,
ADD COLUMN IF NOT EXISTS status ENUM('active', 'pending') DEFAULT 'active';
```

### Step 3: Set existing users to active status
```sql
UPDATE users SET status = 'active' WHERE status IS NULL;
```

### Step 4: Create activity logs table if missing
```sql
CREATE TABLE IF NOT EXISTS activity_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT NOT NULL,
    activity VARCHAR(255) NOT NULL,
    module VARCHAR(100),
    ip_address VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    INDEX idx_user_id (user_id),
    INDEX idx_created_at (created_at)
);
```

### Step 5: Verify data integrity
```sql
SELECT COUNT(*) FROM users;
SELECT COUNT(*) FROM activity_logs;
SELECT DISTINCT role FROM users;
SELECT DISTINCT status FROM users;
```

---

## Performance Optimization

### Add Indexes
```sql
-- Speed up lookups by email
CREATE INDEX idx_email ON users(email);

-- Speed up lookups by role
CREATE INDEX idx_role ON users(role);

-- Speed up lookups by status
CREATE INDEX idx_status ON users(status);

-- Speed up activity log queries
CREATE INDEX idx_activity_user_id ON activity_logs(user_id);
CREATE INDEX idx_activity_created_at ON activity_logs(created_at);
```

### Archive old activity logs (optional)
```sql
-- Move logs older than 90 days to archive table (after creating archive)
INSERT INTO activity_logs_archive 
SELECT * FROM activity_logs 
WHERE created_at < DATE_SUB(NOW(), INTERVAL 90 DAY);

DELETE FROM activity_logs 
WHERE created_at < DATE_SUB(NOW(), INTERVAL 90 DAY);
```

---

## Regular Maintenance

### Cleanup tasks to run periodically

```sql
-- Clear expired reset tokens (daily)
DELETE FROM users WHERE reset_token IS NOT NULL AND reset_expiry < NOW();

-- Clear old activity logs (monthly)
DELETE FROM activity_logs WHERE created_at < DATE_SUB(NOW(), INTERVAL 6 MONTH);

-- Unlock expired locked accounts (hourly check via code)
UPDATE users SET lock_until = NULL, login_attempts = 0 
WHERE lock_until IS NOT NULL AND lock_until < NOW();
```

---

## Troubleshooting Database Issues

### Check if tables exist
```sql
SHOW TABLES;
```

### Check columns in users table
```sql
DESCRIBE users;
```

### Check data types
```sql
SELECT COLUMN_NAME, COLUMN_TYPE, IS_NULLABLE 
FROM INFORMATION_SCHEMA.COLUMNS 
WHERE TABLE_NAME = 'users';
```

### Find duplicate emails
```sql
SELECT email, COUNT(*) as count 
FROM users 
GROUP BY email 
HAVING count > 1;
```

### Check database size
```sql
SELECT 
    ROUND(SUM(data_length + index_length) / 1024 / 1024, 2) as size_mb
FROM information_schema.tables 
WHERE table_schema = 'college';
```

---

Last Updated: March 9, 2026
