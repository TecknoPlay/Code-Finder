<?php //é pour utf8

error_reporting(-1);
ini_set('display_errors', 1);

require_once('functions.php');


$ToFind = '' ;
$Chemin = '../../' ;
if (isset($_GET['chemin']))
{
	$ToFind = $_GET['toFind'] ;
	$Chemin = $_GET['chemin'] ;
}

?>
<!DOCTYPE html>
<html>
<head>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'/>
	<link href='styles.css' rel='stylesheet' type='text/css'/>
	<meta charset="iso-8859-1">
</head>
<body>
	
<div class="formu">
	<h1> Code Finder</h1>
	<form action="">
		<input type="text" name="toFind" class="aChercher" placeholder="A rechercher" value="<?=$ToFind?>"/><br/>
		<input type="text" name="chemin" class="chemin" placeholder="Chemin" value="<?=$Chemin?>"/><br/>
		
		<div class="ext">
		
			<div class="hintautreext">
				<label for="autreext">Extentions: </label>
				<p class="hint">
					Pour rechercher plusieurs extentions separez les par une virgule
				</p>
				<input type="text" placeholder="Par defaut: Toutes" name="autreext"	class="choixform autreext" <?php if(isset($_GET['autreext'])) echo "value=".$_GET['autreext']; ?>><br>
			</div>
		</div>
		<button type="submit" class= "Bouton Chercher">Rechercher</button>
	</form>
</div>

<?php
if (isset($_GET['chemin']) && isset($_GET['toFind']) && $_GET['chemin'] !="" && $_GET['toFind'] != "")
{
	//echo "<div class='error'>";

	if (isset($_GET['autreext']) && $_GET['autreext'] != "" )
	{
		$extention= str_replace(".", "", $_GET['autreext']);
		$extention= str_replace(" ", "", $_GET['autreext']);
		if (strpos($extention, ','))
		{
			$extention= "{".$extention."}";	
		}
		
		$listOfFiles= globFind($_GET['chemin']."/*.".$extention);
		//$listOfFiles= globFind($_GET['chemin']."/*.{php,htaccess}");
	}
			
	else
	{
		$listOfFiles = findFiles($_GET['chemin']);
	}

	//echo "</div>";
	findWord($listOfFiles);
}
?>


</body>
</html>