<?php
$error_update = "";
if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && isset($_POST["save_update"])
) {

    $updateId = $_POST["update_id"] ?? null;
    $update_employee = $updateId;
    $updateName = trim($_POST["update_name"] ?? "");
    $updateAge = $_POST["update_age"] ?? "";
    $updateEmail = trim($_POST["update_email"] ?? "");
    $updateDepartment = $_POST["update_department"] ?? "";
    $updateActive = isset($_POST["update_active"]);
    $usedEmail = [];
    foreach ($jmena as $person) {
        if ($person["id"] !== (int)$updateId) {
            $usedEmail[] = $person["email"];
        }
    }

    if (count(str_split($updateName)) === 0) {
        $error_update .= "ERROR: Name is required.";
    } elseif (!validateAge($updateAge)) {
        $error_update .= "ERROR: Age must be a non-negative integer.";
    } elseif (!filter_var($updateEmail, FILTER_VALIDATE_EMAIL)) {
        $error_update .= "ERROR: Invalid email format.";
    } elseif (!in_array($updateDepartment, ["IT", "Finance"])) {
        $error_update .= "ERROR: Department must be either IT or Finance.";
    } elseif (in_array($updateEmail, $usedEmail)) {
        $error_update .= "ERROR: Email already exists.";
    } else {
        foreach ($jmena as $index => $person) {
            if ($person["id"] === (int)$updateId) {

                $jmena[$index]["name"] = $updateName;
                $jmena[$index]["age"] = (int)$updateAge;
                $jmena[$index]["email"] = $updateEmail;
                $jmena[$index]["department"] = $updateDepartment;
                $jmena[$index]["active"] = $updateActive;

                break;
            }
        }
        $_SESSION["people"] = $jmena;
        header("Location: index.php");
        exit;
    }
}
