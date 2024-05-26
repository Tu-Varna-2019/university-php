<?php include('create.php'); ?>
<html>
    <title>Университет</title>
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
text-align: center;

}



</style>
    </head>
    <div class="header">
    <h1 align="center"  >Университет</h1>
    </div>
    <body>
     
        <ul>
            <li>
        <a href="input.php" align="justify">Въвеждане</a>
            </li>
      <li>
        <a href="update.php" align="justify">Редактиране</a>
         </li>
         <li>
          <a href="delete.php" align="justify">Изтриване</a>
         </li>
           <li>
            <a href="search.php" align="justify">Търсене</a>
          </li>
          <li>
             <a href="academic_transcript.php" align="justify">Академична справка</a>
          </li>
           <li>
                  <a href="average_transcript.php" align="justify">Среден успех за студенти за специалност/курс</a>
           </li>
              <li>
                  <a href="average_transcript2.php" align="justify">Среден успех за дисциплини</a>
              </li>
              <li>
              <a href="print.php" align="justify">Извеждане на всички данни</a>
              </li>
   
        </ul>

    </body>
    
</html>

      
    

