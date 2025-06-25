<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأكيد التسجيل - برمجان المدينة</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 3px solid #4CAF50;
            padding-bottom: 20px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #4CAF50;
            margin-bottom: 10px;
        }
        .title {
            font-size: 20px;
            color: #333;
            margin-bottom: 5px;
        }
        .subtitle {
            font-size: 14px;
            color: #666;
        }
        .content {
            margin-bottom: 30px;
        }
        .greeting {
            font-size: 18px;
            margin-bottom: 20px;
            color: #4CAF50;
        }
        .details {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
            margin: 20px 0;
        }
        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            padding: 5px 0;
            border-bottom: 1px solid #eee;
        }
        .detail-label {
            font-weight: bold;
            color: #555;
        }
        .detail-value {
            color: #333;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 14px;
        }
        .status-pending {
            background-color: #fff3cd;
            color: #856404;
            padding: 10px;
            border-radius: 5px;
            text-align: center;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="logo">برمجان المدينة</div>
            <div class="title">تأكيد التسجيل</div>
            <div class="subtitle">Registration Confirmation</div>
        </div>

        <div class="content">
            <div class="greeting">
                مرحباً {{ $participant->full_name }}،
            </div>

            <p>
                شكراً لك على التسجيل في هاكاثون برمجان المدينة! تم استلام طلب تسجيلك بنجاح.
            </p>

            <div class="status-pending">
                <strong>حالة التسجيل:</strong> قيد المراجعة
                <br>
                <small>Status: Pending Review</small>
            </div>

            <div class="details">
                <h3>تفاصيل التسجيل:</h3>
                <div class="detail-row">
                    <span class="detail-label">الاسم الكامل:</span>
                    <span class="detail-value">{{ $participant->full_name }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">البريد الإلكتروني:</span>
                    <span class="detail-value">{{ $participant->email }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">رقم الهاتف:</span>
                    <span class="detail-value">{{ $participant->phone }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">العمر:</span>
                    <span class="detail-value">{{ $participant->age }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">المدينة:</span>
                    <span class="detail-value">{{ $participant->city }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">مجال الاهتمام:</span>
                    <span class="detail-value">{{ $participant->field_of_interest }}</span>
                </div>
                <div class="detail-row">
                    <span class="detail-label">نوع التسجيل:</span>
                    <span class="detail-value">{{ $participant->registration_type }}</span>
                </div>
                @if($participant->project_idea)
                <div class="detail-row">
                    <span class="detail-label">فكرة المشروع:</span>
                    <span class="detail-value">{{ $participant->project_idea }}</span>
                </div>
                @endif
            </div>

            <p>
                <strong>الخطوات التالية:</strong>
            </p>
            <ul>
                <li>سيتم مراجعة طلبك من قبل فريق المنظمين</li>
                <li>ستتلقى إشعاراً عبر البريد الإلكتروني عند الموافقة على طلبك</li>
                <li>سيتم إرسال تفاصيل إضافية حول الحدث والجدول الزمني</li>
            </ul>

            <p>
                إذا كان لديك أي استفسارات، لا تتردد في التواصل معنا.
            </p>
        </div>

        <div class="footer">
            <p>
                <strong>برمجان المدينة - Madinah Hackathon</strong><br>
                شكراً لك على اهتمامك بالمشاركة في هذا الحدث المميز
            </p>
            <p>
                <small>
                    هذا البريد الإلكتروني تم إرساله تلقائياً، يرجى عدم الرد عليه.<br>
                    This is an automated email, please do not reply.
                </small>
            </p>
        </div>
    </div>
</body>
</html> 