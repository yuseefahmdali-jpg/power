<?php
session_start();
include_once "classes/clsDateBase.php";
 
 enum enPermissions:int {
    case enAll=-1;
    case AddUsers=1;
    case AddCustomers=2;
    case AddEmployees=4;
    case AddReadings=8;
    case AddBills=16;
    case PayBills=32;
} 

      function Haspermission(enPermissions $permission):bool
    {
        if($_SESSION['permi']==-1)
            {
                return true;
            }
            
            if(($_SESSION['permi']&$permission->value)==$permission->value)
                {
                    return true;
                }
                else
                {
                    return false;
                }
    }

?>
<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ادارة المحطة  </title>

    <meta name="description" content="نظرة شاملة على أداء المحطة وعمليات التحصيل">

    <link rel="stylesheet" href="style.css">
</head>



    <header class="topbar">

        <div class="wrap topbar-inner">

            <a class="brand" href="dashboard.php">

                <span class="mark">H</span>

                <span>
                    <b>الشهيد هشام الغرباني</b>
                    <small>إدارة محطة الطاقة الكهربائية</small>
                </span>

            </a>

            <div class="who">

                

                <span>
                    <b> 
                        <?php
                        echo $_SESSION['name'];
                        ?>
                    </b>
                    <small>  <?php
                        echo $_SESSION['imge'];
                        ?></small>
                </span>

            </div>

        </div>


        <nav class="nav">

            <div class="wrap">

                <a class="" href="dashboard.php">الرئيسية</a>
                <a class="" href="customers.php">العملاء</a>
                <a class="" href="employees.php">الموظفون</a>
                <a class="" href="consumption.php">الاستهلاك</a>
                <a class="" href="invoices.php">الفواتير</a>
                <a class="" href="payments.php">المدفوعات</a>
                <a class="" href="add_user.php">المستخدمين</a>
                <a class="" href="UpdataUser.php">الاعدادات</a>
                <a class="" href="Logout.php">تسجيل الخروج</a>


            </div>

        </nav>

    </header>
