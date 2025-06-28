# ✅ قائمة تدقيق نشر مشروع هاكاثون المدينة المنورة

## 📋 قبل البدء:
- [ ] التأكد من توفر متطلبات السيرفر (PHP 8.1+, MySQL, Composer, Node.js)
- [ ] الحصول على بيانات قاعدة البيانات والإيميل
- [ ] التأكد من وجود نسخة احتياطية من البيانات الحالية (إن وجدت)

## 🔧 Backend (Laravel):

### إعداد الملفات:
- [ ] نسخ مجلد `backend/` إلى السيرفر
- [ ] إنشاء ملف `.env` في `backend/` مع الإعدادات الصحيحة
- [ ] التأكد من إعدادات قاعدة البيانات في `.env`
- [ ] إعداد بيانات الإيميل (SMTP) في `.env`

### تشغيل الأوامر:
- [ ] `composer install --optimize-autoloader --no-dev`
- [ ] `php artisan key:generate --force`
- [ ] `php artisan migrate --force`
- [ ] `php artisan db:seed --class=AdminSeeder --force`
- [ ] `php artisan storage:link`
- [ ] `php artisan config:cache`
- [ ] `php artisan route:cache`
- [ ] `php artisan view:cache`

### الصلاحيات:
- [ ] `chmod -R 755 storage/`
- [ ] `chmod -R 755 bootstrap/cache/`
- [ ] `chown -R www-data:www-data storage/` (Linux/Ubuntu)
- [ ] `chown -R www-data:www-data bootstrap/cache/` (Linux/Ubuntu)

## 🎨 Frontend (Vue.js):

### البناء المحلي:
- [ ] تحديث `src/utils/api.ts` برابط السيرفر الصحيح
- [ ] `cd frontend && npm install`
- [ ] `npm run build`
- [ ] التأكد من إنشاء مجلد `dist/` بنجاح

### الرفع للسيرفر:
- [ ] نسخ محتويات `frontend/dist/` إلى `public_html/` (أو المجلد الرئيسي)
- [ ] رفع ملف `.htaccess` إلى `public_html/`
- [ ] التأكد من صحة مسارات الملفات

## 🌐 إعدادات السيرفر:

### Apache:
- [ ] تفعيل mod_rewrite
- [ ] التأكد من عمل ملف `.htaccess`
- [ ] فحص إعدادات Virtual Host (إن وجدت)

### Nginx:
- [ ] إضافة إعدادات Nginx للمشروع
- [ ] إعادة تشغيل Nginx
- [ ] فحص إعدادات PHP-FPM

### SSL (مفضل):
- [ ] تثبيت SSL Certificate
- [ ] إعادة توجيه HTTP إلى HTTPS
- [ ] تحديث APP_URL في `.env` إلى https

## 🔒 الأمان:

### حماية الملفات:
- [ ] حماية ملف `.env` من الوصول المباشر
- [ ] حماية ملفات `composer.json` و `composer.lock`
- [ ] التأكد من عدم وصول الزوار لمجلد `backend/` مباشرة

### كلمات المرور:
- [ ] تغيير كلمة مرور قاعدة البيانات
- [ ] تغيير كلمة مرور الأدمن الافتراضية
- [ ] استخدام كلمات مرور قوية

## ✅ اختبار المشروع:

### Frontend:
- [ ] فتح الموقع الرئيسي: `https://yourdomain.com`
- [ ] اختبار تغيير اللغة (عربي/إنجليزي)
- [ ] اختبار الـ Navigation والروابط
- [ ] اختبار الـ Responsive Design

### التسجيل:
- [ ] فتح صفحة التسجيل
- [ ] اختبار تسجيل مشارك جديد
- [ ] اختبار رفع ملف CV
- [ ] التأكد من وصول إيميل التأكيد

### Admin Panel:
- [ ] فتح صفحة الأدمن: `https://yourdomain.com/admin`
- [ ] تسجيل دخول بحساب الأدمن
- [ ] عرض قائمة المشاركين
- [ ] اختبار الموافقة/الرفض
- [ ] اختبار تصدير البيانات (Excel)

### API:
- [ ] اختبار API endpoints:
  - [ ] `GET /api/registration/field-of-interest-options`
  - [ ] `GET /api/registration/registration-type-options`
  - [ ] `POST /api/registration/register`
  - [ ] `POST /api/admin/login`

## 📊 مراقبة الأداء:

### السجلات:
- [ ] فحص `storage/logs/laravel.log` للأخطاء
- [ ] فحص Apache/Nginx access logs
- [ ] فحص Apache/Nginx error logs

### قاعدة البيانات:
- [ ] اختبار الاتصال بقاعدة البيانات
- [ ] التأكد من إنشاء جميع الجداول
- [ ] فحص بيانات الـ seeder

## 🚨 استكشاف الأخطاء الشائعة:

### خطأ 500:
- [ ] فحص `storage/logs/laravel.log`
- [ ] التأكد من صلاحيات المجلدات
- [ ] التأكد من صحة إعدادات `.env`

### خطأ 404 للـ API:
- [ ] فحص إعدادات `.htaccess` أو Nginx
- [ ] التأكد من مسار الـ API في Frontend
- [ ] فحص `php artisan route:list`

### مشاكل الـ Database:
- [ ] التأكد من صحة بيانات الاتصال في `.env`
- [ ] فحص صلاحيات المستخدم في MySQL
- [ ] التأكد من تشغيل MySQL service

### مشاكل الملفات:
- [ ] التأكد من وجود مجلد `storage/app/public`
- [ ] فحص رابط `storage:link`
- [ ] التأكد من صلاحيات مجلد `storage`

## 📞 معلومات الدعم:

### بيانات الدخول الافتراضية:
- **Admin Email**: admin@madinahtech.com
- **Admin Password**: password123
- **Database**: حسب إعدادات `.env`

### روابط مهمة:
- **الموقع الرئيسي**: https://yourdomain.com
- **Admin Panel**: https://yourdomain.com/admin
- **API Documentation**: https://yourdomain.com/api

### الدعم الفني:
- **Laravel Logs**: `storage/logs/laravel.log`
- **Server Logs**: `/var/log/apache2/` أو `/var/log/nginx/`
- **PHP Errors**: فحص `php_errors.log`

---

## 🎯 الخطوات السريعة للنشر:

1. **رفع الملفات**: Backend + Frontend files
2. **إعداد .env**: Database + Email settings
3. **تشغيل Laravel**: migrate + seed + cache
4. **إعداد Web Server**: .htaccess أو nginx config
5. **اختبار شامل**: Frontend + API + Admin
6. **إعدادات الأمان**: SSL + file permissions

✅ **النشر مكتمل بنجاح!** 🎉

---

💡 **نصيحة**: احتفظ بنسخة احتياطية من قاعدة البيانات والملفات قبل أي تحديث مستقبلي! 