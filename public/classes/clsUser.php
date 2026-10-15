<?php
include_once "classes/clsDateBase.php";
 enum enPermissions:int {
    case enAll=-1;
    case AddUsers=1;
    case AddCustomers=2;
    case AddEmployees=4;
    case AddReadings=8;
    case AddBills=16;
    case PayBills=32;
} 

class User
    {
    public $_Id;  
    public $_name; 
    public $_Username;
    public $_Password;
    public $_Role;
    public $_Permissions;
    public $_Imge;
    public $logecsaccus=false;
    


   

       public function crypting($pass)
   {
    //password_verify($pass);
       $reselt="";
       for($i=0;$i<strlen($pass);$i++)
              {
                     $reselt.=chr(ord($pass[$i])-3);
              }
              return $reselt;
   }

     public function __construct($Username,$pas)
    {
        $db=new Database();
        $row=$db->Login($Username);
        
        
        if($row==false )
            {
                $this->logecsaccus=false;
                return;
                }
                else
                    {
                    $this->_Password=$this->crypting($row['pass']);
                    //password_verify($pass);
                    if($this->_Password==$pas)
                        {

                            $this->logecsaccus=true;
                           $this->_Id =$row['Id_User'];   
                           $this->_name=$row['Name'];
                           $this->_Username=$row['username'];
                           $this->_Role=$row['typing_user'];
                           $this->_Permissions=$row['permission'];
                           $this->_Imge=$row['profileImge'];
                        }
                        else
                            {
                                  $this->logecsaccus=false;
                                   return;
                            }

                }
        
        }






        
    }


?>