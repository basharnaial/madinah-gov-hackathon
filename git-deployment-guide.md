# 📥 دليل سحب مشروع هاكاثون المدينة المنورة من Git

## 🎯 الطرق المختلفة لسحب المشروع

### 1️⃣ الطريقة الأولى: رفع المشروع إلى GitHub أولاً (مُستحسن)

#### أ) إنشاء Repository على GitHub:
1. اذهب إلى [GitHub.com](https://github.com)
2. اضغط على "New Repository" 
3. اسم المشروع: `madinah-hackathon`
4. اجعله Public أو Private
5. **لا تضع** README أو .gitignore

#### ب) ربط المشروع المحلي بـ GitHub:
```bash
# في مجلد المشروع
git remote add origin https://github.com/your-username/madinah-hackathon.git
git branch -M main
git push -u origin main
```

#### ج) سحب المشروع من GitHub لأي مكان:
```bash
# سحب المشروع لأول مرة
git clone https://github.com/your-username/madinah-hackathon.git

# أو سحب التحديثات لمشروع موجود
cd madinah-hackathon
git pull origin main
``` 