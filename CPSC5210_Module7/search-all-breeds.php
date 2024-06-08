<!DOCTYPE html>
<html>
	<head>
		<title>Dog Breed Database</title>
		<meta charset="utf-8" />
		
		<!-- Links to provided files.  Do not edit or remove these links -->
		<link href="dogicon.png" type="image/png" rel="shortcut icon" />

		<!-- Link to your CSS file that you should edit -->
		<link href="dogbreed.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<div id="frame">
			<div id="banner">
				<a href="index.php"><img /></a>
				Dog Breed Database
			</div>

			<div id="main">
				<!-- your HTML output follows -->
		<h1>Results for <?php echo $_GET['breed_name'] . " " . $_GET['breed_fact'] ?></h1> <br/><br/>
        <div id="text">All Breeds</div><br/>
        <table>
            <tr>
                <td class="index"><strong>#</strong></td>
                <td class="breedname"><strong>Breed Name</strong></td>
                <td class="breedfact"><strong>Breed Detail</strong></td>
            </tr>
            <?php  
    			$dbh = new PDO("mysql:host=sysmysql8.auburn.edu;dbname=abb0025db", "abb0025", "Bama1515!");

				$q1 = "SELECT id 
					FROM dogs 
					WHERE (breed_name LIKE '".$_GET['breedname']." %' OR breed_name = '".$_GET['breedname']."') AND breed_fact = '".$_GET['breedfact']."'";
				$id = null;
				//only returns 1 row
				foreach($dbh->query($q1) as $row){
  				  $id = $row['id']	;
			}
				//If breedname is not in the database
				if($id == null){
			    echo "Dog Breed ";
			    echo $_GET['breedname'];
			    echo " ";
			    echo " not found.";
			}
       
            $i = 0;
			//Prints every movie result
            foreach($dbh->query($sql2) as $row){
                echo "<tr><td class=\"index\">";
                echo $i+1;
                echo "</td><td class=\"breedname\">";
                echo $row['breedname'];
                echo "</td><td class=\"breedfact\">";
                echo $row['breedfact'];
                echo "</td></tr>";
                $i++;
            }
			//close the connection
            $dbh = null;
            ?>

        </table>
	
<!-- form to search for every movie by a given actor -->
				<form action="search-all-breeds.php" method="get">
					<fieldset>
						<legend>All Breeds</legend>
						<div>
							<input name="breedname" type="text" size="21" placeholder="breed name" autofocus="autofocus" /> 
							<input type="submit" value="go" />
						</div>
					</fieldset>
				</form>

				<!-- form to search for movies where a given actor was with Kevin Bacon -->
				<!--<form action="search-kevin.php" method="get">
					<fieldset>
						<legend>Movies with Kevin Bacon</legend>
						<div>
							<input name="firstname" type="text" size="12" placeholder="first name" /> 
							<input name="lastname" type="text" size="12" placeholder="last name" /> 
							<input type="submit" value="go" />
						</div>
					</fieldset> 
				-->
				</form>
			</div> <!-- end of #main div -->
		</div> <!-- end of #frame div -->
	</body>
</html>