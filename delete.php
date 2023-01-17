<?php 
$con = mysqli_connect('localhost', 'root', '', "test");

if (isset($_POST['delete-multiple-products']) && isset($_POST['deleteId']))
{
    $all_id = $_POST['deleteId'];
    $extract_id = implode(',' , $all_id);

    foreach ($all_id as $i => $all_id) {
        $query = "DELETE FROM product WHERE id = $all_id";
        
        $query_run = mysqli_query($con, $query);
    }

    header("Location: index.php");
} else {
    header("Location: index.php");
};

?>