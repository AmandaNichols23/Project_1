<!DOCTYPE html>
<html><head>
<title>Survey: Survey Name</title>  <!-- TODO: Change "Survey Name" to the topic of your survey -->
</head>
<body>


<!-- TODO: Fix all bugs/poor practice in the form -->
<form action="project1submit.php" method="post" class="survey">

<label>Enter your email: </label>
<input type="email" name="email-name" id="email-id">

<label>Enter your password: </label>
<input type="text" name="pw-name" id="pw-id">

<label>What age are you? </label>
<input type="radio" name="age" id="0" value="0-12">
<label>0-12 </label>
<input type="radio" name="age" id="1" value="13-17">
<label>13-17 </label>
<input type="radio" name="age" id="2" value="18-22">
<label>18-22 </label>
<input type="radio" name="age" id="3" value="23-27">
<label>23-27 </label>
<input type="radio" name="age" id="4" value="28-32">
<label>28-32 </label>
<input type="radio" name="age" id="5" value="33-37">
<label>33-37 </label>
<input type="radio" name="age" id="6" value="38-42">
<label>38-42 </label>
<input type="radio" name="age" id="7" value="43-47">
<label>43-47 </label>
<input type="radio" name="age" id="8" value="48-52">
<label>48-52 </label>
<input type="radio" name="age" id="9" value="53-57">
<label>53-57 </label>
<input type="radio" name="age" id="10" value="58-62">
<label>58-62 </label>
<input type="radio" name="age" id="11" value="63-67">
<label>63-67 </label>
<input type="radio" name="age" id="12" value="68+">
<label>68+ </label>

<select name="gender" id="gender">
    <option value="m">Male</option>
    <option value="f">Female</option>
    <option value="nb">Nonbinary</option>
    <option value="gf">Genderfluid</option>
    <option value="a">Agender</option>
    <option value="o">Choose not to say/Other</option>
</select>

<!-- TODO: Add your own survey questions -->

</form>

<!-- TODO: All the backend PHP/SQL stuff! (you may need a separate file for this!) -->

</body></html>