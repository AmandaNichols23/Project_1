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

                    case 'email': //Displays all emails
                        $select = $db->prepare("SELECT email FROM project1_data"); //select email column of table
                        $select->execute();
                        $info = $select->fetchAll();

                        echo '<div style="width: 150px; font-weight: bold;">Email</div>';
                        foreach($info as $row) { //loop through each row
                            echo '<div style="width: 150px; margin-right: 30px;">' . $row['email'] . '</div>';
                        }
                        break;

                    case 'age_range': //Displays all age ranges
                        $select = $db->prepare("SELECT age_range FROM project1_data"); //select age range column of table
                        $select->execute();
                        $info = $select->fetchAll();
                        echo '<div style="width: 150px; font-weight: bold;">Age Range</div>';
                        foreach($info as $row) { //loop through each row
                            echo '<div style="width: 150px; margin-right: 30px;">' . $row['age_range'] . '</div>';
                        }
                        break;

                    case 'gender': //Displays all genders
                        $select = $db->prepare("SELECT gender FROM project1_data"); //select gender column of table
                        $select->execute();
                        $info = $select->fetchAll();
                        echo '<div style="width: 150px; font-weight: bold;">Gender</div>';
                        foreach($info as $row) { //loop through each row
                            echo '<div style="width: 150px; margin-right: 30px;">' . $row['gender'] . '</div>';
                        }
                        break;

                    case 'language': //Displays all language
                        $select = $db->prepare("SELECT language FROM project1_data"); //select language column of table
                        $select->execute();
                        $info = $select->fetchAll();
                        echo '<div style="width: 150px; font-weight: bold;">Language</div>';
                        foreach($info as $row) { //loop through each row
                            echo '<div style="width: 150px; margin-right: 30px;">' . $row['language'] . '</div>';
                        }
                        break;

                    case 'experience': //Displays all years of experience
                        $select = $db->prepare("SELECT experience FROM project1_data"); //select experience column of table
                        $select->execute();
                        $info = $select->fetchAll();
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