<?php
/*
 * */
include "inclusions/header.inc.php";
exportData();

$files= preg_grep('/^([^.])/', scandir("uploads"));
sort($files);

//print_r($files);

echo "<br><br><br><h1> Click file to start download</h1><br>";
for($a=0; $a< count($files); $a++){
    //displaying links to download
    if($files[$a] == 'ids.csv' || $files[$a] == 'energy.csv'){
        continue;
    }
?>

    <p>
        <a download="<?php  echo $files[$a]; ?>" href="uploads/<?php echo $files[$a]; ?>"><?php  echo $files[$a]; ?></a>
    </p>
<?php }


?>
<?php include "inclusions/footer.inc.php"; ?>
<a href="/folder_view/vs.php?s=<?php echo __FILE__?>" target="_blank">View Source</a>