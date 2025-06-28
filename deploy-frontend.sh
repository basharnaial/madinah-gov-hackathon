#!/bin/bash

# 🎨 سكريبت نشر Vue.js Frontend
echo "🎨 بدء نشر Vue.js Frontend..."

# التحقق من وجود مجلد frontend
if [ ! -d "frontend" ]; then
    echo "❌ خطأ: مجلد frontend غير موجود!"
    exit 1
fi

cd frontend

# تحديث المكتبات
echo "📦 تحديث npm packages..."
npm install

# بناء المشروع للإنتاج
echo "🏗️  بناء المشروع..."
npm run build

# التحقق من نجاح البناء
if [ ! -d "dist" ]; then
    echo "❌ خطأ في بناء المشروع!"
    exit 1
fi

echo "✅ تم بناء Frontend بنجاح!"
echo "📁 ملفات البناء موجودة في: frontend/dist/"
echo "📋 الخطوة التالية: انسخ محتويات dist/ إلى public_html على السيرفر"

# إنشاء ملف معلومات للنشر
cat > ../deployment-info.txt << EOF
📋 معلومات النشر - $(date)
================================

✅ Frontend: تم البناء بنجاح
📁 الملفات: frontend/dist/
🎯 المطلوب: نسخ محتويات dist/ إلى public_html

📝 ملاحظات:
- تأكد من تحديث رابط API في production
- فحص إعدادات .htaccess أو nginx
- اختبار تحميل الصفحة الرئيسية
- اختبار التسجيل وإدارة المشاركات

🔗 روابط مهمة:
- الموقع الرئيسي: https://yourdomain.com
- Admin Panel: https://yourdomain.com/admin
- API Docs: https://yourdomain.com/api/
EOF

echo "📄 تم إنشاء ملف deployment-info.txt مع معلومات النشر" 