<?php
class Format{
 public function formatDate($date){
  return date('F j, Y, g:i a', strtotime($date));
 }

 public function textShorten($text, $limit = 400){
  $text = $text. " ";
  $text = substr($text, 0, $limit);
  $text = substr($text, 0, strrpos($text, ' '));
  $text = $text.".....";
  return $text;
 }

public function passValidation($pass)
{
    $number = preg_match('@[0-9]@', $pass);
    $uppercase = preg_match('@[A-Z]@', $pass);
    $lowercase = preg_match('@[a-z]@', $pass);
    $specialChars = preg_match('@[^\w]@', $pass);
    
    if(strlen($pass) < 6 || !$number || !$uppercase || !$lowercase || !$specialChars)
        return false;
    else return true;
}

 public function validation($data){
  $data = trim($data);
  $data = stripcslashes($data);
  $data = htmlspecialchars($data);
  return $data;
 }

 public function title(){
  $path = $_SERVER['SCRIPT_FILENAME'];
  $title = basename($path, '.php');
  if ($title == 'index') {
   $title = 'home';
  }elseif ($title == 'contact') {
   $title = 'contact';
  }
  return $title = ucfirst($title);
 }
}