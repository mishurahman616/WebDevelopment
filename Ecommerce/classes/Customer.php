<?php
$filepath =realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Session.php");


include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/Format.php");

class Customer{
   private $db;
   private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function getCustomerInfoById($customerId)
    {
        $customerId = $this->fm->validation($customerId);
        $customerId = mysqli_real_escape_string($this->db->link, $customerId);

        $query = "SELECT * FROM tbl_customer WHERE customer_id='$customerId' LIMIT 1;";
        $result = $this->db->select($query);
                if($result){
                    return $result;
            }else{
                header("Location: index.php");
            }
    }




    public function customerInfoUpdate($data, $image)
    {
        $customerId=$data['customerId'];
        $customerName = $data['customerName'];
        $customerMobile = $data['customerMobile'];
        $customerEmail = $data['customerEmail'];
        $customerAddress = $data['customerAddress'];
        $customerCity = $data['customerCity'];
        $customerImage = "";

        $customerId = $this->fm->validation($customerId);
        $customerName = $this->fm->validation($customerName);
        $customerMobile = $this->fm->validation($customerMobile);
        $customerEmail = $this->fm->validation($customerEmail);
        $customerAddress = $this->fm->validation($customerAddress);
        $customerCity = $this->fm->validation($customerCity);
        
        
        $customerId = mysqli_real_escape_string($this->db->link, $customerId);
        $customerName = mysqli_real_escape_string($this->db->link, $customerName);
        $customerMobile = mysqli_real_escape_string($this->db->link, $customerMobile);
        $customerEmail = mysqli_real_escape_string($this->db->link, $customerEmail);
        $customerAddress = mysqli_real_escape_string($this->db->link, $customerAddress);
        $customerCity = mysqli_real_escape_string($this->db->link, $customerCity);

        if(!empty($image["customerImage"]["name"])){
            $imageName= basename($image["customerImage"]["name"]);
            $fileType = pathinfo($imageName, PATHINFO_EXTENSION);

            $allowedTypes = array('jpg', 'png', 'jpeg');
            if(in_array($fileType, $allowedTypes)){
                $imageTmpName = $image["customerImage"]['tmp_name'];
                $customerImage = addslashes(file_get_contents($imageTmpName));
 
            }else{
                $msg = "Image type can be JPG, PNG Or JPEG only";
                return $msg;
            }

        }



        if(empty($customerName)){
            $msg = "Customer name must not be empty";
            return $msg;
        }else if(empty($customerMobile)){
            $msg = "Customer Mobile must not be empty";
            return $msg;
        }else if(empty($customerCity)){
            $msg = "Customer City must not be empty";
            return $msg;
        }
        else{
            if($customerImage!=''){
                $query = "UPDATE `tbl_customer` SET `customer_name`='$customerName',`customer_mobile`='$customerMobile', `customer_email`='$customerEmail',`customer_image`='$customerImage',`customer_address`='$customerAddress',`customer_city`='$customerCity' WHERE `customer_id`='$customerId';";
            }
            else{
                $query = "UPDATE `tbl_customer` SET `customer_name`='$customerName',`customer_mobile`='$customerMobile', `customer_email`='$customerEmail',`customer_address`='$customerAddress',`customer_city`='$customerCity' WHERE `customer_id`='$customerId';";
            }
            $result = $this->db->update($query);
            if($result != false){
                $msg = "Customer Info Updated Successfully";
                header("Location: paymentoffline.php");
                return $msg;
                
            }else{
                $msg = $this->db->getDbError();
                return $msg;
            }
        }

    }














    
}