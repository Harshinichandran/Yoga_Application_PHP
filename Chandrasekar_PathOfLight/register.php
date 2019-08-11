<?php
//declaration of variables
 $nameErr = $emailErr = $passwordErr = $phoneErr = $addressErr = $classErr = $timeErr = $scheduleErr = "";
$name = $email = $password = $phone = $address = $class = $time = $schedule= "";
$errflagname = $errflagemail = $errflagpassword = $errflagphone = $errflagaddress = $errflagclass = $errflagtime = $errflagschedule = 0;
//functtion to remove unecessary characters from user input
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//form submit 
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	   $servername = "localhost";  
       $username = "root";  
       $password = "";  
       $conn = mysqli_connect ($servername , $username , $password) or die("unable to connect to host");  
	   if(!$conn)
	   {
		   echo "Unable to connect";
	   }
       $sql = mysqli_select_db ($conn,'yoga') or die("unable to connect to database"); 

	   //Name regex check and check for empty field on submit
		if (empty($_POST["Name"])) 
		{
			$nameErr = "Name is required";
			$errflagname=1;
		} else {
			$name = test_input($_POST["Name"]);
			// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			$nameErr = "Only letters and white space allowed"; 
			$errflagname=2;
		}
	}
	
	//Password regex check and check for empty field on submit
	if (empty($_POST["Password"])) 
		{
			$passwordErr = "Password is required";
			$errflagpassword=1;
		} else {
			$password = test_input($_POST["Password"]);
			// check if name only contains letters and whitespace
		if (!preg_match("/^.*(?=.{8,})(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z]).*$/",$password)) {
			$passwordErr = "Minimum 8 characters and must contain at least one lower case letter, one upper case letter and one digit"; 
			$errflagpassword=2;
		}
	}
  
  //Email regex check and check for empty field on submit
  if (empty($_POST["Email"])) {
    $emailErr = "Email is required";
	$errflagemail=1;
  } else {
    $email = test_input($_POST["Email"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
	  $errflagemail=2;
    }
}
	//Phone number regex check and check for empty field on submit
 	 	if (empty($_POST["Phone"])) {
    $phoneErr = "Phone is required";
	$errflagphone=1;
  } else {
    $phone = test_input($_POST["Phone"]);
    // check if e-mail address is well-formed
  if (!preg_match("/^(\+\d{1,2}\s)?\(?\d{3}\)?[\s.-]\d{3}[\s.-]\d{4}$/",$phone)) {
	   $phoneErr = "Valid Formats : 123-456-7890 // (123) 456-7890 // 123 456 7890 // 123.456.7890 // +91 (123) 456-7890 "; 
	   $errflagphone=2;
    }
  } 
  
  //Address regex check and check for empty field on submit
  if (empty($_POST["Address"])) {
    $addressErr = "Address is required";
	$errflagaddress=1;
  } else {
    $address = test_input($_POST["Address"]);
  }
  
  //class check for empty field on submit
  if (empty($_POST["Class"])) {
    $classErr = "Selection of Class is required";
	$errflagclass=1;
  } else {
    $class = test_input($_POST["Class"]);
  }
  
  //Time check for empty field on submit
  if (empty($_POST["Time"])) {
    $timeErr = "Time is required";
	$errflagtime=1;
  } else {
    $time = test_input($_POST["Time"]);
  }
  
  //Schedule check for empty field on submit
   if (empty($_POST["Schedule"])) {
    $scheduleErr = "Schedule is required";
	$errflagschedule=1;
  } else {
    $schedule = test_input($_POST["Schedule"]);
  }
        
		
		$sqlreg = "SELECT time.time, class.classname, days.daysname, time.timeid, days.daysid, class.classid FROM schedule JOIN time ON schedule.timeid = time.timeid JOIN class ON schedule.classid = class.classid JOIN days ON schedule.daysid = days.daysid";
		$result = mysqli_query($conn,$sqlreg);
		$rowcount=mysqli_num_rows($result);
		$regexname = "/[a-z]$/";
		$regexemal = "/[a-z]$/";
		
		
	if(($errflagname == 0)&&($errflagemail == 0) && ($errflagpassword == 0) &&($errflagphone == 0) && ($errflagaddress == 0) && ($errflagclass == 0) && ($errflagtime == 0) && ($errflagschedule == 0))
	{
		if (mysqli_num_rows($result) > 0) 
				{
					$flag=0;
			
					while($row = mysqli_fetch_assoc($result)) 
					{
					$compschedule =(string)"{$row["daysname"]}";
					$comptime= (string)"{$row["time"]}";
					$compclass= (string)"{$row["classname"]}";
					$classid="{$row["classid"]}";
					$timeid="{$row["timeid"]}";
					$daysid="{$row["daysid"]}";
					
							if((trim(strtoupper($compclass))==trim(strtoupper($class)))&&(trim(strtoupper($comptime))==trim(strtoupper($time)))&&(trim(strtoupper($compschedule))==trim(strtoupper($schedule))))
								{
									$flag=1;
								$sqlQ = "insert into client(name, address, phone, email, password) values ('$name','$address','$phone','$email','$password')";
								$resultQ = mysqli_query($conn,$sqlQ);
								$last_id = mysqli_insert_id($conn);
								//echo $last_id;
								$sqlclientschedule="insert into `client-schedule`(clientid, timeid, classid, daysid) values ('$last_id', '$timeid', '$classid', '$daysid')";
								$resultsqlcs = mysqli_query($conn,$sqlclientschedule);
								if($resultsqlcs)
								{
									header('Location: register.php');
								}
							
								}
						
							
						
						}
						If ($flag==0)
						{
							
							//$classid="{$row["classid"]}";
							$sqltimedays="SELECT time.time, days.daysname FROM schedule JOIN time ON schedule.timeid = time.timeid JOIN days ON schedule.daysid = days.daysid where schedule.classid= (select class.classid from class where classname = '".$class."')";
							//echo $sqltimedays;
							$result_timedays = mysqli_query($conn,$sqltimedays);
							$rowcount_timedays=mysqli_num_rows($result_timedays);
							//echo $rowcount_timedays;
							$alertMsgString="Available schedule for ".$class." is:\\n";
							while($row = mysqli_fetch_assoc($result_timedays)) 
							{
								$daysname =(string)"{$row["daysname"]}";
								$time= (string)"{$row["time"]}";
								$alertMsgString=$alertMsgString.$daysname.": ".$time."\\n";
							}
							
							//$alertMsgString=(string)$alertMsgString;
							//echo $alertMsgString;
							//$message="I am here";
							echo "<script type='text/javascript'>alert('$alertMsgString');</script>";
							
							}
											
				}
				
				
  

  }
}
  
?> 
<HTML id="colour">
<link rel="stylesheet" type="text/css" href="yoga.css">
<DIV ID="bg">
<BODY LINK ="BLUE" ID="wrapper">
<H1> Path of Light Yoga Studio </H1>

			<DIV ID="nav">
				<STRONG>
					 <A HREF="index.php">Home</A> &nbsp;
					 <A HREF="class.php">Classes</A> &nbsp; 
					 <A HREF="schedule.php">Schedule</A> &nbsp;
					 <A HREF="register.php">Register</A> &nbsp;
					 <A HREF="contact.php">Contact</A>  &nbsp;
				</STRONG>
			</DIV>
<MAIN> 
<H2>Register Path of Light Yoga Studio </H2>
<P> Required information is marked with an asterisk (*). </P>

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
<TABLE CLASS="reg">
  <TR>
	<TD><Label for=Name>* Name:</Label></TD>
	<TD><input type="text" name="Name" value="<?php echo $name;?>"></TD>
	<TD><span CLASS="error"> <?php echo $nameErr;?></span></TD>
  </TR>
  <TR>
	<TD><Label for=password>* Password :</Label></TD>
	<TD><input type="password" name="Password" value="<?php echo $password;?>"></TD>
	<TD><span class="error"><?php echo $passwordErr;?></span></TD>
 </TR>
  <TR>
	<TD><Label for=E-mail>* E-mail:</Label></TD>
	<TD>
		<input type="text" name="Email"  value="<?php echo $email;?>">
	</TD>
	<TD><span class="error"> <?php echo $emailErr;?></span></TD>
	</TR>
	 <TR>
	<TD><Label for=Phone>* Phone:</Label></TD>
	<TD><input type="text" name="Phone" value="<?php echo $phone;?>"></TD>
	<TD><span class="error"> <?php echo $phoneErr;?></span></TD>
	</TR>
  <TR>
	<TD><Label for=Address>* Address:</Label></TD>
	<TD> <textarea name="Address" rows="2" cols="18" value="<?php echo $address;?>"><?php echo $address;?></textarea></TD>
	<TD><span class="error"> <?php echo $addressErr;?></span></TD>
   </TR>
   <TR>
   <TD><Label for=TypeClass>* Type of Class:</Label></TD>
   <TD>
    <select name="Class" value="<?php echo $class;?>"><option value=""></option>
	 <option value="Gentle Hatha Yoga" <?php if($class == 'Gentle Hatha Yoga') { ?> selected <?php } ?>>Gentle</option>
	 <option value="Vinyasa Yoga" <?php if($class == 'Vinyasa Yoga') { ?> selected <?php } ?>>Vinyasa</option>
	  <option value="Restorative Yoga" <?php if($class == 'Restorative Yoga') { ?> selected <?php } ?>>Restorative</option>
    </select>
	</TD>
	<TD><span class="error"><?php echo $classErr;?></span></TD>
	</TR>
  <TR>
  <TD><Label for=Schedule>* Schedule:</Label></TD>
  
  <TD>
    <select name="Schedule" value="<?php echo $schedule;?>"><option value=""></option>
	<option value="Monday - Friday" <?php if($schedule == 'Monday - Friday') { ?> selected <?php } ?>>Monday - Friday</option>
	<option value="Saturday And Sunday" <?php if($schedule == 'Saturday And Sunday') { ?> selected <?php } ?>>Saturday & Sunday</option>
	</select>
	</TD>
	<TD><span class="error"> <?php echo $scheduleErr;?></span></TD>
	</TR>
	<TR>
  <TD><Label for=Time>* Time:</Label></TD>
  <TD>
    <select name="Time" value="<?php echo $time;?>"><option value=""></option>
	<option value="9:00am" <?php if($time == '9:00am') { ?> selected <?php } ?>>9:00am</option>
	<option value="10:30am" <?php if($time == '10:30am') { ?> selected <?php } ?>>10:30am</option>
	<option value="5:30pm" <?php if($time == '5:30pm') { ?> selected <?php } ?>>5:30pm</option>
	<option value="7:00pm" <?php if($time == '7:00pm') { ?> selected <?php } ?>>7:00pm</option>
	<option value="10:30am" <?php if($time == '10:30am') { ?> selected <?php } ?>>10:30am</option>
	<option value="Noon" <?php if($time == 'Noon') { ?> selected <?php } ?>>Noon</option>
	<option value="1:30pm" <?php if($time == '1:30pm') { ?> selected <?php } ?>>1:30pm</option>
	<option value="3:00pm" <?php if($time == '3:00pm') { ?> selected <?php } ?>>3:00pm</option>
	<option value="5:30pm" <?php if($time == '5:30pm') { ?> selected <?php } ?>>5:30pm</option>
    </select>
	</TD>
	<TD><span class="error"> <?php echo $timeErr;?></span></TD>
	</TR>
	<TR><TD></TD>
	<TD><input type="Submit" id="sendbd" Value="Send now"></TD></TR>
	</TABLE>
	
</FORM>

</MAIN>
		<FOOTER>
			<I>
				<FONT SIZE=2> 
					Copyright @ 2016 Path of Light Yoga Studio <BR>
					<U> <A HREF="">harshini@chandrasekar.com </A> </U>
				</FONT>
			</I>
							
		</FOOTER>
		</DIV>
</BODY>
</HTML>