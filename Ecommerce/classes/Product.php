<?php
$filepath =realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/Format.php");

class Product{
   private $db;
   private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }


    public function productInsert($data, $image)
    {

        $productName = $data['productName'];
        $productDescription = $data['productDescription'];
        $productCategory = $data['productCategory'];
        $productBrand = $data['productBrand'];
        $productPrice = $data['productPrice'];
        $productColor = $data['productColor'];
        $productImage = "";

        $productName = $this->fm->validation($productName);
        $productDescription = $this->fm->validation($productDescription);
        $productCategory = $this->fm->validation($productCategory);
        $productBrand = $this->fm->validation($productBrand);
        $productColor = $this->fm->validation($productColor);
        $productPrice = $this->fm->validation($productPrice);
        
        
        $productName = mysqli_real_escape_string($this->db->link, $productName);
        $productDescription = mysqli_real_escape_string($this->db->link, $productDescription);
        $productCategory = mysqli_real_escape_string($this->db->link, $productCategory);
        $productBrand = mysqli_real_escape_string($this->db->link, $productBrand);
        $productColor = mysqli_real_escape_string($this->db->link, $productColor);
        $productPrice = mysqli_real_escape_string($this->db->link, $productPrice);

        if(!empty($image["productImage"]["name"])){
            $imageName= basename($image["productImage"]["name"]);
            $fileType = pathinfo($imageName, PATHINFO_EXTENSION);

            $allowedTypes = array('jpg', 'png', 'jpeg');
            if(in_array($fileType, $allowedTypes)){
                $imageTmpName = $image["productImage"]['tmp_name'];
                $productImage = addslashes(file_get_contents($imageTmpName));
 
            }else{
                $msg = "Image type can be JPG, PNG Or JPEG only";
                return $msg;
            }

        }else{
            $msg = "Plsease Select Image File";
            return $msg;
        }



        if(empty($productName)){
            $msg = "Product name must not be empty";
            return $msg;
        }else if(empty($productDescription)){
            $msg = "Product Description must not be empty";
            return $msg;
        }else if(empty($productCategory)){
            $msg = "Product Category must not be empty";
            return $msg;
        }else if(empty($productBrand)){
            $msg = "Product Brand must not be empty";
            return $msg;
        }else if(empty($productImage)){
            $msg = "Product Image must not be empty";
            return $msg;
        }else if(empty($productColor)){
            $msg = "Product Color must not be empty";
            return $msg;
        }else if(empty($productPrice)){
            $msg = "Product Price must not be empty";
            return $msg;
        }
        else{
            $query = "INSERT INTO `tbl_product` (`cat_id`, `product_name`, `product_desc`, `product_image1`, `brand_id`, `product_color`, `product_price`) VALUES ('$productCategory', '$productName', '$productDescription', '$productImage', '$productBrand', '$productColor', '$productPrice')";
            $result = $this->db->insert($query);
            if($result !== false){
                $msg = "Product Added Successfully";
                return $msg;
            }else{
                $msg = "error occured";
                return $msg;
            }
        }

    }

    public function productUpdate($data, $image)
    {
        $productId=$data['productId'];
        $productName = $data['productName'];
        $productDescription = $data['productDescription'];
        $productCategory = $data['productCategory'];
        $productBrand = $data['productBrand'];
        $productPrice = $data['productPrice'];
        $productColor = $data['productColor'];
        $productImage = "";

        $productId = $this->fm->validation($productId);
        $productName = $this->fm->validation($productName);
        $productDescription = $this->fm->validation($productDescription);
        $productCategory = $this->fm->validation($productCategory);
        $productBrand = $this->fm->validation($productBrand);
        $productColor = $this->fm->validation($productColor);
        $productPrice = $this->fm->validation($productPrice);
        
        
        $productId = mysqli_real_escape_string($this->db->link, $productId);
        $productName = mysqli_real_escape_string($this->db->link, $productName);
        $productDescription = mysqli_real_escape_string($this->db->link, $productDescription);
        $productCategory = mysqli_real_escape_string($this->db->link, $productCategory);
        $productBrand = mysqli_real_escape_string($this->db->link, $productBrand);
        $productColor = mysqli_real_escape_string($this->db->link, $productColor);
        $productPrice = mysqli_real_escape_string($this->db->link, $productPrice);

        if(!empty($image["productImage"]["name"])){
            $imageName= basename($image["productImage"]["name"]);
            $fileType = pathinfo($imageName, PATHINFO_EXTENSION);

            $allowedTypes = array('jpg', 'png', 'jpeg');
            if(in_array($fileType, $allowedTypes)){
                $imageTmpName = $image["productImage"]['tmp_name'];
                $productImage = addslashes(file_get_contents($imageTmpName));
 
            }else{
                $msg = "Image type can be JPG, PNG Or JPEG only";
                return $msg;
            }

        }



        if(empty($productName)){
            $msg = "Product name must not be empty";
            return $msg;
        }else if(empty($productDescription)){
            $msg = "Product Description must not be empty";
            return $msg;
        }else if(empty($productCategory)){
            $msg = "Product Category must not be empty";
            return $msg;
        }else if(empty($productBrand)){
            $msg = "Product Brand must not be empty";
            return $msg;
        }else if(empty($productColor)){
            $msg = "Product Color must not be empty";
            return $msg;
        }else if(empty($productPrice)){
            $msg = "Product Price must not be empty";
            return $msg;
        }
        else{
            if(!empty($productImage)){
                $query = "UPDATE `tbl_product` SET `cat_id`='$productCategory',`product_name`='$productName',`product_desc`='$productDescription',`product_image1`='$productImage',`brand_id`='$productBrand',`product_color`='$productColor',`product_price`='$productPrice' WHERE `product_id`='$productId';";
            }
            else{
                $query = "UPDATE `tbl_product` SET `cat_id`='$productCategory',`product_name`='$productName',`product_desc`='$productDescription',`brand_id`='$productBrand',`product_color`='$productColor',`product_price`='$productPrice' WHERE `product_id`='$productId';";
            }
            $result = $this->db->update($query);
            if($result != false){
                $msg = "Product Updated Successfully";
                return $msg;
            }else{
                $msg = $this->db->getDBError();
                return $msg;
            }
        }

    }
    public function getAllProduct()
    {
        $query = "SELECT p.*, c.cat_name, b.brand_name From tbl_product as p, tbl_category as c, tbl_brand as b Where p.cat_id = c.cat_id AND p.brand_id = b.brand_id ORDER BY product_id DESC;";
        $result = $this->db->select($query);
                  return $result;
        
    }
    public function searchProduct($search)
    {
        $search = mysqli_real_escape_string($this->db->link, $search);

        $query = "SELECT p.*, c.cat_name, b.brand_name From tbl_product as p, tbl_category as c, tbl_brand as b Where p.cat_id = c.cat_id AND p.brand_id = b.brand_id AND(p.product_name LIKE '%$search%' OR c.cat_name LIKE '%$search%' OR b.brand_name LIKE '%$search%' OR p.product_desc LIKE '%$search%') ;";
        $result = $this->db->select($query);
                  return $result;
    }
    public function getOfferProduct()
    {
        $query = "SELECT p.*, c.cat_name, b.brand_name From tbl_product as p, tbl_category as c, tbl_brand as b Where p.cat_id = c.cat_id AND p.brand_id = b.brand_id AND product_offer=1 ORDER BY product_id DESC;";
        $result = $this->db->select($query);
                  return $result;
        
    }
    public function getProductByCategory($category)
    {
        $query = "SELECT * FROM tbl_product WHERE cat_id='$category' ORDER BY product_id DESC;";
        $result = $this->db->select($query);
        if($result){
            return $result;
        }
        return false;
        
    }
    public function getProductByBrand($brand)
    {
        $query = "SELECT * FROM tbl_product WHERE brand_id='$brand' ORDER BY product_id DESC;";
        $result = $this->db->select($query);
                  return $result;
        
    }
    public function getProductById($id)
    {
        $query = "SELECT p.*, c.cat_name, b.brand_name FROM tbl_product as p, tbl_category as c, tbl_brand as b WHERE p.product_id=$id AND p.cat_id = c.cat_id AND p.brand_id = b.brand_id LIMIT 1;";
        $result = $this->db->select($query);
        if($result){
        $result = $result->fetch_assoc();
        return $result;
        }
        return $result;
        
    }
    public function deleteProductById($id)
    {
        $query = "DELETE FROM tbl_product WHERE product_id='$id' LIMIT 1";
            $result = $this->db->select($query);
            if($result !== false){
                $msg = "Product Deleted Successfully";
                return $msg;
            }else{
                $msg = "error occured";
                return $msg;
            }
    }
}