<?php

/*** begin the session ***/
session_start();

if(!isset($_SESSION['user_id']))
{
    $message = 'You must be logged in to access this page';
}
else
{
    try
    {
        /*** connect to database ***/
        /*** mysql hostname ***/
        $mysql_hostname = 'localhost';

        /*** mysql username ***/
        $mysql_username = 'root';

        /*** mysql password ***/
        $mysql_password = '';

        /*** database name ***/
        $mysql_dbname = 'test';


        /*** select the users name from the database ***/
        $dbh = new PDO("mysql:host=$mysql_hostname;dbname=$mysql_dbname", $mysql_username, $mysql_password);
        /*** $message = a message saying we have connected ***/

        /*** set the error mode to excptions ***/
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        /*** prepare the insert ***/
        $stmt = $dbh->prepare("SELECT phpro_username FROM phpro_users 
        WHERE phpro_user_id = :phpro_user_id");

        /*** bind the parameters ***/
        $stmt->bindParam(':phpro_user_id', $_SESSION['user_id'], PDO::PARAM_INT);

        /*** execute the prepared statement ***/
        $stmt->execute();

        /*** check for a result ***/
        $phpro_username = $stmt->fetchColumn();

        /*** if we have no something is wrong ***/
        if($phpro_username == false)
        {
            $message = 'Access Error';
        }
        else
        {
            $message = 'Welcome '.$phpro_username;
        }
    }
    catch (Exception $e)
    {
        /*** if we are here, something is wrong in the database ***/
        $message = 'We are unable to process your request. Please try again later"';
    }
}

?>

<html>
    <head>
        <title>PHP Test</title>
        <script src="javascript.js"></script>
        <script src="jquery-1.11.3.min.js"></script>
        <script type="text/javascript" src='../myJavascript.js'></script>
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
        <link rel='stylesheet' type='text/css' href='../mystyle.css'>
        <script>
            $(document).ready(function(){
                $("#myBtn").click(function(){
                    $("#myModal").modal();
                });
                
                $(".btn").submit(function(event)
                {
                    var formData = {
                        'phpro_username': $('input[name=phpro_username]').val(),
                        'phpro_password1': $('input[name=phpro_password1]').val()
                    }
                    $.ajax({
                        url: '../login_submit.php',
                        type:'POST',
                        data: formData,
                        datatype: 'json',
                        success: function(data) {

                            // log data to the console so we can see
                            console.log(formData); 

                            // here we will handle errors and validation messages
                        }
                    });
                        // using the done promise callback
//                        .done(function(data) {
//
//                            // log data to the console so we can see
//                            console.log(data); 
//
//                            // here we will handle errors and validation messages
//                            if ( ! data.success) {
//
//                                // handle errors for name ---------------
//                                if (data.errors.name) {
//                                    $('#name-group').addClass('has-error'); // add the error class to show red input
//                                    $('#name-group').append('<div class="help-block">' + data.errors.name + '</div>'); // add the actual error message under our input
//                                }
//
//                                // handle errors for email ---------------
//                                if (data.errors.email) {
//                                    $('#email-group').addClass('has-error'); // add the error class to show red input
//                                    $('#email-group').append('<div class="help-block">' + data.errors.email + '</div>'); // add the actual error message under our input
//                                }
//                            } else {
//
//                                // ALL GOOD! just show the success message!
//                                $('form').append('<div class="alert alert-success">' + data.message + '</div>');
//
//                                // usually after form submission, you'll want to redirect
//                                // window.location = '/thank-you'; // redirect a user to another page
//                                alert('success'); // for now we'll just alert the user
//
//                            }
//                        });

                    // stop the form from submitting the normal way and refreshing the page
                    event.preventDefault();
                    
                });
            });
            
        </script>
    </head>
    <body>
        <div class="container" id="modalModal">
          <!-- Trigger the modal with a button -->
            
            <?php if(isset($_SESSION['user_id']) == TRUE){?>
            <p align='right'>Logged in as: <?php echo $phpro_username ?> <button type="button" class="btn btn-info btn-lg" id="myBtn">Logout</button></p>
            <?php }else{ ?>
                    <p align='right'><button type="button" class="btn btn-info btn-lg" id="myBtn" style>Login</button></p>
            <?php } ?>
          <!-- Modal -->
          <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">

              <!-- Modal content-->
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title" style='text-align: left'> <?php if(isset($_SESSION['user_id']) == FALSE){?>User Login<?php }else{ ?>User Logout<?php } ?> </h4>
                </div>
                <div class="modal-body">
                    <?php
                        if(isset($_SESSION['user_id']) == FALSE):
                    ?>
                        <div>
                            <form action="scheduler.php" method="post" id="modalModal">
                                <fieldset>
                                    <div id="name-group" class="form-group">
                                        <label for="phpro_username">Username</label>
                                        <input type="text" id="phpro_username" name="phpro_username" value="kgarner1" maxlength="20" />
                                    </div>
                                    <div id="password-group" class="form-group">
                                        <label for="phpro_password">Password</label>
                                        <input type="password" id="phpro_password1" name="phpro_password1" value="Null" maxlength="20" style='width: 150px' />
                                        <img src="../theicon.png" onmouseover="mouseoverPass1();" onmouseout="mouseoutPass1();" width='16px' height='15px' />
                                    </div>
                                    <button type="submit" class="btn btn-success" id="submitLogin">&rarr; Login </button>
                                </fieldset>
                            </form>
                        </div>
                        <p>
                            Don't have an account?<br/><a href='adduser.php'>Create One Here!</a>
                        </p>
                    <?php else: ?>
                        <h2>Logout <a href="../logout.php">Here</a></h2>
                    <?php endif; ?>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>

            </div>
          </div>

        </div>
        <p>Your class list was:</p>
        <div id="class1"> 
            <?php
                function get_subj($str){
                    return $str[2];
                }
                function get_num($str){
                    return $str[3];
                }
                function get_section($str){
                    return $str[4];
                }
                function get_crn($str){
                    return $str[6];
                }
                function get_meet_day($str){
                    return $str[7];
                }
                function get_start_time($str) {
                    return $str[8];
                }
                function get_end_time($str) {
                    return $str[9];
                }
                function get_concat_meet_days($str) {
                    return $str[10];
                }
                function get_class_time($str) {
                    return $str[11];
                }

                //  Current CSV file delimits as follows:
                //      0)FullCourse, 1)Subj+Num, 2)Subj, 3)Num, 4)Section, 5)Term, 6)CRN,
                //      7)MeetDay, 8)StartTime, 9)EndTime, 10) ConcatMeetDays, 11)FullTime, 12)Title, 13)ReportDate
                $class1 = array(                                                            // Class 1 array
                    0 => htmlspecialchars($_POST['className1']),
                    1 => (int)$_POST['classNum1'],
                );
                $file_handle = fopen("2015FallScheduleNewest10-7.csv", "r");                //Opens the Schedule Database
                //for(i=0; i<
                //echo ($class1[1]."\n");
                $meetingDays = "";
                $i = 0;
                $j = 0;
                $classesArrayNum1;
                $firstLine = true;
                if($class1[0] !="Select" && $class1[1] !=0){                                //if the class was chosen and the number was given
                    while (!feof($file_handle) ) {                                          //cycle through the database
                        $class = fgetcsv($file_handle, 1024);                               //stores the class database
                        if($firstLine == false){
                            $crn = get_crn($class);
                            if($class[2] == $class1[0] && $class[3] == $class1[1]){         //if the class name and the number match up to somewhere in the database
                                $meetingDays .= get_meet_day($class);
                                for($k=0;$k<=13;$k++){
                                    $classesArrayNum1[$j][$k] = $class[$k];
                                }
                                //break;                                                    //stops the looping
                                $j++;
                            }                                                               //end nested if statement
                            $lastCrn = $crn;
                        } else {
                            $firstLine = false;
                        }
                    }                                                                       //end while loop
                    $class1_info_json = json_encode($classesArrayNum1);
                    $crnOld = $classesArrayNum1[0][6];
                    for($k=0;$k<sizeOf($classesArrayNum1);$k++){
                        $crnNew = $classesArrayNum1[$k][6];
                        
                        //echo ("K: " .$k. " ");
                        //echo ("CRN-NEW: " .$crnNew . ", CRN_OLD: " . $crnOld . "<br/>");
                        if($k == 0 || $crnNew != $crnOld){
                            ?>
                            <input class="class" type="checkbox" id="1_<?php echo $classesArrayNum1[$k][4]; ?>" onchange="disableOtherSections(this.checked, 'class1', '<?php echo get_section($classesArrayNum1[$k]) ?>', '<?php echo get_start_time($classesArrayNum1[$k]) ?>', '<?php echo get_end_time($classesArrayNum1[$k]) ?>');">
                            <?php
                                print($class1[0]." ".$class1[1].", section ".get_section($classesArrayNum1[$k])." goes from " .get_class_time($classesArrayNum1[$k])." on ". get_concat_meet_days($classesArrayNum1[$k]));?></input><?php
                            ?>
                            </br>
                            <?php
                            $i++;
                        } else {
                            
                        }
                        $crnOld = $crnNew;
                    }
                    $firstLine = true;
                    ?>
                    <?php
                                                //prints the start time of the class
                } else if(htmlspecialchars($_POST['className1'])=="Select Class"){                //else if the class name wasn't chosen
                    echo "You did not enter a class name";                                  //"You did not enter a class name"
                }                                                                           //end if statement
                if((int)$_POST['classNum1']==0){                                            //if the class number wasn't input
                    echo "You did not enter a class number";                                //"You did not enter a class number"
                }else{

                }
                fclose($file_handle);                                                       //close the database
            ?></input>
        </div>
        </br>
        <div id="class2">
            <?php
                $class2 = array(                                                            // Class 2 array
                    0 => htmlspecialchars($_POST['className2']),
                    1 => (int)$_POST['classNum2'],
                );
                $file_handle = fopen("2015FallScheduleNewest10-7.csv", "r");                //Opens the Schedule Database
                //for(i=0; i<
                //echo ($class2[1]."\n");
                $meetingDays = "";
                $i = 0;
                $j = 0;
                $classesArrayNum2;
                $firstLine = true;
                if($class2[0] !="Select" && $class2[1] !=0){                                //if the class was chosen and the number was given
                    while (!feof($file_handle) ) {                                          //cycle through the database
                        $class = fgetcsv($file_handle, 1024);                               //stores the class database
                        if($firstLine == false){
                            if($class[2] == $class2[0] && $class[3] == $class2[1]){         //if the class name and the number match up to somewhere in the database
                                $meetingDays .= get_meet_day($class);
                                for($k=0;$k<=13;$k++){
                                    $classesArrayNum2[$j][$k] = $class[$k];
                                }
                                //break;                                                    //stops the looping
                                $j++;
                            }                                                               //end nested if statement
                            $lastCrn = $crn;
                        } else {
                            $firstLine = false;
                        }
                    }                                                                       //end while loop
                    $class2_info_json = json_encode($classesArrayNum2);
                    $crnOld = $classesArrayNum2[0][6];
                    for($k=0;$k<sizeOf($classesArrayNum2);$k++){
                        $crnNew = $classesArrayNum2[$k][6];
                        
                        //echo ("K: " .$k. " ");
                        //echo ("CRN-NEW: " .$crnNew . ", CRN_OLD: " . $crnOld . "<br/>");
                        if($k == 0 || $crnNew != $crnOld){
                            ?>
                            <input class="class" type="checkbox" id="2_<?php echo $classesArrayNum2[$k][4]; ?>" onchange="disableOtherSections(this.checked, 'class2', '<?php echo get_section($classesArrayNum2[$k]) ?>', '<?php echo get_start_time($classesArrayNum2[$k]) ?>', '<?php echo get_end_time($classesArrayNum2[$k]) ?>');">
                            <?php
                                print($class2[0]." ".$class2[1].", section ".get_section($classesArrayNum2[$k])." goes from " .get_class_time($classesArrayNum2[$k])." on ". get_concat_meet_days($classesArrayNum2[$k]));?></input><?php
                            ?>
                            </br>
                            <?php
                            $i++;
                        }
                        $crnOld = $crnNew;
                    }
                    $firstLine = true;
                    ?>
                    <?php
                                                //prints the start time of the class
                } else if(htmlspecialchars($_POST['className2'])=="Select Class"){                //else if the class name wasn't chosen
                    echo "You did not enter a class name";                                  //"You did not enter a class name"
                }                                                                           //end if statement
                if((int)$_POST['classNum2']==0){                                            //if the class number wasn't input
                    echo "You did not enter a class number";                                //"You did not enter a class number"
                }else{

                }
                fclose($file_handle);                                                       //close the database
            ?>
            <br/>
        </div>
        <div id="class3">
            <?php
                $class3 = array(                                                            // Class 2 array
                    0 => htmlspecialchars($_POST['className3']),
                    1 => (int)$_POST['classNum3'],
                );
                $file_handle = fopen("2015FallScheduleNewest10-7.csv", "r");                //Opens the Schedule Database
                //for(i=0; i<
                //echo ($class3[1]."\n");
                $meetingDays = "";
                $i = 0;
                $j = 0;
                $classesArrayNum3;
                $firstLine = true;
                if($class3[0] !="Select" && $class3[1] !=0){                                //if the class was chosen and the number was given
                    while (!feof($file_handle) ) {                                          //cycle through the database
                        $class = fgetcsv($file_handle, 1024);                               //stores the class database
                        if($firstLine == false){
                            if($class[2] == $class3[0] && $class[3] == $class3[1]){         //if the class name and the number match up to somewhere in the database
                                $meetingDays .= get_meet_day($class);
                                for($k=0;$k<=13;$k++){
                                    $classesArrayNum3[$j][$k] = $class[$k];
                                }
                                //break;                                                    //stops the looping
                                $j++;
                            }                                                               //end nested if statement
                            $lastCrn = $crn;
                        } else {
                            $firstLine = false;
                        }
                    }                                                                       //end while loop
                    $crnOld = $classesArrayNum3[0][6];
                    for($k=0;$k<sizeOf($classesArrayNum3);$k++){
                        $crnNew = $classesArrayNum3[$k][6];
                        
                        //echo ("K: " .$k. " ");
                        //echo ("CRN-NEW: " .$crnNew . ", CRN_OLD: " . $crnOld . "<br/>");
                        if($k == 0 || $crnNew != $crnOld){
                            ?>
                            <input class="class" type="checkbox" id="3_<?php echo $classesArrayNum3[$k][4]; ?>" onchange="disableOtherSections(this.checked, 'class3', '<?php echo get_section($classesArrayNum3[$k]) ?>', '<?php echo get_start_time($classesArrayNum3[$k]) ?>', '<?php echo get_end_time($classesArrayNum3[$k]) ?>');">
                            <?php
                                print($class3[0]." ".$class3[1].", section ".get_section($classesArrayNum3[$k])." goes from " .get_class_time($classesArrayNum3[$k])." on ". get_concat_meet_days($classesArrayNum3[$k]));?></input><?php
                            ?>
                            </br>
                            <?php
                            $i++;
                        }
                        $crnOld = $crnNew;
                    }
                    $firstLine = true;
                    ?>
                    <?php
                                                //prints the start time of the class
                } else if(htmlspecialchars($_POST['className3'])=="Select Class"){                //else if the class name wasn't chosen
                    echo "You did not enter a class name";                                  //"You did not enter a class name"
                }                                                                           //end if statement
                if((int)$_POST['classNum3']==0){                                            //if the class number wasn't input
                    echo "You did not enter a class number";                                //"You did not enter a class number"
                }else{

                }
                fclose($file_handle);                                                       //close the database
            ?>
            </br>
        </div>
        <div id="class4">
            <?php
                $class4 = array(                                                            // Class 2 array
                    0 => htmlspecialchars($_POST['className4']),
                    1 => (int)$_POST['classNum4'],
                );
                $file_handle = fopen("2015FallScheduleNewest10-7.csv", "r");                //Opens the Schedule Database
                //for(i=0; i<
                //echo ($class4[1]."\n");
                $meetingDays = "";
                $i = 0;
                $j = 0;
                $classesArrayNum4;
                $firstLine = true;
                if($class4[0] !="Select" && $class4[1] !=0){                                //if the class was chosen and the number was given
                    while (!feof($file_handle) ) {                                          //cycle through the database
                        $class = fgetcsv($file_handle, 1024);                               //stores the class database
                        if($firstLine == false){
                            if($class[2] == $class4[0] && $class[3] == $class4[1]){         //if the class name and the number match up to somewhere in the database
                                $meetingDays .= get_meet_day($class);
                                for($k=0;$k<=13;$k++){
                                    $classesArrayNum4[$j][$k] = $class[$k];
                                }
                                //break;                                                    //stops the looping
                                $j++;
                            }                                                               //end nested if statement
                            $lastCrn = $crn;
                        } else {
                            $firstLine = false;
                        }
                    }                                                                       //end while loop
                    $crnOld = $classesArrayNum4[0][6];
                    for($k=0;$k<sizeOf($classesArrayNum4);$k++){
                        $crnNew = $classesArrayNum4[$k][6];
                        
                        //echo ("K: " .$k. " ");
                        //echo ("CRN-NEW: " .$crnNew . ", CRN_OLD: " . $crnOld . "<br/>");
                        if($k == 0 || $crnNew != $crnOld){
                            ?>
                            <input class="class" type="checkbox" id="4_<?php echo $classesArrayNum4[$k][4]; ?>" onchange="disableOtherSections(this.checked, 'class4', '<?php echo get_section($classesArrayNum4[$k]) ?>', '<?php echo get_start_time($classesArrayNum4[$k]) ?>', '<?php echo get_end_time($classesArrayNum4[$k]) ?>');">
                            <?php
                                print($class4[0]." ".$class4[1].", section ".get_section($classesArrayNum4[$k])." goes from " .get_class_time($classesArrayNum4[$k])." on ". get_concat_meet_days($classesArrayNum4[$k]));?></input><?php
                            ?>
                            </br>
                            <?php
                            $i++;
                        }
                        $crnOld = $crnNew;
                    }
                    $firstLine = true;
                    ?>
                    <?php
                                                //prints the start time of the class
                } else if(htmlspecialchars($_POST['className4'])=="Select Class"){              //else if the class name wasn't chosen
                    echo "You did not enter a class name";                                      //"You did not enter a class name"
                    if((int)$_POST['classNum4']==0){                                            //if the class number wasn't input
                        echo "or a class number";                                               //"You did not enter a class number"
                    }else{

                    }
                } else if((int)$_POST['classNum4']==0){                                                //if the class number wasn't input
                    echo "You did not enter a class number";                                    //"You did not enter a class number"
                }else{

                }
                fclose($file_handle);                                                           //close the database
            ?>
            </br>
        </div>
<!--
        <?php
//        
//        function get_conflicts($str){
//            $i=0;
//            for($i=0;$i<$sizeOf($classArrayNum1);$i++){
//                for($j=0;$j<=13;$j++){
//                    $totalClassArray[$i][$j] = $classArrayNum1[$i][$j];
//                }
//            }
//            for($i=sizeOf($classArrayNum1);$i<$(sizeOf($classArrayNum1)+sizeOf($classArrayNum2));$i++){
//                for($j=0;$j<=13;$j++){
//                    $totalClassArray[$i][$j] = $classArrayNum2[$i][$j];
//                }
//            }
//            for($i=(sizeOf($classArrayNum1)+sizeOf($classArrayNum2));$i<(sizeOf($classArrayNum1)+sizeOf($classArrayNum2)+$sizeOf($classArrayNum3));$i++){
//                for($j=0;$j<=13;$j++){
//                    $totalClassArray[$i][$j] = $classArrayNum3[$i][$j];
//                }
//            }
//            for($i=(sizeOf($classArrayNum1)+sizeOf($classArrayNum2)+sizeOf($classArrayNum3));$i<(sizeOf($classArrayNum1)+sizeOf($classArrayNum2)+sizeOf($classArrayNum3)+$sizeOf($classArrayNum4));$i++){
//                for($j=0;$j<=13;$j++){
//                    $totalClassArray[$i][$j] = $classArrayNum4[$i][$j];
//                }
//            }
//            echo (sizeOf(totalClassArray)<br/>);
//            
//        }
//        
        ?>
-->
    </body>
</html>