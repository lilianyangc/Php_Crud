<?php
/**
 * Created by PhpStorm.
 * User: Lilian
 * Date: 2018-10-06
 * Time: 5:19 PM
 */

include "inclusions/header.inc.php";

$modify_id = requestValue('id');
$institution = $studResid = $streetNo = $city= $province = $postal= '';

//Output modify_id values for user modification
if ( ! empty($modify_id) ) {

    $search_key = getSearchKeyToModify($modify_id);
    $all_rows =getData();

    if ( $search_key != -1 ) { //output to form

        for($i = 1 ; $i < count($all_rows[$search_key]); $i++){

            if($i == 1){ $institution = $all_rows[$search_key][$i];}
            if($i == 2){ $studResid = $all_rows[$search_key][$i];}
            if($i == 3){ $streetNo = $all_rows[$search_key][$i];}
            if($i == 4){ $city = $all_rows[$search_key][$i];}
            if($i == 5){ $province = $all_rows[$search_key][$i];}
            if($i == 6){ $postal = $all_rows[$search_key][$i];}
        }
    }
}

//When set, calls function to modify the data in the file
if(isset($_POST['update'])){
   $success = updateData();

   if($success) {
       $institution = $_POST['institution'];
       $studResid =  $_POST['studResid'];
       $streetNo =  $_POST['streetNo'];
       $city =  $_POST['city'];
       $province =  $_POST['province'];
       $postal =  $_POST['postal'];
   }
}

?>
    <br><h1 class="display-4"> Modify record:</h1><br>

    <form method="POST" class="offset-md-3 col-md-6">
        <div class="form-group row">
            <label for="Institution" class="text-justify col-md-4 col-form-label">Institution</label>
            <div class="col-md-8">
                <input type="text" name="institution" class="form-control" id="Institution" value="<?php echo $institution; ?>" placeholder="" required/>
            </div>
        </div>
        <div class="form-group row">
            <label for="StudentResidence" class="text-justify col-md-4 col-form-label">Student Residence</label>
            <div class="col-md-8">
                <input type="text" name="studResid" class="form-control" id="StudentResidence" value="<?php echo $studResid; ?>" placeholder="" required/>
            </div>
        </div>
        <div class="form-group row">
            <label for="StreetNumber" class="text-justify col-md-4 col-form-label">StreetNumber</label>
            <div class="col-md-8">
                <input type="text" name="streetNo" class="form-control" id="StreetNumber" value="<?php echo $streetNo; ?>" placeholder="" required/>
            </div>
        </div>
        <div class="form-group row">
            <label for="City" class="text-justify col-md-4 col-form-label">City</label>
            <div class="col-md-8">
                <input type="text" name="city" class="form-control" id="City" value="<?php echo $city; ?>" placeholder="" required/>
            </div>
        </div>
        <div class="form-group row">
            <label for="Province" class="text-justify col-md-4 col-form-label">Province</label>
            <div class="col-md-8">
                <input type="text" name="province" class="form-control" id="Province" value="<?php echo $province; ?>" placeholder="" required/>
            </div>
        </div>
        <div class="form-group row">
            <label for="PostalCode" class="text-justify col-md-4 col-form-label">Postal Code</label>
            <div class="col-md-8">
                <input type="text" name="postal" class="form-control" id="Postal" value="<?php echo $postal; ?>" placeholder="" required/>
            </div>
        </div>

        <input type="hidden" name="update_id" value="<?php echo $modify_id; ?>">
        <input type="submit" name="update" value="Update" class="btn btn-warning"><br><br>
    </form>

<?php
    if(isset($_POST['update']) && $success){
        echo "<div class=\"alert alert-success\" role=\"alert\">Successfully updated record.</div>";
    }

    if(isset($_POST['update']) && !$success){
        echo "<div class=\"alert alert-danger\" role=\"alert\">Error: Record was not updated.</div>";
    }
?>

<?php include "inclusions/footer.inc.php"; ?>

<a href="/folder_view/vs.php?s=<?php echo __FILE__?>" target="_blank">View Source</a>
