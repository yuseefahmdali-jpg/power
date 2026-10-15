
<?php
include_once "header.php";
include_once "classes/clsDateBase.php";

 $db=new Database();
if(isset($_GET["customer_id"],$_GET["action"]))
    {
        if($_GET["action"]=="act")
            {
                $id=$_GET["customer_id"];
               // $db->UpdateStatus(0,$id);   
                if($db->UpdateStatus(1,$id)) 
                    {
                        echo "<h3>One Row Update</h3>";
                    }        
            }
             if($_GET["action"]=="enact")
            {
               $id=$_GET["customer_id"];
                //$db->UpdateStatus(1,$id); 
                  if($db->UpdateStatus(0,$id)) 
                    {
                        echo "<h3>One Row Update</h3>";
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

                    <h1>العملاء</h1>

                    <p>سجل المشتركين والحسابات</p>

                </div>

                <a class="btn btn-back" href="dashboard.php">
                    ← العودة إلى لوحة التحكم
                </a>

            </div>


            <div class="tools">

  



                <a class="btn" href="add-customer.php">
                    إضافة عميل
                </a>

            </div>


            <div class="grid g4">

                <article class="stat">

                    <span>إجمالي العملاء</span>

                    <b>
                        <?php
                        $db=new Database();
                        echo $db->SelectRowCount('customers');
                   
                        ?>
                        </b>

                    <small>كل الحسابات</small>

                </article>




            </div>


            <section class="card mt">

                <div class="card-title">

                    <h2>قائمة العملاء</h2>

                    <span> <?php
                        $db=new Database();
                        echo $db->SelectRowCount('customers');
                   
                        ?> سجلات ظاهرة</span>

                </div>


                <div class="table-wrap">

                    <table>

                        <thead>

                            <tr>

                                <th>رقم الحساب</th>
                                <th>الاسم</th>
                                <th>العنوان</th>
                                <th>النوع</th>
                                <th>تاريخ التسجيل</th>
                                <th>الهاتف</th>
                                <th>العنوان الاضافي</th>
                                <th> الحالة</th>

                            </tr>

                        </thead>


                        <tbody>

                       
                     
                       
                    
   

                               <?php
                         
                        $db=new Database();
                      $custmr=$db->GetTable("customers");
                       foreach($custmr as $row)
                        {
                            echo "<tr>";

                            echo "<td><span class='badge badge-on'> ".$row["account_number"]." </span></td>";
                            //echo "<td>".$row["account_number"]."</td>";
                        echo "<td>".$row["name"]."</td>";
                        echo"<td>".$row["address"]."</td>";
                        echo "<td>".$row["customer_type"]."</td>";
                        echo "<td>".$row["created_at"]."</td>";
                        echo "<td>".$row["Phone"]."</td>";
                        echo "<td>".$row["Address_details"]."</td>";
                        
                        if($row["statuse"]==1)
                        {
                            echo "<td><a href=?customer_id=".$row["customer_id"]."&action=enact style='background:#f57c00; color:white;' class='btn'>الغاء التفعيل</a></td>";
                        }
                        elseif($row["statuse"]==0)
                            {
                                echo "<td><a href=?customer_id=".$row["customer_id"]."&action=act style='background:#1B3A73; color:white;' class='btn'>تفعيل</a></td>";
                            }
                       // echo "<td>".$row["statuse"]."</td>";
                            
                            echo "</tr>";
                            }
                        ?>


                           <!-- <tr>

                                <td>AC-2198</td>
                                <td>سارة العتيبي</td>
                                <td>تجاري</td>
                                <td>جدة</td>
                                <td>0559876543</td>

                                <td>
                                    <span class="badge badge-on">نشط</span>
                                </td>

                            </tr>-->


          



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