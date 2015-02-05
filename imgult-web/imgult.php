<?php
$result=0;
if ($result == 0) echo shell_exec("rm -rf uploads/ 2>&1 && mkdir uploads/ 2>&1");
if (trim($_POST["action"]) == "IMGULT!") {
  for ($i = 0; $i < count($_FILES['image_files']['name']); $i++) {
    $target_dir = "uploads/";
    $imagename = $target_dir . basename($_FILES['image_files']['name']);
    $result = @move_uploaded_file($_FILES['image_files']['tmp_name'], $imagename);
    if ($result == 1) { 
      for ($i = 0; $i < count($_FILES['image_files']['name']); $i++) {
        echo "Successfully uploaded: <b>'$imagename'</b>";
        //if ($result == 1) echo "Successfully uploaded: <b>'$imagename'</b>"; for ($i = 0; $i < count($_FILES['image_files']['name']); $i++)
      }
    }
  }
}
?>
<html>
<head>
<link rel="shortcut icon" href="http://faviconist.com/icons/9e77fdea1e5d5361d3eaba02e25c00a9/favicon.ico">
<title>imgult for web</title>
<style>
input {
  padding: 1rem 2rem;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto;
  text-align: center;
  font-family: georgia;
  font-size: 1rem;
  border-radius: 20px;
}
input[type="file"] {
  background-color: hsla(360, 100%, 100%, 0.8);
  color: #000000;
}
input[type="submit"].imgulter {
  background-color: #046631;
  font-size: 2rem;
  color: #eeeeee;
  margin-bottom: 1rem;
}
h1 {
  text-align: center;
  text-shadow: 0.1rem 0.1rem 0.2rem hsla(0, 0%, 0%, 0.6);
}
div.top-banner {
  text-align: center;
  margin: 0 auto;
}
</style>
<script>
function clearForm() {
  document.getElementById("image_dump").value="";
}
</script>
</head>
<body>
<h1>imgult for web</h1>
<div class="top-banner">
  <img src="https://raw.githubusercontent.com/ryanpcmcquen/slackLogos/090ff5191b9f288d4fe25ef90d8a34d3ea59af75/poweredbyslack-imgulted.gif">
</div>
<form method='POST' enctype='multipart/form-data' name='frmmain' action='imgult.php'>
<input type="file" id="image_dump" name="image_files" multiple="true">
<br>
<input class="imgulter" type="submit" value="  IMGULT!  " name="action">
<input type="submit" value="reset" name="action" onClick="clearForm();">
</form>
<br>
<?php
if ($result==1) echo shell_exec("./imgult 2>&1");
if ($result==1) {
  for ($i = 0; $i < count($_FILES['image_files']['name']); $i++) {
    echo "<img src='$imagename'>";
  }
}
?>
</body>
</html>
