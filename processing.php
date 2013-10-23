<!DOCTYPE html>
<html>
<head>


<title>kgml2txt</title>
<link rel="shortcut icon" HREF="imgs/zhao.ico" TYPE="image/x-icon">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">   
<meta name="Description" content="KEGG xml pathway ">
<meta name="Keywords" content="KEGG xml pathway Zhao Li Na NTU">
<link rel="stylesheet" type="text/css" href="css/style_webserver.css" media="screen">
<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-34505451-1']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>



</head>

<body>
      
			
	<h1>kgml2txt server</h1>
	
	<h3>convert the info of kgml from KEGG database into the plain text.</h3>
	
	<div class="update">
	<p>update: Mon Oct 21 23:26:15 SGT 2013</p>
    <p>Any problem: zhao0139@e.ntu.edu.sg</p>
	</div>

	
    
	<article class="middle">

    <form  method="post">
    PATHWAY: hsa id <input type = "text" name = "hsaid" class="form"> eg: 04110 for <a href="http://www.genome.jp/kegg-bin/show_pathway?hsa04110" > Cell Cycle </a>.
       
 
    </form>
    <br>
    
    <?php
      
       exec('rm public/result.txt');

       if($_POST["hsaid"]){
            
        $javacmd = 'public/processingxml.sh ' . $_POST["hsaid"]; 
            
        exec($javacmd);
  
        exec('rm /tmp/*.htm');
        exec('rm /tmp/*.xml');
        }
    
    ?>

    <?php
    function read(){       
        $filename = "/tmp/".$_POST["hsaid"].".txt"; 
        
        if( file_exists($filename) ){
            if( filesize($filename) < 120 ){
                echo "Please input a vaild hsa id ...";
                echo chr(13);
            }else{

                $cmd = "cp " . $filename . " public/result.txt";
                exec($cmd);
                $fh = fopen($filename, "r");
                    while( ! feof($fh) ){
                    $line = fgets($fh);
                    $array = split("\t", $line);
                    //echo "$array[0]&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$array[1] &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$array[2]";
                    //echo chr(13);
                    printf("%s\t%s\t%s\n", $array[0], $array[1],$array[2]);
                }
                fclose($fh);
            }
        }
     }

    ?>

    <br>

    <textarea rows="15" cols="120" id="resultshow" style="resize: none;" data-role="none"> <?php read(); ?></textarea>

    <br>
    <br>
    
    <form method = "get" action = "public/result.txt" >
    <input name = downloadtxt type = submit value = "download full result" class = "savebutton" >
    </form>


    </article>
    
	<footer>
	<div id="copyright">
  		<span class="copyright">Copyright (c) 2012 2013 Zhao Li Na </span>
	</div>
	</footer>
	


</body>

</html>

