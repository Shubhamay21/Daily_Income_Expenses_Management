<?php
include("conn.php");

$msg="";
$msg_name="";
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
    $validNum="/^[0-9 ]*$/";
    $validName="/^[a-zA-Z ]*$/";
    function test_input($data)
    {
       $data = trim($data);
       $data = stripslashes($data);
       $data = htmlspecialchars($data);
       return $data;
    }


   $num = $_POST["num"];
   $name = $_POST["name"];
   intval($num);
   if (empty($name))
   {
    $msg_name = "Fill out Input Field is Required";
    }
    else
   {
     $fname = test_input($name);
    if (!preg_match($validName,$fname))
       {  
           $msg_name = "Only Letters allowed"; 
       }
   }
   if (empty($num))
   {
    $msg = "Fill out Input Field is Required";
    }
    else
   {
     $fnum = test_input($num);
    if (!preg_match($validNum,$fnum))
       {  
           $msg = "Only Numbered allowed"; 
       }else{
        //    echo $num;
            $sql = "INSERT INTO exp(expenses,items) VALUES('$num','$name')";
            $result = mysqli_query($db_conn, $sql);
            if($result == TRUE)
            {
                // echo "Data Stored Successfully";
                header("location:exp.php");
                
                
            }else
            {
                echo "Error: " . $sql . "<br>" . mysqli_error($db_conn);
            }
            }
   }

    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body
    {
        /* background:whitesmoke; */
    }
    hr {
    overflow: visible; /* For IE */
    padding: 0;
    border: none;
    /* width:50px; */
    border-top: medium solid #333;
    color: #333;
   text-align: center;
        }
        hr:before {
            content: "";
            /* text-align: right; */
            /* width:100px; */
            display: inline-block;
            position: relative;
            top: -0.7em;
            font-size: 1.5em;
            padding: 0 0.25em;
            background: white;
        }
        .tag span
        {
            margin: -38px 60px;
            
            position: absolute;
        }
        input[type="text"]
        {
            padding: 6px 80px;
            margin: 10px 0px;
        }
        input[type="submit"]
        {
            padding: 5px 180px;
            margin: 10px 0px;
        }
        h2
        {
            text-align:center;
        }
        .form
        {
            margin: 40px 400px;
        }
        .field
        {
            margin-left: 50px;
            padding-top: 50px;
        }
        td
        {
            text-align:center;
        }
       .yes_pre
       {
        /* margin-left:-20px; */
       }
       .yes_pre span
       {
        padding: 0 38px;
       }
       label
       {
        color:dimgrey;
       }
    </style>
</head>
<body>
    <div class="container">
        <h2><u>Daily Income And Expense Management</u></h2>
        <div>
          
        <!-- <input type="range" min=0 max=1 value=50><br/>
         -->
        <div class="tag" style="position: relative;">
        <hr>
        <span id="date" style="padding: 23px 0px;margin: -40px 40px;"><?php $pre_yes_yes_day= date('Y-m-d', strtotime('-6 day'));
                                                                    echo $pre_yes_yes_day . "<br>";?></span>    
                                                                     <span><b>||</b></span>
        <span style="padding: 23px 40px;margin: -40px 190px;"><?php $pre_yes_pre= date('Y-m-d', strtotime('-5 day'));
                                                                    echo $pre_yes_pre . "<br>";?></span>
        <span style="margin:-38px 270px;"><b>||</b></span>
        <span style="padding: 23px 50px;margin: -40px 385px;"><?php $pre_yes_day= date('Y-m-d', strtotime('-4 day'));
                                                                    echo $pre_yes_day . "<br>";?></span>
        <span style="margin:-38px 470px;"><b>||</b></span>
        <span style="padding: 23px 40px;margin: -40px 588px;"><?php $pre_yes= date('Y-m-d', strtotime('-3 day'));
                                                                    echo $pre_yes . "<br>";?></span>
        <span style="margin:-38px 665px;"><b>||</b></span>
        <span style="padding: 23px 45px;margin: -40px 785px;width: 75px;"><?php $pre_day= date('Y-m-d', strtotime('-2 day'));
                                                                    echo $pre_day . "<br>";?></span>
        <span style="margin:-38px 865px;"><b>||</b></span>
        <span style="padding: 23px 25px;margin: -40px 985px;width: 75px;"><?php $yes_day= date('Y-m-d', strtotime('-1 day'));
                                                                    echo $yes_day . "<br>";?></span>
        <span style="margin:-38px 1045px;"><b>||</b></span>
        <span style="padding: 23px 0px;margin: -40px 1182px;width: 75px;"><?php $today= date('Y-m-d');
                                                                    echo $today . "<br>";?></span>
        <span style="margin:-38px 1220px;"><b>||</b></span>
        </br>
        <div>
                <?php
                     $fetch_sql = "SELECT * FROM exp";
                     $result = mysqli_query($db_conn,$fetch_sql);
                    
                    //  $i = 1;
                    $row = mysqli_num_rows($result);
                    // echo $row;
                    $expenses_today=0;
                    $expenses_yes=0;
                    $expenses_pre=0;
                    $expenses_pre_yes=0;
                    $expenses__pre_yes_pre=0;
                    $expenses__pre_yes_pre_yes=0;
                    $expenses_pre_yes_pre_day=0;
                    // $expenses_yester =0;
                    if($row>0)
                    {
                        while( $data = mysqli_fetch_array($result))

                        {
                            $date=  date('Y-m-d',strtotime($data['time_date']));
                            $exp = $data['expenses'];
                        //    echo $date;
                    
                        
                                // $current_date = date('Y-m-d');
                                
                                if($date == $today)
                                 {
                                    $expenses_today += $exp;
                                 }
                                else if($date == $yes_day){
                                      
                                   $expenses_yes += $exp;
                                   // $expenses_today += $exp;
                                    // print_r($expenses_pre);
                                    // echo "hello";
                                
                                }
                                else if($date == $pre_day){
                                    $expenses_pre += $exp;
                                    // print_r($expenses_pre);
                                    // echo "hello";
                                 }
                                else if($date == $pre_yes){
                                        $expenses_pre_yes += $exp;
                                        // echo $expenses_yester;
                                }
                                else if($date == $pre_yes_day){
                                    $expenses__pre_yes_pre += $exp;
                                    // echo $expenses_yester;
                                }
                                else if($date == $pre_yes_pre){
                                    $expenses__pre_yes_pre_yes += $exp;
                                    // echo $expenses_yester;
                                }
                                else if($date == $pre_yes_yes_day){
                                    $expenses_pre_yes_pre_day += $exp;
                                    // echo $expenses_yester;
                                }else
                                {
                                    // echo $expenses_yester;
                                }
                                

                    
                    }
                }
                    // //  echo $exp_date;
                  

                     
                      ?>
                 
                </div>
               
       
            <!-- <hr> -->
            <!-- <hr> -->
        <?php
        $sql_query = "SELECT SUM(expenses) FROM exp";
        $res = mysqli_query($db_conn,$sql_query);
        $data = mysqli_fetch_assoc($res);
        // print_r($data);
        foreach($data as $a => $key)
        {
            
        }
        ?>
        </div>
        

        <div class="yes_pre">
                <span>Previous day : <?php echo $expenses_pre_yes_pre_day?></span>
                <span>Previous day : <?php echo $expenses__pre_yes_pre_yes?></span>
                <span>Previous day : <?php echo $expenses__pre_yes_pre?></span>
                <span>Previous day : <?php echo $expenses_pre_yes?></span>
                <span>Previous day : <?php echo $expenses_pre?></span>
                <span>yesterday: <?php echo $expenses_yes?></span>
                <span>Today: <?php echo $expenses_today?></span><br/>
              
                
        </div>
        <span><button style="padding: 5px 35px;margin: 25px 40px;" ><a href="report.php" style="text-decoration: none;color: black;">Report</a></button></span>
       
        <h2 style="color:dimgrey;text-align: center;"><u>Daily-Expenses</u></h2>
        <form method="post" style="background:beige;border-radius: 100px;">   
        
            <div class="form">
            <h3 style="color:dimgrey;">
                <label><span><b>Enter items:</b></sapn></br>
                <input type="text" name="name" id="name" size="30" placeholder="Enter Items Name"><br/>
                </label>
                <span class="error" style="color: red;" aria-live="polite"><?php echo $msg_name?></span><br/>
                <br/>
                <label><span><b>Cost of items:</b></sapn></br>
                <input type="text" name="num" id="num" size="30" placeholder="Enter your number"><br/>
                </label>
                <span class="error" style="color: red;" aria-live="polite"><?php echo $msg?></span><br/>
                <br/>
              
                <input type="submit" name="btn" value="Submit"><br/><br/>
           
            </div>
        </form> 
           
        <div class="table" style="margin-top:20px;">
            <table border='1px' width='100%' height='100%' cellpadding='10%'>
                <thead>
                <tr>    
                    <th>id</th>
                    <th>Date</th>
                    <th>Items</th>
                    <th>Expenses Cost</th>
                </tr>
                <thead>
                    <?php
                    $fetch_sql = "SELECT * FROM exp";
                    $result = mysqli_query($db_conn,$fetch_sql);
                
                    $i = 1;
                    while( $data = mysqli_fetch_assoc($result)){
                    ?>
                <tbody>
                <tr>
                    <td><?php echo $i?></td>
                    <td><?php echo $data['time_date'];?></td>
                    <td><?php echo $data['items'];?></td>
                    <td><?php echo $data['expenses'];?></td>
                </tr>
                </tbody>
                <?php
                $i++;
                    }
                ?>
                <!-- <tfoot > -->
                    <tr>
                    <td colspan="3"><b>Grand Total:</b></td>
                    <td ><?php echo $key;?></td>
                    </tr>
                <!-- </tfoot> -->
                </table><br/>
            </div>
            <div class="field">
                <label><b>Expenses Total:</b></tabel><br>
                <input type="text" value="<?php echo $key?>"><br/>
                <?php
                   
                    $pastdate=  date("Y-m-d", strtotime(" -7 day")); 
                    $currentdate= date("Y-m-d");
                    $query2 = "SELECT SUM(expenses) as weeklyexpense FROM exp WHERE time_date between '$pastdate' and '$currentdate'";
                    $res = mysqli_query($db_conn,$query2);
                    $row =mysqli_fetch_array($res);
                    $weekly_expense = $row['weeklyexpense'];
                ?>
                <label><b>Weekly Total:</b></tabel><br>
                <input type="text" value="<?php echo $weekly_expense ?>">&nbsp;&nbsp;&nbsp;
             </div>
        </div>
    </div>
    <!-- <footer>
        <span style="background-color:black;"><p>Copyright:</p></span>
    </footer> -->
</body>
</html>