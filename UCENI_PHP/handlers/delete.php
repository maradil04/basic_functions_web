<?php
if (
    $_SERVER["REQUEST_METHOD"] === "POST"
    && isset($_POST["delete_employee"])
) {

    $deleteId = $_POST["delete_id"] ?? null;

    $remainingPeople = [];
    foreach ($jmena as $person) {
        if ($person["id"] !== (int)$deleteId) {
            $remainingPeople[] = $person;
        }
    }
    $jmena = $remainingPeople;
    $_SESSION["people"] = $jmena;
    header("Location: index.php");
    exit;
}
