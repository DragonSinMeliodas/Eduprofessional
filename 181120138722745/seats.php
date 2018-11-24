<?php
include "connect.php";
include "header.php";

$title = $_GET["title"];
$price = $_GET["price"];
$perfDate = $_GET["perfDate"];
$perfTime = $_GET["perfTime"]

//echo $title . " : " . $price;

//$sql = "Select Seat.RowNumber, Seat.Zone, Zone.Name, Zone.PriceMultiplier*15.00 from Seat , Zone Where Zone.Name = Seat.Zone AND Seat.RowNumber NOT IN (SELECT Booking.RowNumber From Booking where PerfDate='2017-11-01' AND PerfTime='19:00:00')";

?>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Seats Details</h2>
                </div>
                <form action="book.php" method="post">
                    <div class="row">
                        <div class="col-md-6">
                <?php
                // Attempt select query execution
                $sql = "Select Seat.RowNumber, Seat.Zone, Zone.Name, Zone.PriceMultiplier*$price as Price from Seat , Zone Where Zone.Name = Seat.Zone AND Seat.RowNumber NOT IN (SELECT Booking.RowNumber From Booking where PerfDate='".$perfDate."' AND PerfTime='".$perfTime."')";
                if($result = mysqli_query($conn, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Row Number</th>";
                        echo "<th>Zone</th>";
                        echo "<th>Price</th>";
                        echo "<th>Action</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                            echo "<td>" . $row["RowNumber"] . "</td>";
                            echo "<td>" . $row["Zone"] . "</td>";
                            echo "<td>" . round($row["Price"]) . "</td>";
                            echo "<td>";
                            echo "<input type='checkbox' name='rowNumbers[]' value='".$row["RowNumber"]."_".round($row["Price"])."' onchange='checkFunction()'/>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else{
                        echo "<p class='lead'><em>No records were found.</em></p>";
                    }
                } else{
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
                }

                // Close connection
                mysqli_close($conn);
                ?>
                        </div>
                        <div class="col-md-6">
                            <?php echo "<input type='hidden' name='prefDate' value='$perfDate'>"; ?>
                            <?php echo "<input type='hidden' name='prefTime' value='$perfTime'>"; ?>
                            <?php echo "<input type='hidden' name='totalPrice'>"; ?>
                            <div class="form-group">
                                Email = <input type="email" name="email" required \>
                            </div>
                            <div class="form-group">
                                Total = <input type="text" name="total" id="total" disabled>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Book">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    var totalPrice = 0;
    function checkFunction(){
        totalPrice = 0;
        var cboxes = document.getElementsByName('rowNumbers[]');
        var len = cboxes.length;
        for (var i=0; i<len; i++) {
            if(cboxes[i].checked){
                calculatePrice(cboxes[i].value)
            }
        }
        document.getElementById('total').value = totalPrice;
        document.getElementById('totalValue').value = totalPrice;
    }
    
    function calculatePrice(data) {
        let dataArray = data.split("_");
        totalPrice = totalPrice + parseInt(dataArray[1]);
    }
</script>