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

                global $db;

                $currentUsername = $_SESSION['username'];

                // Prepare a SELECT statement to retrieve the columns you want to read
                $stmt = $db->prepare('SELECT User2.nome, User2.username, User2.role2, UserDepartment.department_id FROM User2 
                JOIN UserDepartment ON User2.username = UserDepartment.user_username
                WHERE User2.username = :username;');
                $stmt->bindParam(':username', $id);  // Use the correct variable name here
                $result = $stmt->execute();

                if (!$result) {
                    echo "Error fetching from db";
                    throw new Exception('Query execution failed');
                }

                $users = array();

                // Loop through the results and read each row into the $users array
                while ($row = $stmt->fetchAll(PDO::FETCH_ASSOC)) {
                    foreach ($row as $rowItem) {
                        $nome = $rowItem['nome'];
                        $username = $rowItem['username'];
                        $type = $rowItem['role2'];
                        $departament_id = $rowItem['department_id'];

                        $users[] = array($nome, $username,$departament_id,$type);
                    }
                }

                $db = null;

                // Display the user information
                foreach ($users as $user) {
                    echo '<h1>Update Profile</h1>';
                    echo '<h2>' . $user[0] . '</h2>';
                    echo '<h3> User Type </h3>';
                    echo '<div class="wrapper">';
                    echo '<div class="option">';
                    echo '<input class="input" type="radio" name="btn" value="1"' . ($user[3] == "cliente" ? "checked=" : "") . '>';
                    echo '<div class="btn">';
                    echo '<span class="span">Client</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="option">';
                    echo '<input class="input" type="radio" name="btn" value="2"' . ($user[3] == "agent" ? "checked" : "") . '>';
                    echo '<div class="btn">';
                    echo '<span class="span">Agent</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '<div class="option">';
                    echo '<input class="input" type="radio" name="btn" value="3"' . ($user[3] == "admin" ? "checked" : "") . '>';
                    echo '<div class="btn">';
                    echo '<span class="span">Admin</span>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                        echo '<h3> Departament </h3>';
                        echo '<div class="wrapper">';
                        echo '<div class="option">';
                        echo '<input class="input" type="radio" name="btn" value="1" ' . ($user[2] == 1 ? "checked" : "") . '>';
                        echo '<div class="btn">';
                        echo '<span class="span">Marketing</span>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="option">';
                        echo '<input class="input" type="radio" name="btn" value="2" ' . ($user[2] == 2 ? "checked" : "") . '>';
                        echo '<div class="btn">';
                        echo '<span class="span">Tech Help</span>';
                        echo '</div>';
                        echo '</div>';
                        echo '<div class="option">';
                        echo '<input class="input" type="radio" name="btn" value="3"' . ($user[2] == 3 ? "checked" : "") . '>';
                        echo '<div class="btn">';
                        echo '<span class="span">Information</span>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                }
            } else {
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
        
    </script>
</body>
</html>
