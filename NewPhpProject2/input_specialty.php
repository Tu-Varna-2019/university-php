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
        
         <div class="header"> <h1 align="center">Моля въведете данните  с<font color="red">  * </font> ! </h1></div>
        
        <form action="#" method="POST">
            <br>
            Специалност:   <input type="text" name="Specialty"><font color="red">*</font>
            <br>
            <br>
            <input type="submit" name="submit" value="Въведи">
            <br>
            <br>
     
             
        </form>

<?php
if (isset($_POST['submit'])) {
    
    
    if( !empty($_POST['Specialty'])) { $Specialty=$_POST['Specialty'];
        
        if (!mysqli_query($dbConn,"INSERT INTO Specialty (SP_Id,SP_Name) "
                . "Values(SP_Id,'$Specialty')")) 
                { die("<ul><li>Не могат да се добавят данните</li><li><a href='index.php'>Начало</a></li></ul> !");
                }else {        echo"<table border='1' size=25%><tr><th>Номер</th><th>Специалност</th></tr>";
        $res= mysqli_query($dbConn,"SELECT * FROM Specialty");
    while($row = mysqli_fetch_assoc($res)) {
        
    echo"<tr><td>".$row['SP_Id']."</td><td>".$row['SP_Name']."</td></tr>";
        
    }
    echo"</table><ul><li><a href='index.php'>Начало</a></li></ul>";
        }

    
                
                
    
                
                }else die("<ul><li>Moля въведете необходимата информация !</li><li><a href='index.php'>Начало</a></li></ul>");
    
}

?>

    </body>
</html>
