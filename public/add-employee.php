<?php
include_once "header.php";
 if(!Haspermission(enPermissions::AddEmployees))
    {        
      header("location:noopermission.php");        
    }
include_once "classes/clsDateBase.php";
include_once "classes/clsValidation.php";


     $db=new Database();
     $Valid=new Validation();

    if($_SERVER['REQUEST_METHOD']=='POST')
        {
                  
    $name=$_POST["name"];
    $addres=$_POST["address"];
    $jobe=$_POST["jobe"];
    $phon=$_POST["phone"];
    $salary=$_POST["salary"];
    $error=[];

             if(!$Valid->clsRequired($name))
             {
                $error['name']="<span style='color:red;'>الاسم مطلوب </span>";
             }
                 if(!$Valid->clsRequired($phon))
             {
                $error['phon']="<span style='color:red;'> رقم الهاتف مطلوب </span>";   
             }

                 if(!$Valid->clsInputMatching($phon))
             {
                $error['phon']="<span style='color:red;'> خطاء في رقم الهاتف  </span>"; 
             }
                          
             if(empty($error))
                {
             $db->AddEmploy($name,$addres,$jobe,$phon,$salary);
             header("location:add-employee.php");
             
             }
             else{
                echo '<br><div class="wrap">خطاء في المدخلات </div>';
             }

        }

?>


<body>

   


    <main class="page">

        <div class="wrap">

            <div class="page-header">

                <div>

                    <span class="eyebrow">مركز العمليات</span>

                    <h1>إضافة موظف</h1>

                    <p>إدخال بيانات موظف جديد</p>

                </div>

                <a class="btn btn-back" href="dashboard.php">
                    ← العودة إلى لوحة التحكم
                </a>

            </div>


            <div class="form-layout">

                <form class="card form-card" method="POST" action="add-employee.php">

                    <div class="card-title">

                        <h2>البيانات الأساسية</h2>

                        <span>جميع الحقول مطلوبة</span>

                    </div>


                    <div class="form-grid">

                        <div class="form-group">

                            <label>الاسم الكامل</label>

                            <input
                                class="input"
                                type="text"
                                placeholder="الاسم الرباعي"
                                name="name"
                                >
                                 <?php
                                    if(isset($error["name"]))  echo $error["name"];
                                    ?>

                        </div>


                   <div class="form-group">

                            <label>العنوان</label>

                             <select class="input" name="address">

                                <option>شارع عامر</option>
                                <option>الشارع العام</option>
                                <option>المواصلات</option>
                                <option>الدائري</option>
                                <option>عاطف</option>
                                <option>قاع الجبر</option>
                                <option>المبياض</option>
                                <option>الاسدي</option>

                            </select>
                            
                        </div>


                        <div class="form-group">

                            <label>رقم الهاتف</label>

                            <input
                                class="input"
                                type="tel"
                                name="phone"
                                placeholder="00967xxxxxxxx"
                            >
                            <?php
                                    if(isset($error["phon"]))  echo $error["phon"];
                                    ?>

                        </div>


                        <div class="form-group">

                            <label>المسمى الوظيفي</label>

                            <select class="input" name="jobe">

                                <option>التشغيل</option>
                                <option>الصيانة</option>
                                <option>فني</option>
                                <option>المالية</option>
                                <option>التحصيل</option>
                                <option>خدمة العملاء</option>

                            </select>

                        </div>


            
                        <div class="form-group">

                            <label>الراتب الأساسي</label>

                            <input
                                class="input"
                                type="number"
                                name="salary"
                                placeholder="القيمة بالريال"
                            >

                        </div>

                    </div>


                    <div class="form-actions">

                        <button class="btn" type="submit">
                            حفظ البيانات
                        </button>

                        <a class="btn btn-line" href="dashboard.php">
                            إلغاء
                        </a>

                    </div>

                </form>


                <aside class="card form-aside">

                    <span class="aside-kicker">ملخص الإجراء</span>

                    <h2>إضافة موظف</h2>

                    <p>
                        أضف الموظف إلى القسم المناسب مع بيانات التواصل والتوظيف الأساسية.
                    </p>

                    <div class="check-list">

                        <span>بيانات منظمة</span>
                        <span>متوافق مع سجلات النظام</span>
                        <span>جاهز للحفظ لاحقًا</span>

                    </div>

                </aside>

            </div>

        </div>

    </main>

<?php
include_once "footer.php";

?>
   

</body>

</html>