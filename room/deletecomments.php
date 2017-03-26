<?php 
include('../../connection.php');
include('../class/addon.php');
if (isset($_GET['commentid']))
{
    $comment_ID=$_GET['commentid'];
    
        if (Addon::commentDelete($comment_ID)) {
            header('Location: comments.php');

        } else {
            echo '<script type="text/javascript">';
            echo 'alert("Error");';
            echo 'window.location.href = "comments.php";';
            echo '</script>';
        }
}
//
?>