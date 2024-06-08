<!DOCTYPE html>
<html>
	<head>
		<title>My Movie Database (MyMDb)</title>
		<meta charset="utf-8" />
		
		<!-- Links to provided files.  Do not edit or remove these links -->
		<link href="favicon.png" type="image/png" rel="shortcut icon" />

		<!-- Link to your CSS file that you should edit -->
		<link href="bacon.css" type="text/css" rel="stylesheet" />
	</head>

	<body>
		<div id="frame">
			<div id="banner">
				<a href="index.php"><img src="mymdb.png" alt="banner logo" /></a>
				My Movie Database
			</div>

			<div id="main">
				<!-- your HTML output follows -->
		<h1>Results for <?php echo $_GET['firstname'] . " " . $_GET['lastname'] ?></h1> <br/><br/>
        <div id="text">All Films</div><br/>
        <table>
            <tr>
                <td class="index"><strong>#</strong></td>
                <td class="title"><strong>Title</strong></td>
                <td class="year"><strong>Year</strong></td>
            </tr>
            <?php  
    			$dbh = new PDO("mysql:host=sysmysql8.auburn.edu;dbname=abb0025db", "abb0025", "Bama1515!");

				//Gets the searched actor's id, tiebreaker is filmCount
				$q1 = "SELECT id 
					FROM actors 
					WHERE (first_name LIKE '".$_GET['firstname']." %' OR first_name = '".$_GET['firstname']."') AND last_name = '".$_GET['lastname']."' 
					AND film_count >= all(SELECT film_count 
					
					FROM actors 
					WHERE (first_name LIKE'".$_GET['firstname']." %' OR first_name = '".$_GET['firstname']."') 
					AND last_name = '".$_GET['lastname']."')";
				$id = null;
				//only returns 1 row
				foreach($dbh->query($q1) as $row){
  				  $id = $row['id']	;
			}
				//If actor is not in the database
				if($id == null){
			    echo "Actor ";
			    echo $_GET['firstname'];
			    echo " ";
			    echo $_GET['lastname'];
			    echo " not found.";
			}
            /*
            Joins actors, movies, and roles tables, then Selects movie name and year
            of the movie the actor appears in.
            */
            $sql2 = "SELECT m.name, m.year ";
            $sql2.= "FROM movies m ";
            $sql2.= "JOIN roles r ON r.movie_id = m.id ";
            $sql2.= "JOIN actors a ON r.actor_id = a.id ";
            $sql2.= "WHERE (r.actor_id='".$id."') ";
            $sql2.= "ORDER BY m.year DESC, m.name ASC";

            $i = 0;
			//Prints every movie result
            foreach($dbh->query($sql2) as $row){
                echo "<tr><td class=\"index\">";
                echo $i+1;
                echo "</td><td class=\"title\">";
                echo $row['name'];
                echo "</td><td class=\"year\">";
                echo $row['year'];
                echo "</td></tr>";
                $i++;
            }
			//close the connection
            $dbh = null;
            ?>

        </table>
	
<!-- form to search for every movie by a given actor -->
				<form action="search-all.php" method="get">
					<fieldset>
						<legend>All movies</legend>
						<div>
							<input name="firstname" type="text" size="12" placeholder="first name" autofocus="autofocus" /> 
							<input name="lastname" type="text" size="12" placeholder="last name" /> 
							<input type="submit" value="go" />
						</div>
					</fieldset>
				</form>

				<!-- form to search for movies where a given actor was with Kevin Bacon -->
				<form action="search-kevin.php" method="get">
					<fieldset>
						<legend>Movies with Kevin Bacon</legend>
						<div>
							<input name="firstname" type="text" size="12" placeholder="first name" /> 
							<input name="lastname" type="text" size="12" placeholder="last name" /> 
							<input type="submit" value="go" />
						</div>
					</fieldset>
				</form>
			</div> <!-- end of #main div -->
		</div> <!-- end of #frame div -->
	</body>
</html>