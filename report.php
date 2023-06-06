<?php
include('conn.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body{
            /* background-color:ghostwhite; */

        }
         input[type="date"]
        {
            padding: 5px 60px;
            margin: 17px 10px;
        }
        input[type="submit"]
        {
            padding: 5px 100px;
            margin: 10px 0px;
        }
        h2
        {
            text-align: center;
        }
    </style>
</head>
<body>
    <h2><u>Cost Expenses Report</u></h2>
    <form method="post">
            <div class="cal">
                <label><b>From:</b><input type="date" name="datestart" >
                </label>
                <label><b>To:</b><input type="date" name="dateend" >
                </label>
                <input type="submit" name="btn" value="Submit" >
                <button style="padding:5px 25px;"><a href="exp.php" style="text-decoration:none;color:black;">Back</a></button>
            <div>
           
            

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
                    if ($_SERVER["REQUEST_METHOD"] == "POST")
                    {
                    //    $start = $_POST['datestart'];
                    //    $end = $_POST['dateend'];
                    //    echo $start." ".$end;
                    $start= date('Y-m-d',strtotime($_POST['datestart']));
                    $end= date('Y-m-d',strtotime($_POST['dateend']));
                    
                    // $fetch_sql = "SELECT * FROM exp";
                    // $result = mysqli_query($db_conn,$fetch_sql);
                    // $data = mysqli_fetch_assoc($result);
                  
                    $i = 1;
                    // while( $data = mysqli_fetch_assoc($result)){
                    //     $date= date('Y-m-d',strtotime($data['time_date']));
                     
                        //   echo $date;
                       
                        // }
                        if($start!=='' && $end!='')
                        {
                          $sql= "SELECT * FROM exp WHERE time_date between '$start' and '$end'";
                        //   echo $data;
                        $res = mysqli_query($db_conn,$sql);
                        // echo $res;
                         while($row = mysqli_fetch_assoc($res))
                         {
                        //   echo $row
                        // echo $row['time_date'];
                
                        ?>
                    <tbody>
                    <tr>
                        <td><?php echo $i?></td>
                        <td><?php echo $row['time_date'];?></td>
                        <td><?php echo $row['items'];?></td>
                        <td><?php echo $row['expenses'];?></td>
                    </tr>
                    </tbody>
                    <?php
                    $i++;
                         }
                      }
                    }
                // }
                        // }
                    ?>

                    <?php 

                    ?>
                   <!-- <tfoot > -->
                        <!-- <tr>
                        <td colspan="3"><b>Grand Total:</b></td>
                        <td ><?php echo $key;?></td>
                        </tr> -->
                    <!-- </tfoot> -->
                </table><br/>
               </div>

    </form>
</body>
</html>
          