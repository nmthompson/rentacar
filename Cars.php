<?php
require_once 'connection.php';
include "sanitization.php";
session_start();

$car = "";

$data = $_POST['search_field'];

if (isset($_POST['type']) && is_session_active()){
    $type = sanitizeMYSQL($connection, $_POST['type']);
    
    switch($type){
        case "search_results": //search fully works when not in switch
            if(isset($_POST['search_field']) && trim($_POST['search_field']) != ""){    
                $query = "SELECT * FROM carspecs INNER JOIN car ON carspecs.ID = car.CarSpecsID WHERE carspecs.Make LIKE '%$data%' OR Model LIKE '%$data%' OR Year LIKE '%$data%' OR Size LIKE '%$data%' OR Color LIKE '%$data%' AND car.status = 1";
                $result = mysqli_query($connection, $query);    
                $row_count = mysqli_num_rows($result);
                $car.="<select><option value='' disabled selected>Sort By:</option><option value='year'>Year</option><option value='make'>Make</option></select>";
                for($j = 0; $j < $row_count; ++$j){
                    $row = mysqli_fetch_array($result);
                    $car.=display_car($row);
                }
                echo $car;
            }
            break;
        case "rented_cars": //from here on this is just test code until the switch gets working
            $query ="SELECT * FROM rental WHERE rental.status = 2";
            $result = mysqli_query($connection, $query);
            $row_count = mysqli_num_rows($result);
            for($j = 0; $j < $row_count; ++$j){
                $row = mysqli_fetch_array($result);
                $car.=display_rented($row);
            }            
            echo $car;
            break;
        case "returned_cars":
            $query ="SELECT * FROM rental WHERE rental.status = 2";
            $row_count = mysqli_num_rows($result);
            for($j = 0; $j < $row_count; ++$j){
                $row = mysqli_fetch_array($result);
                $car.=display_returned($row);
            }    
            echo $car;
            break;
        case "logout":
            logout();
            echo "success";
            break;
       
    }
}

//
//$query ="SELECT * FROM rental WHERE rental.status = 2";
//$result = mysqli_query($connection, $query);
//$row_count = mysqli_num_rows($result);
//for($j = 0; $j < $row_count; ++$j){
//    $row = mysqli_fetch_array($result);
//    $rent.=display_rented($row);
//}
//echo $rent;
//request for username
//request ogfr searching(on demand)
//rental history
//current rentals
//return car - send rental_id
//rent car - by id
function is_session_active() {
    return isset($_SESSION) && count($_SESSION) > 0 && time() < $_SESSION['start']+60*5; //check if it has been 5 minutes
}
function display_car($row){
    $car.="<div class='search_item'>";
    $car.='<img src="data:' .$row["picture_type"] . ';base64,' . base64_encode($row["picture"]) . '">';
    $car.="<div class='car_make_background'>";
    $car.='<div class="car_make">' .$row["Make"] . '</div>';
    $car.='<div class="car_model">' .$row["Model"] .' | '.$row["Year"]. '</div>';
    $car.='</div>';
    $car.='<div class="car_size">Size: '.$row["Size"] .'</div>';
    $car.='<div class="car_color">Color: '.$row["Color"] . '</div>';
    $car.='<div class="car_rent">Rent Car</div>';
    $car.="</div>";
    return $car;
}
function display_rented($row){
    $rent.="<div>Hello</div>";
    return $rent;
}
?>


