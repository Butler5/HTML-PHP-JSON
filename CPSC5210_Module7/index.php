<!DOCTYPE html>
<html>
	<head>
		<title>Dog Breed Database</title>
		<meta charset="utf-8" />
		
		<!-- Links to provided files.  Do not edit or remove these links -->
		<link href="dogicon.png" type="image/png" rel="shortcut icon" />

		<!-- Link to your CSS file that you should edit -->
		<link href="dogbreed.css" type="text/css" rel="stylesheet" />
		
		<!-- provided JavaScript files; do not modify -->
		<script src="https://ajax.googleapis.com/ajax/libs/prototype/1.7.3.0/prototype.js" type="text/javascript"></script>

		<!-- your files -->
		<script src="dogbreeds.js" type="text/javascript"></script>
	</head>

	<body>
		<div id="frame">
			<div id="banner">
				<a href="index.php"><img/></a>
				Dog Breed Database
			</div>

			<div id="main">
				<!-- your HTML output follows -->


				<h1>Search Breeds</h1>
				<p>Type in a dog breed to see more details about that breed!</p>
				<p><img src="popularbreeds.png" alt="Popular Breeds" /></p>

				
				<!-- form to search for every breed -->
				<form action="search-all-breeds.php" method="get">
					<fieldset>
						<legend>Type to search breeds</legend>
						<div>
							<input name="breedname" type="text" size="21" placeholder="breed name" autofocus="autofocus" /> 
							<input type="submit" value="go" />
						</div>
					</fieldset>
				</form>

				<div id="namearea">
			<form>
			<fieldset>
			<legend>Select A Breed</legend>
			<div>
				<!-- list of all breed names should be inserted into this select box -->
				<select id="allnames" name="allnames" disabled="disabled">
					<option value="">(choose a name)</option>
				</select>

				<button id="search">
					Search
				</button>

				<span class="loading" id="loadingnames">
					<img src="loading.gif" alt="icon" />
					Loading...
				</span>
			</div>
			</fieldset>
			</form>
		</div>
		
		<div id="resultsarea" style="display: none;">
			<div id="originmeaning">
				<h2>Breed Details:</h2>
				
				<div class="loading" id="loadingmeaning">
					<img src="loading.gif" alt="icon" />
					Searching...
				</div>

				<!-- Breed data should be inserted into this div -->
				<div id="meaning"></div>
			</div>

		</div>
		
		<!-- an empty div for inserting any error text -->
		<div id="errors"></div>
		
				<!-- form to search for movies where a given actor was with Kevin Bacon -->
		<!--		<form action="search-kevin.php" method="get">
					<fieldset>
						<legend>Movies with Kevin Bacon</legend>
						<div>
							<input name="firstname" type="text" size="12" placeholder="first name" /> 
							<input name="lastname" type="text" size="12" placeholder="last name" /> 
							<input type="submit" value="go" />
						</div>
					</fieldset>
				</form>
		-->
			</div> <!-- end of #main div -->
		</div> <!-- end of #frame div -->
	</body>
</html>