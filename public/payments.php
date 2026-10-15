<?php
include_once "header.php";
include_once "classes/clsDateBase.php";

?>

<body>




    <main class="page">

        <div class="wrap">

            <div class="page-header">

                <div>

                    <span class="eyebrow">مركز العمليات</span>

                    <h1>المدفوعات</h1>

                    <p>سجل عمليات السداد والتحصيل</p>

                </div>

                <a class="btn btn-back" href="dashboard.php">
                    ← العودة إلى لوحة التحكم
                </a>

            </div>


            <div class="tools">


            

                <a class="btn" href="record-payment.php">
                    تسجيل دفعة
                </a>

            </div>


            <div class="grid g4">

                <article class="stat">

                    <span>إجمالي المدفوعات</span>

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

                    <small><?php
                       $db=new Database();
              echo " عمليات التسديد ". $db->SelectRowCount('payments');
                        ?></small>

                </article>





                <article class="stat">

                    <span>المبالغ المتبقية</span>

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

                    <small>قيد التحصيل</small>

                </article>

            </div>


            <section class="card mt">

                <div class="card-title">

                    <h2>سجل المدفوعات</h2>

                    

                </div>


                <div class="table-wrap">

                    <table>

                        <thead>

                            <tr>

                                <th>رقم الفاتورة</th>
                                <th>رقم العملية</th>
                                <th>العميل</th>
                                <th>المبلغ المتبقي</th>
                                <th>التاريخ</th>
                                <th>الحالة</th>

                            </tr>

                        </thead>


                        <tbody>

                                           <?php
                        $db=new Database();
                      $Riding=$db->GetBillsConsumptionWithCustomer();

                       foreach($Riding as $row)
                        {
                             if($row["statuse"]==1)
                            {
                            echo "<tr>";
                         echo "<td><span class='badge badge-on'> ".$row["account_num"]." </span></td>";
                         echo "<td><span class='badge badge-on'> ".$row["consumption_account"]." </span></td>";
                         echo "<td>".$row["name"]."</td>";
                        // echo "<td>".$row["consumption_value"]."</td>";
                         echo "<td>".$row["remaining_amount"]."</td>";
                         echo "<td>".$row["period_end"]."</td>";
                         
                           if($row["status"]==0)
                            {
                              echo "<td><span class='badge badge-off'>غير مدفوعة</span> </td>";
                            }
                         elseif($row["status"]==1)
                         {
                                echo "<td><span class='badge badge-on'>مدفوعة</span> </td>";
                         }
                     
                    
                            



/*
                        if($row["status"]==2)
                        {
                            echo "<td><a href=?bill_id=".$row["bill_id"]."&action=del style='background:#1b7322; color:white;' class='btn'> هل تريد الحذف</a></td>";
                        }*/




                            echo "</tr>";
                            }
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