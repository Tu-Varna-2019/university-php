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
            Име:    <input type="text" name="Name"><font color="red">*</font>
            <br>
            <br>
            Факултетен номер: <input type="text" name="Fac_num"><font color="red">*</font>
            <br>
             <br>
            <label for="Specialty">Специалност:</label>
            <select name="Specialty" id="Specialty">
                <?php
                 $res= mysqli_query($dbConn,"SELECT * FROM Specialty");
    while($row = mysqli_fetch_assoc($res)) {
        $valName=$row['SP_Name'];
       $valId=$row['SP_Id'];
    echo"<option value=$valId>$valName</option>";
    }
    ?>
                            </select>
           
            <font color="red">*</font>

            <br>
             <br>
            Курс: <input type="text" name="Course"><font color="red">*</font>
            <br>
             <br>
            Е-mail: <input type="email" name="Email">
            <br>
            <br>
            <input type="submit" name="submit" value="Въведи">
            <br>
            <br>
           
                
           
            <br>
                 
       
        </form>


<?php
if (isset($_POST['submit'])) {
    $Email="Няма";
    
    if (!empty($_POST['Name']) && !empty($_POST['Fac_num']) && !empty($_POST['Specialty']) && !empty($_POST['Course'])) {
        $Name=$_POST['Name'];
        $Fac_n=$_POST['Fac_num'];
        $Specialty=$_POST['Specialty'];
        $Course=$_POST['Course'];
        if (!empty($_POST['Email'])) { $Email=$_POST['Email'];}
        
        
        
        
        if (!mysqli_query($dbConn,"INSERT INTO Student (ST_Name,Facility_num,SP_FK_Id,Course,ST_Email) "
                . "Values('$Name',$Fac_n,$Specialty,$Course,'$Email')")) { die("<ul><li>Не могат да се добавят данните</li> <li><a href='index.php'>Начало</a></li></ul> !");
                
                }else {        echo"<table border='1' size=25%><tr><th>Студент</th><th>Факултетен номер</th><th>Специалност</th><th>Курс</th><th>Еmail</th></tr>";
        $res= mysqli_query($dbConn,"SELECT * FROM Student JOIN Specialty ON (SP_Id = SP_FK_Id)");
    while($row = mysqli_fetch_assoc($res)) {
        
    echo"<tr><td>".$row['ST_Name']."</td><td>".$row['Facility_num']."</td><td>".$row['SP_Name']."</td><td>".$row['Course']."</td><td>".$row['ST_Email']."</td></tr>";
        
    }
    echo"</table><li><a href='index.php'>Начало</a></li></ul>";
        }
    }else die("<ul><li>Moля въведете необходимата информация !</li><li><a href='index.php'>Начало</a></li></ul>");
    
}
?>

    </body>
</html>
