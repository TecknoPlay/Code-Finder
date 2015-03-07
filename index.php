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
		<input type="text" name="toFind" class="aChercher" placeholder="A rechercher" value=""/><br/>
		<input type="text" name="chemin" class="chemin" placeholder="Chemin" value=""/><br/>
		
		<div class="ext">
		
			<div class="hintautreext">
				<label for="autreext">Extentions: </label>
				<p class="hint">
					Pour rechercher plusieurs extentions separez les par une virgule
				</p>
				<input type="text" placeholder="Par defaut: Toutes" name="ext"	class="choixform autreext" ><br>
			</div>
		</div>
		<button type="submit" class= "Bouton Chercher">Rechercher</button>
	</form>
</div>

<?php
if (isset($_GET['chemin']) && isset($_GET['toFind']) && $_GET['chemin'] !="" && $_GET['toFind'] != ""){
	error_reporting(-1);
	ini_set('display_errors', 1);
	include("class/CodeFinder.class.php");

	echo "<div class='result'><table ><tr>
	  			<th>Fichier</th>
	  			<th># ligne</th>
	 			<th>Contenu</th>
			</tr>";

	$results = CodeFinder::find($_GET['toFind'],$_GET['chemin'],$_GET['ext']);

	foreach ($results as $result) {
		echo "<tr>
	     	 	<td>{$result['file']}</td>
	     	 	<td>{$result['line']}</td>
	     	 	<td>{$result['content']}</td>
	     	 </tr>";
	}

}


	//echo $value['file'].$value['line'].$value['content']."<br>";


?>
