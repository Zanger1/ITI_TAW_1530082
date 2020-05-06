<?php
function listFolderFiles($dir){
    $ffs = scandir($dir);

    unset($ffs[array_search('.', $ffs, true)]);
    unset($ffs[array_search('..', $ffs, true)]);

    // prevent empty ordered elements
    if (count($ffs) < 1)
        return;

    echo "\n\t<ul>";
    foreach($ffs as $ff){
        if(is_dir($dir.'/'.$ff)){
			        echo "\n\t\t<li> - ".$ff;
			listFolderFiles($dir.'/'.$ff);
		} else {
			echo "\n\t\t<li><a href='index.php?path=".$dir."/".$ff."&file=".$ff."' target='_blank'> - ".$ff."</a>";
		}
        echo "</li>";
    }
    echo "\n</ul>\n";
}

echo "\n<div id='html1'> - Packages";
listFolderFiles('html/packages');
echo "\n</div>";