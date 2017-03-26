            <?php
              include("../../connection.php");
              session_start();
            if ($_POST)
            {

              $d = new DateTime();
              $date = $d->format('Y-m-d');
            $searchroomid=$_POST['searchroomid'];
            $arrival =$_SESSION['date']['arrival'];
            $departure =$_SESSION['date']['departure'];

              $s = \DateTime::createFromFormat('Y-m-d', $arrival);
              $e = \DateTime::createFromFormat('Y-m-d', $departure);
              $start = $s->format('Y-m-d');
              $end = $e->format('Y-m-d');
              $from=date_create($start); //sa arrival ug departure ni na date
              $to=date_create($end);

            $numberofdays =$_SESSION['date']['numberofdays'];





                $sql = "select tblcategories.CategoryName, tblrooms.Room_ID,tblrooms.Rate,tblrooms.Discount,tblrooms.Date_Start,tblrooms.Date_End,tblrooms.No_adult,tblrooms.No_child from tblrooms inner join tblcategories on  tblrooms.Category_ID=tblcategories.Category_ID
                            where tblrooms.Room_ID='".$searchroomid."'";






               $result = mysqli_query($conn, $sql) or die (mysqli_error($conn));

               while($row=mysqli_fetch_array($result)){


            $rate=$row['Rate'];
            $payable=  $rate * $numberofdays;
            $total=$payable;
            $promofrom = $row['Date_Start'];
            $promoto=$row['Date_End'];



            echo "<div>";
            echo "<p><i><b>Room Category</b></i><input class='form-control' type='text' name='categoryname' id='categoryname' value=".$row['CategoryName']." readonly> </p>";
            echo "<p><input type='hidden' name='roomid' id='roomid' value=".$row['Room_ID']." > </p>";
            echo "<p><input type='hidden' name='start' id='arrival' value=" .$arrival."> </p>";
            echo "<p><input type='hidden' name='end'  id='departure' value=" .$departure."></p>";
            echo "<p><input type='hidden' name='numberofdays'  id='numberofdays' value=".$numberofdays."></p>";
            echo "<p><select class='form-control' name='nadult' id='nadult'>";
            echo "<option value=''>choose the number of Adult</option>";
                for($adult=0; $adult<=$row["No_adult"]; $adult++)
                {
                    echo "<option value=".$adult.">$adult</option>";
                }
                        echo "</select></p>";

            echo "<p><select  class='form-control' name='nchild' id='nchild'>";
            echo "<option value=''>choose the number of Child</option>";
                for($child=0; $child<=$row["No_child"]; $child++)
                {
                    echo "<option value=".$child.">$child</option>";
                }
                        echo "</select></p>
            </div>";
            if($row['Discount']==0 )
            {
            echo "<p><i><b>Total Amount</b></i><input class='form-control' type='text' name='total' id='total' value=" .$total." readonly></p></div>";
            }
            else if ($arrival >= $promofrom && $departure <= $promoto  &&  $row['Discount']>0) // ang promo naunung xa arrival to departure
            {
              $percent=$row['Discount']; //10%
              $payable=  $rate * $numberofdays; //1000
              $discount=($payable/100) * $percent ;//.04 percent/100
              $finaltotal= $payable-$discount;
              $total=$finaltotal;

             echo "<p><i><b>Total Amount</b></i><input class='form-control' type='text' name='total' id='total' value=".$total." readonly></p>";
            }
            else if ($arrival < $promoto && $departure >$promofrom && $departure<=$promoto  && $row['Discount']>0) // kutob ra xa cuurentpromo departure date
            {
             $currentstartdate = \DateTime::createFromFormat('Y-m-d', $promofrom);
            $currentenddate = \DateTime::createFromFormat('Y-m-d', $promoto);

            $startdate=$currentstartdate->format('Y-m-d');
            $enddate=$currentenddate->format('Y-m-d');

            $from2=date_create($startdate);
            $to2=date_create($enddate);
            $diff2= date_diff($from, $from2);// gkuha ni nako xa arrival na date ug promo date start para xa pag total xa adlaw
            $diff3= date_diff($from2, $to); // gkuha ni nako xa promo date start na date ug promo date end para xa pag total xa adlaw


            $Numberofdays2 = $diff2->d; //days xa arrival ug  promo start date
            $Numberofdays3 = $diff3->d; //days xa promo start date ug  departure



              $percent=$row['Discount']; //10%
              $payable=  $rate * $Numberofdays2; //1000
              $promo=$rate * $Numberofdays3;
              $discount=($promo/100) * $percent ;//.04 percent/100
              $totaldiscount=$promo-$discount;
              $total=$payable + $totaldiscount;

               echo "<p><i><b>Total Amount</b></i><input class='form-control' type='text' name='total' id='total' value=".$total." readonly></p>";
            }
            else if ($arrival < $promoto && $departure > $promofrom  && $row['Discount']>0)// natunong xa promo pero mulapas apilon ug kwenta ang wala natunong xa promo
            {

               $currentstartdate = \DateTime::createFromFormat('Y-m-d', $promofrom);
            $currentenddate = \DateTime::createFromFormat('Y-m-d', $promoto);

            $startdate=$currentstartdate->format('Y-m-d');
            $enddate=$currentenddate->format('Y-m-d');

            $from2=date_create($startdate);
            $to2=date_create($enddate);
            $diff2= date_diff($from, $from2);// gkuha ni nako xa arrival na date ug promo date start para xa pag total xa adlaw
            $diff3= date_diff($to2, $to); // gikuha ni nako xa promo date end date ug departure para xa pagcompute xa adlaw
            $diff4= date_diff($from2, $to2);// gikuha nu nako xa  promo date start ug promo date end para makuha nako ang total xa adlaw

            $Numberofdays2 = $diff2->d;
            $Numberofdays3 = $diff3->d;
            $Numberofdays4 = $diff4->d;


              $percent=$row['Discount']; //10%
              $datestart=  $rate * $Numberofdays2; //1000
              $dateend=$rate * $Numberofdays3;
              $promo=$rate * $Numberofdays4;
              $discount=($promo/100) * $percent ;//.04 percent/100
              $totaldiscount=$promo-$discount;
              $total=$datestart + $dateend + $totaldiscount;
             echo "<p><i><b>Total Amount</b></i><input class='form-control' type='text' name='total' id='total' value=".$total." readonly></p>";
            }
            else
            {
              echo "<p><i><b>Total Amount</b></i><input class='form-control' type='text' name='total' id='total' value=" .$total." readonly></p></div>";
            }

            echo "<div class='modal-footer'>";
            echo "<p><input type='button' name='reserve' class='btn btn-primary' value='Reserve'  onclick='validReserve()'' ></p></div>";
            
              }
              mysqli_close($conn);
            }
            ?>
            <script>
                var num = <?php echo $total ?>;
                var n = num.toFixed(2)
                document.getElementById("total").value= n;
            </script>
