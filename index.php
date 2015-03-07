<html>
<head>

	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,700' rel='stylesheet' type='text/css'/>
<style>body{background-color:#1f253d;margin:auto;font-family:'Open Sans',sans-serif;font-weight:700;color:#FFF}.formu{width:700px;margin:50px auto auto;border-radius:10px;text-align:center;background-color:#394264;padding:20px}.aChercher,.chemin{width:300px;height:40px;color:#fff;background-color:#50597b;margin-bottom:10px;border:2px solid #11a8ab;border-radius:5px;padding:5px}input:focus{outline:0}.autreext{color:#fff;background-color:#50597b;height:40px;border:2px solid #11a8ab;border-radius:5px;padding:5px}.ext{font-family:'Open Sans',sans-serif;font-weight:300;color:silver}h2{text-align:center;text-shadow:2px 2px 2px rgba(0,0,0,.7)}.formu h1{font-size:50px;margin-top:0;text-shadow:4px 4px 4px rgba(0,0,0,.7)}.formu button{background-color:#11a8ab;height:40px;width:150px;border:none;color:#fff;font-size:20px;border-radius:5px;margin-top:10px;margin-bottom:-10px}.result{width:700px;display:table;margin:20px auto 0;padding:20px;border-radius:10px;background-color:#394264;font-family:'Open Sans',sans-serif;font-weight:400}table{border:1px solid #343c5b;border-width:1px;border-style:solid;border-collapse:collapse}td,th{border:2px solid #2f3652;padding:2px 2px 2px 5px}p.hint{display:none}.error{width:100%;text-align:center;background:#ff6767;display:table;margin:20px auto 0;padding:20px;border-radius:10px;box-sizing:border-box}div.hintautreext:hover>p.hint{position:absolute;display:block;font-size:14px;color:#fff;margin:-32px 0 0 460px;padding:3px 8px;background:#1f253d;border:2px solid #11a8ab;border-radius:5px;box-shadow:2px 2px 2px #000}</style>	
<meta charset="utf-8">
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
	$results = CodeFinder::find($_GET['toFind'],$_GET['chemin'],$_GET['ext']);

	$totalResult = sizeof($results);

	if ( $totalResult == 0){
		echo "<div class='result'>";
		echo "<h2>Nombre de résultat : $totalResult </h2>";
		echo "<div class='error'>Aucun resultats</div>";
		echo "</div >";
		die();
	}
	

	echo "<div class='result'>";
	

	echo"<table ><tr>
	  		<th>Fichier</th>
	  		<th># ligne</th>
	 		<th>Contenu</th>
		</tr>";
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
