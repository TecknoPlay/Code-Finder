<?php //é pour utf8

function globFind($pattern) {
	//echo $pattern."<br>";
    $files = glob("$pattern", GLOB_BRACE); 
    foreach (glob(dirname($pattern).'/*',GLOB_ONLYDIR|GLOB_NOSORT) as $dir) {
        $files = array_merge($files, globFind($dir.'/'.basename($pattern)));
    }
    //echo "globFind";
    return $files;
}

function findFiles($chemin)
{
	//echo "normalFind";
	if (file_exists($chemin))
	{
		$ite=new RecursiveDirectoryIterator($chemin);
	
		$bytestotal=0;
		$nbfiles=0;
		$files= array();
		foreach (new RecursiveIteratorIterator($ite) as $filename=>$cur)
		{
			if (!is_link($cur))
			{
				if (!strpos($filename, ".jpg") && !strpos($filename, ".gif") && !strpos($filename, ".zip") && !strpos($filename, ".rar") && !strpos($filename, ".png"))
				{
					$filesize = $cur->getSize() ;
					
					if ($filesize < 1 * 1000000)
					{
						$files[] = $cur;
					}
		   		}
		   	}
		}
		return $files ;
	}
}

function findWord($listOfFiles)
{
	
	if (sizeof($listOfFiles) != 0)
	{
		$cpt=0;
		echo "<div class='result'><table >
			<tr>
	  			<th>Fichier</th>
	  			<th># ligne</th>
	 			 <th>Contenu</th>
			</tr>";

		foreach($listOfFiles as $aVerif)
	  	{
	    	foreach (file($aVerif) as $line_num => $line) {
	    		if(strpos($line, $_GET['toFind'])!==false)
	   			{
	     			//echo $filename.' on line '.($fli+1)."<br>";
	     			echo "<tr>
	     	 			<td>$aVerif </td>
	     	 			<td>{$line_num}</td>
	     	 			<td>".htmlspecialchars($line)."</td>
	     	 		</tr>";
	     	 		$cpt++;
	   	 		}   
			}
	  	}
	  	echo "</table>";
	  	if ($cpt == 0)
	  	{
	  		echo ("</div>
				<script>document.getElementsByClassName('result')[0].style.display = 'none';</script>
	  			<div class='error'>Aucun resultats</div>");
	  	}
	  	else
	  	{
			echo "<h2>Nombre de resultats: $cpt</h2></div></div>";
		}
	}
	else
	{
		echo ("<div class='error'>Dossier non trouvé</div>");
	}
}

?>