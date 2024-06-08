<!DOCTYPE html>
<html>
	<head>
		<title>Rancid Tomatoes</title>

		<meta charset="utf-8" />
		<link href="movie.css" type="text/css" rel="stylesheet" />
		<link href="rotten.gif" type="image/gif" rel="shortcut icon"/>
	</head>
<?php
		//variables
		$movie = $_GET["film"];
		$raw_info = file_get_contents("$movie/info.txt");
		$raw_overview = file_get_contents("$movie/overview.txt");
		$info = explode("\n", $raw_info);
		$overview = explode("\n", $raw_overview);
		$count = 0;
		$freshness = "";
		$freshAlt = "";
		
		//this sets the value for freshness and freshAlt
		if (intval($info[2]) >= 60){
				$freshness = "freshbig.png";
				$freshAlt = "Fresh";
			}
			else{
				$freshness = "rottenbig.png";
				$freshAlt = "Rotten";
			}
		
		//functions
		
		//this function displays the overview sidebar 
		function sidebar(){
			global $overview;
			foreach($overview as $row){
				$row = explode(":", $row);
				echo "<dt>{$row[0]}</dt><dd>{$row[1]}</dd>";
			}
		}
		
		//this function gets the review information
		function getReviews(){
			global $movie;
			global $count;
			$raw_review = array();
			foreach (glob("$movie/review*.txt") as $filename){
				$raw_review[$count] = file_get_contents("$filename");
				$count++;
			}
			for ($i=0;$i<$count;$i++){
				$review = explode("\n", $raw_review[$i]);
				displayReview($review,$i);
			}
		}
		
		//this function displays the review information
		function displayReview($review,$num){
			global $count;
			$num++;
			$review[1] = strtolower($review[1]);
			echo "<p class='review'>
						<img src='{$review[1]}.gif' alt='{$review[1]}' />
						<q>{$review[0]}</q>
				 </p>
				 <p class='reviewer'>
				 		<img src='critic.gif' alt='Critic' />
				 		{$review[2]}<br />
				 		{$review[3]}
				 </p>";
			if($num == ceil($count/2)){
			echo "</div>
				  <div class='column'>";
			}
		}			
	?>
	<body>
		<div class="banner">
			<img src="banner.png" alt="Rancid Tomatoes" />
		</div>

		<h1><?echo "$info[0] ($info[1])";?></h1>
		
		<div class="overall">
		
			<div class="overview">
			
				<div>
				<img src="overview.png" alt="general overview" />
				</div>

				<dl>
					<?php sidebar();?>
				</dl>
			
			</div>

			<div class="reviewsection">
			
				<div class="rotten">
					<img id="rotten" src="<?=$freshness?>" alt="<?=$freshAlt?>" />
					<?=$info[2]?>%
				</div>
				
				<!--1st review column-->
				<div class="reviewcolumn">
					<?php getReviews();?>
				</div>
				
				<!--2nd Review Column-->
				<div class="reviewcolumn">
					
				</div>
			
					<p id="footer">(1- <?=$count?>) of <?=$count?></p>
				
			</div>	
				
		</div>
		
	</body>
</html>