<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../../Style/master.css">
    <link rel="stylesheet" href="../../Style/tickets.css">
    <script src="../../Scripts/master.js"></script>
    <link type="image/png" sizes="32x32" rel="icon" href="../../Images/icon.png">
    <title>Update Profile</title>
</head>

<body>
    <header>
        <div id="logo" onclick="mainLogin()">
            <h2>Solve Us</h2>
        </div>
        <div id="icon" onclick="goToProfile()">
            <img src="../../Images/pngwing.com.png" alt="Image" class="square-image">
        </div>
    </header>
    <form style="display:contents" action="submit.php" method="post">
        <div id="forms" class="box">
            <?php

            if (isset($_GET['username'])) {

                $id = $_GET['username'];

                session_start();
                include_once('../Login/connect.php');
                $currentUsername = $_SESSION['username'];
                //echo $currentUsername;
                //echo $id;

                global $db;
                
                $stmt = $db->prepare('SELECT User2.username, User2.role2, UserDepartment.department_id
                FROM User2
                LEFT JOIN UserDepartment ON User2.username = UserDepartment.user_username
                WHERE User2.username = :username');
                $stmt->bindParam(':username', $id);
                $stmt->execute();
                $row = $stmt->fetch();

            
                $username = $row['username'];
                $role2 = $row['role2'];
                $deparment = $row['department_id'];
                //echo $role2;
                //echo $username;
                //echo $department_id;
                
                echo '<h1>Update Profile</h1>';
                echo '<h2>' . $username . '</h2>';
                echo '<h3> User Type </h3>';
                echo '<div class="wrapper">';
                echo '<div class="option">';
                echo '<input class="input" type="radio" name="btn_client" value="1"' . ($role2 == "cliente" ? "checked=" : "") . '>';
                echo '<div class="btn">';
                echo '<span class="span">Client</span>';
                echo '</div>';
                echo '</div>';

                echo '<div class="option">';
                echo '<input class="input" type="radio" name="btn_client" value="2"' . ($role2  == "Agent" ? "checked" : "") . '>';
                echo '<div class="btn">';
                echo '<span class="span">Agent</span>';
                echo '</div>';
                echo '</div>';
                echo '<div class="option">';
                echo '<input class="input" type="radio" name="btn_client" value="3"' . ($role2  == "Admin" ? "checked" : "") . '>';
                echo '<div class="btn">';
                echo '<span class="span">Admin</span>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                
                echo '<h3> Departament </h3>';
                echo '<div class="wrapper">';
                echo '<div class="option">';
                echo '<input class="input" type="radio" name="btn_dp" value="1" ' . ($department_id == 1 ? "checked" : "") . '>';
                echo '<div class="btn">';
                echo '<span class="span">Marketing</span>';
                echo '</div>';
                echo '</div>';
                echo '<div class="option">';
                echo '<input class="input" type="radio" name="btn_dp" value="2" ' . ($department_id == 2 ? "checked" : "") . '>';
                echo '<div class="btn">';
                echo '<span class="span">Tech Help</span>';
                echo '</div>';
                echo '</div>';
                echo '<div class="option">';
                echo '<input class="input" type="radio" name="btn_dp" value="3"' . ($department_id == 3 ? "checked" : "") . '>';
                echo '<div class="btn">';
                echo '<span class="span">Information</span>';
                echo '</div>';
                echo '</div>';
                echo '</div>';

                echo '<button id="send-button" type="button" class="basic" onclick="send2(\'' . $id . '\', \'' . $role2 . '\')">Send</button>';

                
                        
            }
         
            else {
                echo "No ID provided.";
            }
            ?>
        </div>
    </form>
    
    <footer>
        <div class="footer">
            University of Porto
        </div>
    </footer>

    <script>

        function getValue() {
      
            var radioButtons = document.getElementsByName("btn_client");

            for (var i = 0; i < radioButtons.length; i++) {
        
                if (radioButtons[i].checked) {
        
                var selectedValue = radioButtons[i].nextElementSibling.querySelector('.span').textContent;

                return selectedValue;
                }
            }
        }

        function send2(userId, role2){
            //console.log("CLIQUEI NO BOTAO");
            //console.log("User ID: " + userId);
            var selectedOption = getValue();
            //console.log(selectedOption);

            console.log("Entered the function to update the User role");

            var xhr = new XMLHttpRequest();

            xhr.open("POST", "submit.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    console.log(xhr.responseText);
                }
            };

            
            var data = "selectedOption=" + encodeURIComponent(selectedOption)+ "&userId=" + encodeURIComponent(userId);
            xhr.send(data);
               
        
                
        }


        
    </script>
</body>
</html>
