<?php
/**
 * Created by PhpStorm.
 * User: Lilian
 * Date: 2018-10-19
 * Time: 4:04 PM
 */
include "inclusions/header.inc.php";



//When delete is set, calls the delete function
if ( isset($_GET['delete']) ) {
    $delete_id = requestValue('id');

    if(!empty($delete_id)){
       $success = deleteId($delete_id);
    }
}

if(isset($_GET['delete']) && $success) {

    echo "<div class=\"alert alert-success\" role=\"alert\">Entry Deleted!</div>";
}
if(isset($_GET['delete']) && !$success){

    echo "<div class=\"alert alert-warning\" role=\"alert\">Entry was not deleted.</div>";
}


$search = requestValue('search', '');
$all_rows = getData();

///Pagination
$pageNo= isset($_GET['pageNo'])? $_GET['pageNo']: 1;

$recordsPerPage =5;
$startIndex = 1;
$endIndex =25;

$startIndex = startIndex($recordsPerPage,$pageNo);
$endIndex = endIndex($recordsPerPage,$pageNo);
$number_of_pages = numPages($all_rows, $recordsPerPage);

$number_of_pages = floor($number_of_pages);
?>



<div class="jumbotron jumbotron-fluid">
    <div class="container">
        <h1 class="display-4">CRUD</h1>
        <p class="lead">File Manipulation<br>List of Energy Property Tax Credit<br>of Student Residences</p>
    </div>

</div>


<div>
    <div class="dropdown show float-left" id="page">
        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Page
        </a>

        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink" id="pages">
            <?php for($i = 1; $i <=$number_of_pages; $i++){

                echo "<a  class=\"dropdown-item\" href=index.php?pageNo=$i> ".$i ."</a>";

            }?>
        </div>
    </div>
        <form class="form-inline my-2 my-lg-0 float-right" action="searchforarecord.php?id=<?php echo $search;?>">
            <input name="search" class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" value="<?php echo $search;?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
</div>
<br>
<br>
<?php


// View All Table data

echo "<table class=\"table table-sm table-hover\">";
echo "<thead><tr><th>No.</th>";

for ($v = 0; $v < count($all_rows[0]); $v++) {

    echo "<th>".$all_rows[0][$v]. " </th>";
}
echo "<th>Action</th>";
echo "</tr></thead><tbody>";

for($z = $startIndex; $z <= $endIndex; $z++) {
    if(isset($all_rows[$z])) {
        echo "<tr><td> $z</td>";
        //echo "<tr>";
        for ($v = 0; $v < count($all_rows[$z]); $v++) {
            echo "<td>" . $all_rows[$z][$v] . " </td>";
        }
        ?>
        <td>
            <a href="modify.php?id=<?php echo $all_rows[ $z ][0]; ?>" name="modify">
                <img src="images/if_16.Pen_290134.png" alt="editpen"></a>&nbsp;

            <button type="button" class="btn btn-primary"
                     data-toggle="modal" data-target="<?php $modalId = 'modal'. $all_rows[ $z ][0];
                     echo '#'.$modalId; ?>">
                Delete
            </button>
            <?php deleteModal($all_rows[ $z ][0], $modalId);?>

        </td>
        </tr><?php
    }
}

echo "</tbody></table>";


?>
<br>
<div class="text-justify float-left">
    Showing page <?php echo $pageNo; ?> of <?php echo $number_of_pages; ?> pages <br>
    Total no. of entries: <?php echo count($all_rows); ?>
</div>


                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<a href="/folder_view/vs.php?s=<?php echo __FILE__?>" target="_blank">View Source</a>
