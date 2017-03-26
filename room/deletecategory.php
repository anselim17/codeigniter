<?php 
include('../../connection.php');
include('../Class/categories.php');
include('../Class/room.php');
if (isset($_GET['categoryname']))
{
    $categoryname=$_GET['categoryname'];

            if (!Category::CAtegoryEmpty($categoryname))
            {
                echo '<script type="text/javascript">';
                echo 'alert("This Category has still rooms. please delete all rooms before removing the Category");';
                echo 'window.location.href = "manageroom.php";';
                echo '</script>';
              }

            else
            {
            $Category= new Category(Category::GetCategoryID($categoryname),$categoryname);


    
        if ($Category->DeleteCategory())
        {
        echo "success";
        header('Location: manageroom.php');
        }
}
}
?>