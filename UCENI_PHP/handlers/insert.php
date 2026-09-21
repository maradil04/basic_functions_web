<?php
$error = "";
if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && isset($_POST["add_employee"])
) {
    $NewName = trim($_POST["new_name"] ?? "");
    $NewAge = $_POST["new_age"] ?? "";
    $NewEmail = trim($_POST["new_email"] ?? "");
    $NewDepartment = $_POST["new_department"] ?? "";
    $NewActive = isset($_POST["new_active"]);

    if (count(str_split($NewName)) === 0) {
        $error .= "ERROR: Name is required.";
    } elseif (!validateAge($NewAge)) {
        $error .= "ERROR: Age must be a non-negative integer.";
    } elseif (!filter_var($NewEmail, FILTER_VALIDATE_EMAIL)) {
        $error .= "ERROR: Invalid email format.";
    } elseif (in_array($NewEmail, array_column($jmena, "email"))) {
        $error .= "ERROR: Email already exists.";
    } elseif (!in_array($NewDepartment, ["IT", "Finance"])) {
        $error .= "ERROR: Department must be either IT or Finance.";
    } else {
        $newId = count($jmena) > 0 ? max(array_column($jmena, "id")) + 1 : 1;
        $newPerson = [
            "id" => $newId,
            "name" => $NewName,
            "age" => (int)$NewAge,
            "email" => $NewEmail,
            "department" => $NewDepartment,
            "active" => $NewActive
        ];
        $jmena[] = $newPerson;
        $_SESSION["people"] = $jmena;
        $error = "New employee added successfully.";
        header("Location: index.php");
        exit;
    }
}
