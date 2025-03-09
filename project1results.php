<!DOCTYPE html>
    <html lang="en-US">
       <head>
            <meta charset="utf-8">
         </head>
          <body>
                <form action="project1results.php" method="post" class="survey-form">
                    <label for="data">Select Data To View:</label>
                    <select name="data" id="data">
                        <option value="all">View All</option>
                        <option value="email">Email</option>
                        <option value="age_range">Age Range</option>
                        <option value="gender">Gender</option>
                        <option value="language">Language</option>
                        <option value="experience">Years of Experience</option>
                    </select>
                    <button type="submit" name="view-button" id="view-button">View Data</button>
                </form>
            <?php

                $selection = $_POST['data']; //set selection to selected option

                require('dbconfig.php'); //include config file
                $db = connectDB(); //connect to database 

                switch ($selection) { //displays data depending on user selection
                    case 'all':
                        $select = $db->prepare("SELECT * FROM project1_data"); //select entire table
                        $select->execute();
                        $info = $select->fetchAll();

                        //display column labels
                        echo '<div style="display: flex; margin-bottom: 10px;">';
                        echo '<div style="width: 150px; margin-right: 30px; font-weight: bold;">ID</div>';
                        echo '<div style="width: 150px; margin-right: 30px; font-weight: bold;">Email</div>';
                        echo '<div style="width: 150px; margin-right: 30px; font-weight: bold;">Age Range</div>';
                        echo '<div style="width: 150px; margin-right: 30px; font-weight: bold;">Gender</div>';
                        echo '<div style="width: 150px; margin-right: 30px; font-weight: bold;">Language</div>';
                        echo '<div style="width: 150px; margin-right: 30px; font-weight: bold;">Experience</div>';
                        echo "</div>";

                        //display all data from table
                        foreach($info as $row){ //loop through each row
                            echo '<div style="display: flex; flex-wrap: wrap;">';
                            $counter = 0;
                            foreach($row as $column){ //loop through each column of each row
                                if ($counter % 2 == 0){ //ensure each column of data is only being output once
                                    echo '<div style="width: 150px; margin-right: 30px;">' . $column . '</div>';
                                }
                                $counter++;
                            }
                            echo "</div>";
                        }
                        echo "</div>";
                        break;

                    case 'email': //Displays all emails, and 3 random emails at the top of the page
                        $select = $db->prepare("SELECT email FROM project1_data ORDER BY RAND() LIMIT 3"); //select 3 random emails from email column of table
                        $select->execute();
                        $info = $select->fetchAll();
                        echo '<div style="width: 150px; font-weight: bold;">3 Random Emails</div>';
                        foreach($info as $row) { //loop through each row
                            echo '<div style="width: 150px; margin-right: 30px;">' . $row['email'] . '</div>';
                        }


                        $select = $db->prepare("SELECT email FROM project1_data"); //select email column of table
                        $select->execute();
                        $info = $select->fetchAll();

                        echo '<div style="width: 150px; font-weight: bold;">All Emails</div>';
                        foreach($info as $row) { //loop through each row
                            echo '<div style="width: 150px; margin-right: 30px;">' . $row['email'] . '</div>';
                        }
                        break;

                    case 'age_range': //Displays all age ranges
                        $select = $db->prepare("SELECT age_range FROM project1_data"); //select age range column of table
                        $select->execute();
                        $info = $select->fetchAll();

                        $gender_count = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0]; //counts number of occurances of all age ranges and stores the counts in an array
                        foreach($info as $row){ 
                            switch($row['age_range']){
                                case '0-12': $gender_count[0] ++; break; case '13-17': $gender_count[1] ++; break; case '18-22': $gender_count[2] ++; break;
                                case '23-27': $gender_count[3] ++; break; case '28-32': $gender_count[4] ++; break; case '33-37': $gender_count[5] ++; break;
                                case '38-42': $gender_count[6] ++; break; case '43-47': $gender_count[7] ++; break; case '48-52': $gender_count[8] ++; break;
                                case '53-57': $gender_count[9] ++; break; case '58-62': $gender_count[10] ++; break; case '63-67': $gender_count[11] ++; break;
                                case '68+': $gender_count[12] ++; break;
                            }
                        }

                        echo '<div style="width: 150px; font-weight: bold;">Age Range Totals</div>'; //Display the total counts for each age range
                        echo '<div style="width: 150px; margin-right: 30px;">'."0-12: $gender_count[0]" .'</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">'."13-17: $gender_count[1]" .'</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">'."18-22: $gender_count[2]" .'</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">'."23-27: $gender_count[3]" .'</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">'."28-32: $gender_count[4]" .'</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">'."33-37: $gender_count[5]" .'</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">'."38-42: $gender_count[6]" .'</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">'."43-47: $gender_count[7]" .'</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">'."48-52: $gender_count[8]" .'</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">'."53-57: $gender_count[9]" .'</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">'."58-62: $gender_count[10]" .'</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">'."63-67: $gender_count[11]" .'</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">'."68+: $gender_count[12]" .'</div>';

                        echo '<div style="width: 150px; font-weight: bold;">Age Range</div>';
                        foreach($info as $row) { //loop through each row
                            echo '<div style="width: 150px; margin-right: 30px;">' . $row['age_range'] . '</div>';
                        }
                        break;

                    case 'gender': //Displays all genders
                        $select = $db->prepare("SELECT gender FROM project1_data"); //select gender column of table
                        $select->execute();
                        $info = $select->fetchAll();

                        $gender_count = [0, 0, 0, 0, 0, 0]; //counts number of occurances of all genders and stores the counts in an array
                        foreach($info as $row){ 
                            switch($row['gender']){
                                case 'm': $gender_count[0] ++; break; case 'f': $gender_count[1] ++; break; case 'nb': $gender_count[2] ++; break;
                                case 'gf': $gender_count[3] ++; break; case 'a': $gender_count[4] ++; break; case 'o': $gender_count[5] ++; break;
                            }
                        }

                        echo '<div style="width: 150px; font-weight: bold;">Gender Totals</div>'; //Display the total counts for each gender
                        echo '<div style="width: 150px; margin-right: 30px;">'."Male: $gender_count[0]" .'</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">'."Female: $gender_count[1]" .'</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">'."Nonbinary: $gender_count[2]" .'</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">'."Genderfluid: $gender_count[3]" .'</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">'."Agender: $gender_count[4]" .'</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">'."Other: $gender_count[5]" .'</div>';


                        echo '<div style="width: 150px; font-weight: bold;">All Genders</div>';
                        foreach($info as $row) { //loop through each row
                            echo '<div style="width: 150px; margin-right: 30px;">' . $row['gender'] . '</div>';
                        }
                        break;

                    case 'language': //Displays all languages, and 3 random languages at the top of the page
                        $select = $db->prepare("SELECT language FROM project1_data ORDER BY RAND() LIMIT 3"); //select 3 random languages from language column of table
                        $select->execute();
                        $info = $select->fetchAll();
                        echo '<div style="width: 150px; font-weight: bold;">3 Random Languages</div>';
                        foreach($info as $row) { //loop through each row
                            echo '<div style="width: 150px; margin-right: 30px;">' . $row['language'] . '</div>';
                        }

                        $select = $db->prepare("SELECT language FROM project1_data"); //select language column of table
                        $select->execute();
                        $info = $select->fetchAll();
                        echo '<div style="width: 150px; font-weight: bold;">All Languages</div>';
                        foreach($info as $row) { //loop through each row
                            echo '<div style="width: 150px; margin-right: 30px;">' . $row['language'] . '</div>';
                        }
                        break;

                    case 'experience': //Displays all years of experience
                        $select = $db->prepare("SELECT experience FROM project1_data"); //select experience column of table
                        $select->execute();
                        $info = $select->fetchAll();

                        $avg_experience = 0;
                        $counter = 0;

                        foreach($info as $row) { //Adds all years of experience together to get an average
                            $avg_experience += $row['experience'];
                            $counter++;
                        }

                        if($counter != 0) { //calculates and displays average if counter isnt 0
                        $avg_experience /= $counter;
                        echo '<div style="width: 150px; font-weight: bold;">Average Experience</div>';
                        echo '<div style="width: 150px; margin-right: 30px;">' . $avg_experience . '</div>';
                        }

                        echo '<div style="width: 150px; font-weight: bold;">Years of Experience</div>';
                        foreach($info as $row) { //loop through each row
                            echo '<div style="width: 150px; margin-right: 30px;">' . $row['experience'] . '</div>';
                        }
                        break;
                    }

            ?>
            <form action="project1starter.php" method="post" class="survey-form">
            <button type="submit" name="return-to-survey" id="submit-button">Return To survey</button>
          </body>
    </html>
    </doctype>