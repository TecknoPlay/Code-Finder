<?php

/**
* CodeFinder - Find everything in your code 
* The function findInCode take 3 args thePath, wordToFind, extention
*/
class CodeFinder {

	static private $_ext;
	static private $_path;
	static private $_fileList;
	const MINSIZE = 10;
	const MAXSIZE = 1000000;

	static private $_listResult;



	static public function find($text, $path, $ext="",$req=TRUE){
	
		self::clearExt($ext);
		
		
		self::clearPath($path);
		
		self::findInFolder();
		

		
		self::findWord($text);

		return self::$_listResult;
		



	
	

	}

	static public function findInFolder(){
		$path = self::$_path;
		$ite=new RecursiveDirectoryIterator($path);
		foreach (new RecursiveIteratorIterator($ite) as $filename=>$cur) {
		    if ($cur->getSize() > self::MINSIZE &&  $cur->getSize() < self::MAXSIZE){
		    	
		    	if (self::$_ext[0] != '*'){
		    		
		    		$ext = explode('.', $filename);
		    		$ext = $ext[sizeof($ext)-1];
		    		if (in_array($ext, self::$_ext))
		    			self::$_fileList[]= $filename;
		    		
		    	}
		    	else{
		    		
		    		self::$_fileList[]= $filename;
		    	}

		    }

		    		
		}
	}

	static private function clearExt($ext){ //create a array with all extention to find.
		if ($ext == "")
			self::$_ext[0] = "*";
		else{
			$ext = explode(" ", $ext);
			foreach ($ext as $extention) {
				$extTmp = str_replace(".", "", $extention);
				$extTmp = str_replace("-", "", $extTmp);
				self::$_ext[] = $extTmp;
	
			}
		}
	}

	static private function clearPath($path){ //create a array with all extention to find.
		
		if ($path[sizeof($path)] == "/")
			self::$_path = substr($path, 0, -1);
		else
			self::$_path = $path;

	
			
		
	}



	static private function findInOneFolder(){
		$path = self::$_path;

		foreach ( self::$_ext as $extention) {
			foreach (glob("$path*.$extention") as $filename) {
	    		self::$_fileList[] = $filename ;
			}
		}

	}

	static private function findWord($word){
		foreach(self::$_fileList as $file)
	  	{
	    	foreach (file($file) as $line_num => $line) {
	    		if(strpos($line, $word)!==false)
	   			{
	   				self::$_listResult[]= array(
	   										"file" => $file,
	   										"line" => $line_num,
	   										"content" => htmlspecialchars($line)
	   									);
	     			
	     	 		
	   	 		}   
			}
	  	}
	}


}


?>
