<?php
include("con.php");

if (isset($_GET['state_id'])) {
    $state_id = intval($_GET['state_id']);
    $query = "SELECT * FROM district WHERE state_id = '$state_id' ORDER BY name";
    $result = mysqli_query($con, $query);

    echo '<option value="">--Select District--</option>';
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<option value="'.$row['id'].'">'.$row['name'].'</option>';
    }
}
?>
