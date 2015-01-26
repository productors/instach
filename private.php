<?php
    session_start();
    $login = $_SESSION['login'];
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Private</title>
        <meta name="description" content="Private">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="/img/logo.png">
        <link rel="stylesheet" href="libs/font-awesome-4.2.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/fonts.css">
        <link rel="stylesheet" href="css/media.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="libs/bootstrap/bootstrap-grid-3.3.1.min.css">
        <script language="JavaScript" type="text/javascript">
            var req;
            function processReqChange() {
                if (req.readyState == 4){      
                    if (req.status == 200){
                        document.getElementById('content').innerHTML=req.responseText;      
                     };        
                };
            };
            function loadXMLDoc(url) {  
                if (window.XMLHttpRequest) {        
                    req = new XMLHttpRequest();        
                    req.onreadystatechange = processReqChange;        
                    req.open("GET", url, true);        
                    req.send(null);    
                } else if (window.ActiveXObject) {        
                    req = new ActiveXObject("Microsoft.XMLHTTP");        
                    if (req) {            
                        req.onreadystatechange = processReqChange;
                        req.open("GET", url, true);    
                        req.send();            
                    };   
                };
            };
            function getFile(url){
                loadXMLDoc(url);   
            };    
        </script>
        <!--//////////////////////////////////////////////////////////////////////////////////////////////////////////////////-->
    </head>
    <body>
      <?php
    	$dbcon = mysql_connect("localhost", "mian", "petrovka"); 
    	mysql_select_db("instarep", $dbcon);
		if (!$dbcon)
		{
    		echo "<p>Произошла ошибка при подсоединении к MySQL!</p>".mysql_error(); 
    		exit();
    	}
    	else 
    	{
    		if (!mysql_select_db("instarep", $dbcon))
    		{
    			echo("<p>Выбранной базы данных не существует!</p>");
    		} 
		}
	
		//Формирование оператора SQL SELECT 
		$sqlCart = mysql_query("SELECT login, id, reposts FROM users WHERE login = '$login'", $dbcon);
		//Цикл по множеству записей и вывод необходимых записей 

 		while($row = mysql_fetch_array($sqlCart)) 
 		{
			//Присваивание записей 
			$name = $row["login"];
			$idn = $row["id"];
			$repostn = $row["reposts"];
  		}
  
    	// Если не пусты, то мы выводим ссылку
    	
    	echo "<div class='you_have'><font>You have <font color='red'>".$repostn."</font> points!</font></div>";

  		mysql_close($dbcon);   
    ?>     
       <div class="window" style="width:800px; height: 600px; margin: 0 auto;">
           <!--шапка-->
            <div class="hat" style="width:300px; height: 60px; margin: 0 auto; padding: 10px 0;">
               <div class="menu_private"><!--hidden-md hidden-lg hidden-sm hidden-xs-->
                    <a onclick="getFile('price.html')"><span class="a_span">Price</span></a>
                    <a onclick="getFile('about.html')"><span class="a_span">About</span></a>
                    <a onclick="getFile('need.html')"><span class="a_span">Need</span></a>
                </div>
                <button class="roll_but"><i class="fa fa-bars"></i></button>
            </div>
            
            <!--поле контента-->
            <div id="content" style="width: 800px; height: 410px;">
               <div class="menu_2" style="width:210px; height: 40px; margin: 0 auto;">
                <a onclick=getFile("earn.php?idn=<?php echo($idn)?>")><span class="a_span">Earn</span></a> 
	            <a onclick=getFile("spend.php?idn=<?php echo($idn)?>")><span class="a_span">Spend</span></a>
            </div>
                <p class="home_font">what will you do <span>next</span>?</p>
            </div>
            <!--ссылки в социальных сетях-->
            <div class="links" style="width: 220px; height: 70px; margin: 0 auto;">
                <a href="https://vk.com" class="vk"><i alt="vk.com" class='fa fa-vk'></i></a>
                <a href="https://twitter.com" class="twitter"><i alt="twitter.com" class="fa fa-twitter"></i></a>
                <a href="https://www.facebook.com" class="facebook"><i class="fa fa-facebook-square"></i></a>
                <a href="http://instagram.com/" class="instagram"><i class="fa fa-instagram"></i></a>
            </div>
            <a href="viiti.php">ВЫЙТИ</a>
        </div>
    </body>
</html>