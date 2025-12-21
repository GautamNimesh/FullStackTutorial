<?php
function formatName($name) {
    return ucwords(trim($name));
}

function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function cleanSkills($string) {
    $skills = explode(",", $string);
    return array_map("trim", $skills);
}

function saveStudent($name, $email, $skillsArray) {
    $file = "../data/students.txt";
    $skillsString = implode(" | ", $skillsArray);
    $data = "$name,$email,$skillsString\n";

    if (!file_put_contents($file, $data, FILE_APPEND)) {
        throw new Exception("Unable to save student data.");
    }
}

function uploadPortfolioFile($file) {
    $allowedTypes = ["application/pdf", "image/jpeg", "image/png"];
    $maxSize = 2 * 1024 * 1024;

    if ($file["error"] !== 0) {
        throw new Exception("File upload error.");
    }

    if (!in_array($file["type"], $allowedTypes)) {
        throw new Exception("Invalid file type.");
    }

    if ($file["size"] > $maxSize) {
        throw new Exception("File exceeds 2MB.");
    }

    $newName = time() . "_" . strtolower(str_replace(" ", "_", $file["name"]));
    $destination = "../uploads/" . $newName;

    if (!move_uploaded_file($file["tmp_name"], $destination)) {
        throw new Exception("File upload failed.");
    }
}
