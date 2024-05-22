<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление результата экзамена</title>
    <style>
        body {
            display: flex;
            justify-content: center;

            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
        }

        select, input, button {
            margin: 5px;
            padding: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Добавление результата экзамена</h2>
        
        <div>
            <label for="studentLastName">Фамилия студента:</label>
            <select id="studentLastName">
                <?php
                    $db = new PDO('mysql:host=localhost;dbname=klyushkinDB', 'klyushkin', '5iofa727el0H_');
                    $query = $db->query('SELECT last_name FROM Students');
                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='".$row['last_name']."'>".$row['last_name']."</option>";
                    }
                ?>
            </select>
            
            <label for="teacherLastName">Фамилия учителя:</label>
            <select id="teacherLastName">
                <?php
                    $query = $db->query('SELECT last_name FROM Teachers');
                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='".$row['last_name']."'>".$row['last_name']."</option>";
                    }
                ?>
            </select>
            
            <label for="subject">Дисциплина:</label>
            <select id="subject">
                <?php
                    $query = $db->query('SELECT discipline_name FROM Disciplines');
                    while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                        echo "<option value='".$row['discipline_name']."'>".$row['discipline_name']."</option>";
                    }
                ?>
            </select>
            
            <label for="date">Дата:</label>
            <input type="date" id="date">
            
            <label for="grade">Оценка:</label>
            <select id="grade">
                <option value="Отлично">Отлично</option>
                <option value="Хорошо">Хорошо</option>
                <option value="Удовлетворительно">Удовлетворительно</option>
            </select>
            
            <button>Добавить экзамен</button>
        </div>

        <h2>Список студентов</h2>

        <button>Вывести список студентов</button>
    </div>
</body>
</html>
<?php
    require_once('connect.php');  
    
?>