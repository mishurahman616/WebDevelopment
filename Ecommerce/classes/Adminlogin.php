<?php
$filepath =realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Session.php");

Session::checkLogin();
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/Format.php");

class Adminlogin{
   private $db;
   private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function adminLogin($adminEmail, $adminPass)
    {
        $adminEmail = $this->fm->validation($adminEmail);
        $adminPass = $this->fm->validation($adminPass);

        $adminEmail = mysqli_real_escape_string($this->db->link, $adminEmail);
        $adminPass = mysqli_real_escape_string($this->db->link, $adminPass);
        
        if(empty($adminEmail) || empty($adminPass)){
            $loginmsg = "Email or Password must not be empty";
            return $loginmsg;
        }else{
            $query = "SELECT * FROM tbl_admin WHERE admin_email='$adminEmail' AND admin_pass='$adminPass' LIMIT 1;";
            $result = $this->db->select($query);
            if($result){
                $value = $result->fetch_assoc();
                Session::set("login", true);
                Session::set("adminId", $value['admin_id']);
                Session::set('adminEmail', $value['admin_email']);
                Session::set('adminFname', $value['admin_Fname']);
                Session::set('adminLname', $value['admin_Lname']);
                header('Location: dashboard.php');
            }else{
                $loginmsg = "Email or password not match";
                return $loginmsg;
            }
        }
    }
}