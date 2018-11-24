<?php
include "connect.php";
include "header.php";

$title = $_GET["title"];
$price = $_GET["price"];
//echo $title . " : " . $price;
?>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left"><?php echo $title ?> Performance Details</h2>
                </div>
                <?php
                // Attempt select query execution
                $sql = "SELECT * FROM Performance WHERE Performance.Title = '" . $title . "'";
                if($result = mysqli_query($conn, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Date</th>";
                        echo "<th>Time</th>";
                        echo "<th>Title</th>";
                        echo "<th>Action</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                            echo "<td>" . $row["PerfDate"] . "</td>";
                            echo "<td>" . $row["PerfTime"] . "</td>";
                            echo "<td>" . $row["Title"] . "</td>";
                            echo "<td>";
                            echo "<a href='seats.php?title=". $row['Title'] ."&price=". $price ."&perfDate=". $row['PerfDate'] ."&perfTime=". $row['PerfTime'] ."'><span class='glyphicon glyphicon-eye-open'></span></a>";
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
                    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                }

                // Close connection
                mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
</div>
