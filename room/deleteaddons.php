<?php 
include('../../connection.php');
include('../Class/addon.php');
if (isset($_GET['id']))
{
    $addon_id=$_GET['id'];
    
        if (Addon::AddonsDelete($addon_id)) {
            header('Location: manageroom.php');

        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Error");';
            echo 'window.location.href = "manageroom.php";';
            echo '</script>';
        }
}
//
?>