<?php
session_start();
if (!isset($_SESSION["people"])) {
    $_SESSION["people"] = [
        [
            "id" => 1,
            "name" => "lice",
            "age" => 25,
            "email" => "alice@example.com",
            "department" => "IT",
            "active" => true
        ],
        [
            "id" => 2,
            "name" => "Bob",
            "age" => 30,
            "email" => "bob@example.com",
            "department" => "Finance",
            "active" => false
        ]
    ];
}
$jmena = $_SESSION["people"];
$vybrane_veky = [];
$vek = $_GET["age"] ?? "";
$jmeno = $_GET["jmeno"] ?? "";
$sort = $_GET["sort"] ?? "age_asc";
$department = $_GET["department"] ?? "";
$status = $_GET["status"] ?? "";
$id = $_GET["id"] ?? null;
$update_employee = $_POST["update_employee"] ?? null;



$filteredPeople = [];
foreach ($jmena as $data) {
    if (matchesCriteria($data, $vek, $jmeno) && filterByActive($data, $status) && filterByDepartment($data, $department)) {
        $filteredPeople[] = $data;
    }
}
$filteredPeople = sortingPeople($filteredPeople, $sort);
$vybrane_veky = array_column($filteredPeople, "age");
$person = findPersonById($jmena, $id);
