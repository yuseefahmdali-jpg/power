<?php
include_once "header.php";
  if(!Haspermission(enPermissions::PayBills))
    {        
      header("location:noopermission.php");        
    }
include_once "classes/clsDateBase.php";
include_once "classes/clsValidation.php";

       $db=new Database();
        $Valid=new Validation();
        if($_SERVER['REQUEST_METHOD']=='POST')
        {
             $error=[];
             $BilId=$_POST["BillId"];
        
                if(!$Valid->clsRequiredId($BilId))
                    {
                $error['BilId']="<span style='color:red;'>اسم العميل مطلوب </span>";
                
                    }
                    else
                    {
                        $Riding=$db->GetRowBiil($BilId);
                       
                        $custmrid=$Riding["customer_id"];
                        $amont=$_POST["amount"];
                        $mthod=$_POST["method"];
                            if($amont<0)
                            {
                                $error['amont']="<span style='color:red;'>القيمة اقل من الصفر </span>";
                            }
                          

                            if(empty($mthod))
                              {
                              $error['mthod']="<span style='color:red;'>  اختر طريقة دفع  </span>";
                              }
                                       
                                              

                          $paidAmount=$Riding["paid_amount"];
                          $RemainingAmount=$Riding["remaining_amount"];
                          $paidAmount+=(float)$amont;
                          $RemainingAmount-=(float)$amont;
                          $statu=($RemainingAmount==0)? 1:0;

                         
                              
                            
           
                    }
                         if(empty($error))
                        {
                            $db->AddPayment($BilId,$custmrid,$amont,$mthod,$paidAmount,$RemainingAmount,$statu);
                            header("location:payments.php");
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

                    <h1>تسجيل دفعة</h1>

                    <p>توثيق عملية سداد جديدة</p>

                </div>

                <a class="btn btn-back" href="dashboard.php">
                    ← العودة إلى لوحة التحكم
                </a>

            </div>


            <div class="form-layout">

                <form class="card form-card" method="POST" action="record-payment.php" >

                    <div class="card-title">

                        <h2>البيانات الأساسية</h2>

                        <span>جميع الحقول مطلوبة</span>

                    </div>


                    <div class="form-grid">

                        <div class="form-group">

                            <label>رقم الفاتورة</label>

                            <select class="input" name="BillId">
                                <option value="0">اختر فاتورة</option>
                            <?php
                        $db=new Database();
                      $Riding=$db->GetBillsConsumptionWithCustomer();

                       foreach($Riding as $row)
                        {
                            if($row['status']==0&&$row['statuse']==1){

                            
                             
                            echo "<option value=".$row["bill_id"].">";
                         echo $row["account_num"]." - ";
                        // echo $row["consumption_account"];
                         echo $row["name"]." - ";
                         echo $row["remaining_amount"];
                
                            echo "</option>";
                            }
                            
                        }
                        ?>

                                

                            </select>
                             <?php
                                 if(isset($error["BilId"]))  echo $error["BilId"];
                                 ?>

                        </div>




                        <div class="form-group">

                            <label>المبلغ المدفوع</label>

                            <input
                                class="input"
                                type="number"
                                placeholder="ر.س"
                                name="amount"
                                value="0"
                                step="any"
                            >
                             <?php
                             if(isset($error["amont"]))  echo $error["amont"];
                             ?>

                        </div>


                        <div class="form-group">

                            <label>طريقة الدفع</label>

                            <select class="input" name="method">

                                <option>نقدًا</option>
                                <option>تحويل بنكي</option>
                                <option>بطاقة</option>

                            </select>
                             <?php
                                 if(isset($error["mthod"]))  echo $error["mthod"];
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

                    <h2>تسجيل دفعة</h2>

                    <p>
                        وثّق المبلغ وطريقة السداد واربط العملية بالفاتورة الصحيحة.
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