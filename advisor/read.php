<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/advisor.php';

// instantiate database and advisor object
$database = new Database();
$db = $database->getConnection();

// initialize object
$advisor = new Advisor($db);

// query advisors
$stmt = $advisor->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {

    // advisors array
    $advisors_arr = array();
    $advisors_arr["records"] = array();

    // retrieve our table contents
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $advisor_item = array(
            "id" => $id,
            "name" => $name,
            "area" => html_entity_decode($area),
        );

        array_push($advisors_arr["records"], $advisor_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show advisors data in json format
    echo json_encode($advisors_arr);
}

else{
 
   // set response code - 404 Not found
   http_response_code(404);

   // tell the user no advisors found
   echo json_encode(
       array("message" => "No advisors found.")
   );
}
