
<?php
session_start();
error_reporting(0);
include("../../connection.php");
    if ($_POST)
    { 
    $fromdate=$_POST['searchstartdate']; 
    $todate=$_POST['searchenddate']; 

    $searchstartdate = \DateTime::createFromFormat('d/m/Y', $fromdate)->format('Y-m-d');
    $searchenddate= \DateTime::createFromFormat('d/m/Y', $todate)->format('Y-m-d');



      $sql = "select tblrooms.Room_ID, tblcategories.CategoryName, tblrooms.Category_ID, 
      tblrooms.Rate,tblrooms.Discount, tblrooms.Description, tblrooms.Status,tblrooms.No_adult,tblrooms.No_child,tblrooms.Date_Start,tblrooms.Date_End,tblrooms.Image 
      FROM tblrooms INNER JOIN 
      tblcategories ON tblrooms.Category_ID=tblcategories.Category_ID WHERE Room_ID NOT IN
      (select Room_ID from tblreservation WHERE Reservation_ID is null
      OR Departure > '".$searchstartdate."' AND Arrival < '".$searchenddate."' AND tblreservation.Status!='Cancelled' AND tblreservation.Status!='Check Out'
        Union
      select Room_ID from tblwalkins WHERE Customer_ID is null
      OR Departure >= '".$searchstartdate."' AND Arrival <= '".$searchenddate."') ORDER by tblrooms.Date_Start ASC";
           
                                     $result = mysqli_query($conn,$sql) or die(mysqli_error($conn));

                                    while($row=mysqli_fetch_assoc($result)) {
                                    $arrival=date_create($row['Date_Start']);
                                    $departure=date_create($row['Date_End']);    
                                echo "<div class='table-responsive' style='overflow:auto'>";
                                echo "<table class='table table-striped'>";

                                     echo "<tbody><tr>
                                     <td>" .$row["Room_ID"]. "</td>
                                     <td> ".$row["CategoryName"]. "</td>
                                     <td> ".$row["Rate"]. "</td>
                                     <td> ".$row["Discount"]. "%</td>
                                     <td> ".$row["Description"]. "</td>
                                     <td> ".$row["Status"]. "</td>
                                     <td> ".$row["No_adult"]. "</td>
                                     <td> ".$row["No_child"]. "</td>";
                                     if ($row['Date_Start']==""  || $row['Date_Start']=="0000-00-00")
                                     {
                                        echo "<td>No set Promo</td>";
                                     }
                                     else
                                     {
                                      echo "<td> ".date_format($arrival,"Y/m/d"). "</td>";
                                       
                                     }
                                  if ($row['Date_End']=="" || $row['Date_Start']=="0000-00-00" )
                                     {
                                        echo "<td>No set Promo</td>";
                                     }
                                     else
                                     {
                                       
                                         echo "<td> ".date_format($departure,"Y/m/d"). "</td>";
                                       
                                     }

                                    echo "<td><a rel='facebox'  href='editpic.php?id=". $row['Room_ID']."'><img id='imagelist' style='border: thin solid silver;float: left;padding: 5px;width: 70px;height: 70px;margin: 0 5px 0 0;' src=".$row['Image']. "></td>
                                     <td><a href='#' style='color:#23527C;' onclick='deleteRoom(".$row['Room_ID'].")' data-toggle='modal' data-target='#deleteroom' class='fa fa-times'> Delete</a>
                                     <a href='editroomdetails.php?cid=". mysqli_real_escape_string($conn, $row['Room_ID'])."' style='color:#23527C;' class='fa fa-gear' class='editcategory'>Edit</a></td>
                                     </tr></tbody></table>
                                     </div>
                                     </div>";
                                   }
                               }
                                     else
                                     {
                                        echo "";
                                     }
         
       ?>                      



