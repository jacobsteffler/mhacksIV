<!doctype html>

<?php

exec("rm -rf puzzles/" . $_GET["id"]);

?>

<html>
    <body>
        <script type="text/javascript">
            window.location.href = "/";
        </script>
    </body>
</html>