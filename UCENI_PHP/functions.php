<?php


function formatPerson($person)
{
    return ($person["name"] ?? "No name") . ", " . $person["age"] . ", " . ($person["email"] ?? "No email");
}

function findPersonById($people, $id)
{
    foreach ($people as $person) {
        if ($person["id"] === (int)$id) {
            return $person;
        }
    }

    return null;
}

function matchesCriteria($person, $age, $name)
{
    return $person["age"] >= $age && ($name === "" || str_contains(strtolower($person["name"] ?? ""), strtolower($name)) || str_contains(strtolower($person["email"] ?? ""), strtolower($name)));
}

function calculateAverageAge($ages)
{
    return count($ages) > 0 ? array_sum($ages) / count($ages) : "No data";
}

function minAge($ages)
{
    return count($ages) > 0 ? min($ages) : "No data";
}

function maxAge($ages)
{
    return count($ages) > 0 ? max($ages) : "No data";
}

function countPeople($ages)
{
    return count($ages);
}

function e($value)
{
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES,
        "UTF-8"
    );
}

function validateAge($age)
{
    if (filter_var($age, FILTER_VALIDATE_INT) === false || $age < 0) {
        return false;
    }
    return true;
}

function sortingPeople($data, $sort)
{
    if ($sort === "age_asc") {
        usort($data, function ($a, $b) {
            return $a["age"] <=> $b["age"];
        });
    } elseif ($sort === "age_desc") {
        usort($data, function ($a, $b) {
            return $b["age"] <=> $a["age"];
        });
    } elseif ($sort === "name_asc") {
        usort($data, function ($a, $b) {
            return strcmp($a["name"] ?? "", $b["name"] ?? "");
        });
    } elseif ($sort === "email_asc") {
        usort($data, function ($a, $b) {
            return strcmp($a["email"] ?? "", $b["email"] ?? "");
        });
    }
    return $data;
}


function filterByActive($data, $status)
{
    if ($status === "All Statuses" || $status === "") {
        return true;
    }
    if ($status === "active" && $data["active"] === true) {
        return true;
    }
    if ($status === "inactive" && $data["active"] === false) {
        return true;
    }
    return false;
}

function filterByDepartment($data, $department)
{
    if ($department === "All Departments" || $department === "") {
        return true;
    }
    if ($data["department"] === $department) {
        return true;
    }
    return false;
}
