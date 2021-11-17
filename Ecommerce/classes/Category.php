<?php
$filepath =realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/Format.php");

class Category{
   private $db;
   private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function catInsert($catName, $catDescription)
    {
        $catName = $this->fm->validation($catName);
        $catDescription = $this->fm->validation($catDescription);

        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $catDescription = mysqli_real_escape_string($this->db->link, $catDescription);
        
        if(empty($catName)){
            $msg = "Category name must not be empty";
            return $msg;
        }else{
            $query = "INSERT INTO `tbl_category` (`cat_name`, `cat_description`) VALUES ('$catName', '$catDescription')";
            $result = $this->db->insert($query);
            if($result !== false){
                $msg = "Category Added Successfully";
                return $msg;
            }else{
                $msg = "Maybe Category already exist or others error occured";
                return $msg;
            }
        }
    }

    public function catUpdate($catId, $catName, $catDescription)
    {
        
        $catId = $this->fm->validation($catId);
        $catName = $this->fm->validation($catName);
        $catDescription = $this->fm->validation($catDescription);

        $catId = mysqli_real_escape_string($this->db->link, $catId);
        $catName = mysqli_real_escape_string($this->db->link, $catName);
        $catDescription = mysqli_real_escape_string($this->db->link, $catDescription);
        
        if(empty($catName)){
            $msg = "Category name must not be empty";
            return $msg;
        }else if(empty($catId)){
            $msg = "Category id must not be empty";
            return $msg;
        }else{
            
            $query = "UPDATE `tbl_category` SET `cat_name`='$catName', `cat_description`='$catDescription' WHERE cat_id = '$catId' LIMIT 1;";
            $result = $this->db->update($query);
            if($result !== false){
                $msg = "Category Updated Successfully";
                return $msg;
            }else{
                $msg = "Maybe Category already exist or others error occured";
                return $msg;
            }
        }
    }
    public function getCategoryNameById($id)
    {
        $query = "SELECT cat_name, cat_description FROM tbl_category WHERE cat_id='$id' LIMIT 1";
            $result = $this->db->select($query);
            $result = $result->fetch_assoc();
                    return $result['cat_name'];
    }

    public function getCategoryById($id)
    {
        $query = "SELECT cat_name, cat_description FROM tbl_category WHERE cat_id='$id' LIMIT 1";
        $result = $this->db->select($query);
        $result = $result->fetch_assoc();
                  return $result;
    }
    public function getAllCat()
    {
        $query = "SELECT cat_id, cat_name FROM tbl_category;";
        $result = $this->db->select($query);
                  return $result;
        
    }
    public function deleteCatById($id)
    {
        $query = "DELETE FROM tbl_category WHERE cat_id='$id' LIMIT 1";
            $result = $this->db->select($query);
            if($result !== false){
                $msg = "Category Deleted Successfully";
                return $msg;
            }else{
                $msg = "error occured";
                return $msg;
            }
    }
}