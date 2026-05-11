# College Portal - New Authentication & User Management System

## Overview
The college portal has been updated with a new authentication workflow where:
- **Only Admins** can register and login directly
- **Admins** manage all student and faculty accounts
- **Students & Faculty** receive credentials via email and use them to login

---

## System Architecture

### Three User Roles
1. **Admin** - Can register, login, add students/faculty, manage accounts
2. **Student** - Added by admin, receives credentials via email, can login and access features
3. **Faculty** - Added by admin, receives credentials via email, can login and access features

---

## User Workflows

### 1️⃣ First Admin Registration (Initialization)
```
New System → Admin Registration Page → Creates Account → Logins → Dashboard
```

**Steps:**
1. Navigate to: `index.php?action=register`
2. Enter: Name, Email, Password
3. Role automatically set to "Admin"
4. Click "Create Admin Account"
5. Login with credentials

**Important:** Only the first admin can self-register. After that, only existing admins can create new admin accounts.

---

### 2️⃣ Creating Student Account (By Admin)

**Steps:**
1. Admin logs in to portal
2. Click "Manage Students" card on dashboard
3. Fill in:
   - **Full Name**: Student's full name
   - **Email**: Student's email address
4. Click "➕ Add Student"
5. System auto-generates a random password
6. Email is automatically sent to student with:
   - Login email
   - Generated password
   - Portal login link

**Student's Email Contains:**
```
Email: student_email@example.com
Password: (auto-generated 12 character password)
Login URL: http://localhost/college/index.php?action=login
```

---

### 3️⃣ Creating Faculty Account (By Admin)

**Steps:**
1. Admin logs in to portal
2. Click "Manage Faculty" card on dashboard
3. Fill in:
   - **Full Name**: Faculty's full name
   - **Email**: Faculty's email address
4. Click "➕ Add Faculty"
5. System auto-generates a random password
6. Email is automatically sent to faculty with same info as students

---

### 4️⃣ Student/Faculty Login

**Steps:**
1. Navigate to: `index.php?action=login`
2. Enter:
   - **Email**: The email provided during account creation
   - **Password**: The password received in email notification
   - **CAPTCHA**: Enter the displayed code
3. Click "Sign In"
4. Access dashboard

**First Login Tips:**
- Students and Faculty are advised to change their password after first login (feature to be added)
- They can use "Forgot Password" if they lose credentials

---

### 5️⃣ Managing Existing Users

#### View All Students
1. Admin Dashboard → "Manage Students"
2. See table with all students:
   - ID, Name, Email, Status, Delete option

#### View All Faculty
1. Admin Dashboard → "Manage Faculty"
2. See table with all faculty:
   - ID, Name, Email, Status, Delete option

#### Delete Student/Faculty
1. Go to Manage Students/Faculty page
2. Click "🗑️ Delete" button next to user
3. Confirm deletion
4. User access removed

---

## Database Schema

### Users Table Required Columns
```sql
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255),
    email VARCHAR(255) UNIQUE,
    password VARCHAR(255),
    role ENUM('admin', 'student', 'faculty'),
    status ENUM('active', 'pending') DEFAULT 'active',
    login_attempts INT DEFAULT 0,
    lock_until DATETIME NULL,
    reset_token VARCHAR(255) NULL,
    reset_expiry DATETIME NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE activity_logs (
    id INT PRIMARY KEY AUTO_INCREMENT,
    user_id INT,
    activity VARCHAR(255),
    module VARCHAR(100),
    ip_address VARCHAR(50),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

---

## Key Features Implemented

### ✅ Email Notifications
- **Trigger**: When admin creates student/faculty account
- **Content**: Login credentials and portal link
- **Format**: HTML formatted email
- **Headers**: Proper MIME type for HTML email
- **From**: admin@college.edu (configurable)

### ✅ Auto-Generated Passwords
- **Length**: 12 characters (hex: bin2hex(random_bytes(6)))
- **Characters**: Mix of hex characters (0-9, a-f)
- **Hashing**: PASSWORD_BCRYPT for storage
- **Strength**: Unique per user

### ✅ Admin Dashboard Features
- View statistics (total users, active, pending, by role)
- Approve pending users
- Add students with one-click email notification
- Add faculty with one-click email notification
- View all students/faculty in tables
- Delete user accounts
- Activity logging for all actions

### ✅ Security Features
- Role-based access control (RBAC)
- Admin-only management pages
- CAPTCHA on login
- Login attempt tracking (max 3 attempts)
- Account lockout mechanism (10 minutes)
- Password hashing with bcrypt
- Activity logging (user actions, IP address, timestamp)

### ✅ User Experience
- Clear role descriptions on login/register pages
- Informative messages and alerts
- Table-based user lists with status badges
- One-click deletion with confirmation
- Success/error messages for actions
- Responsive design for mobile/desktop

---

## File Structure

```
college/
├── index.php                          (Main router)
├── config/
│   └── db.php                        (Database connection)
├── model/
│   └── usermodel.php                 (Enhanced with new methods)
├── controller/
│   └── usercontroller.php            (Enhanced with new methods)
└── views/
    ├── login.php                     (Original - still used)
    ├── register.php                  (Original - still used)
    ├── dashboard.php                 (Original - still used)
    ├── manage_students.php           (NEW - Add/View/Delete students)
    ├── manage_faculty.php            (NEW - Add/View/Delete faculty)
    ├── forgetpassword.php            (Original - unchanged)
    └── resetpassword.php             (Original - unchanged)
```

---

## New Methods Reference

### UserModel Methods
```php
// Add student or faculty with auto password
$result = $userModel->addUserByAdmin($name, $email, $role);
// Returns: ['success' => true, 'generated_password' => '...', 'user_id' => 123]

// Send credentials via email
$userModel->sendCredentialsEmail($email, $password, $name, $role);

// Get all students
$students = $userModel->getAllStudents();

// Get all faculty
$faculty = $userModel->getAllFaculty();

// Get user by ID
$user = $userModel->getUserById($id);

// Delete user
$userModel->deleteUser($id);
```

### UserController Methods
```php
// Admin adds student
$result = $userController->addStudent(['name' => '...', 'email' => '...']);
// Returns: ['success' => true, 'message' => '...']

// Admin adds faculty
$result = $userController->addFaculty(['name' => '...', 'email' => '...']);
// Returns: ['success' => true, 'message' => '...']
```

---

## Configuration

### Email Settings
Located in **usermodel.php** `sendCredentialsEmail()` method:
```php
$from = "admin@college.edu";  // Change this to your email
$portalURL = "http://localhost/college";  // Change for production
```

### Password Generation
Located in **usermodel.php** `addUserByAdmin()` method:
```php
$generatedPassword = bin2hex(random_bytes(6));  // 12 character password
```

### Lockout Settings
Located in **usermodel.php** `lockUser()` method:
```php
$lockUntil = date('Y-m-d H:i:s', time() + (10 * 60));  // 10 minutes
```

---

## Action URLs Reference

| Action | URL | Access | Purpose |
|--------|-----|--------|---------|
| Home | `index.php?action=home` | Public | Landing page |
| Login | `index.php?action=login` | Public | Admin login |
| Register | `index.php?action=register` | Conditional* | First admin registration |
| Dashboard | `index.php?action=dashboard` | Logged In | Main dashboard |
| Manage Students | `index.php?action=manage_students` | Admin | Add/view/delete students |
| Manage Faculty | `index.php?action=manage_faculty` | Admin | Add/view/delete faculty |
| Delete Student | `index.php?action=delete_student&id=X` | Admin | Remove student |
| Delete Faculty | `index.php?action=delete_faculty&id=X` | Admin | Remove faculty |
| Logout | `index.php?action=logout` | Logged In | Logout |
| Forgot Password | `index.php?action=forgot` | Public | Reset password |
| Reset Password | `index.php?action=reset&token=X` | Public | Update password |

*Conditional: Can register if no admins exist OR if you're logged in as an admin

---

## Testing Checklist

- [ ] First admin can register successfully
- [ ] Subsequent admin cannot register via registration page
- [ ] Existing admin cannot see registration page or gets warning
- [ ] Admin can add student with valid email
- [ ] Email sent to student with credentials
- [ ] Student can login with emailed credentials
- [ ] Student sees appropriate dashboard
- [ ] Admin can add faculty
- [ ] Faculty can login with emailed credentials
- [ ] Admin can delete student/faculty
- [ ] Activity logs created for all actions
- [ ] CAPTCHA required on login
- [ ] Account lockout after 3 failed attempts
- [ ] Password reset works for all roles

---

## Troubleshooting

### Email Not Sending
1. Check mail function is enabled in PHP
2. Verify email configuration in `sendCredentialsEmail()`
3. Check server logs for mail errors
4. Use local mail server or SMTP

### Password Not Generated
1. Ensure `random_bytes()` function available (PHP 7+)
2. Check database connection
3. Verify user role is 'student' or 'faculty'

### Login Failed
1. Verify email matches what was sent
2. Check password (case-sensitive)
3. Verify CAPTCHA entry
4. Check if account is locked
5. Confirm user role is 'admin', 'student', or 'faculty'

### Activity Logs Empty
1. Check activity_logs table exists
2. Verify user_id is valid in users table
3. Check IP address capture

---

## Future Enhancements

- [ ] Change password on first login
- [ ] Two-factor authentication
- [ ] Bulk student/faculty import via CSV
- [ ] Password reset email for students/faculty
- [ ] Admin user roles (super admin, department admin)
- [ ] Attendance tracking
- [ ] Grade management
- [ ] Course assignment
- [ ] Notifications dashboard
- [ ] Student status updates

---

## Support & Documentation

For issues or questions, refer to:
- Database schema in `/config/db.php`
- User management logic in `/model/usermodel.php`
- Controller logic in `/controller/usercontroller.php`
- View templates in `/views/` directory

Last Updated: March 9, 2026
