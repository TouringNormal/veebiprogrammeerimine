<?php	
	function readAllFilms(){
		//var_dump($GLOBALS);
		//loeme andmebaasist filmide infot
		//loome andmebaasiühenduse ($mysqli  $conn)
		//$conn = new mysqli($serverHost, $serverUsername, $serverPassword, $database);
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//valmistan ette päringu
		$stmt = $conn -> prepare("SELECT pealkiri, aasta FROM film");
		echo $conn -> error;
		
		//$filmtitle = "Tühjus";
		$filmInfoHTML = null;
		$stmt -> bind_result($filmTitle, $filmYear);
		$stmt -> execute();
		//sain pinu (stack) täie infot, ühe kaupa võtma, kuni saab
		while($stmt -> fetch()){
			//echo " Pealkiri: " .$filmTitle;
			$filmInfoHTML .= "<h3>" .$filmTitle ."</h3>";
			$filmInfoHTML .= "<h3>" .$filmYear ."</h3>";
		}
		//sulgen ühenduse
		$stmt -> close();
		$conn -> close();
		return $filmInfoHTML;
	}
	
	function storeFilmInfo($filmTitle, $filmYear, $filmDuration, $filmGenre, $filmStudio, $filmDirector){
		$conn = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $conn -> prepare("INSERT INTO film (pealkiri, aasta, kestus, zanr, tootja, lavastaja) VALUES (?,?,?,?,?,?)");
		echo $conn -> error;
		//andmetüübid: s - string, i - integer, d - decimal
		$stmt -> bind_param("siisss", $filmTitle, $filmYear, $filmDuration, $filmGenre, $filmStudio, $filmDirector);
		$stmt -> execute();
		
		$stmt -> close();
		$conn -> close();
	}
	
	
	