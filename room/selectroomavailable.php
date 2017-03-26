<html>
<body>
<?php
 session_start();
 include('../../connection.php'); // wa ni labot
 
 
if($_POST)
{
   $arrival=$_SESSION["arrival"];
   $departure=$_SESSION["departure"];
   $numberofdays=$_SESSION["numberofdays"];
$q=isset($_POST['searchroomavailable']) ? htmlspecialchars($_POST['searchroomavailable']) : ""; // tanang special characters, kay i convert pareha ani "&#32;"
                         
 $sql = "select tblrooms.Room_ID, tblrooms.Image, tblrooms.Status,tblcategories.CategoryName, tblrooms.Rate, tblrooms.Description,tblrooms.No_child,
         tblrooms.No_adult,tblrooms.Date_Start,tblrooms.Date_End,tblrooms.Discount  FROM tblrooms INNER JOIN tblcategories ON tblrooms.Category_ID=tblcategories.Category_ID 
          where   tblrooms.Room_ID NOT IN 
          (select Room_ID from tblreservation WHERE tblreservation.Reservation_ID is null
          OR tblreservation.Departure > '$arrival' AND tblreservation.Arrival < '$departure' AND
           Room_ID like ? || CategoryName like ? AND tblreservation.Status='Pending' AND tblreservation.Status!='Cancelled' AND tblreservation.Status!='Check Out') ";
           // ang mga ? kay i substitute sa $q
   
    $stmt = $conn->prepare($sql);
    if ($stmt) {
      $param = $q."%";
      $stmt->bind_param("ss", $param, $param); // since duha man ka '?', duha pud ka $param, nya $param gigamit kay pareha raman nang duha
    
      $stmt->execute(); // run ang query
      $stmt->store_result(); // par=a ni sa num_rows
      $stmt->bind_result($roomID, $roomImage ,$roomStatus, $roomCategoryname, $roomRate, $roomDescription, $noChild, $noAdult, $dateStart, $dateEnd, $roomDiscount);
       // kaning bind_result, dapat sequence ang order sa pag SELECT statement.. tan-awa gani... pwede ra ikay magbuot sa ngalan, basta mag sunod na sila 

      if ($stmt->num_rows > 0) {
        while ($stmt->fetch()) {
          // mas dali pa ni kaysa katong row['FirstName']
          if ($roomID==$q || $roomCategoryname==$q )
          {
         echo "
                <div class='row' style='margin-top:10px;' >
            <div class='col-md-1 text-center'>
                <p><i class='fa fa-camera fa-4x'></i></p>
            </div>
           <div class='col-md-5'>
                <a href='#".$roomID."".$noChild."' class='portfolio-link' data-toggle='modal'>
                    <img class='img-responsive img-hover'  src='../../adminpage/room/" .$roomImage. "' alt=''>
                </a>
            </div>
            <div class='col-md-6'>
                <h3>
                    Room Number: ".$roomID."</a>
                </h3>
                <p class='tooltip-demo'> <a href='#' class='btn btn-default btn-xs' data-target='moreinfo' data-toggle='modal'><i class='fa fa-search-plus ''></i> More information </a> ";
                 if (isset($_SESSION['Customerid'])) {
                    echo "<button value='".$roomID."'  class='Reserve btn btn-promo4 btn-sm' />Reserve</button>";
                } else {
                    echo "<a href='#portfolioModal1' class='portfolio-link btn btn-promo4 btn-sm' data-toggle='modal' />Reserve</a>";
                }
            echo "<p><ul class='nav'>
                <li>Status : ".$roomStatus." Room</li>
                <li>Room Type : ".$roomCategoryname."</li>
                <li>Room Rate : ".$roomRate."</li>
                <li>Room Description : ".$roomDescription."</li>
                <li>Max Child : ".$noChild."</li>
                <li>Max Adult : ".$noAdult."</li>";
                $promofrom = $dateStart;
                $promoto = $dateEnd;

                if ($arrival < $promoto && $departure > $promofrom  && $roomDiscount>0) {
                  echo "<li style='font-weight:bold'>Promo!</li>";
                  echo "<li>Discount : ".$roomDiscount."%</li>
                  <li>Promo Start : ".$dateStart."</li>
                  <li>Promo End : ".$dateEnd."</li>";
                }
                echo "</ul></p>
            </div>
        </div>
        

        <hr>";
        }
      }
    }

        else
        {
          echo "No Result Found";
        }
        
      }
    }
?>

        



