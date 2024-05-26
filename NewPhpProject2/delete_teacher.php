<?php include('config.php');if (!mysqli_select_db($dbConn,'University')) {
    die("Не може да избере базата данни!");
} ?>


<html>
                <head>
      <style>
body {
    background-color:#C5E2F6;



margin: 0;
}
ul {
list-style-type: none;
margin: 0;
padding: 0;
text-align: center;
 border: 3px solid #BCC1E9;
width: 100%;
background-color: #C5E2F6;


position: fixed;
height: 100%;
overflow: auto;
}
li a {
display: block;
color: #000;
padding: 8px 16px;
text-decoration: none;
}
li a.active {
background-color: #4CAF50;
color: white;
}
li a:hover:not(.active) {
background-color: #555;
color: white;
}

.header {

background-color:#0D6DB0
;
color:white;
padding: 20px;
text-align: left;

}



</style>
    </head>
  
    <body>
        <form action="#" method="POST">
            <br>
            <div class="header">
            <h2 align="center"> Въведете имената на преподавателя, който искате да изтриете:</h2>
            </div>
            <br>
            <br>
           Имена:<input type="text" name="Name">
            <br>
            <br>
            <input type="submit" name="submit" value="Потвърди !">
        
         </form>
    
       <br>
       <br>
<?php
if (isset($_POST['submit'])) {
 
   
    $flag=false;
    $Name=$_POST['Name'];
    $res= mysqli_query($dbConn,"SELECT * FROM Teacher");
    while($row = mysqli_fetch_assoc($res)) {
       
       if ($_POST['Name'] == $row['TCH_Name']) { $flag=true; }
    }
    
    if (!$flag) {
        die("<ul><li>Преподавател с такова име не съществува</li><li><a href='index.php'>Начало</a></li></ul> !");
    }
    else  {
        
        if (!mysqli_query($dbConn,"DELETE FROM Teacher WHERE TCH_Name = '$Name' ")) { die("<ul><li>Не може да се изтрие преподавател !</li><li><a href='index.php'>Начало</a></li></ul>");}
        else echo"<ul><li>Изтриването бе успешно</li><li><a href='index.php'>Начало</a></ul> !";
    }
    }
        ?>
       <br>
       <br><br>
        
   
    </body>
</html>