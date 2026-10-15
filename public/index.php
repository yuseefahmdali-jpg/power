<?php
session_start();
include_once "classes/clsUser.php";
include_once "classes/clsValidation.php";


$Valid=new Validation();
    if($_SERVER['REQUEST_METHOD']=='POST')
        {
          $username=$_POST['username'];
          $pass=$_POST['pass'];
          $error=[];
          
          // echo $username.$Valid->IsClean($username)." - ".$pass;
          if(!$Valid->IsClean($username))
            {
                $error['user']="<span style='color:red;'> اسم المستخدم او كلمة السر غير صحيح </span>";
                }
                if(!$Valid->IsClean($pass))
                  {
                    $error['user']="<span style='color:red;'> اسم المستخدم او كلمة السر غير صحيح </span>";
             }
             
             if(empty($error)){
               
               
                $User=new User($username,$pass);
                if($User->logecsaccus==true)
                  {
                    setcookie("username",$_POST['username'],time()+60*60*24);
                    $_SESSION['user']=$_POST['username'];
                    $_SESSION['Id']=$User->_Id;
                    $_SESSION['name']=$User->_name;
                    $_SESSION['username']=$User->_Username;
                    $_SESSION['pass']=$User->_Password;
                    $_SESSION['role']=$User->_Role;
                    $_SESSION['permi']=$User->_Permissions;
                    $_SESSION['imge']=$User->_Imge;
                  header("location:dashboard.php");
                   $db=new Database();
                   $db->Addlogin($_SESSION['name'],$_SESSION['imge']);
                }else
                {
                  $_SESSION['user']=NULL;
                    $error['user']="<span style='color:red;'> اسم المستخدم او كلمة السر غير صحيح </span>";

                }

             }
             else{
                //echo '<br><div class="wrap">خطاء في المدخلات </div>';
             }
        }
?>
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
      <span class="eyebrow">نظام إدارة المحطة</span>
      <h1>تسجيل الدخول</h1>
      
      <form id="loginForm" method="POST" action="Login.php">
        
        <div class="form-group">
          <label for="username">اسم المستخدم</label>
          <input name="username" class="input" id="username" type="text" placeholder="أدخل اسم المستخدم" required autocomplete="username" />
        </div>

        <div class="form-group mt">
          <label for="password">كلمة المرور</label>
          <input name="pass" class="input" id="password" type="password" placeholder="••••••••" required autocomplete="current-password" />
        </div>

         <?php
          if(isset($error["user"]))  echo $error["user"];
           ?>
        <div class="form-actions">
          <button class="btn" type="submit" style="width: 100%;">تسجيل الدخول</button>
        </div>
        
      </form>
    </div>
  </div>

</body>
</html>