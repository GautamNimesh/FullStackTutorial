<?php
include("../includes/header.php");
include("functions.php");

$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["portfolio"])) {
    try {
        uploadPortfolioFile($_FILES["portfolio"]);
        $message = "Portfolio uploaded successfully.";
    } catch (Exception $e) {
        $message = "Error: " . $e->getMessage();
    }
}
?>

<h3>Upload Portfolio File</h3>

<form method="POST" enctype="multipart/form-data">
    Select file:
    <input type="file" name="portfolio" accept=".pdf,.jpg,.png" required><br><br>
    <button type="submit">Upload</button>
</form>

<p><?php echo $message; ?></p>

<?php include("../includes/footer.php"); ?>
