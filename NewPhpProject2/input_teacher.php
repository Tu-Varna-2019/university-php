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
            <label for="Title">Титла:</label>
            <select name="Title" id="Title">
                <?php
                 $res= mysqli_query($dbConn,"SELECT * FROM Title");
    while($row = mysqli_fetch_assoc($res)) {
        $valName=$row['TL_Name'];
       $valId=$row['TL_Id'];
    echo"<option value=$valId>$valName</option>";
    }
    ?>
                            </select>
            <font color="red">*</font>

            <br>
             <br>
            Телефонен номер: <input type="text" name="Phone">
            <br>
             <br>
            Е-mail: <input type="email" name="Email">
            <br>
            <br>
            <input type="submit" name="submit" value="Въведи">
            <br>
            <br>
            
        </form>

<?php
if (isset($_POST['submit'])) {
    $Email="Няма";
    $Phone="Няма";
    if (!empty($_POST['Name']) && !empty($_POST['Title'])) {
        $Name=$_POST['Name'];
        $Title=$_POST['Title'];
        if (!empty($_POST['Phone'])) { $Phone=$_POST['Phone'];}
        if (!empty($_POST['Email'])) { $Email=$_POST['Email'];}
        
        if (!mysqli_query($dbConn,"INSERT INTO Teacher (TCH_Id,TCH_Name,TL_FK_Id,Phone,TCH_Email) "
                . "Values(TCH_Id,'$Name',$Title,'$Phone','$Email')")) { die("<ul><li>Не могат да се добавят данните</li><li><a href='index.php'>Начало</a></li></ul> !");
                
                }else {        echo"<table border='1' size=25%><tr><th>Номер</th><th>Преподавател</th><th>Титла</th><th>Тел. номер</th><th>Еmail</th></tr>";
        $res= mysqli_query($dbConn,"SELECT * FROM Teacher JOIN Title ON (TL_Id = TL_FK_Id)");
    while($row = mysqli_fetch_assoc($res)) {
        
    echo"<tr><td>".$row['TCH_Id']."</td><td>".$row['TCH_Name']."</td><td>".$row['TL_Name']."</td><td>".$row['Phone']."</td><td>".$row['TCH_Email']."</td></tr>";
        
    }
    echo"</table><ul><li><a href='index.php'>Начало</a></li></ul>";
        }
    }else die("<ul><li>Moля въведете необходимата информация !</li><li><a href='index.php'>Начало</a></li></ul>");
    
}
?>

    </body>
</html>