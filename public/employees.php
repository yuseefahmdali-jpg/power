
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

                    <h1>الموظفون</h1>

                    <p>كوادر المحطة والأقسام</p>

                </div>

                <a class="btn btn-back" href="dashboard.php">
                    ← العودة إلى لوحة التحكم
                </a>

            </div>


            <div class="tools">

    

                <a class="btn" href="add-employee.php">
                    إضافة موظف
                </a>

            </div>


            <div class="grid g4">

                <article class="stat">

                    <span>عدد الموظفين</span>

                    <b> <?php
                       $db=new Database();
              echo $db->SelectRowCount('employees');
                        ?></b>

                    <small>جميع الأقسام</small>

                </article>






            </div>


            <section class="card mt">

                <div class="card-title">

                    <h2>قائمة الموظفين</h2>

                    <span>4 سجلات ظاهرة</span>

                </div>


                <div class="table-wrap">

                    <table>

                        <thead>

                            <tr>

                                <th>الرقم</th>
                                <th>الاسم</th>
                                <th>العنوان</th>
                                <th>المسمى</th>
                                <th>الهاتف</th>
                                <th>الراتب</th>
                                <th>تاريخ التسجيل</th>

                            </tr>

                        </thead>


                        <tbody>

                                                       <?php
                        $db=new Database();
                      $custmr=$db->GetTable("employees");
                       foreach($custmr as $row)
                        {
                            echo "<tr>";

                            echo "<td><span class='badge badge-on'> ".$row["account_emp"]." </span></td>";
                            //echo "<td>""</td>";
                           echo "<td>".$row["name"]."</td>";
                           echo"<td>".$row["address"]."</td>";
                          echo "<td>".$row["job_type"]."</td>";
                         echo "<td>".$row["phone"]."</td>";
                         echo "<td>".$row["salary"]."</td>";
                         echo "<td>".$row["created_at"]."</td>";
                            
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