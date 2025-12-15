# Admin Approval System - Documentation

## Overview
The admin system has been successfully implemented with approval workflows for:
1. Event Manager applications
2. Event approvals (for events created by event managers)

## Admin Account
- **Email:** Admin@gmail.com
- **Password:** 12345678
- **Role:** admin

## Features Implemented

### 1. Admin Dashboard (`/admin/dashboard`)
The admin dashboard shows:
- **Statistics Cards:**
  - Total Users
  - Event Managers
  - Total Events
  - Pending Applications
  - Pending Events

- **Pending Manager Applications:**
  - View all pending applications
  - Approve applications (upgrades user to eventManager role)
  - Reject applications with optional reason

- **Pending Event Approvals:**
  - View all events waiting for approval
  - Approve or reject events

### 2. User Management (`/admin/users`)
- View all users with their details:
  - Name, Email, Role
  - Email verification status
  - Registration date
- Paginated list (20 users per page)
- Role badges (Admin, Event Manager, User)

### 3. Manager Application System
**For Users:**
- Users can apply for Event Manager status from their profile page
- Application creates a pending record in `manager_applications` table
- Users see their application status (pending/rejected)
- Users can reapply if rejected

**For Admins:**
- Review applications from dashboard
- Approve: User role upgraded to `eventManager`
- Reject: Can provide reason for rejection
- Application history tracked with timestamps

### 4. Event Approval System
**For Event Managers:**
- Events created by event managers start with `approval_status = 'pending'`
- Events need admin approval before being public

**For Admins:**
- View all pending events
- Approve or reject events
- Track who approved and when

## Database Tables

### manager_applications
```
- id
- user_id (FK to users)
- status (enum: pending, approved, rejected)
- reviewed_by (FK to users - the admin who reviewed)
- reviewed_at (timestamp)
- rejection_reason (text, nullable)
- created_at, updated_at
```

### events (new columns)
```
- approval_status (enum: pending, approved, rejected) DEFAULT 'pending'
- approved_by (FK to users - the admin who approved)
- approved_at (timestamp)
```

## Routes

### Admin Routes (Protected by `auth` and `admin` middleware)
```php
GET  /admin/dashboard                        - Admin dashboard
GET  /admin/users                            - User management
POST /admin/applications/{id}/approve        - Approve manager application
POST /admin/applications/{id}/reject         - Reject manager application
POST /admin/events/{id}/approve              - Approve event
POST /admin/events/{id}/reject               - Reject event
```

## Middleware
Created `IsAdmin` middleware that:
- Checks if user is authenticated
- Verifies user role is 'admin'
- Returns 403 error if unauthorized

## User Interface

### Navigation
When admin logs in, navbar shows:
- Dashboard (links to admin dashboard)
- Users (links to user management)

### Profile Page (for regular users)
- Shows application status if user has applied
- Pending: Yellow alert with submission date
- Rejected: Red alert with rejection reason and option to reapply
- Can submit new application if no pending application

## Workflow

### Event Manager Application Flow:
1. User clicks "Apply for Event Manager Status" on profile page
2. System creates `ManagerApplication` with status 'pending'
3. Admin sees application in dashboard
4. Admin approves:
   - Application status → 'approved'
   - User role → 'eventManager'
   - Records reviewer and timestamp
5. Admin rejects:
   - Application status → 'rejected'
   - Records reviewer, timestamp, and reason
   - User can reapply

### Event Approval Flow:
1. Event Manager creates event
2. Event created with `approval_status = 'pending'`
3. Admin sees event in dashboard pending events list
4. Admin approves:
   - Event `approval_status` → 'approved'
   - Records approver and timestamp
   - Event becomes public
5. Admin rejects:
   - Event `approval_status` → 'rejected'
   - Records approver and timestamp

## Testing

### To Test Manager Application:
1. Login as regular user (Sean.tandjaja2005@gmail.com / 12345678)
2. Go to Profile
3. Click "Apply for Event Manager Status"
4. Logout and login as admin (Admin@gmail.com / 12345678)
5. Go to Admin Dashboard
6. See pending application and approve/reject

### To Test Event Approval:
1. Create an event as an event manager
2. Event will have `approval_status = 'pending'`
3. Login as admin
4. Go to Admin Dashboard
5. See pending event and approve/reject

## Next Steps (Optional Enhancements)
- Email notifications for approval/rejection
- Application submission form with more details
- Event approval with feedback/comments
- Admin activity logs
- Bulk approval actions
- Search and filter in user management
- Application statistics and reports

## Files Modified/Created

### Controllers:
- `app/Http/Controllers/AdminController.php` - Admin dashboard and approval logic
- `app/Http/Controllers/ProfileController.php` - Updated to handle applications

### Models:
- `app/Models/ManagerApplication.php` - New model
- `app/Models/Event.php` - Updated with approval fields
- `app/Models/User.php` - Existing

### Views:
- `resources/views/admin/dashboard.blade.php` - Admin dashboard
- `resources/views/admin/users.blade.php` - User management
- `resources/views/user/profile.blade.php` - Updated with application status

### Migrations:
- `2025_12_15_024329_create_manager_applications_table.php`
- `2025_12_15_024329_add_approval_status_to_events_table.php`

### Routes:
- `routes/web.php` - Added admin routes

### Middleware:
- `app/Http/Middleware/IsAdmin.php` - Admin access control
- `bootstrap/app.php` - Registered middleware alias

## Security
- All admin routes protected by `auth` and `admin` middleware
- Non-admin users get 403 error if accessing admin routes
- CSRF protection on all forms
- Password confirmation required for account deletion
