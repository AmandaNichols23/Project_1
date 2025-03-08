<!DOCTYPE html>
    <html lang="en-US">
       <head>
            <meta charset="utf-8">
         </head>
          <body>
            <?php
                $globalPassHash = '$2y$10$FR9ixFJYJyqicuQ8Es6/ZulZJUlVlMD/QWHtcizwdJQMSXVWdTSQq';
                $userEnteredPassword = $_POST['pw-name'];

                $error = false;

                $age_range;
                $gender;
                $language;
                $experience;
                $email;

                if (password_verify($userEnteredPassword, $globalPassHash)) { //checks if password is correct before doing anything else, and sets an error flag if password is incorrect

                    $email = filter_var($_POST["email-name"], FILTER_SANITIZE_EMAIL); //Sanitize and store email

                    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) { //Sets an error flag if email is empty or if it doesn't follow a standard email format
                        $error = true; 
                    } 

                    if (isset($_POST["age"])) { //checks if age radio button is selected, and stores the value or sets an error flag if nothing is selected
                        $age_range = $_POST["age"];
                    } else {
                        $error = true;
                    }

                    $gender = $_POST["gender"];

                    if(empty($gender)) { //sets an error flag if no gender is selected
                        $error = true;
                    }

                    $language = trim(filter_var($_POST["language"], FILTER_SANITIZE_SPECIAL_CHARS)); //Stores user entered language and sanitizes it by removing whitespace and some special characters

                    if (empty($language) || !ctype_alpha($language)) { //sets an error flag if the language is either empty or contains non-alphanumeric characters
                        $error = true;
                    }

                    $experience = filter_var($_POST["number"], FILTER_SANITIZE_NUMBER_INT); //stores years of programming experience and sanitizes the input

                    if (!isset($experience) || $experience < 0 || $experience > 99) { //sets an error flag if no value was entered or the number of years is not between 0 and 99
                        $error = true;
                    }

                }
                else {
                    $error = true;
                }

                if($error) //if the error flag was set at any point, redirect the user to project1error.php. only tries to upload to database if $error = false
                {
                    header("Location: project1error.php");
                }
                else 
                {
                    //echo saved values for testing
                    echo "Email: " . $email. "<br>";
                    echo "Password: " . $userEnteredPassword. "<br>";
                    echo "Age Range: " . $age_range. "<br>";
                    echo "Gender: " . $gender. "<br>";
                    echo "Primary Language: " . $language. "<br>";
                    echo "Years of Programming Experience: " . $experience. "<br>";

                    require('dbconfig.php'); //include config file
                    $db = connectDB(); //connect to database 

                    $select = $db->prepare("SELECT COUNT(*) FROM project1_data WHERE email = ?"); //prepared statement to count how many times an email was used
                    $select->execute([$email]); //execute prepared statement to count number of times the user supplied email was used
                    $check_email = $select->fetch(); //store data in $check_email

                    if($check_email[0] == 0){ //checks if there are no emails in the database that match the user entered email
                        $prepared_stat = $db->prepare("INSERT INTO project1_data (email, age_range, gender, language, experience) VALUES (?, ?, ?, ?, ?)"); //prepared statement to add data to table
                        $prepared_stat->execute(array($email, $age_range, $gender, $language, $experience)); //execute prepared statement with user supplied data    
                        echo "Your results have been submitted, thanks for taking the survey"   
                    }
                    else //displays message to user that their results were not submitted
                    {
                        echo "Thanks for taking the survey again; because you've already submitted results with this email they will not be uploaded";
                    }
                }
            ?>
            <form action="project1starter.php" method="post" class="survey-form">
            <button type="submit" name="return-to-survey" id="submit-button">Return To survey</button>
          </body>
    </html>
    </doctype>