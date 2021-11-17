<?php
$filepath =realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Session.php");


include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/Format.php");

class CustomerLogin{
   private $db;
   private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function customerLogin($customerMobile, $customerPass)
    {
        $customerMobile = $this->fm->validation($customerMobile);
        $customerPass = $this->fm->validation($customerPass);

        $customerMobile = mysqli_real_escape_string($this->db->link, $customerMobile);
        $customerPass = mysqli_real_escape_string($this->db->link, $customerPass);
        
        if(empty($customerMobile) || empty($customerPass)){
            $loginmsg = "Mobile or Password must not be empty";
            return $loginmsg;
        }else{
            $query = "SELECT * FROM tbl_customer WHERE customer_mobile='$customerMobile' AND customer_pass='$customerPass';";
            $result = $this->db->select($query);
                if($result){
                $value = $result->fetch_assoc();
                Session::set("customerLogin", true);
                Session::set("customerId", $value['customer_id']);
                Session::set('customerMobile', $value['customer_mobile']);
                Session::set('customerName', $value['customer_name']);
                header('Location: login.php');
            }else{
                $loginmsg = "Mobile or password not match";
                return $loginmsg;
            }
        }
    }
}