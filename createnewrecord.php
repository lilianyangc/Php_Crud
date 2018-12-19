<?php
/**
 * Created by PhpStorm.
 * User: Lilian
 * Date: 2018-10-05
 * Time: 4:12 PM
 *

 */
include "inclusions/header.inc.php";

$isSubmit = requestValue('submit');

if(isset($_POST['submit'])){

    $id = addData();

}

$institution = requestValue('institution');
$studResid = requestValue('studResid');
$streetNo = requestValue('streetNo');
$city = requestValue('city');
$province = requestValue('province');
$postal = requestValue('postal');
?>
<br><br>
<h1 class="display-4"> Create a new record:</h1>
<br><br>
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


    <input type="submit" name="submit" value="Create" class="btn btn-primary"><br><br>
    <?php
        if($isSubmit && ($id != -1)){
            echo "<div class=\"alert alert-success\" role=\"alert\">Successfuly created new entry!</div>";
        }

        if($isSubmit && ($id == -1) ){
            echo "<div class=\"alert alert-danger\" role=\"alert\">Please place correct input.</div>";
        }
    ?>
</form>

<?php



?>


<?php include "inclusions/footer.inc.php"; ?>
<a href="/folder_view/vs.php?s=<?php echo __FILE__?>" target="_blank">View Source</a>

