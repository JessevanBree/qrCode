<?php
	$_SESSION["user"] = "paul";
	//controleerd of de post is gebeurt.
	if(isset($_POST["submit"]) && isset($_FILES['bestand'])){
		//controleerd of de map (dir) bestaad.
		if(!file_exists("Docenten/".$_SESSION["user"])){
			mkdir("Docenten/".$_SESSION["user"], 0750);
		}
		
		//controleerd of het wel een img is.
		$check = getimagesize($_FILES["bestand"]["tmp_name"]);
		if($check !== false){
			$gebruikers_map = "Docenten/".$_SESSION["user"]."/";
			$bestandnaam = 'profile_picture.jpg';
			
			//converteed de afbeelding naar de standaard maat.
			//steld de nieuwe waardes in
			$new_width = 600;
			$new_height = 800;
			list($width, $height) = getimagesize($_FILES["bestand"]["tmp_name"]);//imagecopyresampled
			
			//laad de afbeelding
			$img_resized = imagecreatetruecolor($new_width, $new_height);
			$source = imagecreatefromjpeg($_FILES["bestand"]["tmp_name"]);
			
			//resize
			imagecopyresampled($img_resized, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
			
			//slaat de afbeelding op in de aangegeven map.
			imagejpeg($img_resized, $gebruikers_map.$bestandnaam);
		}
		else{
			echo"Dit is geen afbeelding";
		}
	}
?>


