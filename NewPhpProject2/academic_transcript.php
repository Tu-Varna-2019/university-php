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
text-align: left;
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
         <div class="header">
        <h2 align="center">Академична справка</h2>
         </div>
        <br>
        <ul>
        <?php
       
        $res= mysqli_query($dbConn,"SELECT * FROM Student JOIN Specialty ON ( SP_Id = SP_FK_Id ) ");
        echo"<ul type='disk'>";
        while ($row=mysqli_fetch_assoc($res)) {
            $FN=$row['Facility_num'];
            echo"<br><li><fieldset><li> Име: ".$row['ST_Name']."  <br> Факултетен номер: ".$row['Facility_num']."  <br> Специалност: ".$row['SP_Name']."  <br>Курс: ".$row['Course']
                    . "   <br>Email: ".$row["ST_Email"]."</li><br><hr>";
             $res_DS_R= mysqli_query($dbConn,"SELECT * FROM Student JOIN Rating ON ( Facility_num = ST_FK_R) JOIN Discipline ON ( DS_Id = DS_FK_R) WHERE Facility_num=$FN");
            while ($row_DS_R= mysqli_fetch_assoc($res_DS_R)) {
                echo"<br><li>Дисциплина: ".$row_DS_R['DS_Name']."<br>Oценка: ".$row_DS_R['Grade']."</li>";
            }
            echo"</fieldset>";
            
        }
     //   echo"<li><a href='index.php'>Начало</a></li></ul>";
        ?>
        </ul>
        <br>
        
    </body>
      
</html>

