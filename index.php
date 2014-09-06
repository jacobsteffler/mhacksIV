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



       table =table . "<tr><td> plus.png </td>"
       //Now add two more thumbnails via file_names array
       if($i==2){//Only one puzzle available
          table= table . " <td> " . $file_names[0] . "\thumbnail.jpg" . "</td>";
       
       //Place holder for 3rd column
          table .= "<td> ". placeholder . "</td>";
          table .= table . "</tr>"
       }

       else{ //i is 3 or greater
       


       }


    
    ?>
    
    

</body>
</html>
