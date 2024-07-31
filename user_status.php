<?php
include "connect_db.php";
$id = $_GET['id'];
$old_status = $_GET['status'];

if (isset($_POST['cancel'])) {
    echo '<script>window.location.href="user.php"</script>';
}

if (isset($_POST['change'])) {
    $new_status = ($old_status == 'yes') ? 'no' : 'yes';

    $query = "UPDATE users SET active = '$new_status' WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    if ($result) {
        echo '<script>window.location.href="user.php"</script>';
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }
}
?>