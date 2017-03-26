

<?php

include('../Class/addon.php');
include("../../connection.php");

$item=$_POST['item'] ;
$price=$_POST['price'] ;
$quantity=$_POST['quantity'] ;


if ($item==''){
  echo 'Item is required';
}
else if ($price=='')
{
  echo 'Price is required';
}
else if ($quantity=='')
{
  echo 'Quantity is required';
}
else
{

$Addon= new Addon($item,$price,$quantity);

      if ($Addon->Addon())
            {
    
       echo "true";
      }
  
}
?>