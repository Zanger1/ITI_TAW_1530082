<?php
if(isset($_GET['q']) and $_GET['q'] != '') {
    $dir = 'html/packages/Models/';
    $ext = '.php';
    $search = $_GET['q'];
    $results = glob("$dir/*$search*$ext");
    if(count($results) != 1) {
        foreach($results as $item) {
            echo "<li><a href='$item'>$item</a></li>\r\n";    
        }
    }
    if(count($results) == 1) {
        $item = $results[0];
        echo "<li color='blue'><a href='index.php?path=".$item."&file=".$item."' target='_blank'>$item - only result</a></li>\r\n";
    }
    if(count($results) == 0) {
       echo "<li>no results to display</li>\r\n";   
    }
}