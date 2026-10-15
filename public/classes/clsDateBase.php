<?php
class Database
{
  private $conn="mysql:host=localhost;dbname=power_manager";
  private $user="root";
   private $pass="";
   private $pdo;
   
   
   public function __construct()
   {

      $this->pdo=new PDO($this->conn,$this->user,$this->pass); 
   }

   public function TestConnection():bool
   {
    return $this->pdo !==null;
   }


   public function AddCustomer( $name, $addres, $customer, $phon, $add_details):void
   {
          $ss="SELECT * FROM customers";
          $q=$this->pdo->prepare($ss);
          $q->execute();
          $account="CU-".$q->rowcount()+1;

       $sql="INSERT INTO `customers`( `account_number`, `name`, `address`, `customer_type`,  `Phone`, `Address_details`,`statuse`)
                VALUES ('$account','$name','$addres','$customer','$phon','$add_details','1')";
            $reselt=$this->pdo->prepare($sql);
            $reselt->execute();

   }


     public function AddEmploy($name,$addres,$jobe,$phon,$salary):void
   {
          $ss="SELECT * FROM employees";
          $q=$this->pdo->prepare($ss);
          $q->execute();
          $account="EM-".$q->rowcount()+1;

       $sql="INSERT INTO `employees`(`account_emp`, `name`, `address`, `job_type`, `phone`, `salary`)
                VALUES ('$account','$name','$addres','$jobe','$phon','$salary')";
            $reselt=$this->pdo->prepare($sql);
            $reselt->execute();

   }


       public function AddConsumption($custmr_id,$previous_read,$current_read):void
   {
          $ss="SELECT * FROM consumption";
          $q=$this->pdo->prepare($ss);
          $q->execute();
          $account="CN-".$q->rowcount()+1;

          $consum_value=$current_read-$previous_read;
          $sql="INSERT INTO `consumption`( `account_number`, `customer_id`, `previous_reading`, `current_reading`, `consumption_value`,`statuss`)
           VALUES ('$account','$custmr_id','$previous_read','$current_read','$consum_value','0')";
            $reselt=$this->pdo->prepare($sql);
            $reselt->execute();

   }


     public function SelectRowCount($Value):int
   {
          $ss="SELECT * FROM $Value";
          $q=$this->pdo->prepare($ss);
          $q->execute();
        return $q->rowcount();
   }


       public function GetTable($Value):array
   {
          $ss="SELECT * FROM $Value";
          $q=$this->pdo->prepare($ss);
          $q->execute();
        
        return $q->fetchall(PDO::FETCH_ASSOC);
   }

          public function GetRow($Table,$Value):array
   {
          $ss="SELECT * FROM $Table WHERE consumption_id=$Value ";
          $q=$this->pdo->prepare($ss);
          $q->execute();
        
        return $q->fetch(PDO::FETCH_ASSOC);
   }


            public function GetRowBiil($Value):array
   {
          $ss="SELECT * FROM bills WHERE bill_id=$Value";
          $q=$this->pdo->prepare($ss);
          $q->execute();
        
        return $q->fetch(PDO::FETCH_ASSOC);
   }

         public function GetConsumptionWithcustomer():array
   {
          $ss="SELECT
    consumption.consumption_id,
    consumption.account_number,
    consumption.customer_id,
    customers.name,
    customers.statuse,
    consumption.previous_reading,
    consumption.current_reading,
    consumption.consumption_value,
    consumption.statuss,
    consumption.reading_date
FROM consumption
INNER JOIN customers
    ON consumption.customer_id = customers.customer_id;";
          $q=$this->pdo->prepare($ss);
          $q->execute();
        
        return $q->fetchall(PDO::FETCH_ASSOC);
   }

          public function AddInvoice($customerid,$consumptionid,$amont,$paidamount,$remainingamount,$stetus,$periodstart,$periodend):void
   {
          $ss="SELECT * FROM bills";
          $q=$this->pdo->prepare($ss);
          $q->execute();
          $account="BI-".$q->rowcount()+1;

          $consum_value="INSERT INTO `bills`( `account_num`, `customer_id`, `consumption_id`, `amount`, `paid_amount`, `remaining_amount`, `status`,  `period_start`, `period_end`) 
          VALUES ('$account','$customerid','$consumptionid','$amont','$paidamount','$remainingamount','$stetus','$periodstart','$periodend')";
            $reselt=$this->pdo->prepare($consum_value);
            $reselt->execute();

            $Upd="UPDATE `consumption` SET `statuss`= '1' WHERE `consumption_id`=$consumptionid";
            $up=$this->pdo->prepare($Upd);
            $up->execute();
   }


            public function GetBillsConsumptionWithCustomer():array
   {
          $ss="SELECT
    bills.*,
    bill_id,
    customers.account_number AS customer_account,
    customers.name,
    customers.statuse,
    consumption.account_number AS consumption_account,
    consumption.current_reading,
    consumption.consumption_value,
    consumption.reading_date
FROM bills
INNER JOIN customers
    ON bills.customer_id = customers.customer_id
INNER JOIN consumption
    ON bills.consumption_id = consumption.consumption_id;";
          $q=$this->pdo->prepare($ss);
          $q->execute();
        
        return $q->fetchall(PDO::FETCH_ASSOC);
   }


         public function UpdateStatus($stat,$id):int
   {
        $sql="UPDATE `customers` SET `statuse`=$stat WHERE customer_id='$id'";
            $reselt=$this->pdo->prepare($sql);
            $reselt->execute();
            return $reselt->rowcount();

   }

           public function AddPayment($BillId,$CustomerId,$amont,$Method,$paidAmount,$RemainingAmount,$statu):void
   {
       
          $sql2="INSERT INTO `payments`( `bill_id`, `customer_id`, `amount`, `method`)
           VALUES ('$BillId','$CustomerId','$amont','$Method')";
            $reselt=$this->pdo->prepare($sql2);
            $reselt->execute();

            $sql="UPDATE `bills` SET `paid_amount`='$paidAmount',`remaining_amount`='$RemainingAmount',`status`='$statu'
             WHERE bill_id='$BillId'";
          $q=$this->pdo->prepare($sql);
          $q->execute();
         

   }

   public function Encrypting($pass)
   {
       //$pass=password_hash($pass,PASSWORD_DEFAULT);
       $reselt="";
       for($i=0;$i<strlen($pass);$i++)
              {
                     $reselt.=chr(ord($pass[$i])+3);
              }
              return $reselt;
   }

          public function AddUser($Name,$username,$pass,$phone,$date,$fill,$type,$permission):void
   {
       $EncPass=$this->Encrypting($pass);
          $sql="INSERT INTO `user`( `Name`, `username`, `pass`, `phone`, `data`, `typing_user`, `profileImge`, `permission`) 
          VALUES ('$Name','$username','$EncPass','$phone','$date','$fill','$type','$permission')";
            $reselt=$this->pdo->prepare($sql);
            $reselt->execute();

   }

   public function UpdataUser($ID,$Name,$username,$pass,$phone,$date,$fill)
   {
       $EncPass=$this->Encrypting($pass);
       $sql="UPDATE `user` SET `Name`='$Name',`username`='$username',`pass`='$EncPass',`phone`='$phone',`data`='$date',`typing_user`='$fill' WHERE Id_User='$ID'";
       $updat=$this->pdo->prepare($sql);
       $updat->execute();
   }



            public function Login($username)
   {
         // $EncPass=$this->Encrypting($pass);
          $sql="SELECT * FROM `user` WHERE `username`=:user";
            $reselt=$this->pdo->prepare($sql);
            $reselt->execute([
              ':user'=>$username
            ]);
            return $reselt->fetch(PDO::FETCH_ASSOC);
   }


             public function GetRowCustmer($Value):array
   {
          $ss="SELECT * FROM customers WHERE customer_id =$Value ";
          $q=$this->pdo->prepare($ss);
          $q->execute();
        
        return $q->fetch(PDO::FETCH_ASSOC);
   }



           public function Addlogin($Name,$rol):void
   {
     
          $sql="INSERT INTO `logees`( `name`, `role`)
          VALUES ('$Name','$rol')";
            $reselt=$this->pdo->prepare($sql);
            $reselt->execute();

   }

}