<?php
$filepath =realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Session.php");
include_once ($filepath."/../helpers/Format.php");

class CustomerRegistration{
   private $db;
   private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function customerRegistration($data)
    {

        $customerName = $data['customerName'];
        $cutomerMobile = $data['customerMobile'];
        $customerCity = $data['customerCity'];
        $customerPass = $data['customerPass'];
       
        $customerName = $this->fm->validation($customerName);
        $cutomerMobile = $this->fm->validation($cutomerMobile);
        $customerCity = $this->fm->validation($customerCity);
        $customerPass = $this->fm->validation($customerPass);
        
        
        $customerName = mysqli_real_escape_string($this->db->link, $customerName);
        $customerMobile = mysqli_real_escape_string($this->db->link, $cutomerMobile);
        $customerCity = mysqli_real_escape_string($this->db->link, $customerCity);
        $customerPass = mysqli_real_escape_string($this->db->link, $customerPass);

        if(empty($customerName)){
            $msg = "Customer name must not be empty";
            return $msg;
        }else if(empty($cutomerMobile)){
            $msg = "Customer Mobile No. must not be empty";
            return $msg;
        }else if(empty($customerCity)){
            $msg = "Customer City must not be empty";
            return $msg;
        }else if(empty($customerPass)){
            $msg = "Customer password must not be empty";
            return $msg;
        }else{
            $customerPass = hash('sha512', $customerPass);
            $query = "INSERT INTO `tbl_customer`(`customer_name`, `customer_mobile`, `customer_city`, `customer_pass`) VALUES ('$customerName', '$customerMobile', '$customerCity', '$customerPass')";
            $result = $this->db->insert($query);
          

                       
            if($result !== false){
                $msg = "Customer Registraion Successfull";
                return $msg;
            }else{
                $msg = $this->db->getDBError();
                return $msg;
            }
        }

    }


}