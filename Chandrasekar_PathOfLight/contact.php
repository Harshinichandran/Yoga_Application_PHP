<?php
	   //Connection to the database
	   $servername = "localhost";  
       $username = "root";  
       $password = "";  
       $conn = mysqli_connect ($servername , $username , $password) or die("unable to connect to host");  
	   if(!$conn)
	   {
		   echo "Unable to connect";
	   }
       $sql = mysqli_select_db ($conn,'yoga') or die("unable to connect to database"); 
	   
	    $nameErr = $emailErr = $commentsErr = "";
		$name = $email = $comments = "";
		$errflagname = $errflagemail = $errflagcomments = 0;
		//function removes unnecessary characters from user inputs
			function test_input($data) {
				$data = trim($data);
				$data = stripslashes($data);
				$data = htmlspecialchars($data);
				return $data;
			}
	 //Form is submitted on submit action 
	if ($_SERVER["REQUEST_METHOD"] == "POST")
	{  
			if (empty($_POST["Name"])) 
		{
			$nameErr = "Name is required";
			$errflagname=1;
		} else {
			$name = test_input($_POST["Name"]);
			// check if name only contains letters and whitespace
			//https://www.w3schools.com/php/php_form_validation.asp
			if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
			$nameErr = "Only letters and white space allowed"; 
			$errflagname=1;
			}
		}
	
		if (empty($_POST["Email"])) {
		$emailErr = "Email is required";
		$errflagemail=1;
		} else {
		$email = test_input($_POST["Email"]);
		// check if e-mail address is well-formed 
		//https://www.w3schools.com/php/php_form_validation.asp
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailErr = "Invalid email format"; 
		$errflagemail=1;
		}
	}

		if (empty($_POST["Comments"])) {
		$commentsErr = "Comments is required";
		$errflagcomments=1;
		} else {
			$comments = test_input($_POST["Comments"]);
		}
		
	   $Uname = (isset($_POST['Name']) ? $_POST['Name'] : 'ajaai');
	   $email = (isset($_POST['Email']) ? $_POST['Email'] : 'aaaa');
	   $comments = (isset($_POST['Comments']) ? $_POST['Comments'] : 'bbbbb');
	   
if(($errflagname == 0)&&($errflagemail == 0) && ($errflagcomments == 0))
{
     $sqlQ = "insert into contact (name,email,`comments/questions`) values ('$Uname','$email','$comments')";
	 $resultQ = mysqli_query($conn,$sqlQ);
	 if($resultQ)
	 {
		header('Location: contact.php');
	 }
		 
	 
}
	}
?> 

<HTML id="colour">
<link rel="stylesheet" type="text/css" href="yoga.css">
<DIV ID="bg">
<BODY LINK ="BLUE" ID="wrapper">
<H1> Path of Light Yoga Studio </H1>

			<DIV ID="nav" CLASS="PathYoga">
				<STRONG>
					 <A HREF="index.php">Home</A> &nbsp;
					 <A HREF="class.php">Classes</A> &nbsp; 
					 <A HREF="schedule.php">Schedule</A> &nbsp;
					 <A HREF="register.php">Register</A> &nbsp;
					 <A HREF="contact.php">Contact</A>  &nbsp;
				</STRONG>
			</DIV>
 <MAIN> 
<H2>Contact Path of Light Yoga Studio </H2>
<P> Required information is marked with an asterisk (*). </P>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">
<TABLE CLASS="reg">
  <TR>
	<TD><Label for=Name>* Name:</Label></TD>
	<TD><input type="text" name="Name" value="<?php echo $name;?>"></TD>
	<TD><span class="error"> <?php echo $nameErr;?></span></TD>
  </TR>
  <TR>
	<TD><Label for=E-mail>* E-mail:</Label></TD>
	<TD>
		<input type="text" name="Email" value="<?php echo $email;?>"></TD>
		<TD><span class="error"><?php echo $emailErr;?></span></TD></TR>
	<TR>
	<TD><Label for=Comments>* Comments/Questions:</Label></TD>
	<TD> <textarea name="Comments" rows="2" cols="18"  value="<?php echo $comments;?>"><?php echo $comments;?></textarea></TD>
	<TD><span class="error"><?php echo $commentsErr;?></span></TD></TR>
   </TR>
 <TR><TD></TD>
<TD><input type="Submit" id="sendbd" Value="Send now"></TD></TR>
<TD></TD><TD></TD><TD></TD>
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