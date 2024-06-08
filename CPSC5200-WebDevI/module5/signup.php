
<?php include("top.html"); ?>

<!-- Web Programming, Project 4 (NerdLuv)-->

<div>
    <form action="signup-submit.php">
        <fieldset>
            <legend>New User Signup:</legend>
           
            <strong class="column">Name:</strong>
            <input type="text" name="name" size="16" autofocus: "autofocus" required = "required"/><br/>

            <strong class="column">Gender:</strong>
            <label><input type="radio" name="gender" value="M" /> Male</label>
            <input type="radio" name="gender" value="F" checked = "checked"/> Female<label><br />

            <strong class="column">Age:</strong>
            <input type="text" name="age" size="6" maxlength="2" required = "required" /><br />
            
            <strong class="column">Personality type:</strong>
            <input type="text" name="ptype" size="6" maxlength="4" required = "required" />
            <a href="https://www.humanmetrics.com/personality">(Dont know your type?)</a><br />
            
            <strong class="column">Favorite OS:</strong>
            <select name="OS">
                <option>Windows</option>
                <option>Mac OS X</option>
                <option>Linux</option>
            </select><br />
            
            <strong class="column">Seeking age:</strong>
            <input type="text" name="min_seeking_age" size="6" maxlength="2" placeholder="min" required = "required" /> to
                <input type="text" name="max_seeking_age" size="6" maxlength="2" placeholder="max" /><br />
            
            <input type="submit" value="Sign Up" />
        </fieldset>
    </form>
</div>

<?php include("bottom.html"); ?>
