<?php
include_once "header.php";
 if(!Haspermission(enPermissions::AddReadings))
    {        
      header("location:noopermission.php");        
    }
include_once "classes/clsValidation.php";
include_once "classes/clsDateBase.php";

    $db=new Database();
    $Valid=new Validation();


        if($_SERVER['REQUEST_METHOD']=='POST'){
        
    $customer=$_POST["customer_id"];
    $previous=$_POST["previous_reading"];
    $current=$_POST["current_reading"];



    $error=[];



             if(!$Valid->clsRequired($customer))
             {
                $error['name']="<span style='color:red;'>اختر عميل  </span>";
             }

                 if(!$Valid->clsInputCheckDeciml($previous))
             {
                $error['previous']="<span style='color:red;'> خطاء في القراءة السابقة </span>"; 
             }
                  if(!$Valid->clsInputCheckDeciml($current))
             {
                $error['current']="<span style='color:red;'> خطاء في القراءة الحالية </span>"; 
             }
               if($previous>=$current)
             {
                $error['previouscurrent']="<span style='color:red;'>القراءة السابقة اكبر من القراءة الحالية</span>"; 
             }
                          
             if(empty($error)){
              $db->AddConsumption($customer,$previous,$current);
        header("location:consumption.php");
             
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

                    <h1>تسجيل قراءة الكهرباء</h1>

                    <p>إدخال قراءة عداد جديدة</p>

                </div>

                <a class="btn btn-back" href="dashboard.php">
                    ← العودة إلى لوحة التحكم
                </a>

            </div>


            <div class="form-layout">

                <form class="card form-card" method="POST" action="meter-reading.php">

                    <div class="card-title">

                        <h2>البيانات الأساسية</h2>
                           <?php
                                    if(isset($error["previouscurrent"]))  echo $error["previouscurrent"];
                             ?>

                        <span>جميع الحقول مطلوبة</span>

                    </div>


                    <div class="form-grid">

                      

                        <div class="form-group">

                            <label>العميل</label>

                            <select class="input" name="customer_id">

                                <option>اختر العميل</option>

                                             <?php
                        $db=new Database();
                      $custmr=$db->GetTable("customers");
                       foreach($custmr as $row)
                        {
                            if($row["statuse"]==1)
                                {
                            echo "<option value=".$row["customer_id"].">";
                            echo $row["name"]." - ".$row["account_number"];
                            echo "</option>";
                                }
                        }
                        ?>
                            </select>

                              <?php
                                    if(isset($error["name"]))  echo $error["name"];
                                ?>

                        </div>


                     

                        <div class="form-group">

                            <label>القراءة السابقة</label>

                            <input
                                class="input"
                                type="number"
                                step="0.001"
                                placeholder="مثال: 12480"
                                name="previous_reading"
                            >
                             <?php
                                    if(isset($error["previous"]))  echo $error["previous"];
                                 ?>

                        </div>


                        <div class="form-group">

                            <label>القراءة الحالية</label>

                            <input
                                class="input"
                                type="number"
                                step="0.001"
                                placeholder="مثال: 12800"
                                name="current_reading"
                            >
                              <?php
                                    if(isset($error["current"]))  echo $error["current"];
                                 ?>

                        </div>


                        <div class="form-group">

                            <label>ملاحظات</label>

                            <textarea
                                class="input"
                                rows="4"
                                placeholder="ملاحظات اختيارية"
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

                    <h2>تسجيل قراءة الكهرباء</h2>

                    <p>
                        سجّل القراءة الحالية للعداد بعد مطابقتها مع الحساب وتاريخ دورة الفوترة.
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