<!doctype html>
<html>
<body>

    <?php
    $i = 0;
    $dir = 'puzzles/';
    if($handle = opendir($dir)) {
        while(($file = readdir($handle)) != false) {
            if(!in_array($file, array('.', '..')))
                $i++;
        }
    }

    $i++;
    ?>
    
    <?php
        
    ?>
    
    

</body>
</html>
