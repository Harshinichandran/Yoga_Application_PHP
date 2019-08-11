<?php    
 //Connection to the database   
	   $servername = "localhost";  
       $username = "root";  
       $password = "";  
       $conn = mysqli_connect ($servername , $username , $password) or die("unable to connect to host");  
       $sql = mysqli_select_db ($conn,'yoga') or die("unable to connect to database");
//Query for displaying the schedule of yoga with days, time and classes
$sql1 = "SELECT days.daysname, schedule.daysid
FROM schedule
    JOIN days
        ON schedule.daysid = days.daysid where schedule.daysid=1 LIMIT 1";
$sql2 = "SELECT days.daysname, schedule.daysid
FROM schedule
    JOIN days
        ON schedule.daysid = days.daysid where schedule.daysid=2 LIMIT 1";
		
$sql3 = "SELECT time.time, class.classname
FROM schedule
    JOIN time
        ON schedule.timeid = time.timeid
    JOIN class
        ON schedule.classid = class.classid where schedule.daysid=1 ORDER BY time.timeid";
$sql4 = "SELECT time.time, class.classname
FROM schedule
    JOIN time
        ON schedule.timeid = time.timeid
    JOIN class
        ON schedule.classid = class.classid where schedule.daysid=2 ORDER BY time.timeid";

$result1 = mysqli_query($conn,$sql1);
$result2 = mysqli_query($conn,$sql2);
$result3 = mysqli_query($conn,$sql3);
$result4 = mysqli_query($conn,$sql4);
$num= mysqli_num_rows($result3);
$num1= mysqli_num_rows($result4);
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
		<img src="yogalounge.jpg" alt="An image of a yoga lounge">
	</DIV>
		<h2> Yoga Schedule </h2>
			<p>Mats, blocks, and blankets provided. Please arrive 10 minutes before your class begins. Relax
			   in our Serenity Lounge before or after your class.</p>
			 <div class ="indent">
			 <?php  
			 if (mysqli_num_rows($result1) > 0) 
				{
					// displays daysname
					while($row = mysqli_fetch_assoc($result1)) 
					{
						echo "<h3>{$row["daysname"]}</h3>";
					}
				} else {
						echo "no results";
						}
				?>	
		<ul>				
			<?php 
			if(0==$num) {
				echo "No record";
				exit;
			} else {
			// displays classname and timings for the daysname
			while($row=mysqli_fetch_assoc($result3)) {
		
				echo "<li>{$row["time"]}&nbsp;{$row["classname"]}";
				}
			}
			?>
			</ul>
			<?php
			 if (mysqli_num_rows($result2) > 0) 
				{
					// displays daysname
					while($row = mysqli_fetch_assoc($result2)) 
					{
						echo "<h3>{$row["daysname"]}</h3>";
					}
				} else {
						echo "no results";
						}
			?>
			<ul>
			<?php
			if(0==$num1) {
				echo "No record";
				exit;
			} else {
			// displays classname and timings for the daysname
			while($row=mysqli_fetch_assoc($result4)) {
		
				echo "<li>{$row["time"]}&nbsp;{$row["classname"]}</li>";
				}
			}
			?> 
	<br>	
	</div>
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


