<?php

require_once __DIR__ . "/functions.php";
require_once __DIR__ . "/bootstrap.php";
require_once __DIR__ . "/handlers/insert.php";
require_once __DIR__ . "/handlers/update.php";
require_once __DIR__ . "/handlers/delete.php";
?>


<!DOCTYPE HTML>
<html lang="cs">

<head>
    <meta charset="UTF-8">
    <title>Jména</title>
</head>

<body>
    <h1>Seznam jmen:</h1>
    <div>
        <h2>Add new person:</h2>
        <form method="post">

            Name:
            <input type="text" name="new_name"><br><br>

            Age:
            <input type="number" name="new_age"><br><br>

            Email:
            <input type="email" name="new_email"><br><br>

            Department:
            <select name="new_department">
                <option value="IT">IT</option>
                <option value="Finance">Finance</option>
            </select><br><br>

            Active:
            <input type="checkbox" name="new_active"><br><br>

            <button type="submit" name="add_employee">
                Add employee
            </button>
            <p><?= $error ?></p>


        </form>
    </div>
    <br><br>
    <form method="get">
        <h2>Filter:</h2>
        Age: <br> <input type="number" name="age" value="<?= e($vek); ?>"><br><br>

        Name Contains: <br> <input type="text" name="jmeno" value="<?= e($jmeno); ?>"><br><br>

        Department:
        <select name="department">
            <option value="">All Departments</option>
            <option value="IT" <?= $department === "IT" ? "selected" : "" ?>>IT</option>
            <option value="Finance" <?= $department === "Finance" ? "selected" : "" ?>>Finance</option>
        </select><br><br>

        Status:
        <select name="status">
            <option value="">All Statuses</option>
            <option value="active" <?= $status === "active" ? "selected" : "" ?>>Active</option>
            <option value="inactive" <?= $status === "inactive" ? "selected" : "" ?>>Inactive</option>
        </select><br><br>


        Sort by:
        <select name="sort">
            <option value="age_asc" <?= $sort === "age_asc" ? "selected" : "" ?>>Age ascending</option>
            <option value="age_desc" <?= $sort === "age_desc" ? "selected" : "" ?>>Age descending</option>
            <option value="name_asc" <?= $sort === "name_asc" ? "selected" : "" ?>>Name A-Z</option>
            <option value="email_asc" <?= $sort === "email_asc" ? "selected" : "" ?>>Email A-Z</option>
        </select><br><br>
        <button type="submit">Submit</button>
        <a href="index.php">Reset</a><br>
    </form>

    <h1> <?= validateAge($vek) ? "Chosen age: " . e($vek) : "" ?> </h1>
    <h1> <?= $jmeno === "" ? "" : "Name/Email contains: " . e($jmeno) ?> </h1>

    <div>
        <?php if ($id != null) { ?>
            <p> Name: <?= e($person["name"] ?? "No name") ?> </p>
            <p> Age: <?= e($person["age"] ?? "No age") ?> </p>
            <p> Email: <?= e($person["email"] ?? "No email") ?> </p>
            <p> Department: <?= e($person["department"] ?? "No department") ?> </p>
            <p> Status: <?= e($person["active"] === true ? "Active" : "Inactive") ?> </p>
        <?php } ?>
    </div>
    <br>
    <ul>
        <?php foreach ($filteredPeople as $data) { ?>
            <li>
                <p> <?= e(formatPerson($data)); ?> </p>
                <a href="index.php?id=<?= $data["id"] ?>">Detail</a>
                <form method="post">
                    <input
                        type="hidden"
                        name="delete_id"
                        value="<?= $data["id"] ?>">

                    <button
                        type="submit"
                        name="delete_employee">
                        Delete
                    </button>
                </form>
                <form method="post">
                    <button
                        type="submit"
                        name="update_employee"
                        value="<?= $data["id"] ?>">
                        Update
                    </button>
                </form>
                <?php if ($update_employee == $data["id"]) { ?>
                    <form method="post">
                        <input
                            type="hidden"
                            name="update_id"
                            value="<?= $data["id"] ?>">

                        Name:
                        <input type="text" name="update_name" value="<?= e($data["name"] ?? ""); ?>"><br><br>

                        Age:
                        <input type="number" name="update_age" value="<?= e($data["age"] ?? ""); ?>"><br><br>

                        Email:
                        <input type="email" name="update_email" value="<?= e($data["email"] ?? ""); ?>"><br><br>

                        Department:
                        <select name="update_department">
                            <option value="IT" <?= $data["department"] === "IT" ? "selected" : "" ?>>IT</option>
                            <option value="Finance" <?= $data["department"] === "Finance" ? "selected" : "" ?>>Finance</option>
                        </select><br><br>

                        Active:
                        <input type="checkbox" name="update_active" <?= $data["active"] ? "checked" : ""; ?>><br><br>

                        <button type="submit" name="save_update">Save</button>
                        <p><?= $error_update ?></p>
                    </form>

                <?php } ?>
            </li>
            <br>
        <?php } ?>
    </ul>

    <p> Average age: <?= calculateAverageAge($vybrane_veky); ?></p>
    <p> Minimum age: <?= minAge($vybrane_veky); ?></p>
    <p> Maximum age: <?= maxAge($vybrane_veky); ?></p>
    <p> Number of people: <?= countPeople($vybrane_veky); ?></p>
</body>

</html>