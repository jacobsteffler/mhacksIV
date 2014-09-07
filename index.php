<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
    <title>GIF Sliding Puzzle</title>
    
    <style>
        html {
            min-height: 100%;
        }
        
        #title {
            text-align: center;
            color: white;
            font-size: 250%;
            background: #70a8e7;
            font-family: "Arial Black", Gadget, sans-serif;
        }
        
        body {
            background: url("bg.png") repeat-x left bottom;
        }
        
        #instructions {
            text-align: center;
            font-size: 110%;
            font-style: bold;
            font-family: "Times New Roman";
        }
        
        table {
            margin-left: auto;
            margin-right: auto;
        }
        
        td {
            padding: 10px;
        }
        
        img {
            border-radius: 10px;
        }
    </style>
</head>
    
<body>
    <h1 id="title">GIF SLIDING PUZZLE</h1>

    <?php


    error_reporting(E_ALL);
    ini_set("display_errors",1);

    $i = 0;
    $dir = 'puzzles/';
    $file_names=array();
    if($handle = opendir($dir)) {//See if directory exists
        while(($file = readdir($handle)) != false) {//Reads next directory in handle
            if(!in_array($file, array('.', '..')))
                 array_push($file_names, $file);
                 $i++;
        }
    }

    $i++;//i stores number of puzzles + + button
    
    $i = count($file_names) + 1;

    //String html representation
    $table = "<table>";

    //Concatenation of tr and td elements


       $num_rows=($i-1)/3+1;
       $num_columns=3;


       for($j=1; $j<=$i;$j++){

	   if($j==1){
		   tableTag($table,"o", "r");
		   tableTag($table,"o","c");
		   $table .= "<a href=\"record.html\"><img src= \"plus.png\"></a>";		   
	   }
	   else{
		   tableTag($table,"o","c");
//		   $table .= "<a href=\"puzzle.php?t=$file_names[$j-2]\"" . "<img src= \"" . "puzzles/" . $file_names[$j-2] . "/" . "thumbnail.jpg\"" . ">";
$table .= "<a href=\"puzzle.php?id=" . $file_names[$j-2] . "\"><img src=\"puzzles/" . $file_names[$j-2] . "/thumbnail.jpg\"></a>";

	   }
//DEBUG

	   tableTag($table,"c","c");

	   //Close the row. Start new row
	   if($j % $num_columns==0){
		tableTag($table,"c","r");
		if($j != $i){
		      tableTag($table,"o","r");
		}

	   }
           //Create placeholders to create/close more columns if necessary?
       }//End for loop
	   
	 

       $table .= "</table>";
       //Display the table
       echo $table;



      //row or column, open or close html tag
       function tableTag(&$tablehtml,$o_or_c, $r_or_c){
          $tablehtml .= "<" . ($o_or_c=="c" ? "/" : "");
          $tablehtml .= "t" . ($r_or_c=="r" ? "r>" : "d>"); 
       }



    ?>

    <p id="instructions">Take a 5-10 second video of your surroundings. Then solve an animated <a href= "http://en.wikipedia.org/wiki/15_puzzle"> 15 puzzle</a> constructed from the frames of your video.
    </p>
    
    

</body>
</html>
