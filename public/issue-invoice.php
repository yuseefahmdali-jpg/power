<?php
include_once "header.php";
  if(!Haspermission(enPermissions::AddBills))
    {        
      header("location:noopermission.php");        
    }
include_once "classes/clsValidation.php";
include_once "classes/clsDateBase.php";

    $db=new Database();
    $Valid=new Validation();

    if($_SERVER['REQUEST_METHOD']=='POST'){
        $error=[];
        $consumptionid=$_POST['consumptionid'];
      //  echo $consumptionid;
          if(!$Valid->clsRequiredId($consumptionid))
             {
                $error['consumptionid']="<span style='color:red;'>اسم العميل مطلوب </span>";
             }else
             {

                 $arry_cons=$db->GetRow('consumption',$consumptionid);
                 $amont=$arry_cons['consumption_value'];
                 $customerid=$arry_cons['customer_id'];

                   
                      $elect=$db->GetTable("electricity_rates");
                      $custType=$db->GetRowCustmer($customerid);
                       foreach($elect as $row)
                        {
                            if($custType['customer_type']==$row['customer_type'])
                                {
                                   $amont*=$row['price_per_kwh'];
                                }
                        }


                // $paidamount=$_POST['amount'];
                $remainingamount=$amont;
                // $stetus=$_POST['staus'];

                 
                 $periodend=$arry_cons['reading_date'];
                 $periodstart=date('y-m-d',strtotime('-1 month'));
            if($amont<=0)
             {
                $error['amont']="<span style='color:red;'>القيمة اقل من الصفر </span>";
             }
                if(empty($error)){
//               AddInvoice($customerid,$consumptionid,$amont,$paidamount,$remainingamount,$stetus,$periodstart,$periodend):void

            $db->AddInvoice($customerid,$consumptionid,$amont,'0',$remainingamount,'0',$periodstart,$periodend);
            header("location:invoices.php");
             
             }
             else{
                echo '<br><div class="wrap">خطاء في المدخلات </div>';
             }
             }
          
     
    }
?>
<body>




    <main class="page">

        <div class="wrap">

            <div class="page-header">

                <div>

                    <span class="eyebrow">مركز العمليات</span>

                    <h1>إصدار فاتورة</h1>

                    <p>إنشاء فاتورة استهلاك جديدة</p>

                </div>

                <a class="btn btn-back" href="dashboard.php">
                    ← العودة إلى لوحة التحكم
                </a>

            </div>


            <div class="form-layout">

                <form class="card form-card" method="POST" action="issue-invoice.php">

                    <div class="card-title">

                        <h2>البيانات الأساسية</h2>

                        <span>جميع الحقول مطلوبة</span>

                    </div>


                    <div class="form-grid">

                        <div class="form-group">

                            <label>العميل</label>

                            <select class="input" name="consumptionid">

                                <option>اختر العميل</option>
                                                   <?php
                        $db=new Database();
                      $Riding=$db->GetConsumptionWithcustomer();
                              
                       foreach($Riding as $row)
                        {

                            $c_Id=$row["statuss"];
                            if($c_Id==0)
                            {
                            echo "<option value=".$row["consumption_id"].">";

                            echo $row["account_number"]." - ".$row["name"]." - ".$row["consumption_value"];
                            echo "</option>";
                            }   

                            
                        }
                            
                        ?>

                            </select>
                              <?php
                                 if(isset($error["consumptionid"]))  echo $error["consumptionid"];
                                 ?>

                        </div>


                        <!--
                        <div class="form-group">

                            <label> المبلغ المقدم</label>

                            <input
                                class="input"
                                type="number"
                                placeholder="ر.ي"
                                value="0"
                                name="amount"
                                step="any"
                            >
                           

                        </div>-->

                        <!--
                        <div class="form-group">

                            <label>حالة الفاتوره</label>

                            <select class="input" name="staus">

                                <option value="0"> غير مدفوعة</option>
                                <option value="1"> دفع جزء</option>
                              <option value="2">مدفوعة</option>
                               
                            </select>

                        </div>-->


        



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

                    <h2>إصدار فاتورة</h2>

                    <p>
                        راجع الاستهلاك والتعرفة ورسوم الخدمة قبل اعتماد الفاتورة للمشترك.
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