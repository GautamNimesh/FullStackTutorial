<?php
include("../includes/header.php");
include("functions.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        $name = formatName($_POST["name"]);
        $email = $_POST["email"];
        $skills = cleanSkills($_POST["skills"]);

        if (!validateEmail($email)) {
            throw new Exception("Invalid email format.");
        }

        saveStudent($name, $email, $skills);
        $message = "Student information saved successfully.";
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<h3>Add Student Info</h3>

<form method="POST">
    Name: <input type="text" name="name" required><br><br>
    Email: <input type="email" name="email" required><br><br>
    Skills (comma-separated): <input type="text" name="skills" required><br><br>
    <button type="submit">Save Student</button>
</form>

<p><?php echo $message; ?></p>

<?php include("../includes/footer.php"); ?>
