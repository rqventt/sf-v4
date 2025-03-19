<?php

require_once 'config.php';
session_start();

if (isset($_POST['t-bulk'])) {
    $action = $_POST['t-bulk'];
    $ba_data = explode('-', $_POST['ba-data']);
    $ba_data = array_map('intval', $ba_data);

    // ARCHIVE
    if ($action === 'archive') {
        $placeholders = implode(',', array_fill(0, count($ba_data), '?'));
        $query = "UPDATE theses SET archived = 1 WHERE thesis_id IN ($placeholders)";

        $stmt = $conn->prepare($query);
        $stmt->bind_param(str_repeat('i', count($ba_data)), ...$ba_data);

        $stmt->execute();
        $stmt->close();

        $_SESSION['success'] = 'Successfully archived selected theses.';
    }

    // RETRIEVE
    if ($action === 'retrieve') {
        $placeholders = implode(',', array_fill(0, count($ba_data), '?'));
        $query = "UPDATE theses SET archived = 0 WHERE thesis_id IN ($placeholders)";

        $stmt = $conn->prepare($query);
        $stmt->bind_param(str_repeat('i', count($ba_data)), ...$ba_data);

        $stmt->execute();
        $stmt->close();

        $_SESSION['success'] = 'Successfully retrieved selected theses.';
    } 

    // DELETE
    if ($action === 'delete') {
        $placeholders = implode(',', array_fill(0, count($ba_data), '?'));

        // Step 1: Transfer data to theses_backup
        $transferQuery = "INSERT INTO theses_backup SELECT * FROM theses WHERE thesis_id IN ($placeholders)";
        $stmt = $conn->prepare($transferQuery);
        $stmt->bind_param(str_repeat('i', count($ba_data)), ...$ba_data);
        $stmt->execute();
        $stmt->close();
    
        // Step 2: Delete from theses
        $deleteQuery = "DELETE FROM theses WHERE thesis_id IN ($placeholders)";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param(str_repeat('i', count($ba_data)), ...$ba_data);
        $stmt->execute();
        $stmt->close();
    
        // Step 3: Get the next AUTO_INCREMENT value
        $result = $conn->query("SELECT IFNULL(MAX(thesis_id), 0) + 1 AS next_id FROM theses");
        $row = $result->fetch_assoc();
        $nextAutoIncrement = $row['next_id'];
    
        // Step 4: Reset AUTO_INCREMENT
        $conn->query("ALTER TABLE theses AUTO_INCREMENT = $nextAutoIncrement");
    }    

    header("Location: testphp.php");
    exit();
}

if (isset($_POST['new-thesis'])) {
    $title = addslashes($_POST['title']);
    $authors = implode('-', array_map('trim', explode('+', $_POST['authors'])));
    $abstract = addslashes($_POST['abstract']);
    $keywords = implode(', ', array_map('trim', explode(',', $_POST['keywords'])));
    $course = $_POST['course'];
    $pdate = $_POST['pdate'];

    $query = "INSERT INTO theses (published_date, course, title, authors, abstract, keywords) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('ssssss', $pdate, $course, $title, $authors, $abstract, $keywords);

    $stmt->execute();
    $stmt->close();

    $_SESSION['success'] = 'Successfully added new thesis';
    header("Location: testphp.php");
    exit();
}
