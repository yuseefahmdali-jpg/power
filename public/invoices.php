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

                    <h1>الفواتير</h1>

                    <p>إصدار ومتابعة فواتير المشتركين</p>

                </div>

                <a class="btn btn-back" href="dashboard.php">
                    ← العودة إلى لوحة التحكم
                </a>

            </div>


            <div class="tools">

        

                <a class="btn" href="issue-invoice.php">
                    إصدار فاتورة
                </a>

            </div>


            <div class="grid g4">

                <article class="stat">

                    <span>إجمالي الفواتير</span>

                     <b>
                         <?php
                       $db=new Database();
              echo $db->SelectRowCount('bills');
                        ?>
                    </b>

                    <small>كل الفترات</small>

                </article>


                <article class="stat">

                    <span>مدفوعة</span>

                     <b>
                         <?php
                       $db=new Database();
              $finsh=$db->GetTable('bills');
              $count=0;
               foreach($finsh as $row)
                {
                    if($row['status']==1)
                        {
                            $count++;
                        }
                }
                echo $count;
               
                        ?>
                    </b>


                </article>


                <article class="stat">

                    <span> غير مدفوعة</span>

                       <b>
                         <?php
                       $db=new Database();
              $finsh=$db->GetTable('bills');
              $count=0;
               foreach($finsh as $row)
                {
                    if($row['status']==0)
                        {
                            $count++;
                        }
                }
                echo $count;
               
                        ?>
                    </b>

                   

                </article>


              

            </div>


            <section class="card mt">

                <div class="card-title">

                    <h2>سجل الفواتير</h2>

                    <span><?php
                       $db=new Database();
              echo $db->SelectRowCount('bills');
                        ?></span>

                </div>


                <div class="table-wrap">

                    <table>

                        <thead>

                            <tr>

                                <th>رقم الفاتورة</th>
                                <th>رقم القراءة</th>
                                <th>اسم العميل</th>
                                <th>  الاستهلاك باكيلو</th>
                                <th>اجمالي الفاتورة</th>
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
                         echo "<td>".$row["consumption_value"]."</td>";
                                     echo "<td>".$row["amount"]."</td>";
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