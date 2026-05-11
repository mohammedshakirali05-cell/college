# Quick Start Guide - New Admin-Based User Management System

## 🚀 Installation & Setup

### Step 1: Verify Database Tables
Ensure your database has these tables with correct columns:
- `users` table with all required columns
- `activity_logs` table for tracking actions

### Step 2: Test the System

#### For Testing Email (Optional)
If your server doesn't have mail configured, do this:
1. Open `/model/usermodel.php`
2. Find the `sendCredentialsEmail()` method
3. Comment out the `mail()` line temporarily
4. Or use a mail testing service like Mailtrap

#### First Admin Registration
1. Go to: `http://localhost/college/index.php?action=register`
2. Fill registration form (only Admin role available)
3. Save credentials
4. Login with the credentials

#### Testing Student Addition
1. Login as Admin
2. Click "Manage Students" card
3. Enter a test student name and email
4. Click "Add Student"
5. Check if email was sent (check spam folder if using real email)

#### Student Login
1. Check email for credentials
2. Go to login page
3. Enter email and generated password
4. Verify student can access dashboard

---

## 📋 Implementation Summary

### Modified Files (3)
1. ✅ `/model/usermodel.php` - Added 6 new methods
2. ✅ `/controller/usercontroller.php` - Added 2 new methods
3. ✅ `/index.php` - Added routing for new actions

### Created Files (2)
1. ✅ `/views/manage_students.php` - Admin student management
2. ✅ `/views/manage_faculty.php` - Admin faculty management

### Documentation Files (2)
1. ✅ `/AUTHENTICATION_README.md` - Complete documentation
2. ✅ `/QUICK_START_GUIDE.md` - This file

---

## 🔄 User Flow Diagram

```
┌─────────────────────────────────────────────────────────────┐
│                   COLLEGE PORTAL SYSTEM                      │
└─────────────────────────────────────────────────────────────┘

FIRST ADMIN SETUP:
┌──────────────┐
│  Home Page   │
└──────┬───────┘
       │ Admin Registration
       ▼
┌──────────────────┐
│ Register Page    │  ← Only Admin role available
│ (Name, Email,    │
│  Password, Role) │
└──────┬───────────┘
       │ Submit
       ▼
┌──────────────────────┐
│ Account Created      │
│ Admin user active    │
└──────┬───────────────┘
       │ Redirect to Login
       ▼
┌──────────────────┐
│ Login with Email │
│ Pass & CAPTCHA   │
└──────┬───────────┘
       │ Success
       ▼
┌──────────────────────┐
│ ADMIN DASHBOARD      │
│ ✓ Stats Cards        │
│ ✓ Manage Students    │
│ ✓ Manage Faculty     │
│ ✓ Pending Approvals  │
│ ✓ Activity Logs      │
└──────┬───────────────┘
       │ Click Manage Students
       ▼

ADDING STUDENT:
┌──────────────────────────┐
│ Manage Students Page     │
│ Name: [_____________]    │
│ Email: [____________]    │
│ [➕ Add Student Button]   │
└──────┬───────────────────┘
       │ Submit
       ▼
┌──────────────────────────┐
│ System Actions:          │
│ 1. Generate Password     │
│ 2. Hash Password         │
│ 3. Insert in DB          │
│ 4. Send Email            │
│ 5. Log Activity          │
└──────┬───────────────────┘
       │ Success
       ▼
┌──────────────────────────────┐
│ Email Sent to Student        │
│ ├─ Subject: Login Creds      │
│ ├─ Email: student@example.com│
│ ├─ Password: (generated)     │
│ └─ Portal Link              │
└──────┬───────────────────────┘
       │
       ├─────────────────────────┐
       │                         │
       ▼                         ▼
    ADMIN               STUDENT (checks email)
  Sees success    Receives credentials, logins
   message         as Student user
```

---

## 🔐 Security Features

✅ **Role-Based Access Control (RBAC)**
   - Only admins see manage pages
   - Unauthorized access redirected

✅ **Password Security**
   - Auto-generated unique passwords
   - Stored with PASSWORD_BCRYPT
   - Never shown in plain text in system

✅ **Email Verification**
   - Only provided during creation
   - Prevents student self-registration
   - Controlled by admin

✅ **Activity Logging**
   - All admin actions tracked
   - Timestamp and IP logged
   - Module categorization

✅ **Login Protection**
   - CAPTCHA required
   - Account lockout after 3 failures
   - Countdown timer displayed

---

## 🎯 Key Features

### For Admins
- ✓ Register as first admin
- ✓ View dashboard statistics
- ✓ Add students (email sent auto)
- ✓ Add faculty (email sent auto)
- ✓ Delete student/faculty
- ✓ View user lists with status
- ✓ Approve pending users
- ✓ See activity logs
- ✓ See upcoming events

### For Students/Faculty
- ✓ Receive credentials via email
- ✓ Login with email + password
- ✓ View personal dashboard
- ✓ Reset forgotten password
- ✓ See recent activities
- ✓ View upcoming events
- ✓ Access role-specific features

---

## 📝 Configuration Options

### Email Settings
Edit `/model/usermodel.php`, line ~160:
```php
$headers .= "From: admin@college.edu" . "\r\n";
```
Change email to match your server

### Portal URL
Edit `/model/usermodel.php`, line ~150:
```php
<a href='http://localhost/college/index.php?action=login'>
```
Update for production environment

### Password Length
Edit `/model/usermodel.php`, line ~60:
```php
$generatedPassword = bin2hex(random_bytes(6));  // Currently 12 chars
// Use random_bytes(8) for 16 chars, random_bytes(5) for 10 chars
```

### Lockout Duration
Edit `/model/usermodel.php`, line ~219:
```php
$lockUntil = date('Y-m-d H:i:s', time() + (10 * 60));  // 10 minutes
// Change time() + (10 * 60) to other values:
// 5 minutes: (5 * 60)
// 15 minutes: (15 * 60)
// 1 hour: (60 * 60)
```

---

## ✅ Testing Checklist

Before deploying to production:

- [ ] First admin can register
- [ ] Admin dashboard shows 6 statistic cards
- [ ] "Manage Students" button visible on dashboard
- [ ] "Manage Faculty" button visible on dashboard
- [ ] Can add student with name and email
- [ ] Email received by student (or logged if mail disabled)
- [ ] Student can login with received credentials
- [ ] Student sees correct dashboard
- [ ] Can add faculty member
- [ ] Faculty can login and access dashboard
- [ ] Can delete student/faculty (with confirmation)
- [ ] Activity logs show admin actions
- [ ] CAPTCHA appears on login
- [ ] Account locks after 3 failed login attempts
- [ ] Forgot password link works for all users

---

## 🐛 Troubleshooting

### Problem: "Email already exists" when adding student
**Solution**: Check if email already registered in database
```sql
SELECT * FROM users WHERE email = 'student@example.com';
```
If exists, delete it or use different email.

### Problem: Credentials email not sent
**Solution**: Check PHP mail configuration
1. Open `/model/usermodel.php` line ~150-160
2. Add debug before mail() call:
   ```php
   echo "Debug: About to send email to " . $email;
   $result = mail($to, $subject, $body, $headers);
   echo "Mail result: " . ($result ? "Sent" : "Failed");
   ```
3. Check server error logs for mail errors

### Problem: Login says "Account locked"
**Solution**: Either wait 10 minutes OR update database directly:
```sql
UPDATE users SET lock_until = NULL, login_attempts = 0 WHERE id = 123;
```

### Problem: Can't add second admin
**Solution**: Check if admin count logic working
```sql
SELECT COUNT(*) FROM users WHERE role = 'admin';
```
Should return current count. If issue continues, set one user as admin:
```sql
UPDATE users SET role = 'admin' WHERE id = 2;
```

---

## 📞 Support

For issues:
1. Check `/AUTHENTICATION_README.md` for detailed docs
2. Verify database schema is correct
3. Check PHP error logs: `/php_errors.log` or `/error_log`
4. Test from command line:
   ```bash
   php -l index.php  # Check syntax
   ```

---

## 📦 Files Modified / Created

```
college/
├── index.php                      ← MODIFIED (routing, actions)
├── model/
│   └── usermodel.php             ← MODIFIED (6 new methods)
├── controller/
│   └── usercontroller.php        ← MODIFIED (2 new methods)
├── views/
│   ├── manage_students.php       ← NEW
│   ├── manage_faculty.php        ← NEW
│   └── [other views unchanged]
├── AUTHENTICATION_README.md      ← NEW (detailed docs)
└── QUICK_START_GUIDE.md         ← NEW (this file)
```

---

**System Ready! 🎉**

Your college portal now has a secure admin-based user management system.
Next step: Test the workflows and customize as needed.

Last Updated: March 9, 2026
