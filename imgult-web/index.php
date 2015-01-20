<?php
$result=0;
if ($result == 0) echo shell_exec("rm -rf uploads/ 2>&1 && mkdir uploads/ 2>&1");
if (trim($_POST["action"]) == "IMGULT!") {
    $target_dir = "uploads/";
    $imagename = $target_dir . basename($_FILES['image_files']['name']);
    $result = @move_uploaded_file($_FILES['image_files']['tmp_name'], $imagename);
  }
}

/*
 *
 * @ Multiple File upload script.
 *
 * @ Can do any number of file uploads
 * @ Just set the variables below and away you go
 *
 * @ Author: Kevin Waterson
 *
 * modified by Ryan McQuen
 *
 * @copywrite 2008 PHPRO.ORG
 *
 */

  error_reporting(E_ALL);

  /*** the upload directory ***/
  $upload_dir= './uploads';

  /*** a message for users ***/
  $msg = 'Please select files for uploading';

  /*** an array to hold messages ***/
  $messages = array();

  /*** check if a file has been submitted ***/
  if(isset($_FILES['userfile']['tmp_name'])) {
    /** loop through the array of files ***/
    for($i = 0; $i < count($_FILES['userfile']['tmp_name']); $i++) {
      // check if there is a file in the array
      if(!is_uploaded_file($_FILES['userfile']['tmp_name'][$i])) {
        $messages[] = 'No file uploaded';
      }
      else {
        // copy the file to the specified dir 
        if(@copy($_FILES['userfile']['tmp_name'][$i],$upload_dir.'/'.$_FILES['userfile']['name'][$i])) {
          /*** give praise and thanks to the php gods ***/
          $messages[] = $_FILES['userfile']['name'][$i].' uploaded';
        }
        else {
          /*** an error message ***/
          $messages[] = 'Uploading '.$_FILES['userfile']['name'][$i].' Failed';
        }
      }
    }
  }
?>
 <!DOCTYPE html>
 <html>
 <head>
 <title>imgult</title>
 </head>

 <body>
 
 <h3><?php echo $msg; ?></h3>
 <p>
 <?php
    if(sizeof($messages) != 0)
    {
        foreach($messages as $err)
        {
            echo $err.'<br />';
        }
    }
 ?>
 </p>
 <form enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']);?>" method="post">
 <input type="file" name="userfile[]" multiple="true">

 <input type="submit" value="IMGULT!">
<?php
if ($result == 1) echo shell_exec("./imgult 2>&1; zip ./uploads/");
if ($result == 1) echo "./uploads.zip");
?>
 </form>

 </body>
 </html>
