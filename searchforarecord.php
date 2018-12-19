<?php
/**
 * Created by PhpStorm.
 * User: Lilian
 * Date: 2018-10-06
 * Time: 10:31 AM
 */
include "inclusions/header.inc.php";

$search = requestValue('search', '');

if(isset($_GET['search'])){
    $all_rows_header = getData();
    $all_rows = allRowsWithKeys();
    $search_key = searchId($search);
}

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
?>
<br /><br />
<h1> Search a record:</h1><br>
<p>Enter a keyword for the institution name or city.</p>
<form method="GET">
    <input type="text" name="search" placeholder="Institution or City" value="<?php echo $search; ?>">
    <input type="submit" name="submit">
</form>

<?php if ( (! empty($search)) && ( ! empty($search_key))){?>
    <br><br>
    <table class="table table-sm table-hover">
        <?php
        echo "<thead><tr>";

            for ($v = 0; $v < count($all_rows_header[0]); $v++) {

            echo "<th>".$all_rows_header[0][$v]. " </th>";
            }
            echo "<th>Action</th>";
            echo "</tr></thead>"; ?>

        <tbody><?php $count = 0;
        foreach( $search_key as $key ) { ?>
        <tr><?php $count++;
            foreach ($all_rows[ $key ] as $col_data) { ?>
                <td><?php echo $col_data;  ?></td><?php

            }
            ?>
                <td>
                    <a href="modify.php?id=<?php echo $all_rows[ $key ]['Id']; ?>" name="modify">
                        <img src="images/if_16.Pen_290134.png" alt="editpen"></a>
                    <button type="button" class="btn btn-primary"
                            data-toggle="modal" data-target="<?php $modalId = 'modal'. $all_rows[ $key ]['Id'];
                    echo '#'.$modalId; ?>">
                        Delete
                    </button>
                    <?php deleteModal($all_rows[ $key ]['Id'], $modalId);?>
                </td>
            </tr><?php
        }
        ?>
        </tbody>

    </table>
<?php }
        if( ! empty($search) && empty($search_key)){
            echo "<br>No record match found.";
        }

        if(! empty($search) && ! empty($search_key)){

            echo "<p> Total no. of entries found: " . $count."</p>";
        }

        ?>


<?php include "inclusions/footer.inc.php"; ?>
<a href="/folder_view/vs.php?s=<?php echo __FILE__?>" target="_blank">View Source</a>