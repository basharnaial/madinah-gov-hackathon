#!/bin/bash

# 🚀 سكريبت نشر Laravel Backend
echo "🚀 بدء نشر Laravel Backend..."

# التحقق من وجود مجلد backend
if [ ! -d "backend" ]; then
    echo "❌ خطأ: مجلد backend غير موجود!"
    exit 1
fi

cd backend

# تحديث المكتبات
echo "📦 تحديث Composer..."
composer install --optimize-autoloader --no-dev

# التحقق من وجود ملف البيئة
if [ ! -f ".env" ]; then
    echo "⚠️  ملف .env غير موجود - يجب إنشاؤه يدوياً"
    echo "يمكنك نسخ الإعدادات من deployment-instructions.md"
    exit 1
fi

# إنشاء مفتاح التطبيق
echo "🔑 إنشاء مفتاح التطبيق..."
php artisan key:generate --force

# تحديث قاعدة البيانات
echo "🗄️  تحديث قاعدة البيانات..."
php artisan migrate --force

# إنشاء حساب الأدمن
echo "👤 إنشاء حساب الأدمن..."
php artisan db:seed --class=AdminSeeder --force

# إنشاء رابط التخزين
echo "📁 إنشاء رابط التخزين..."
php artisan storage:link

# تحسين الأداء
echo "⚡ تحسين الأداء..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# ضبط الصلاحيات
echo "🔐 ضبط صلاحيات الملفات..."
chmod -R 755 storage
chmod -R 755 bootstrap/cache

echo "✅ تم نشر Backend بنجاح!"
echo "🔗 يمكنك الآن الوصول للـ API على: /api/"
echo "📊 Admin Panel: /admin/login" 