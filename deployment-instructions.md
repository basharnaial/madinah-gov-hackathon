# 📚 تعليمات رفع مشروع هاكاثون المدينة المنورة

## 🔧 إعداد Backend (Laravel)

### 1. إنشاء ملف البيئة (.env):
```env
APP_NAME="Madinah Hackathon"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://yourdomain.com

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_db_username
DB_PASSWORD=your_db_password

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MAIL_MAILER=smtp
MAIL_HOST=your_smtp_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_email_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=noreply@yourdomain.com
MAIL_FROM_NAME="Madinah Hackathon"
```

### 2. الأوامر للسيرفر:
```bash
# تحديث Composer
composer install --optimize-autoloader --no-dev

# إنشاء مفتاح التطبيق
php artisan key:generate

# تشغيل قاعدة البيانات
php artisan migrate --force

# إنشاء حساب الأدمن
php artisan db:seed --class=AdminSeeder

# تحسين الأداء
php artisan config:cache
php artisan route:cache
php artisan view:cache

# ضبط الصلاحيات
chmod -R 755 storage
chmod -R 755 bootstrap/cache
chown -R www-data:www-data storage
chown -R www-data:www-data bootstrap/cache
```

## 🎨 إعداد Frontend (Vue.js)

### 1. تحديث إعدادات API:
قم بتحديث ملف `src/utils/api.ts`:
```typescript
const baseURL = 'https://yourdomain.com/api';
```

### 2. بناء المشروع:
```bash
npm install
npm run build
```

### 3. رفع ملفات البناء:
- انسخ محتويات مجلد `dist/` إلى مجلد `public_html` أو المجلد الرئيسي للموقع

## 🌐 إعداد Apache/Nginx

### Apache (.htaccess):
```apache
<IfModule mod_rewrite.c>
    RewriteEngine On
    
    # Handle Angular and Vue.js routes
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^(?!api|storage).*$ /index.html [L]
    
    # API Routes to Laravel
    RewriteCond %{REQUEST_URI} ^/api/
    RewriteRule ^api/(.*)$ /backend/public/api/$1 [L,QSA]
</IfModule>
```

### Nginx:
```nginx
server {
    listen 80;
    server_name yourdomain.com;
    root /var/www/html;
    index index.html;

    # Frontend routes
    location / {
        try_files $uri $uri/ /index.html;
    }

    # API routes to Laravel
    location /api {
        alias /var/www/html/backend/public;
        try_files $uri $uri/ @laravel;
        
        location ~ \.php$ {
            include fastcgi_params;
            fastcgi_param SCRIPT_FILENAME $request_filename;
            fastcgi_pass unix:/var/run/php/php8.1-fpm.sock;
        }
    }

    location @laravel {
        rewrite /api/(.*)$ /api/index.php/$1 last;
    }
}
```

## 📁 هيكل الملفات على السيرفر:
```
public_html/
├── index.html (من Vue build)
├── assets/ (من Vue build)
├── backend/
│   ├── app/
│   ├── config/
│   ├── public/
│   │   └── index.php
│   ├── storage/
│   └── ...
└── .htaccess
```

## 🔒 إعدادات الأمان:

### 1. حماية مجلد Backend:
```apache
# في backend/.htaccess
<Files ".env">
    Order allow,deny
    Deny from all
</Files>

<Files "composer.json">
    Order allow,deny  
    Deny from all
</Files>
```

### 2. إعداد SSL:
- تفعيل SSL Certificate
- إعادة توجيه HTTP إلى HTTPS

## ✅ اختبار المشروع:

### 1. فحص Frontend:
- زيارة الموقع الرئيسي
- اختبار صفحة التسجيل
- اختبار تغيير اللغة

### 2. فحص Backend API:
```bash
curl https://yourdomain.com/api/registration/field-of-interest-options
```

### 3. فحص Admin Panel:
- تسجيل دخول الأدمن
- مراجعة المشاركات
- تصدير البيانات

## 🚨 استكشاف الأخطاء:

### 1. خطأ 500:
```bash
# فحص السجلات
tail -f storage/logs/laravel.log

# فحص صلاحيات الملفات
chmod -R 755 storage
chmod -R 755 bootstrap/cache
```

### 2. مشاكل قاعدة البيانات:
```bash
# اختبار الاتصال
php artisan tinker
>>> DB::connection()->getPdo();
```

### 3. مشاكل الإيميل:
```bash
# اختبار إعدادات البريد
php artisan tinker
>>> Mail::raw('Test', function($msg) { $msg->to('test@example.com'); });
```

## 📞 معلومات مفيدة:

### أوامر Laravel مفيدة:
```bash
# مسح الكاش
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear

# فحص الحالة
php artisan about

# إنشاء رابط تخزين
php artisan storage:link
```

### معلومات قاعدة البيانات:
- الجداول الرئيسية: participants, admins, team_members, evaluations
- حساب الأدمن الافتراضي يتم إنشاؤه من AdminSeeder

## 🎯 الخطوات الأساسية المختصرة:

1. **رفع Backend**: انسخ مجلد backend إلى السيرفر
2. **إعداد .env**: أدخل بيانات قاعدة البيانات والإيميل  
3. **تشغيل Laravel**: migrate + seed + cache
4. **بناء Frontend**: npm run build
5. **رفع Frontend**: انسخ dist/ إلى public_html
6. **إعداد Server**: htaccess أو nginx config
7. **اختبار**: تأكد من عمل التسجيل والأدمن

---

هذا دليل شامل لرفع المشروع. إذا كنت تحتاج مساعدة في أي خطوة محددة أو واجهت مشكلة، أخبرني وسأساعدك في حلها! 🚀 