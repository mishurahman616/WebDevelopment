<?php

class Session{
 public static function init(){
        if (session_status() == PHP_SESSION_NONE) {
         
            $expire = 365*24*3600; 
            ini_set('session.gc_maxlifetime', $expire);
            session_start();
            setcookie(session_name(),session_id(),time()+$expire);
        }
     }

 public static function set($key, $val){
  $_SESSION[$key] = $val;
 }

 public static function get($key){
  if (isset($_SESSION[$key])) {
   return $_SESSION[$key];
  } else {
   return false;
  }
 }

 public static function checkSession(){
  self::init();
  if (self::get("login")== false) {
   self::destroy();
   header("Location:login.php");
  }
 }

 public static function customerCheckLogin(){
    self::init();
    if (self::get("customerLogin")== true) {
     header("Location:index.php");
    }
   }

 public static function checkLogin(){
  self::init();
  if (self::get("login")== true) {
   header("Location:dashboard.php");
  }
 }

 public static function destroy(){
  session_destroy();
  header("Location:login.php");
 }
}