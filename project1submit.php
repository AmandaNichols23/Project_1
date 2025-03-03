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

                if (password_verify($userEnteredPassword, $globalPassHash)) { //checks if password is correct before doing anything else, and sets an error flag if password is incorrect

                }
                else {
                    $error = true;
                }

                if($error) //if the error flag was set at any point, redirect the user to project1error.php
                {
                    header("Location: project1error.php");
                }
            ?>
            <form action="project1starter.php" method="post" class="survey-form">
            <button type="submit" name="return-to-survey" id="submit-button">Return To survey</button>
          </body>
    </html>
    </doctype>