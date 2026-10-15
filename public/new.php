

<?php
$servername = "localhost";
$username = "root";  
$password = "";      
$dbname = "university_db";

// إنشاء الاتصال
$conn = new mysqli($servername, $username, $password, $dbname);

// التحقق من الاتصال
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}

echo "تم الاتصال بقاعدة البيانات بنجاح!";

// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "", "university_db");

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
 




if (isset($_POST['search']) && !empty($_POST['search_term'])) {
    $term = $_POST['search_term'];
    $sql_select = "SELECT * FROM students WHERE name LIKE '%$term%'";
} else {
    $sql_select = "SELECT * FROM students";
}

$result = $conn->query($sql_select);


 
        
        if ($result && $result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</br>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['degree'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='4'>لا توجد بيانات</td></tr>";
        }
        ?>
    
