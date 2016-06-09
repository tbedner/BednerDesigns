<?php
  include 'mycell_fns.php';
 session_start();
 do_html_mypageheader('cellme.mobi');
 check_valid_user2();
  if (empty($short) || empty($userfile))
  {
?>
    <!DOCTYPE HTML PUBLIC 
               "-//W3C//DTD HTML 4.0 Transitional//EN"
               "http://www.w3.org/TR/html4/loose.dtd">
    <html>
    <head>
      <title>Upload an Image File</title>
    </head>
    <body bgcolor="white">
    <form method="post" action="insert.php" enctype="multipart/form-data">
    <h1>Upload an Image File</h1> 
    <h3>Please fill in the details below to upload your file. 
    Fields shown in <font color="red">red</font> are mandatory.</h3>
    <table>
    <col span="1" align="right">

    <tr>
       <td><font color="red">Short description:</font></td>
       <td><input type="text" name="short" size=50></td>
    </tr>

    <tr>    
       <td><font color="red">File:</font></td>
       <td><input name="userfile" type="file"></td>
    </tr>

    <tr>
          <td><input id="mysubmit" type="submit" value="Submit"></td>
    </tr>
    </table>
    <input type="hidden" name="MAX_FILE_SIZE" value="30000">
    </form>
    <h3>Click <a href="upload.php">here</a> to browse the images instead.</h3>
    </body>
    </html>
<?php    
  }
  else 
  {
     $short = clean($short, 50);
     $userfile = clean($userfile, 50);

     if (!($connection = @ mysql_pconnect($hostName, 
                                         $username, 
                                         $password)))
        showerror();

     if (!mysql_select_db("files", $connection))
        showerror();

     // Was a file uploaded?
     if (is_uploaded_file($userfile))
     {
       
       switch ($userfile_type)
       {
          case "image/gif";       
             $mimeName = "GIF Image";
             break;
          case "image/jpeg";          
             $mimeName = "JPEG Image";
             break;
          case "image/png";       
             $mimeName = "PNG Image";
             break;
          case "image/x-MS-bmp";       
             $mimeName = "Windows Bitmap";
             break;
          default: 
             $mimeName = "Unknown image type";
       }
   
       // Open the uploaded file
       $file = fopen($userfile, "r");
    
       // Read in the uploaded file
       $fileContents = fread($file, filesize($userfile)); 

       // Escape special characters in the file
       $fileContents = AddSlashes($fileContents);
     }  
     else
       $fileContents = NULL;

     $insertQuery = "INSERT INTO files VALUES (NULL, \"{$short}\",
         \"{$userfile_type}\", \"{$mimeName}\", \"{$fileContents}\")";

     if ((@ mysql_query ($insertQuery, $connection)) 
         && @ mysql_affected_rows() == 1)
       header("Location: receipt.php?status=T&file="
         . mysql_insert_id($connection));
     else
       header("Location: receipt.php?status=F&file=" 
         . mysql_insert_id($connection));  
  } // if else empty()
?>