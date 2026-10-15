
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

                    <h1>الاستهلاك</h1>

                    <p>قراءات العدادات الشهرية</p>

                </div>

                <a class="btn btn-back" href="dashboard.php">
                    ← العودة إلى لوحة التحكم
                </a>

            </div>


            <div class="tools">

     

              

                <a class="btn" href="meter-reading.php">
                    تسجيل قراءة
                </a>

            </div>


            <div class="grid g4">

                <article class="stat">

                    <span>استهلاك الشهر</span>

                    <b>184,300</b>

                    <small>ك.و.س</small>

                </article>


                <article class="stat">

                    <span>متوسط المشترك</span>

                    <b>397</b>

                    <small>ك.و.س</small>

                </article>


                <article class="stat">

                    <span>أعلى استهلاك</span>

                    <b>1,240</b>

                    <small>ك.و.س</small>

                </article>


                <article class="stat">

                    <span>عدادات مقروءة</span>

                    <b>
                     <?php
                       $db=new Database();
              echo $db->SelectRowCount('consumption');
                        ?>
                    </b>

             

                </article>

            </div>


            <section class="card mt">

                <div class="card-title">

                    <h2>قراءات العدادات</h2>

                    <span>
                              <?php
                       $db=new Database();
              echo $db->SelectRowCount('consumption');
                        ?>
                    </span>

                </div>


                <div class="table-wrap">

                    <table>

                        <thead>

                            <tr>

                                <th>رقم الحساب</th>
                                <th>العميل</th>
                                <th>السابقة</th>
                                <th>الحالية</th>
                                <th>تاريخ القراءة</th>

                            </tr>

                        </thead>


                        <tbody>

                            <?php
                        $db=new Database();
                      $Riding=$db->GetConsumptionWithcustomer();
                              
                       foreach($Riding as $row)
                        {
                            if($row["statuse"]==1)
                                {
                            echo "<tr>";

                         echo "<td><span class='badge badge-on'> ".$row["account_number"]." </span></td>";
                            //echo "<td>".$row["account_number"]."</td>";
                          //echo "<td>".$row["consumption_id"]."</td>";
                         echo "<td>".$row["name"]."</td>";
                         echo "<td>".$row["previous_reading"]."</td>";
                         echo "<td>".$row["current_reading"]."</td>";
                         echo "<td>".$row["reading_date"]."</td>";
                            
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