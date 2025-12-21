<?php
include("../includes/header.php");

$file = "../data/students.txt";

if (file_exists($file)) {
    $students = file($file);
    foreach ($students as $student) {
        list($name, $email, $skills) = explode(",", $student);
        $skillsArray = explode(" | ", trim($skills));

        echo "<p><strong>Name:</strong> $name<br>";
        echo "<strong>Email:</strong> $email<br>";
        echo "<strong>Skills:</strong>";
        echo "<ul>";
        foreach ($skillsArray as $skill) {
            echo "<li>$skill</li>";
        }
        echo "</ul></p><hr>";
    }
} else {
    echo "No students found.";
}

include("../includes/footer.php");
?>
