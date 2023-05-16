<!DOCTYPE html>

<html>
    <style>
        /* Remove the border */
        iframe {
            border: none;
        }
    </style>

    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../../Style/master.css">
        <link rel="stylesheet" href="../../Style/tickets.css">
        <title>Tickets</title>
    </head>

    <body>

        <header>
    
            <div id="logo" onclick="goBack()">
                <h2>Solve Us</h2>
            </div>
        
        </header>

            <h1>
                Ticket Answering
            </h1>
         
            <?php
             
                if(isset($_GET['id'])) {
                    $id = $_GET['id'];
                    $db = new SQLite3('tickets.db');
                    $stmt = $db->prepare('SELECT id, department ,hashtag, date2, description2, status2, user_username FROM Ticket WHERE id = :id');
                    $stmt->bindParam(':id', $id, SQLITE3_INTEGER);
                    $result = $stmt->execute();
                
                    $tickets = array();
                
                    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
                        $id = $row['id'];
                        $department = $row['department'];
                        $hashtag = $row['hashtag'];
                        $date = $row['date2'];
                        $description = $row['description2'];
                        $status = $row['status2'];
                        $username = $row['user_username'];
                
                        $tickets[] = array($id, $department, $hashtag, $date, $description, $status, $username);
                    }

                    echo '<div class="ticket-container cdd">';
                    echo '<h2 class="ticket-id">Ticket ID: ' . $id . '</h2>';
                    echo '<h3 class="ticket-status-date">Ticket status: ' . $status . ' | Submited ' . $date . '</h3>';
                    echo '<p class="ticket-description">' . $description . '</p>';
                    echo '</div>';

            
                
                    echo '<div id="answering-box">';
                    echo '<textarea id="answer-textarea" rows="4" cols="100" placeholder="Write your answer..."></textarea>';
                    echo '<button onclick="Sendanswer()">Answer</button>';
                    echo '</div>';


                } else {
                    echo "No ID provided.";
                }

            ?>
           
            
    

        <script>
            function goBack() {
                window.location.href = "../../Views/Login/login.html";
            }

            function Sendanswer() {
                console.log("CLIQUEI NO BOTAO");
                var answerTextarea = document.getElementById("answer-textarea");
                var answer = answerTextarea.value;

                
            }
        </script>

    </body>

</html>
