<?php
$filepath =realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/Format.php");

class Brand{
   private $db;
   private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function brandInsert($brandName)
    {
        $brandName = $this->fm->validation($brandName);

        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        
        if(empty($brandName)){
            $msg = "Brand name must not be empty";
            return $msg;
        }else{
            $query = "INSERT INTO `tbl_brand` (`brand_name`) VALUES ('$brandName')";
            $result = $this->db->insert($query);
            if($result !== false){
                $msg = "Brand Added Successfully";
                return $msg;
            }else{
                $msg = $this->db->getDbError();
                return $msg;
            }
        }
    }

    public function brandUpdate($brandId, $brandName)
    {
        $brandId=$this->fm->validation($brandId);
        $brandName = $this->fm->validation($brandName);
       
        $brandId = mysqli_real_escape_string($this->db->link, $brandId);
        $brandName = mysqli_real_escape_string($this->db->link, $brandName);
        
        if(empty($brandName)){
            $msg = "Brand name must not be empty";
            return $msg;
        }else if(empty($brandId)){
            $msg = "Brand Id must not be empty";
            return $msg;
        }else{
            $query = "UPDATE `tbl_brand` SET `brand_name`='$brandName' WHERE brand_id = '$brandId' LIMIT 1;";
            $result = $this->db->update($query);
            if($result !== false){
                $msg = "Brand Updated Successfully";
                return $msg;
            }else{
                $msg = "Maybe Brand already exist or others error occured";
                return $msg;
            }
        }
    }


    public function getBrandNameById($id)
    {
        $query = "SELECT brand_name FROM tbl_brand WHERE brand_id='$id' LIMIT 1;";
        $result = $this->db->select($query);
        $result = $result->fetch_assoc();
                  return $result['brand_name'];
    }
    public function getAllBrand()
    {
        $query = "SELECT * FROM tbl_brand;";
        $result = $this->db->select($query);
                  return $result;
        
    }

    public function deleteBrandById($id)
    {
        $query = "DELETE FROM tbl_brand WHERE brand_id='$id' LIMIT 1";
            $result = $this->db->select($query);
            if($result !== false){
                $msg = "Brand Deleted Successfully";
                return $msg;
            }else{
                $msg = "error occured";
                return $msg;
            }
    }
}