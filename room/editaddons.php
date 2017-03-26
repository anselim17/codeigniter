
<?php

include('../Class/addon.php');
include("../../connection.php");

$addItem=$_GET['additem'] ;
$addPrice=$_GET['addprice'] ;
$addQuantity=$_GET['addquantity'] ;
$addID=$_GET['addID'] ;

if ($addItem==''||$addPrice==''||$addQuantity==''){
  echo "<script>
  alert('Add On textbox is empty');
  window.location='manageroom.php';
  </script>";
}
else
{



/*$Addon= new Addon($addItem,$addPrice,$addQuantity);

      if ($Addon->addonUpdate())
            {
    
       echo "success";
      }
      else
      {
      echo "An error has occured during the operation",
      "Wesviewhotel";
      }
    }*/
    if (Addon::addonUpdate($addItem,$addPrice,$addQuantity,$addID)) {
      echo "<script>
      alert('Addon Succesfully updated');
      window.location='manageroom.php';
      </script>";
    }
  }
?>