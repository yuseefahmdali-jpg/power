<?php

include_once "header.php";
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
             if($imgesize>1000000)
             {
                $error['imge']="<span style='color:red;'>   حجم الصورة كبير جداً </span>";   
             }
              if(!$Valid->clsRequired($nameimge))
             {
                $error['imge']="<span style='color:red;'>الصوره مطلوبة</span>";
             }



            if(empty($error)){
                $imgepath='C:\xampp\htdocs\myproject\level-power-manager-main\public\image\\'.$nameimge;
             move_uploaded_file($tempimge,$imgepath);

           // $db->UpdataUser($name,$usernm,$pass,$phon,$date,$imgepath);
              $db->UpdataUser($_SESSION['Id'],$name,$usernm,$pass,$phon,$date,$imgepath);
            header("location:UpdataUser.php");
                
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
                    <span class="eyebrow">اعدادات المستخدم</span>
                    <h1>
                        <?php 
                        echo 'مرحباً بك '.$_SESSION['name'].' ';
                        ?>
                    </h1>
                    <p>تعديل حساب مستخدم  </p>
                </div>
                <a class="btn btn-back" href="Logout.php">تسجيل الخروج</a>

            </div>

            <div class="form-layout">
                
                <!-- نموذج إضافة المستخدم -->
                <form class="card form-card" method="POST" action="UpdataUser.php" enctype="multipart/form-data">
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
                            <label>  تحميل الصوره</label>
                            <input name="Uplood"  type="file"  placeholder="اختر صوره" class="input">
                          <?php
                                    if(isset($error["imge"]))  echo $error["imge"];
                                    ?>
                        </div>
                                
                              

                    </div>

                    <!-- أزرار الحفظ والإلغاء -->
                     <div class="form-actions">

                        <button class="btn" type="submit">
                            حفظ البيانات
                        </button>

                        <a class="btn btn-line" href="dashboard.php">
                            إلغاء
                        </a>


                    </div>
                </form>
                


            </div>
        </div>
    </main>

    
<?php
include_once "footer.php";

?>
   

</body>
</html>