<?php
    include "connect.php";
    include "header.php";
?>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header clearfix">
                    <h2 class="pull-left">Production Details</h2>
                </div>
                <?php
                // Attempt select query execution
                $sql = "SELECT * FROM Production";
                if($result = mysqli_query($conn, $sql)){
                    if(mysqli_num_rows($result) > 0){
                        echo "<table class='table table-bordered table-striped'>";
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>Title</th>";
                        echo "<th>Price</th>";
                        echo "<th>Action</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                            echo "<td>" . $row["Title"] . "</td>";
                            echo "<td>" . $row["BasicTicketPrice"] . "</td>";
                            echo "<td>";
                            echo "<a href='perf.php?title=". $row['Title'] ."&price=". $row['BasicTicketPrice'] ."'><span class='glyphicon glyphicon-eye-open'></span></a>";
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
<?php
//    if (mysqli_num_rows($result) > 0) {
//        // output data of each row
//        while($row = mysqli_fetch_assoc($result)) {
////            print_r($row);
//            echo "id: " . $row["Title"]. " - Name: " . $row["BasicTicketPrice"]. " <br>";
//        }
//    } else {
//        echo "0 results";
//    }
//    $conn->close();
//
//    ?>
<!--    </form>-->
