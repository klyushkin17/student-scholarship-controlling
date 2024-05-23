<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Добавление результата экзамена</title>
    <style>
        body {
            
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

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Добавление результата экзамена</h2>
        
        <div>
            <form method="POST">
                <label for="studentId">ID студента:</label>
                <select name="studentId">
                    <?php
                        $db = new PDO('mysql:host=localhost;dbname=klyushkinDB', 'klyushkin', '5iofa727el0H_');
                        $query = $db->query('SELECT student_id FROM Students');
                        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='".$row['student_id']."'>".$row['student_id']."</option>";
                        }
                    ?>
                </select>
                
                <label for="teacherLastName">Фамилия учителя:</label>
                <select name="teacherLastName">
                    <?php
                        $query = $db->query('SELECT last_name FROM Teachers');
                        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='".$row['last_name']."'>".$row['last_name']."</option>";
                        }
                    ?>
                </select>
                
                <label for="subject">Дисциплина:</label>
                <select name="subject">
                    <?php
                        $query = $db->query('SELECT discipline_name FROM Disciplines');
                        while($row = $query->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='".$row['discipline_name']."'>".$row['discipline_name']."</option>";
                        }
                    ?>
                </select>
                
                <label for="date">Дата:</label>
                <input type="date" name="date">
                
                <label for="grade">Оценка:</label>
                <select name="grade">
                    <option value=5>5</option>
                    <option value=4>4</option>
                    <option value=3>3</option>
                    <option value=2>2</option>
                </select>
            
                <button type="submit" name="add_exam">Добавить экзамен</button>
            </form> 

            <h2>Меню действий</h2>

            <form method="POST">
                <button type="submit" name="amount_of_scholarship_students">Кол-во стипеднидантов</button>
            </form>

            <form method="POST">
                <button type="submit" name="task_3">Задание 3</button>
            </form>

            <form method="POST">
                <button type="submit" name="report">Создать отчет</button>
            </form>
            <form method="POST">
                <button type="submit" name="show_students">Вывести список студентов</button>
            </form>

            <form action="#" method="POST">
                <input type="text" name="last_name_input" placeholder="Введите фамилию студента" required>
                <button type="submit" name="find_student">Найти</button>
            </form>

            <form method="POST">
                <button type="submit" name="sort_last_name">Сортировать по фамилии</button>
            </form>

            <form method="POST">
                <button type="submit" name="sort_scholarship_amount">Сортировать по размеру стипеднии</button>
            </form>

            <form method="POST">
                <button type="submit" name="sort_groups">Сортировать по группам</button>
            </form>

            <form method="POST">
                <button type="submit" name="disciplines">Список дисциплин</button>
            </form>

            <form method="POST">
                <button type="submit" name="no_scholarship_students">Студенты без стипендии</button>
            </form>
        </div>    
    </div>
</body>
</html>
<?php
    require_once('connect.php');  

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['show_students'])) {
        $query = $db->query('SELECT
            Students.student_id,
            Students.last_name AS student_last_name,
            Students.first_name AS student_first_name,
            StudentGroups.group_name,
            Scholarships.scholarship_amount
        FROM Students
        LEFT JOIN StudentGroups ON Students.group_id = StudentGroups.group_id
        LEFT JOIN Scholarships ON Students.scholarship_id = Scholarships.scholarship_id;');
        $students = $query->fetchAll(PDO::FETCH_ASSOC);
    
        echo "
        <table>
            <tr>
                <th>Student ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Group Name</th>
                <th>Scholarship Amount</th>
            </tr>";
        
        foreach ($students as $student) {
            echo "
            <tr>
                <td>" . $student['student_id'] . "</td>
                <td>" . $student['student_last_name'] . "</td>
                <td>" . $student['student_first_name'] . "</td>
                <td>" . $student['group_name'] . "</td>
                <td>" . $student['scholarship_amount'] . "</td>
            </tr>";
        }
    
        echo "</table>";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['no_scholarship_students'])) {
        $query = $db->query('SELECT
            Students.student_id,
            Students.last_name AS student_last_name,
            Students.first_name AS student_first_name,
            StudentGroups.group_name,
            Scholarships.scholarship_amount
        FROM Students
        LEFT JOIN StudentGroups ON Students.group_id = StudentGroups.group_id
        LEFT JOIN Scholarships ON Students.scholarship_id = Scholarships.scholarship_id
        WHERE Students.scholarship_id = 3;');
        $students = $query->fetchAll(PDO::FETCH_ASSOC);
    
        echo "
        <table>
            <tr>
                <th>Student ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Group Name</th>
                <th>Scholarship Amount</th>
            </tr>";
            
        foreach ($students as $student) {
            echo "
            <tr>
                <td>" . $student['student_id'] . "</td>
                <td>" . $student['student_last_name'] . "</td>
                <td>" . $student['student_first_name'] . "</td>
                <td>" . $student['group_name'] . "</td>
                <td>" . $student['scholarship_amount'] . "</td>
            </tr>";
        }
    
        echo "</table>";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sort_last_name'])) {
        $query = $db->query('SELECT
            Students.student_id,
            Students.last_name AS student_last_name,
            Students.first_name AS student_first_name,
            StudentGroups.group_name,
            Scholarships.scholarship_amount
        FROM Students
        LEFT JOIN StudentGroups ON Students.group_id = StudentGroups.group_id
        LEFT JOIN Scholarships ON Students.scholarship_id = Scholarships.scholarship_id
        ORDER BY Students.last_name DESC;');
        $students = $query->fetchAll(PDO::FETCH_ASSOC);
    
        echo "
        <table>
            <tr>
                <th>Student ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Group Name</th>
                <th>Scholarship Amount</th>
            </tr>";
        
        foreach ($students as $student) {
            echo "
            <tr>
                <td>" . $student['student_id'] . "</td>
                <td>" . $student['student_last_name'] . "</td>
                <td>" . $student['student_first_name'] . "</td>
                <td>" . $student['group_name'] . "</td>
                <td>" . $student['scholarship_amount'] . "</td>
            </tr>";
        }
    
        echo "</table>";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sort_scholarship_amount'])) {
        $query = $db->query('SELECT
            Students.student_id,
            Students.last_name AS student_last_name,
            Students.first_name AS student_first_name,
            StudentGroups.group_name,
            Scholarships.scholarship_amount
        FROM Students
        LEFT JOIN StudentGroups ON Students.group_id = StudentGroups.group_id
        LEFT JOIN Scholarships ON Students.scholarship_id = Scholarships.scholarship_id
        ORDER BY Scholarships.scholarship_amount DESC;');
        $students = $query->fetchAll(PDO::FETCH_ASSOC);
    
        echo "
        <table>
            <tr>
                <th>Student ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Group Name</th>
                <th>Scholarship Amount</th>
            </tr>";
        
        foreach ($students as $student) {
            echo "
            <tr>
                <td>" . $student['student_id'] . "</td>
                <td>" . $student['student_last_name'] . "</td>
                <td>" . $student['student_first_name'] . "</td>
                <td>" . $student['group_name'] . "</td>
                <td>" . $student['scholarship_amount'] . "</td>
            </tr>";
        }
    
        echo "</table>";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sort_groups'])) { 
        $query = $db->query('SELECT 
            Students.student_id,
            Students.last_name AS student_last_name,
            Students.first_name AS student_first_name,
            StudentGroups.group_name,
            Scholarships.scholarship_amount
        FROM Students
        LEFT JOIN StudentGroups ON Students.group_id = StudentGroups.group_id
        LEFT JOIN Scholarships ON Students.scholarship_id = Scholarships.scholarship_id
        ORDER BY StudentGroups.group_name DESC;');
        $students = $query->fetchAll(PDO::FETCH_ASSOC);     
    
        echo "
        <table>
            <tr>
                <th>Student ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Group Name</th>
                <th>Scholarship Amount</th>
            </tr>";
        
        foreach ($students as $student) {
            echo "
            <tr>
                <td>" . $student['student_id'] . "</td>
                <td>" . $student['student_last_name'] . "</td>
                <td>" . $student['student_first_name'] . "</td>
                <td>" . $student['group_name'] . "</td>
                <td>" . $student['scholarship_amount'] . "</td>
            </tr>";
        }
    
        echo "</table>";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['find_student'])) {
        $last_name_input = isset($_POST['last_name_input']) ? trim($_POST['last_name_input']) : '';
    
        // Prepare the query with a WHERE clause to filter by the entered last name
        $query = $db->prepare('SELECT
                Students.student_id,
                Students.last_name AS student_last_name,
                Students.first_name AS student_first_name,
                StudentGroups.group_name,
                Scholarships.scholarship_amount
            FROM Students
            LEFT JOIN StudentGroups ON Students.group_id = StudentGroups.group_id
            LEFT JOIN Scholarships ON Students.scholarship_id = Scholarships.scholarship_id
            WHERE Students.last_name = :last_name;');
        $query->bindParam(':last_name', $last_name_input);
        $query->execute();
    
        $students = $query->fetchAll(PDO::FETCH_ASSOC);
    
        echo "
        <table>
            <tr>
                <th>Student ID</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Group Name</th>
                <th>Scholarship Amount</th>
            </tr>";
    
        foreach ($students as $student) {
            echo "
            <tr>
                <td>" . $student['student_id'] . "</td>
                <td>" . $student['student_last_name'] . "</td>
                <td>" . $student['student_first_name'] . "</td>
                <td>" . $student['group_name'] . "</td>
                <td>" . $student['scholarship_amount'] . "</td>
            </tr>";
        }
    
        echo "</table>";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['disciplines'])) {
        $query = $db->query('SELECT 
            Disciplines.discipline_name,
            Teachers.last_name AS teacher_last_name,
            Exams.exam_date
        FROM Disciplines
        LEFT JOIN Exams ON Disciplines.discipline_id = Exams.discipline_id
        LEFT JOIN Teachers ON Exams.teacher_id = Teachers.teacher_id
        ORDER BY Disciplines.discipline_name;');
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
        if ($results) {
            echo '<table>';
            echo '<tr><th>Дисциплина</th><th>Преподаватель</th><th>Дата экзамена</th></tr>';
            
            foreach ($results as $result) {
                $examDate = new DateTime($result['exam_date']);
                $formattedDate = $examDate->format('j F Y');
    
                echo '<tr>';
                echo '<td>' . $result['discipline_name'] . '</td>';
                echo '<td>' . $result['teacher_last_name'] . '</td>';
                echo '<td>' . $formattedDate . '</td>';
                echo '</tr>';
            }
    
            echo '</table>';
        } else {
            echo "Нет данных о дисциплинах и преподавателях по экзаменам.";
        }
    }
    

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_exam'])) {
        $studentId = $_POST['studentId'];
        $teacherLastName = $_POST['teacherLastName'];
        $subject = $_POST['subject'];
        $date = $_POST['date'];
        $grade = $_POST['grade'];

        $selectTeacherIdQuery = "SELECT teacher_id FROM Teachers WHERE last_name = :teacher_last_name";
        $stmtTeacherId = $db->prepare($selectTeacherIdQuery);
        $stmtTeacherId->bindParam(':teacher_last_name', $teacherLastName);
        $stmtTeacherId->execute();
        $teacherId = $stmtTeacherId->fetchColumn();

        $selectDisciplineIdQuery = "SELECT discipline_id FROM Disciplines WHERE discipline_name = :subject";
        $stmtDisciplineId = $db->prepare($selectDisciplineIdQuery);
        $stmtDisciplineId->bindParam(':subject', $subject);
        $stmtDisciplineId->execute();
        $disciplineId = $stmtDisciplineId->fetchColumn();

        $maxExamIdQuery = "SELECT MAX(exam_id) FROM Exams";
        $stmtMaxExamId = $db->prepare($maxExamIdQuery);
        $stmtMaxExamId->execute();
        $maxExamId = $stmtMaxExamId->fetchColumn();
        $newExamId = $maxExamId + 1; 

    
        $insertQuery = "INSERT INTO Exams (exam_id, student_id, teacher_id, discipline_id, exam_date, grade) 
                VALUES (:exam_id, :student_id, :teacher_id, :discipline_id, :exam_date, :grade)";

        $stmt = $db->prepare($insertQuery);
        $stmt->bindParam(':student_id', $studentId);
        $stmt->bindParam(':teacher_id', $teacherId);
        $stmt->bindParam(':discipline_id', $disciplineId);
        $stmt->bindParam(':exam_date', $date);
        $stmt->bindParam(':grade', $grade);
        $stmt->bindParam(':exam_id', $newExamId);

        $updateNeeded = false;
    
        if ($stmt->execute()) {
            $updateNeeded = true;
            echo "Экзамен успешно добавлен!";
        } else {
            echo "Произошла ошибка при добавлении экзамена.";
        }
    
        if ($updateNeeded) {
            $updateQuery = "
                UPDATE Students
                SET scholarship_id = CASE
                    WHEN (SELECT MIN(grade) FROM Exams WHERE student_id = :student_id) = 5 THEN 1
                    WHEN (SELECT MIN(grade) FROM Exams WHERE student_id = :student_id) = 4 THEN 2
                    ELSE 3
                    END
                WHERE student_id = :student_id";
    
            $updateStmt = $db->prepare($updateQuery);
            $updateStmt->bindParam(':student_id', $studentId);
    
            if ($updateStmt->execute()) {
                echo "Студенту присвоен соответствующий стипендии";
            } else {
                echo "Произошла ошибка при обновлении стипендии студента.";
            }
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['amount_of_scholarship_students'])) {
        $stmt = $db->prepare("SELECT COUNT(*) AS student_count FROM Students WHERE scholarship_id != 3");
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
        if ($result) {
            $studentCount = $result['student_count'];
            echo "Количество студентов, получающиx стипендию: $studentCount";
        } else {
            echo "Произошла ошибка при выполнении запроса.";
        }
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['task_3'])) {
        $query = $db->query('
            SELECT 
                Students.last_name, 
                Students.first_name, 
                Students.patronymic, 
                StudentGroups.group_name, 
                Disciplines.discipline_name, 
                Exams.grade, 
                Teachers.last_name AS teacher_last_name, 
                Scholarships.scholarship_amount, 
                GroupStudentCount.student_count
            FROM Students
            JOIN StudentGroups ON Students.group_id = StudentGroups.group_id
            JOIN Scholarships ON Students.scholarship_id = Scholarships.scholarship_id
            JOIN Exams ON Students.student_id = Exams.student_id
            JOIN Disciplines ON Exams.discipline_id = Disciplines.discipline_id
            JOIN Teachers ON Exams.teacher_id = Teachers.teacher_id
            JOIN (
                SELECT group_id, COUNT(student_id) AS student_count
                FROM Students
                GROUP BY group_id
            ) AS GroupStudentCount ON Students.group_id = GroupStudentCount.group_id
            ORDER BY Students.last_name, Students.first_name, Students.patronymic;
        ');
    
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
        echo "<table border='1'>
                <tr>
                    <th>Last Name</th>
                    <th>First Name</th>
                    <th>Patronymic</th>
                    <th>Group Name</th>
                    <th>Discipline Name</th>
                    <th>Grade</th>
                    <th>Teacher Last Name</th>
                    <th>Scholarship Amount</th>
                    <th>Student Count</th>
                </tr>";
    
        foreach ($results as $row) {
            echo "<tr>
                    <td>{$row['last_name']}</td>
                    <td>{$row['first_name']}</td>
                    <td>{$row['patronymic']}</td>
                    <td>{$row['group_name']}</td>
                    <td>{$row['discipline_name']}</td>
                    <td>{$row['grade']}</td>
                    <td>{$row['teacher_last_name']}</td>
                    <td>{$row['scholarship_amount']}</td>
                    <td>{$row['student_count']}</td>
                </tr>";
        }
    
        echo "</table>";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['report'])){
        $query = $db->query('
            SELECT Students.last_name AS Last_Name, 
            Students.first_name AS First_Name, 
            Students.patronymic AS Patronymic, 
            StudentGroups.group_name AS Group_Name, 
            Scholarships.scholarship_amount AS Scholarship_Amount
            FROM Students
            JOIN StudentGroups ON Students.group_id = StudentGroups.group_id
            JOIN Scholarships ON Students.scholarship_id = Scholarships.scholarship_id
            WHERE Scholarships.scholarship_amount > 0
            ORDER BY Last_Name, First_Name, Patronymic
        ');
    
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
    
        // Вывод результатов запроса в виде отчета
        echo "<h1>Отчет «Студенты, получающие стипендию»</h1>";
        echo "<table border='1' cellpadding='5'>";
        echo "<tr><th>Last Name</th><th>First Name</th><th>Patronymic</th><th>Group Name</th><th>Scholarship Amount</th></tr>";
    
        if (count($results) > 0) {
            foreach ($results as $row) {
                echo "<tr>";
                echo "<td>" . $row['Last_Name'] . "</td>";
                echo "<td>" . $row['First_Name'] . "</td>";
                echo "<td>" . $row['Patronymic'] . "</td>";
                echo "<td>" . $row['Group_Name'] . "</td>";
                echo "<td>" . $row['Scholarship_Amount'] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No students receiving scholarships found.</td></tr>";
        }
    
        echo "</table>";
    }
?>