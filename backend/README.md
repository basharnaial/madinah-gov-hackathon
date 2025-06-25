# Madinah Hackathon Registration Platform - Backend

This is the Laravel 11 backend for the Madinah Hackathon Registration Platform.

## Features

- **Participant Registration**: Complete registration system with file upload
- **Admin Panel**: Secure admin authentication and participant management
- **Email Notifications**: Automatic confirmation emails
- **File Management**: CV upload and download functionality
- **Data Export**: Excel export for participant data
- **API Documentation**: RESTful API endpoints

## Tech Stack

- **Framework**: Laravel 11
- **Database**: MySQL
- **Authentication**: Laravel Sanctum
- **File Storage**: Local storage with symbolic links
- **Email**: Laravel Mail
- **Excel Export**: Maatwebsite Excel
- **Validation**: Form Request Validation

## Installation

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd backend
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Environment setup**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configure database**
   Edit `.env` file and set your database credentials:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=madinah_hackathon
   DB_USERNAME=your_username
   DB_PASSWORD=your_password
   ```

5. **Configure email** (optional)
   ```env
   MAIL_MAILER=smtp
   MAIL_HOST=smtp.mailtrap.io
   MAIL_PORT=2525
   MAIL_USERNAME=your_username
   MAIL_PASSWORD=your_password
   MAIL_ENCRYPTION=tls
   MAIL_FROM_ADDRESS="noreply@madinah-hackathon.com"
   MAIL_FROM_NAME="Madinah Hackathon"
   ```

6. **Run migrations**
   ```bash
   php artisan migrate
   ```

7. **Seed the database**
   ```bash
   php artisan db:seed
   ```

8. **Create storage link**
   ```bash
   php artisan storage:link
   ```

## Default Admin Credentials

After running the seeder, you can login with:
- **Email**: admin@madinah-hackathon.com
- **Password**: admin123

## API Endpoints

### Registration Endpoints

#### Register Participant
```
POST /api/registration/register
```

**Request Body:**
```json
{
    "full_name": "أحمد محمد",
    "email": "ahmed@example.com",
    "phone": "+966501234567",
    "age": 25,
    "city": "المدينة المنورة",
    "field_of_interest": "AI",
    "registration_type": "Individual",
    "cv": "file (PDF, max 5MB)",
    "project_idea": "فكرة مشروع تطوير تطبيق ذكي",
    "terms_accepted": true
}
```

#### Get Field of Interest Options
```
GET /api/registration/field-of-interest-options
```

#### Get Registration Type Options
```
GET /api/registration/registration-type-options
```

### Admin Endpoints

#### Admin Login
```
POST /api/admin/login
```

**Request Body:**
```json
{
    "email": "admin@madinah-hackathon.com",
    "password": "admin123"
}
```

#### Admin Logout
```
POST /api/admin/logout
```
**Headers:** `Authorization: Bearer {token}`

#### Get Admin Profile
```
GET /api/admin/profile
```
**Headers:** `Authorization: Bearer {token}`

#### Get Participants List
```
GET /api/admin/participants
```
**Headers:** `Authorization: Bearer {token}`

**Query Parameters:**
- `registration_type`: Individual/Team
- `status`: Pending/Approved/Rejected
- `field_of_interest`: AI/Web Development/etc.
- `search`: Search in name, email, city
- `sort_by`: created_at, full_name, email
- `sort_order`: asc/desc
- `per_page`: 15 (default)

#### Get Participant Details
```
GET /api/admin/participants/{id}
```
**Headers:** `Authorization: Bearer {token}`

#### Update Participant Status
```
PATCH /api/admin/participants/{id}/status
```
**Headers:** `Authorization: Bearer {token}`

**Request Body:**
```json
{
    "status": "Approved"
}
```

#### Download Participant CV
```
GET /api/admin/participants/{id}/cv
```
**Headers:** `Authorization: Bearer {token}`

#### Export Participants to Excel
```
GET /api/admin/participants/export/excel
```
**Headers:** `Authorization: Bearer {token}`

#### Get Dashboard Statistics
```
GET /api/admin/dashboard/stats
```
**Headers:** `Authorization: Bearer {token}`

## Database Schema

### Participants Table
- `id` - Primary key
- `full_name` - Participant full name
- `email` - Unique email address
- `phone` - Phone number
- `age` - Age (16-100)
- `city` - City name
- `field_of_interest` - Enum: AI, Web Development, IoT, etc.
- `registration_type` - Enum: Individual, Team
- `cv_path` - CV file path (nullable)
- `project_idea` - Project description (nullable)
- `status` - Enum: Pending, Approved, Rejected
- `terms_accepted` - Boolean
- `created_at` - Timestamp
- `updated_at` - Timestamp

### Admins Table
- `id` - Primary key
- `name` - Admin name
- `email` - Unique email address
- `password` - Hashed password
- `remember_token` - Remember me token
- `created_at` - Timestamp
- `updated_at` - Timestamp

## File Storage

CV files are stored in `storage/app/public/cvs/` and are accessible via the symbolic link at `public/storage/`.

## Email Templates

Email templates are located in `resources/views/emails/`:
- `registration-confirmation.blade.php` - Registration confirmation email

## Running the Application

```bash
php artisan serve
```

The API will be available at `http://localhost:8000/api/`

## Testing

```bash
php artisan test
```

## Security Features

- CSRF protection (handled by Laravel)
- File upload validation (PDF only, max 5MB)
- Rate limiting on registration endpoint
- Input sanitization and validation
- Secure password hashing
- Token-based authentication for admin panel

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## License

This project is licensed under the MIT License.
