<?php
include_once "header.php";
include_once "classes/clsDateBase.php"; 


if(!isset($_SESSION['user'] ))
    {
     header("location:Login.php");

    }


    $db=new Database();
    $arr=$db->GetTable('customers');
    $cust_type=[];
    $home=(int)0;
    $shop=(int)0;
    $make=(int)0;
    $gov=(int)0;
    $count=0;
      foreach($arr as $s)
               {
                $count++;
                  if($s['customer_type']=="سكني")
                    {
                        $home++;
                     }
                     if($s['customer_type']=="تجاري")
                    {
                        $shop++;
                    }
                    if($s['customer_type']=="صناعي")
                    {
                        $make++;
                     }
                       if($s['customer_type']=="حكومي")
                    {
                        $gov++;
                     }

                }
                $cust_type['home']=intval(($home/$count)*100);
                $cust_type['shop']=intval(($shop/$count)*100);
                $cust_type['make']=intval(($make/$count)*100);
                $cust_type['gov'] =intval(($gov/$count)*100);
                            
?>

<body>




    <main class="page">

        <div class="wrap">

            <div class="page-header">

                <div>

                    <span class="eyebrow">مركز العمليات</span>

                    <h1>لوحة التحكم</h1>

                    <p>نظرة شاملة على أداء المحطة وعمليات التحصيل</p>

                </div>

                <span class="system-state">
                    <i></i> النظام يعمل بكفاءة
                </span>

            </div>


            <div class="grid g4">

                <article class="stat">

                    <span>إجمالي المشتركين</span>

                    <b>
                        <?php
                       $db=new Database();
              echo $db->SelectRowCount('customers');
                        ?>
                    </b>
                    <small>مشتركون</small>

                </article>

               


                <article class="stat">

                    <span> عدد الفواتير </span>

                    <b>
                         <?php
                       $db=new Database();
              echo $db->SelectRowCount('bills');
                        ?>
                    </b>

                    <small>فاتورة مطبوعة</small>

                </article>


                   <article class="stat">

                    <span>إجمالي الموظفون</span>

                    <b>
                        <?php
                       $db=new Database();
              echo $db->SelectRowCount('employees');
                        ?>
                    </b>
                    <small>موظفون</small>

                </article>



                     <article class="stat">
                    <span>رواتب الموظفون</span>
                    <b>
                         <?php
                       $db=new Database();
               $pay=$db->GetTable('employees');
               $rev=0;
               foreach($pay as $row)
                {
                    $rev+=$row['salary'];
                    }
                    echo $rev;
                        ?>
                    </b>

                    <small>ر </small>

                </article>




                <article class="stat">

                    <span>الايرادات</span>

                    
                    <b>
                         <?php
                       $db=new Database();
               $pay=$db->GetTable('payments');
               $rev=0;
               foreach($pay as $row)
                {
                    $rev+=$row['amount'];
                    }
                    echo $rev;



                        ?>
                    </b>

                    <small>ر. محصّلة</small>

                </article>

              


                <article class="stat">

                    <span>المبالغ المتأخرة</span>

                    <b>
                        <?php
                        $db=new Database();
                      $Riding=$db->GetBillsConsumptionWithCustomer();
                      $arrears=0;
                      $bills=0;
                       foreach($Riding as $row)
                        {
                            if($row['remaining_amount']!=0)
                                {
                                    $arrears+=$row['remaining_amount'];
                                    $bills++;
                                }
                        }
                        echo $arrears;
                        echo "<small>$bills  فاتورة</small>";
                       ?>
                    </b>

                

                </article>

            </div>


            <section class="section-head">

                <div>

                    <span class="eyebrow">الوصول السريع</span>

                    <h2>واجهات النظام</h2>

                </div>

                <span>9 أقسام تشغيلية</span>

            </section>


            <div class="gate-grid">

                <a class="gate" href="customers.php">

                    <small>01</small>

                    <b>العملاء</b>

                    <span>إدارة حسابات المشتركين</span>

                    <i>←</i>

                </a>


                <a class="gate" href="employees.php">

                    <small>02</small>

                    <b>الموظفون</b>

                    <span>الكوادر والأقسام</span>

                    <i>←</i>

                </a>


                <a class="gate" href="consumption.php">

                    <small>03</small>

                    <b>الاستهلاك</b>

                    <span>قراءات العدادات</span>

                    <i>←</i>

                </a>


             


                <a class="gate" href="invoices.php">

                    <small>05</small>

                    <b>الفواتير</b>

                    <span>الإصدار والمتابعة</span>

                    <i>←</i>

                </a>


                <a class="gate" href="payments.php">

                    <small>06</small>

                    <b>المدفوعات</b>

                    <span>عمليات السداد</span>

                    <i>←</i>

                </a>






                <a class="gate" href="station.php">

                    <small>09</small>

                    <b>معلومات المحطة</b>

                    <span>الوحدات والجاهزية</span>

                    <i>←</i>

                </a>

                     <a class="gate" href="add_user.php">

                    <small>10</small>

                    <b> معلومات المستخدمين</b>

                    <span> اضافة المستخدمين</span>

                    <i>←</i>

                </a>

            </div>


              <div class="grid g2 mt">

                <section class="card">

                    <div class="card-title">

                        <h2>بيانات المحطة</h2>

                        <span>الملف التعريفي</span>

                    </div>


                    <div class="rows">

                        <div>

                            <span>اسم المحطة</span>

                            <b>  <?php
                    $db=new Database();
                    $arr=$db->GetTable('power_station');
                    foreach($arr as $s)
                        {

                        echo $s['name'];
                    }
                    ?> </b>

                        </div>


                        <div>

                            <span>المدينة</span>

                            <b> <?php
                    $db=new Database();
                    $arr=$db->GetTable('power_station');
                    foreach($arr as $s)
                        {

                        echo $s['location'];
                    }
                    ?></b>

                        </div>
                    </div>

                </section>

            </div>

            <div class="grid g2 mt">

        


                <section class="card">

                    <div class="card-title">

                        <h2>توزيع الاستهلاك</h2>

                        <span>يونيو 2026</span>

                    </div>


                    <div class="rows">

                        <div>

                            <span>سكني</span>

                            <b>
                                <?php
                                echo  $cust_type['home']."%";
                                ?>
                            </b>

                        </div>


                        <div>

                            <span>تجاري</span>

                            <b>   <?php
                                   
                                echo  $cust_type['shop']."%";
                                ?></b>

                        </div>


                        <div>

                            <span>صناعي</span>

                            <b>   <?php
                                echo  $cust_type['make']."%";
                                ?></b>

                        </div>


                        <div>

                            <span>حكومي</span>

                            <b>   <?php
                                echo  $cust_type['gov']."%";
                                ?></b>

                        </div>

                    </div>

                </section>

            </div>


            <section class="card mt">

                <div class="card-title">

                    <h2>أحدث الفواتير</h2>

                   <span> <?php
                       $db=new Database();
              echo $db->SelectRowCount('bills');
                        ?></span>

                </div>


                <div class="table-wrap">

                    <table>

                        <thead>

                            <tr>

                                <th>رقم الفاتورة</th>
                                <th>العميل</th>
                                <th>المبلغ المتبقي</th>
                                <th>الحالة</th>

                            </tr>

                        </thead>


                        <tbody>
                                  <?php
                        $db=new Database();
                      $Riding=$db->GetBillsConsumptionWithCustomer();

                       foreach($Riding as $row)
                        {
                            echo "<tr>";


                         echo "<td><span class='badge badge-on'> ".$row["account_num"]." </span></td>";
                        // echo "<td><span class='badge badge-on'> ".$row["consumption_account"]." </span></td>";
                         echo "<td>".$row["name"]."</td>";
                        // echo "<td>".$row["consumption_value"]."</td>";
                         echo "<td>".$row["remaining_amount"]."</td>";
                        // echo "<td>".$row["period_end"]."</td>";
                         
                           if($row["status"]==0)
                            {
                              echo "<td><span class='badge badge-off'>غير مدفوعة</span> </td>";
                            }
                         elseif($row["status"]==1)
                         {
                                echo "<td><span class='badge badge-on'>مدفوعة</span> </td>";
                         }
                      
                    
                            
                            echo "</tr>";
                            }
                        ?>


                        </tbody>

                    </table>

                </div>

            </section>

        </div>

    </main>

<?php
include_once "footer.php";

?>
   

</body>

</html>

