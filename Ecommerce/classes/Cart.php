<?php
$filepath =realpath(dirname(__FILE__));
include_once ($filepath."/../lib/Database.php");
include_once ($filepath."/../helpers/Format.php");

class Cart{
   private $db;
   private $fm;

    public function __construct(){
        $this->db = new Database();
        $this->fm = new Format();
    }

    public function insertCart($productDetails, $productQuantity, $sessionId)
    {
        $productId = $productDetails['product_id'];
        $productName = $productDetails['product_name'];
        $productDescription = $productDetails['product_desc'];
        $productCategory = $productDetails['cat_name'];
        $productBrand = $productDetails['brand_name'];
        $productPrice = $productDetails['product_price'];
        $productColor = $productDetails['product_color'];
        $productImage = $productDetails['product_image1'];

       $productQuantity = $this->fm->validation($productQuantity);
       $productQuantity = mysqli_real_escape_string($this->db->link, $productQuantity);
       $sessionId = mysqli_real_escape_string($this->db->link, $sessionId);
       $productImage = mysqli_real_escape_string($this->db->link, $productImage);


        if(empty($productId)){
            $msg = "Product name must not be empty";
            return $msg;
        }else if(empty($productQuantity)){
            $msg = "Product Description must not be empty";
            return $msg;
        }else if(empty($sessionId)){
            $msg = "Product Category must not be empty";
            return $msg;
        }else{

            $duplicateCheckQuery="SELECT * FROM tbl_cart WHERE session_id='$sessionId' AND product_id='$productId';";
            $duplicateFound = $this->db->select($duplicateCheckQuery);
            if($duplicateFound){
                return "Product Already Added. To increase quantiy go to cart";
            }
            $query = "INSERT INTO `tbl_cart`(`session_id`, `product_id`, `product_name`, `product_quantity`, `product_price`, `product_image`, `product_color`) VALUES ('$sessionId','$productId','$productName','$productQuantity','$productPrice','$productImage','$productColor');";
            $result = $this->db->insert($query);
            if($result !== false){
                header("location: cart.php");
            }else{
                $msg = $this->db->getDbError();
                return $msg;
            }

        }

    }

   
    public function getCartProductBySessionId($sessionId)
    {
        $sessionId = $this->fm->validation($sessionId);
        $sessionId = mysqli_real_escape_string($this->db->link, $sessionId);
        if($sessionId){
            $query = "SELECT * FROM tbl_cart WHERE session_id='$sessionId';";
            $result = $this->db->select($query);
            if($result){
               return $result;
            }else{
                return false;
            }
        }

    }  
    
    public function updateCartQuantity($sessionId, $quantity){
        $sessionId = $this->fm->validation($sessionId);
        $productQuantity = $this->fm->validation($quantity);
       $sessionId = mysqli_real_escape_string($this->db->link, $sessionId);
       $productQuantity = mysqli_real_escape_string($this->db->link, $productQuantity);
        
       if($sessionId){
           if($productQuantity){
               $query = "UPDATE tbl_cart SET product_quantity='$productQuantity' WHERE cart_id = '$sessionId';";
               $this->db->update($query);
               header("Location: cart.php");
           }
       }
    }

    public function deleteCartByCartId($sessionId){
        $sessionId = $this->fm->validation($sessionId);
       $sessionId = mysqli_real_escape_string($this->db->link, $sessionId);        
       if($sessionId){
               $query = "DELETE FROM tbl_cart  WHERE cart_id = '$sessionId' LIMIT 1;";
               $this->db->delete($query);
        
       }
    }
    public function deleteCartBySessionId($sessionId){
        $sessionId = $this->fm->validation($sessionId);
       $sessionId = mysqli_real_escape_string($this->db->link, $sessionId);        
       if($sessionId){
               $query = "DELETE FROM tbl_cart  WHERE session_id = '$sessionId';";
               $this->db->delete($query);
        
       }
    }

    public function dataInsertToOrderTbl($sessionId, $customerId)
    {
        if($sessionId){
            $query = "SELECT * FROM tbl_cart WHERE session_id='$sessionId';";
            $cart = $this->db->select($query);

            if($cart){
                while($result= $cart->fetch_assoc()){

                    $productId = $result['product_id'];
                    $productName = $result['product_name'];
                    $productQuantity = $result['product_quantity'];
                    $productPrice = $result['product_price'];
                    $productColor = $result['product_color'];
                    $productImage = $result['product_image'];
                    $productImage = mysqli_real_escape_string($this->db->link, $productImage);
                    $productPrice = $productPrice *$productQuantity;


                    $date = date("Y-m-d H:i:s");

                    $query = "INSERT INTO `tbl_order`(`customer_id`, `product_id`, `product_name`, `product_price`, `product_quantity`, `product_image`, `product_color`, `date`, `status`) VALUES ('$customerId','$productId','$productName','$productPrice','$productQuantity','$productImage','$productColor', '$date', '0');";
                
                    $insert = $this->db->insert($query);
                   
                    if($insert == false){
                        return $this->db->getDbError();
                    }
                }
            }

        }

        
    }



    public function paymentAmount($customerId){
        $date = date("Y-m-d H:i:s");
        $query = "SELECT product_price FROM tbl_order WHERE customer_id = '$customerId' AND date =  '$date'";
        $getAmount = $this->db->select($query);
        if($getAmount == false){
            return $this->db->getDbError();
        }
        return $getAmount;
    }

    public function getOrderProducts($customerId){
        
        $query = "SELECT * FROM tbl_order WHERE customer_id = '$customerId'";
        $getAmount = $this->db->select($query);
        if($getAmount == false){
            return $this->db->getDbError();
        }
        return $getAmount;
    }
    

}