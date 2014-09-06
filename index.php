<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
    
    <style>
        table {
            margin-left: auto;
            margin-right: auto;
        }
        
        td {
            padding: 10px;
        }
    </style>
</head>
    
<body>

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
    
    

</body>
</html>
