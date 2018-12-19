<?php
/**
 * Created by PhpStorm.
 * User: Lilian
 * Date: 2018-10-19
 * Time: 12:02 PM
 */

include "inclusions/header.inc.php";

echo "<br><br>";

if(isset($_FILES['file'])){

    $success = appendData();
}


?>
<h1>Choose a file to import</h1>
<br><br>
<form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="file"/><br><br><br>
    <input type="submit" value="Submit"/>
</form>

<?php
if (isset($_FILES['file']) && $success){

    echo "<br>Successfully uploaded to current file";
}
if(isset($_FILES['file']) && ! $success){

    echo "<br>Must use the same file or has the same no. of rows to upload to this file. Please try again.";
}


?>

<?php include "inclusions/footer.inc.php"; ?>
<a href="/folder_view/vs.php?s=<?php echo __FILE__?>" target="_blank">View Source</a>