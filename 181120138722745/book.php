<?php
include "connect.php";
include "header.php";

$rowNumbers = $_POST['rowNumbers'];
$email = $_POST['email'];
$total = $_POST['totalPrice'];
$prefDate = $_POST['prefDate'];
$prefTime = $_POST['prefTime'];

//print_r($rowNumbers);
//echo $email.$prefDate.$prefTime.$total;

$rowNumberArray = array();
$pushedRow = 0;

foreach ($rowNumbers as $rowNumber){
    $elements =  explode("_",$rowNumber);
    array_push($rowNumberArray,$elements[0]);
    $sql = "INSERT INTO Booking VALUES ('".$email."','".$prefDate."','".$prefTime."','".$elements[0]."')";
    if (mysqli_query($conn, $sql)) {
        $pushedRow = $pushedRow + 1;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Booking Confirmation</h2>
                </div>
                <?php
                    if($pushedRow === count($rowNumberArray,COUNT_NORMAL)){
                        echo "<h2>Booking Confirmed for $pushedRow Seats !!</h2>";
                    }
                ?>
            </div>
        </div>
    </div>
</div>

