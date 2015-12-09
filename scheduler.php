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
        <br/>
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
        
        <form action="action.php" method="post">
            <div name="classes">
                <p> Enter up to 4 classes and class numbers you want to schedule.</p>
                <p>First Class: <t/>
                    <select name="className1">
                        <option value="Select Class" selected>Select Class</option>
                        <option value="ACCT">ACCT</option>
                        <option value="AFST">AFST</option>
                        <option value="ANTH">ANTH</option>
                        <option value="ART">ART</option>
                        <option value="ARTH">ARTH</option>
                        <option value="ARTS">ARTS</option>
                        <option value="ASIA">ASIA</option>
                        <option value="ASTR">ASTR</option>
                        <option value="ATMS">ATMS</option>
                        <option value="BIOL">BIOL</option>
                        <option value="CCS">CCS</option>
                        <option value="CHEM">CHEM</option>
                        <option value="CLAS">CLAS</option>
                        <option value="CSCI">CSCI</option>
                        <option value="DAN">DAN</option>
                        <option value="DRAM">DRAM</option>
                        <option value="E">E</option>
                        <option value="ECE">ECE</option>
                        <option value="ECON">ECON</option>
                        <option value="EDUC">EDUC</option>
                        <option value="ENG">ENG</option>
                        <option value="ENVR">ENVR</option>
                        <option value="ESI">ESI</option>
                        <option value="FREN">FREN</option>
                        <option value="GERM">GERM</option>
                        <option value="HIST">HIST</option>
                        <option value="HON">HON</option>
                        <option value="HUM">HUM</option>
                        <option value="HW">HW</option>
                        <option value="HWP">HWP</option>
                        <option value="INTS">INTS</option>
                        <option value="IST">IST</option>
                        <option value="JEM">JEM</option>
                        <option value="LA">LA</option>
                        <option value="LANG">LANG</option>
                        <option value="LIT">LIT</option>
                        <option value="MAE">MAE</option>
                        <option value="MATH">MATH</option>
                        <option value="MCOM">MCOM</option>
                        <option value="MGMT">MGMT</option>
                        <option value="MLAS">MLAS</option>
                        <option value="MSE">MSE</option>
                        <option value="MUSC">MUSC</option>
                        <option value="NM">NM</option>
                        <option value="PHIL">PHIL</option>
                        <option value="PHYS">PHYS</option>
                        <option value="POLS">POLS</option>
                        <option value="PORT">PORT</option>
                        <option value="PSYC">PSYC</option>
                        <option value="RELS">RELS</option>
                        <option value="SABR">SABR</option>
                        <option value="SOC">SOC</option>
                        <option value="SPAN">SPAN</option>
                        <option value="STAT">STAT</option>
                        <option value="UNCX">UNCX</option>
                        <option value="VMP">VMP</option>
                        <option value="WGSS">WGSS</option>
                    </select>
                    <input type="text" name="classNum1"><br/>
                </p>
                <p>Second Class: <t/>
                    <select name="className2">
                        <option value="Select Class" selected>Select Class</option>
                        <option value="ACCT">ACCT</option>
                        <option value="AFST">AFST</option>
                        <option value="ANTH">ANTH</option>
                        <option value="ART">ART</option>
                        <option value="ARTH">ARTH</option>
                        <option value="ARTS">ARTS</option>
                        <option value="ASIA">ASIA</option>
                        <option value="ASTR">ASTR</option>
                        <option value="ATMS">ATMS</option>
                        <option value="BIOL">BIOL</option>
                        <option value="CCS">CCS</option>
                        <option value="CHEM">CHEM</option>
                        <option value="CLAS">CLAS</option>
                        <option value="CSCI">CSCI</option>
                        <option value="DAN">DAN</option>
                        <option value="DRAM">DRAM</option>
                        <option value="E">E</option>
                        <option value="ECE">ECE</option>
                        <option value="ECON">ECON</option>
                        <option value="EDUC">EDUC</option>
                        <option value="ENG">ENG</option>
                        <option value="ENVR">ENVR</option>
                        <option value="ESI">ESI</option>
                        <option value="FREN">FREN</option>
                        <option value="GERM">GERM</option>
                        <option value="HIST">HIST</option>
                        <option value="HON">HON</option>
                        <option value="HUM">HUM</option>
                        <option value="HW">HW</option>
                        <option value="HWP">HWP</option>
                        <option value="INTS">INTS</option>
                        <option value="IST">IST</option>
                        <option value="JEM">JEM</option>
                        <option value="LA">LA</option>
                        <option value="LANG">LANG</option>
                        <option value="LIT">LIT</option>
                        <option value="MAE">MAE</option>
                        <option value="MATH">MATH</option>
                        <option value="MCOM">MCOM</option>
                        <option value="MGMT">MGMT</option>
                        <option value="MLAS">MLAS</option>
                        <option value="MSE">MSE</option>
                        <option value="MUSC">MUSC</option>
                        <option value="NM">NM</option>
                        <option value="PHIL">PHIL</option>
                        <option value="PHYS">PHYS</option>
                        <option value="POLS">POLS</option>
                        <option value="PORT">PORT</option>
                        <option value="PSYC">PSYC</option>
                        <option value="RELS">RELS</option>
                        <option value="SABR">SABR</option>
                        <option value="SOC">SOC</option>
                        <option value="SPAN">SPAN</option>
                        <option value="STAT">STAT</option>
                        <option value="UNCX">UNCX</option>
                        <option value="VMP">VMP</option>
                        <option value="WGSS">WGSS</option>
                    </select>
                    <input type="text" name="classNum2"><br/>
                </p>
                <p>Third Class: 
                    <select name="className3">
                        <option value="Select Class" selected>Select Class</option>
                        <option value="ACCT">ACCT</option>
                        <option value="AFST">AFST</option>
                        <option value="ANTH">ANTH</option>
                        <option value="ART">ART</option>
                        <option value="ARTH">ARTH</option>
                        <option value="ARTS">ARTS</option>
                        <option value="ASIA">ASIA</option>
                        <option value="ASTR">ASTR</option>
                        <option value="ATMS">ATMS</option>
                        <option value="BIOL">BIOL</option>
                        <option value="CCS">CCS</option>
                        <option value="CHEM">CHEM</option>
                        <option value="CLAS">CLAS</option>
                        <option value="CSCI">CSCI</option>
                        <option value="DAN">DAN</option>
                        <option value="DRAM">DRAM</option>
                        <option value="E">E</option>
                        <option value="ECE">ECE</option>
                        <option value="ECON">ECON</option>
                        <option value="EDUC">EDUC</option>
                        <option value="ENG">ENG</option>
                        <option value="ENVR">ENVR</option>
                        <option value="ESI">ESI</option>
                        <option value="FREN">FREN</option>
                        <option value="GERM">GERM</option>
                        <option value="HIST">HIST</option>
                        <option value="HON">HON</option>
                        <option value="HUM">HUM</option>
                        <option value="HW">HW</option>
                        <option value="HWP">HWP</option>
                        <option value="INTS">INTS</option>
                        <option value="IST">IST</option>
                        <option value="JEM">JEM</option>
                        <option value="LA">LA</option>
                        <option value="LANG">LANG</option>
                        <option value="LIT">LIT</option>
                        <option value="MAE">MAE</option>
                        <option value="MATH">MATH</option>
                        <option value="MCOM">MCOM</option>
                        <option value="MGMT">MGMT</option>
                        <option value="MLAS">MLAS</option>
                        <option value="MSE">MSE</option>
                        <option value="MUSC">MUSC</option>
                        <option value="NM">NM</option>
                        <option value="PHIL">PHIL</option>
                        <option value="PHYS">PHYS</option>
                        <option value="POLS">POLS</option>
                        <option value="PORT">PORT</option>
                        <option value="PSYC">PSYC</option>
                        <option value="RELS">RELS</option>
                        <option value="SABR">SABR</option>
                        <option value="SOC">SOC</option>
                        <option value="SPAN">SPAN</option>
                        <option value="STAT">STAT</option>
                        <option value="UNCX">UNCX</option>
                        <option value="VMP">VMP</option>
                        <option value="WGSS">WGSS</option>
                    </select>
                    <input type="text" name="classNum3"><br/>
                </p>
                <p>Fourth Class: 
                    <select name="className4">
                        <option value="Select Class" selected>Select Class</option>
                        <option value="ACCT">ACCT</option>
                        <option value="AFST">AFST</option>
                        <option value="ANTH">ANTH</option>
                        <option value="ART">ART</option>
                        <option value="ARTH">ARTH</option>
                        <option value="ARTS">ARTS</option>
                        <option value="ASIA">ASIA</option>
                        <option value="ASTR">ASTR</option>
                        <option value="ATMS">ATMS</option>
                        <option value="BIOL">BIOL</option>
                        <option value="CCS">CCS</option>
                        <option value="CHEM">CHEM</option>
                        <option value="CLAS">CLAS</option>
                        <option value="CSCI">CSCI</option>
                        <option value="DAN">DAN</option>
                        <option value="DRAM">DRAM</option>
                        <option value="E">E</option>
                        <option value="ECE">ECE</option>
                        <option value="ECON">ECON</option>
                        <option value="EDUC">EDUC</option>
                        <option value="ENG">ENG</option>
                        <option value="ENVR">ENVR</option>
                        <option value="ESI">ESI</option>
                        <option value="FREN">FREN</option>
                        <option value="GERM">GERM</option>
                        <option value="HIST">HIST</option>
                        <option value="HON">HON</option>
                        <option value="HUM">HUM</option>
                        <option value="HW">HW</option>
                        <option value="HWP">HWP</option>
                        <option value="INTS">INTS</option>
                        <option value="IST">IST</option>
                        <option value="JEM">JEM</option>
                        <option value="LA">LA</option>
                        <option value="LANG">LANG</option>
                        <option value="LIT">LIT</option>
                        <option value="MAE">MAE</option>
                        <option value="MATH">MATH</option>
                        <option value="MCOM">MCOM</option>
                        <option value="MGMT">MGMT</option>
                        <option value="MLAS">MLAS</option>
                        <option value="MSE">MSE</option>
                        <option value="MUSC">MUSC</option>
                        <option value="NM">NM</option>
                        <option value="PHIL">PHIL</option>
                        <option value="PHYS">PHYS</option>
                        <option value="POLS">POLS</option>
                        <option value="PORT">PORT</option>
                        <option value="PSYC">PSYC</option>
                        <option value="RELS">RELS</option>
                        <option value="SABR">SABR</option>
                        <option value="SOC">SOC</option>
                        <option value="SPAN">SPAN</option>
                        <option value="STAT">STAT</option>
                        <option value="UNCX">UNCX</option>
                        <option value="VMP">VMP</option>
                        <option value="WGSS">WGSS</option>
                    </select>
                    <input type="text" name="classNum4"><br/>
                </p>
                <input type="submit" value="Create My Schedule">
            </div>
        </form>
        
        <?php
        /*
            if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') == TRUE) {
                ?>
                <h3>strpos() must have returned true on MSIE</h3>
                <p>You are using Internet Explorer</p>
                <?php
            } else if (strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome') == TRUE) {
                ?>
                <h3>strpos() must have returned true on Chrome</h3>
                <p>You are using Chrome</p>
                <?php
            } else if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') == TRUE) {
                ?>
                <h3>strpos() must have returned true on Firefox</h3>
                <p>You are using Mozilla Firefox</p>
                <?php
            }
        */
        ?>
        <?php
          /*  
            $useragent=$_SERVER['HTTP_USER_AGENT'];
            
        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
                echo ("You are using a mobile browser!");
        */
        ?>
    </body>
</html>