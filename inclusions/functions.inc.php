<?php
/**
 * Created by PhpStorm.
 * User: Maria Lilian Yang 101151657
 * Date: 2018-10-19
 * Time: 3:51 PM
 *
 * For importing a file, this system adds an id for every entry and takes out all the id's when exported.
 * When importing a file, take note it has to be the same number of rows from this system(6).
 *
 */


//Checks the string if the it contains any string within the $search
function str_contains($string, $search) {
    return stripos($string, $search) !== false;

}

//A function that returns a value if placed or the default ''
function requestValue($name, $default=''){

    return isset($_REQUEST[$name]) ? $_REQUEST[$name]: $default;

}

//Returns all the rows in the file
function getData()
{
    $file = fopen("uploads/energy.csv", "r");
    $all_rows = array();

    while (!feof($file)) {

        $header = fgetcsv($file);
        $all_rows[] = $header;

        while ($row = fgetcsv($file)) {

            $all_rows[] = $row;

        }
    }

    fclose($file);
    return $all_rows;

}

//A function that creates an ID
function getID(){
    $file_name ='uploads/ids.csv';

    if(!file_exists($file_name)) // if file not found
    {
        touch($file_name);

        $handle = fopen($file_name,'r+'); // opens the file.
        $id= 0; //sets the id to 0

    }else{
        $handle =fopen($file_name,'r+'); // opens the file
        $id = fread($handle,'10000');

        settype($id,"integer"); //sets the type of variable

    }
    rewind($handle);

    fwrite($handle,++$id);
    fclose($handle);
    return $id;

}

//A function that reads an uploaded file and appends to the current file
function appendData(){

    $uploaded_file = isset($_FILES['file']['tmp_name']) ? $_FILES['file']['tmp_name']: '';
    $success = false;
    if ( $uploaded_file ) {

        $uploaded_handle = fopen( $uploaded_file, 'r' );
        $current_handle = fopen('uploads/energy.csv', 'a+');


        $up_handle = fgetcsv($uploaded_handle);
        $num = count($up_handle);

        if($num == 6) {


            while (!feof($uploaded_handle)) {

                $row = fgetcsv($uploaded_handle);

                if ($row) {
                    $id = getID();
                    array_unshift($row, $id);
                    fputcsv($current_handle, $row);
                }
            }
            $success = true;
        }

        fclose($uploaded_handle);
        fclose($current_handle);

    }

    return $success;
}

//Creates or adds a new entry to the current file when fields are completely entered
function addData(){

    if ( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

        $id = getID();
        $institution = requestValue('institution',"");
        $studResid = requestValue('studResid',"");
        $streetNo = requestValue('streetNo',"");
        $city = requestValue('city',"");
        $province = requestValue('province',"");
        $postal = requestValue('postal',"");

        if(!empty($institution) && !empty($studResid) && !empty($streetNo) && !empty($city) && !empty($province)
            && !empty($postal)){ //But if null don't append
            $user = array($id, $institution, $studResid, $streetNo, $city, $province, $postal);

            $file = fopen("uploads/energy.csv","a");
            fputcsv($file, $user);
            fclose($file);

        }


        return $id;
    }

}

//A bootstrap 4 modal for delete function
function deleteModal($delete_id, $modalId){
?>
    <!-- Modal -->
    <div class="modal fade" id="<?php echo $modalId;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Record</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this record?

                </div>
                <div class="modal-footer">
                    <form method="GET">

                        <input type="hidden" name="id" value="<?php echo $delete_id; ?>">

                        <button type="submit" name="delete" class="btn btn-primary" value="Delete">Delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
    <?php

}

//Deletes an entry of a file when called
function deleteId($delete_id){

    $new_all_rows = array();
    $handle = fopen("uploads/energy.csv", "r");
    $header = fgetcsv($handle); //header for the info.csv
    $new_all_rows[] = $header;
    $success = false;

    while ($row = fgetcsv($handle)) {

        if ( $row[0] == $delete_id ) {
            $success = true;
            continue;
        } else {
            $new_all_rows[] = $row;
        }
    }
    fclose($handle);


    $file = fopen("uploads/energy.csv","w");
    foreach ( $new_all_rows as $new_row ) {
        fputcsv($file, $new_row);
    }
    fclose($file);

return $success;

}

//Checks the file for all the user's search string
function searchId($search)
{
    if (!empty($search)) {
        $all_rows = array();
        $search_key = array();
        $handle = fopen("uploads/energy.csv", "r");
        $header = fgetcsv($handle);

        while ($row = fgetcsv($handle)) {
            $all_rows[] = array_combine($header, $row);


            if (str_contains($row[1], $search) || str_contains($row[4], $search)) {
                $search_key[] = count($all_rows) - 1;

            }
        }
        fclose($handle);
        return $search_key;
    }

}

//Function that returns all rows with keys
function allRowsWithKeys()
{
    $all_rows = array();
    $handle = fopen("uploads/energy.csv", "r");
    $header = fgetcsv($handle); //header for the info.csv /as keys /1st fgetcsv

    while ($row = fgetcsv($handle)) { // 2nd fgetcsv /ends when all rows are converted to assoc arrays
        $all_rows[] = array_combine($header, $row);//Creates an array by using the values from the keys array as keys

    }
    fclose($handle);
    return $all_rows;

}

//Readies the file for export
function exportData()
{
    $file = fopen("uploads/energy.csv", "r");
    $all_rows = array();

    while (!feof($file)) {

        $header = fgetcsv($file);
        array_shift($header);

        $all_rows[] = $header;

        while ($row = fgetcsv($file)) {
            array_shift($row);
            $all_rows[] = $row;
        }


    }
    fclose($file);

    $temp_file= 'uploads/energy_export_file.csv';
    if(!file_exists($temp_file)) {
        touch($temp_file);
        $handle = fopen($temp_file, 'w');

    }else{
        $handle = fopen($temp_file, 'w');
    }

    foreach ( $all_rows as $new_row ) {
        fputcsv($handle, $new_row);
    }
    fclose($handle);

}

//Updates the file when called
function updateData()
{
    if (isset($_POST['update'])) {
        $modify_id = requestValue('update_id');
        $institution = requestValue('institution');
        $studResid = requestValue('studResid');
        $streetNo = requestValue('streetNo');
        $city = requestValue('city');
        $province = requestValue('province');
        $postal = requestValue('postal');
        $success = false;

        if (!empty($institution) && !empty($studResid) && !empty($streetNo) && !empty($city) && !empty($province) && !empty($postal)) { //But if null write
            $newData = array($modify_id, $institution, $studResid, $streetNo, $city, $province, $postal);

            $new_all_rows = array();
            $handle = fopen("uploads/energy.csv", "r");
            $header = fgetcsv($handle); //header for the info.csv
            $new_all_rows[] = $header;


            while ($row = fgetcsv($handle)) {

                if ($row[0] == $modify_id) {
                    $new_all_rows[] = $newData;
                } else {
                    $new_all_rows[] = $row;
                }
            }
            fclose($handle);


            $file = fopen("uploads/energy.csv", "w");
            foreach ($new_all_rows as $new_row) {
                fputcsv($file, $new_row);
            }
            fclose($file);

            $success = true;
        }

        return $success;
    }

}

//Gets the search_key for modification, when key is returned it is used for the page to be able to output the fields
function getSearchKeyToModify($modify_id){
    $all_rows = array();
    $search_key = -1;
    $handle = fopen("uploads/energy.csv", "r");
    $header = fgetcsv($handle); //header for the info.csv

    $all_rows[] = $header;
    while ($row = fgetcsv($handle)) {

        $all_rows[] = $row;
        if( str_contains($row[0], $modify_id) ){ //If found
            $search_key = count( $all_rows ) - 1; // $get the count of all rows so far and -1 to get the ID.
            //$search_key = stores the index of the item to be replaced
            break; //breaks when key is found
        }
    }

    return $search_key;
}

//Pagination
//For start index and end Index
function startIndex($recordsPerPage,$pageNo){
    if ($pageNo == 1) {

        $startIndex = 1;

    } else {

        $startIndex = ($pageNo - 1) * $recordsPerPage;
        $startIndex += 1;
    }
    return $startIndex;

}

function endIndex($recordsPerPage,$pageNo){
    if ($pageNo == 1) {

        $endIndex = $recordsPerPage;

    } else {

        $startIndex = ($pageNo - 1) * $recordsPerPage;
        $endIndex = $startIndex + ($recordsPerPage);
    }
    return $endIndex;

}

//For number of pages
function numPages($all_rows, $recordsPerPage){
    $rows_total = count($all_rows);

    if(($rows_total % $recordsPerPage) == 0){

        $number_of_pages= $rows_total / $recordsPerPage;
    }else{

        $number_of_pages= $rows_total / $recordsPerPage;
        $number_of_pages += 1;
    }
    return $number_of_pages;

}

?><a href="/folder_view/vs.php?s=<?php echo __FILE__?>" target="_blank">View Source</a>
