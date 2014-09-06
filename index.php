<!doctype html>
<html>
<body>

    <?php
    $i = 0;
    $dir = 'puzzles/';
    $file_names=array();
    if($handle = opendir($dir)) {//See if directory exists
        while(($file = readdir($handle)) != false) {//Reads next directory in handle
            if(!in_array($file, array('.', '..')))
                 array_push($file_names,$file);
                 $i++;
        }
    }

    $i++;//i stores number of puzzles + + button

    //String html representation
    $table= "<table width='600' cellpadding ='5' cellspacing ='5' border='1'>";

    //Concatenation of tr and td elements
       $num_rows=(i-1)/3+1
       $num_columns=3

       for($j=1; j<=i;++j){
	   if(j==1){
		   tableTag(table,o, r);
		   table .= <Element with plus.png>
		   tableTag(table,c,r)
	   }

	}


       table .= "</table>"
       //Display the table
       echo $table;
       

      //row or column, open or close html tag
       function tableTag(&$tablehtml,$o_or_c, $r_or_c){
          $tablehtml .= "<" . o_or_c=="c" ? "/" : "";
          $tablehtml .= "t" . r_or_c=="r" ? "r" : "d" . ">"; 
       }


    ?>
    
    

</body>
</html>
