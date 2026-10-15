<?php

include_once "header.php";
   if(!Haspermission(enPermissions::AddUsers))
    {        
      header("location:noopermission.php");        
    }

include_once "classes/clsValidation.php";
include_once "classes/clsDateBase.php";

    $db=new Database();
   $Valid=new Validation();



    if($_SERVER['REQUEST_METHOD']=='POST')
        {
            $name=$_POST["name"];
            $usernm=$_POST["username"];
            $pass=$_POST["pass"];
            $phon=$_POST["phone"];
            $date=$_POST["date"];
            $typeemp=$_POST["typeemp"];
            $error=[];

            $imge=$_FILES["Uplood"];

            $tempimge=$_FILES['Uplood']['tmp_name'];
            $nameimge=$_FILES['Uplood']['name'];
            $imgesize=$_FILES['Uplood']['size'];

            $surseimge=array('jpg','gif','jpeg','png');
           
            $imgestion=explode('.',$nameimge);
            $imge_extenstion=strtolower(end($imgestion));

            if(!in_array($imge_extenstion,$surseimge))
                {
                 $error['imge']="<span style='color:red;'>خطاء في الصوره </span>";

                }

             if(!$Valid->clsRequired($name))
             {
                $error['name']="<span style='color:red;'>الاسم مطلوب </span>";
             }
              if(!$Valid->clsRequired($usernm))
             {
                $error['usernm']="<span style='color:red;'> اسم المستخدم مطلوب </span>";
             }
              if(!$Valid->clsRequired($pass))
             {
                $error['pass']="<span style='color:red;'>يلزم كلمة مرور</span>";
             }
                   if(!$Valid->clsRequired($phon))
             {
                $error['phon']="<span style='color:red;'> رقم الهاتف مطلوب </span>";   
             }
                if(!$Valid->clsRequired($date))
             {
                $error['date']="<span style='color:red;'> خطاء في تاريخ الميلاد</span>";   
             }
             if($imgesize>100000)
             {
                $error['imge']="<span style='color:red;'>   حجم الصورة كبير جداً </span>";   
             }
              if(!$Valid->clsRequired($nameimge))
             {
                $error['imge']="<span style='color:red;'>الصوره مطلوبة</span>";
             }

            $permission=0;

                 if(isset($_POST['AddUsers']))
                {
                    $permission+=enPermissions::AddUsers->value;
                }
                 if(isset($_POST['AddCustomers']))
                {
                    $permission+=enPermissions::AddCustomers->value;
                }
                 if(isset($_POST['AddEmployees']))
                {
                    $permission+=enPermissions::AddEmployees->value;
                }
                 if(isset($_POST['AddReadings']))
                {
                    $permission+=enPermissions::AddReadings->value;
                }
                 if(isset($_POST['AddBills']))
                {
                    $permission+=enPermissions::AddBills->value;
                }
                   if(isset($_POST['PayBills']))
                {
                    $permission+=enPermissions::PayBills->value;
                }
                if($permission==63||$typeemp=="اداري")
                    {
                        $permission=enPermissions::enAll->value;;
                    }
                if(!$Valid->clsRequired($permission))
             {
                $error['permission']="<span style='color:red;'> لازم اختيار صلاحيات</span>";   
             }

            if(empty($error)){
                $imgepath='C:\xampp\htdocs\myproject\level-power-manager-main\public\image\\'.$nameimge;
             move_uploaded_file($tempimge,$imgepath);

            $db->AddUser($name,$usernm,$pass,$phon,$date,$imgepath,$typeemp,$permission);
            //  AddUser($Name,$username,$pass,$phone,$date,$fill,$type,$permission)
            header("location:add_user.php");
                
             }
             else{
                echo '<br><div class="wrap">خطاء في المدخلات </div>';
             }        
             
        }




     
?>

<body>

    <main class="page">
        <div class="wrap">
            
            <!-- ترويسة الصفحة -->
            <div class="page-header">
                <div>
                    <span class="eyebrow">إدارة النظام</span>
                    <h1>إضافة مستخدم</h1>
                    <p>إنشاء حساب مستخدم جديد وتعيين الصلاحيات</p>
                </div>
                <a class="btn btn-back" href="dashboard.php">
                    ← العودة إلى لوحة التحكم
                </a>
            </div>

            <div class="form-layout">
                
                <!-- نموذج إضافة المستخدم -->
                <form class="card form-card" method="POST" action="add_user.php" enctype="multipart/form-data">
                    <div class="card-title">
                        <h2>البيانات الأساسية</h2>
                        <span>جميع الحقول مطلوبة</span>
                    </div>

                    <div class="form-grid">
                        
                        <!-- حقل الاسم -->
                        <div class="form-group">
                            <label>الاسم الكامل</label>
                            <input name="name" class="input" type="text"  placeholder="الاسم الرباعي">
                                     <?php
                                    if(isset($error["name"]))  echo $error["name"];
                                    ?>
                        </div>
                        
                        <!-- حقل اسم المستخدم -->
                        <div class="form-group">
                            <label>اسم المستخدم (لتسجيل الدخول)</label>
                            <input name="username" class="input" type="text" placeholder="مثال: ahmed_99">
                               <?php
                                    if(isset($error["usernm"]))  echo $error["usernm"];
                                    ?>
                        </div>

                        <!-- حقل كلمة المرور -->
                        <div class="form-group">
                            <label>كلمة المرور</label>
                            <input name="pass" class="input" type="password" placeholder="كلمة المرور">
                          <?php
                                    if(isset($error["pass"]))  echo $error["pass"];
                                    ?>
                        </div>

                        <!-- حقل رقم الهاتف -->
                        <div class="form-group">
                            <label>رقم الهاتف</label>
                            <input name="phone" class="input" type="text" placeholder="00967000000000">
                              <?php
                                    if(isset($error["phon"]))  echo $error["phon"];
                                    ?>
                        </div>



                         <div class="form-group">
                            <label> تاريخ الميلاد</label>
                            <input name="date" class="input" type="date" placeholder="">
                            <?php
                                    if(isset($error["date"]))  echo $error["date"];
                                    ?>
                        </div>
                                
                                               
                        
                        <div class="form-group">

                            <label> نوع المستخدم</label>

                            <select class="input" name="typeemp">

                                <option>اداري </option>
                                <option>موظف</option>

                            </select>
                   

                        </div>

                          
                        
                        <div class="form-group">
                            <label>  تحميل الصوره</label>
                            <input name="Uplood"  type="file"  placeholder="اختر صوره" class="input">
                          <?php
                                    if(isset($error["imge"]))  echo $error["imge"];
                                    ?>
                        </div>
                                
                              
                        <!-- قسم الصلاحيات -->
                        <div class="form-group" style="grid-column: 1 / -1; margin-top: 10px;">
                            <label>صلاحيات المستخدم</label>
                            
                            
                            
                            <div class="tools" style="padding: 16px; border: 1px solid var(--line); border-radius: var(--radius); background: var(--surface);">
                            
                                <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--navy); font-weight: 600; cursor: pointer; margin-left: 15px;">
                                    <input type="checkbox" name="AddUsers" > إضافة مستخدم
                                </label>

                                <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--navy); font-weight: 600; cursor: pointer; margin-left: 15px;">
                                    <input type="checkbox" name="AddCustomers" > إضافة عملاء
                                </label>

                                <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--navy); font-weight: 600; cursor: pointer; margin-left: 15px;">
                                    <input type="checkbox" name="AddEmployees" > إضافة موظفين
                                </label>

                                <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--navy); font-weight: 600; cursor: pointer; margin-left: 15px;">
                                    <input type="checkbox" name="AddReadings" > تسجيل قراءات
                                </label>

                                <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--navy); font-weight: 600; cursor: pointer; margin-left: 15px;">
                                    <input type="checkbox" name="AddBills" > إصدار فواتير
                                </label>

                                <label style="display: flex; align-items: center; gap: 8px; font-size: 13px; color: var(--navy); font-weight: 600; cursor: pointer;">
                                    <input type="checkbox" name="PayBills" > تسديد فواتير
                                </label>

                                  <?php
                                    if(isset($error["permission"]))  echo "<br>". $error["permission"];
                                    ?>
                            </div>
                        </div>

                    </div>

                    <!-- أزرار الحفظ والإلغاء -->
                     <div class="form-actions">

                        <button class="btn" type="submit">
                            حفظ البيانات
                        </button>

                        <a class="btn btn-line" href="dashboard.html">
                            إلغاء
                        </a>

                    </div>
                </form>
                       <div class="table-wrap">

                    <table>

                        <thead>

                            <tr>

                                <th>user name</th>
                                <th>الاسم</th>
                                <th>نوع المستخدم</th>
                                <th>الرقم الهاتف</th>
                                <th>الصلاحيات</th>
                               
                            </tr>

                        </thead>


                        <tbody>

                                                       <?php
                        $db=new Database();
                      $custmr=$db->GetTable("user");
                       foreach($custmr as $row)
                        {
                            echo "<tr>";

                            echo "<td><span class='badge badge-on'> ".$row["username"]." </span></td>";
                            //echo "<td>""</td>";
                           echo "<td>".$row["Name"]."</td>";
                           echo"<td>".$row["profileImge"]."</td>";
                          echo "<td>".$row["phone"]."</td>";
                          echo "<td>".$row["permission"]."</td>";
                            
                            echo "</tr>";
                            }
                        ?>
          


                        </tbody>

                    </table>

                </div>

                <!-- القائمة الجانبية التوضيحية -->
                <aside class="card form-aside">
                    <span class="aside-kicker">ملخص الإجراء</span>
                    <h2>إضافة مستخدم</h2>
                    <p>أنشئ حساباً لمستخدم جديد في النظام وقم بتحديد الصلاحيات الخاصة به لتنظيم سير العمل بأمان.</p>

                    <div class="check-list">
                        <span>إعداد حساب الدخول</span>
                        <span>تخصيص صلاحيات محددة</span>
                        <span>إمكانية التعديل لاحقاً</span>
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