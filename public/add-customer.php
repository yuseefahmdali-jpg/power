<?php
include_once "header.php";
  if(!Haspermission(enPermissions::AddCustomers))
    {        
      header("location:noopermission.php");        
    }
include_once "classes/clsValidation.php";
include_once "classes/clsDateBase.php";

    $db=new Database();
   $Valid=new Validation();

  

    if($_SERVER['REQUEST_METHOD']=='POST'){
        
    $name=$_POST["name"];
    $addres=$_POST["address"];
    $customer=$_POST["customer_type"];
    $phon=$_POST["Phone"];
    $add_details=$_POST["Address_details"];
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
                          
             if(empty($error)){
              $db->AddCustomer( $name, $addres, $customer, $phon, $add_details);
        header("location:customers.php");
             
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
                    <h1>إضافة عميل</h1>
                    <p>إنشاء حساب مشترك جديد</p>


                </div>

                <a class="btn btn-back" href="dashboard.php">
                    ← العودة إلى لوحة التحكم
                </a>

            </div>


            <div class="form-layout">

                <form class="card form-card" method="POST" action="add-customer.php">

                    <div class="card-title">

                        <h2>البيانات الأساسية</h2>

                        <span>جميع الحقول مطلوبة</span>

                    </div>


                    <div class="form-grid">

<!--
                        <div class="form-group">

                            <label>رقم حساب العميل </label>

                            <input
                                class="input"
                                type="text"
                                name ="account_number"
                            >

                        </div>-->

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

                            <label>الشارع</label>

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

                            <label>نوع الاشتراك</label>

                            <select class="input" name="customer_type">

                                <option>سكني</option>
                                <option>تجاري</option>
                                <option>صناعي</option>
                                <option>حكومي</option>

                            </select>

                        </div>

                        
  

                        
                        <div class="form-group">

                            <label>رقم الهاتف</label>

                            <input
                                class="input"
                               type="phone"
                                placeholder="00967000000000"
                                name="Phone"
                            >
                             <?php
                                    if(isset($error["phon"]))  echo $error["phon"];
                                    ?>

                        </div>
                        
                        
                        <div class="form-group">

                            <label>العنوان</label>

                            <textarea
                                class="input"
                                rows="4"
                                placeholder="العنوان بالتفصيل"
                                name="Address_details"
                            ></textarea>

                        </div>

                    </div>


                    <div class="form-actions">

                        <button class="btn" type="submit">
                            حفظ البيانات
                        </button>

                        <a class="btn btn-line" href="dashboard.html">
                            إلغاء
                        </a>

                    </div>

                </form>


                <aside class="card form-aside">

                    <span class="aside-kicker">ملخص الإجراء</span>

                    <h2>إضافة عميل</h2>

                    <p>
                        أنشئ ملف المشترك واربط بيانات التواصل بنوع الاشتراك وموقع الخدمة.
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