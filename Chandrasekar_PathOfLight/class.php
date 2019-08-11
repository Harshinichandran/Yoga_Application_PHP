<?php    
	//Connection to the database
       $servername = "localhost";  
       $username = "root";  
       $password = "";  
       $conn = mysqli_connect ($servername , $username , $password) or die("unable to connect to host");  
       $sql = mysqli_select_db ($conn,'yoga') or die("unable to connect to database"); 
	 //Query for displaying the class and its description
	   $sqlQ = "select classname,description from class";    
	   $result = mysqli_query($conn,$sqlQ);  
 ?>
<HTML id="colour">
<link rel="stylesheet" type="text/css" href="yoga.css">
<DIV ID="bg">
	<BODY link="BLUE" ID="wrapper">
		<H1> Path of Light Yoga Studio </H1>

			<DIV id="nav">
				<STRONG>
					 <A HREF="index.php">Home</A> &nbsp;
					 <A HREF="class.php">Classes</A> &nbsp; 
					 <A HREF="schedule.php">Schedule</A> &nbsp;
					 <A HREF="register.php">Register</A> &nbsp;
					 <A HREF="contact.php">Contact</A>  &nbsp;
				</STRONG>
			</DIV>
		<MAIN>
			<DIV>
				<img src="yogamat.jpg" alt="yoga mat" height="300" width="900">
			</DIV>
		
		<H2>Yoga Classes</H2>
		<DL>
			<?php  
				if (mysqli_num_rows($result) > 0) 
				{
					// displays classname and description
					while($row = mysqli_fetch_assoc($result)) 
					{
					echo "<DT><B>	{$row["classname"]}	</B></DT>";
					
					echo "<DD> {$row["description"]} </DD> "; 
					
					}
				} else {
						echo "no results";
						}
				mysqli_close($conn);
			?>
				
			</DL>
			
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
 

