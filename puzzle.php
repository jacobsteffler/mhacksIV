<!doctype html>

<?php
$id = $_GET["id"];
?>

<html>
    <head>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
        <title>GIF Sliding Puzzle</title>
        
        <style>
            html {
                min-height: 100%;
            }
            
            #cent {
                width: 700px;
                height: 700px;
                margin-left: auto;
                margin-right: auto;
            }
            
            body {
                margin-top: 10px;
                background: url("bg.png") repeat-x left bottom;
            }
            
            a {
                width: 45%;
                margin-top: 20px;
                margin-left: auto;
                margin-right: auto;
            }
            
            #del {
                color: white;
                background: rgb(202, 60, 60);
            }
            
            table {
                margin: 0 auto;
                margin-left: auto;
                margin-right: auto;
            }
            
            table, td {
                border-collapse: collapse;
                border: none;
                padding: 0;
                margin: 0;
                line-height: 0;
            }

	    #stop-watch{
	        font   : "Times New Roman";
	        margin-top: 100px;
            text-align: center;
	    }
        </style>
    </head>

    <body>
        <div id="cent">
            <table id="table">
                <tr>
                    <td><div id="1"><img width="175" height="175" src=<?php echo("\"puzzles/" . $id . "/1.gif\""); ?> ></div></td>
                    <td><div id="2"><img width="175" height="175" src=<?php echo("\"puzzles/" . $id . "/2.gif\""); ?> ></div></td>
                    <td><div id="3"><img width="175" height="175" src=<?php echo("\"puzzles/" . $id . "/3.gif\""); ?> ></div></td>
                    <td><div id="4"><img width="175" height="175" src=<?php echo("\"puzzles/" . $id . "/4.gif\""); ?> ></div></td>
                </tr>
                <tr>
                    <td><div id="5"><img width="175" height="175" src=<?php echo("\"puzzles/" . $id . "/5.gif\""); ?> ></div></td>
                    <td><div id="6"><img width="175" height="175" src=<?php echo("\"puzzles/" . $id . "/6.gif\""); ?> ></div></td>
                    <td><div id="7"><img width="175" height="175" src=<?php echo("\"puzzles/" . $id . "/7.gif\""); ?> ></div></td>
                    <td><div id="8"><img width="175" height="175" src=<?php echo("\"puzzles/" . $id . "/8.gif\""); ?> ></div></td>
                </tr>
                <tr>
                    <td><div id="9"><img width="175" height="175" src=<?php echo("\"puzzles/" . $id . "/9.gif\""); ?> ></div></td>
                    <td><div id="10"><img width="175" height="175" src=<?php echo("\"puzzles/" . $id . "/10.gif\""); ?> ></div></td>
                    <td><div id="11"><img width="175" height="175" src=<?php echo("\"puzzles/" . $id . "/11.gif\""); ?> ></div></td>
                    <td><div id="12"><img width="175" height="175" src=<?php echo("\"puzzles/" . $id . "/12.gif\""); ?> ></div></td>
                </tr>
                <tr>
                    <td><div id="13"><img width="175" height="175" src=<?php echo("\"puzzles/" . $id . "/13.gif\""); ?> ></div></td>
                    <td><div id="14"><img width="175" height="175" src=<?php echo("\"puzzles/" . $id . "/14.gif\""); ?> ></div></td>
                    <td><div id="15"><img width="175" height="175" src=<?php echo("\"puzzles/" . $id . "/15.gif\""); ?> ></div></td>
                    <td><div id="16"><img width="175" height="175" src="blank.png"</div></td>
                </tr>
            </table>
            
            <a class="pure-button pure-button-primary" href="/">Return to puzzles</a>
            <a class="pure-button" id="del" href="delete.php?id=<?php echo($id); ?>">Delete this puzzle</a>
        </div>
        
        <h2 id="stop-watch">00:00</h2>
        
        <script type="text/javascript">
            var tiles = [[1, 2, 3, 4], [5, 6, 7, 8], [9, 10, 11, 12], [13, 14, 15, 16]];
            var correct = [[1, 2, 3, 4], [5, 6, 7, 8], [9, 10, 11, 12], [13, 14, 15, 16]];
            
            var ready;
//            var start_time =new Date();
            var sec;
            var interval;
            var winTime = "-1";

            window.onload = function() {
                ready = false;
                sec = 0;
                
                for(count = 1; count < 500; count++) {
                    var rand = Math.floor((Math.random() * 16) + 1);
                    requestSwitch(rand);
                }
                
                ready = true;
                interval = setInterval(setTime, 1000);
                
                reapply();
            }
            
            function setTime() {
                sec++;
                var minutes = Math.floor(sec / 60);
                
                document.getElementById("stop-watch").innerHTML = pad(minutes) + ":" + pad(sec % 60);
            }
            
            function pad(val)
            {
                var valString = val + "";
                if(valString.length < 2)
                {
                    return "0" + valString;
                }
                else
                {
                    return valString;
                }
            }
            
            function findIndex(number) {
                for(i = 0; i < 4; i++) {
                    for(j = 0; j < 4; j++) {
                        if(tiles[i][j] == number) {
                            return [i, j];
                        }
                    }
                }
            }
            
            function requestSwitch(cell) {
                //var location = findIndex(cell);
                var location = cellToIndex(cell);
                var image = tiles[location[0]][location[1]];
                var up = false, down = false, left = false, right = false;
                
                if(location[0] == 0) {
                    up = false
                } else if(tiles[location[0] - 1][location[1]] == 16) {
                    up = true;
                }
                
                if(location[0] == 3) {
                    down = false
                } else if(tiles[location[0] + 1][location[1]] == 16) {
                    down = true;
                }
                
                if(location[1] == 0) {
                    left = false
                } else if(tiles[location[0]][location[1] - 1] == 16) {
                    left = true;
                }
                
                if(location[1] == 3) {
                    right = false
                } else if(tiles[location[0]][location[1] + 1] == 16) {
                    right = true;
                }
                
                if(up) {
                    tiles[location[0] - 1][location[1]] = image;
                    tiles[location[0]][location[1]] = 16;
                    switchCells(cellIndex(location[0], location[1]), cellIndex(location[0] - 1, location[1]));
                }
                
                if(down) {
                    tiles[location[0] + 1][location[1]] = image;
                    tiles[location[0]][location[1]] = 16;
                    switchCells(cellIndex(location[0], location[1]), cellIndex(location[0] + 1, location[1]));
                }
                
                if(left) {
                    tiles[location[0]][location[1] - 1] = image;
                    tiles[location[0]][location[1]] = 16;
                    switchCells(cellIndex(location[0], location[1]), cellIndex(location[0], location[1] - 1));
                }
                
                if(right) {
                    tiles[location[0]][location[1] + 1] = image;
                    tiles[location[0]][location[1]] = 16;
                    switchCells(cellIndex(location[0], location[1]), cellIndex(location[0], location[1] + 1));
                }
                
                if(match() && ready) {
                    if(winTime == "-1") {
                        winTime = document.getElementById("stop-watch").innerHTML;
                    }
                    
                    clearInterval(interval);
                    new Audio("zelda_treasurechest.mp3").play();
                    alert("Congratulations! You won.");
                    document.getElementById("stop-watch").innerHTML = "<a href=\"http://twitter.com/home?status=I scored a time of " + winTime + " in GIF Sliding Puzzle! %23MHacks\">Tweet your time of " + winTime + "</a>";
                }
            }
            
            function match() {
                var matching = true;
                
                for(i = 0; i < 4; i++) {
                    for(j = 0; j < 4; j++) {
                        if(tiles[i][j] != correct[i][j]) {
                            matching = false;
                        }
                    }
                }
                
                return matching;
            }
            
            function cellToIndex(cell) {
                return [Math.floor((cell - 1) / 4), (cell - 1) % 4];
            }
            
            function cellIndex(row, col) {
                return row * 4 + col + 1;
            }
                
            function switchCells(cellOne, cellTwo) {
                var table = document.getElementById("table");
                var r1 = Math.ceil(cellOne / 4);
                var c1 = (cellOne - 1) % 4 + 1;
                var r2 = Math.ceil(cellTwo / 4);
                var c2 = (cellTwo - 1) % 4 + 1;
                
                var one = document.getElementById(cellOne);
                var two = document.getElementById(cellTwo);
                
                //var cont1 = table.rows[r1-1].cells[c1-1].src;
                var cont1 = one.innerHTML;
                var cont2 = two.innerHTML;
                //var cont2 = table.rows[r2-1].cells[c2-1].src;
                
                one.innerHTML = cont2;
                two.innerHTML = cont1;
            }
            
            function reapply() {
                document.getElementById("1").onclick = function() {
                    requestSwitch(1);
                }
                document.getElementById("2").onclick = function() {
                    requestSwitch(2);
                }
                document.getElementById("3").onclick = function() {
                    requestSwitch(3);
                }
                document.getElementById("4").onclick = function() {
                    requestSwitch(4);
                }
                document.getElementById("5").onclick = function() {
                    requestSwitch(5);
                }
                document.getElementById("6").onclick = function() {
                    requestSwitch(6);
                }
                document.getElementById("7").onclick = function() {
                    requestSwitch(7);
                }
                document.getElementById("8").onclick = function() {
                    requestSwitch(8);
                }
                document.getElementById("9").onclick = function() {
                    requestSwitch(9);
                }
                document.getElementById("10").onclick = function() {
                    requestSwitch(10);
                }
                document.getElementById("11").onclick = function() {
                    requestSwitch(11);
                }
                document.getElementById("12").onclick = function() {
                    requestSwitch(12);
                }
                document.getElementById("13").onclick = function() {
                    requestSwitch(13);
                }
                document.getElementById("14").onclick = function() {
                    requestSwitch(14);
                }
                document.getElementById("15").onclick = function() {
                    requestSwitch(15);
                }
                document.getElementById("16").onclick = function() {
                    requestSwitch(16);
                }
            }
        </script>

    </body>
</html>
