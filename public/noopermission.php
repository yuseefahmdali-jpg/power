
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>تسجيل الدخول |  نظام المحطة</title>
  <!-- ربط ملف التنسيق المرفق -->
  <link rel="stylesheet" href="style.css" />
  <style>
    /* توسيط النموذج في منتصف الشاشة تماماً باستخدام Flexbox */
    body {
      display: flex;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      margin: 0;
      /* استخدام لون الخلفية الأساسي من ملف style.css */
      background: var(--surface); 
    }

    .login-wrapper {
      width: 100%;
      max-width: 420px;
      padding: 20px;
    }

    /* إنشاء تصميم "ضخم" وبارز باستخدام المتغيرات اللونية من ملف التنسيق */
    .card-bold {
      background: var(--navy);
      color: var(--light);
      border: 2px solid var(--blue);
      border-radius: var(--radius);
      padding: 35px 25px;
      box-shadow: 0 15px 35px rgba(10, 22, 49, 0.4); /* ظل لإعطاء بروز قوي للبطاقة */
    }

    .card-bold h1 {
      color: var(--light);
      font-size: 28px;
      text-align: center;
      margin-bottom: 25px;
      margin-top: 5px;
    }

    .card-bold .eyebrow {
      color: var(--gray);
      text-align: center;
      display: block;
      font-size: 14px;
      letter-spacing: 1px;
    }

    .card-bold label {
      color: var(--light);
      font-size: 14px;
    }

    /* تخصيص الحقول لتتناسب مع الخلفية الداكنة */
    .card-bold .input {
      background: color-mix(in srgb, var(--navy) 85%, var(--light));
      color: var(--light);
      border: 1px solid var(--blue);
    }

    .card-bold .input:focus {
      border-color: var(--light);
      outline: none;
    }

    .card-bold .input::placeholder {
      color: var(--gray);
    }

    /* تخصيص زر الدخول ليكون بارزاً */
    .card-bold .btn {
      background: var(--blue);
      color: var(--light);
      border: 1px solid var(--light);
      font-size: 16px;
      padding: 12px;
      margin-top: 15px;
      border-radius: 10px;
    }

    .card-bold .btn:hover {
      background: var(--light);
      color: var(--navy);
      border-color: var(--navy);
    }
  </style>
</head>

<body>

  <div class="login-wrapper">
    <!-- إضافة فئة card-bold التي أضفناها لتغيير الألوان بشكل جذري -->
    <div class="card card-bold">
      <span class="eyebrow">نظام إدارة الصلاحيات</span>
      <h1> غير مسموح لك بالدخول</h1>
      
        <a class="btn btn-back" href="dashboard.php">
                    ← العودة إلى لوحة التحكم
                </a>
    </div>
  </div>

</body>
</html>