<?php
require_once 'config.php';
session_start();

if (isset($_POST['t-act'])) {
    $action = $_POST['t-act'];
    $a_data = $_POST['a-data'];
    $padded_a_data = str_pad($a_data, 4, '0', STR_PAD_LEFT);

    // ARCHIVE
    if ($action === 'archive') {
        $query = "UPDATE theses SET archived = 1 WHERE thesis_id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $a_data);

        $stmt->execute();
        $stmt->close();

        $_SESSION['success'] = 'Successfully archived thesis with an ID of ' . $padded_a_data . '.';
    }

    // RETRIEVE
    if ($action === 'retrieve') {
        $query = "UPDATE theses SET archived = 0 WHERE thesis_id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('i', $a_data);

        $stmt->execute();
        $stmt->close();

        $_SESSION['success'] = 'Successfully retrieved thesis with an ID of ' . $padded_a_data . '.';
    }

    // DELETE
    if ($action === 'delete') {
        $transferQuery = "INSERT INTO theses_backup SELECT * FROM theses WHERE thesis_id = ?";
        $stmt = $conn->prepare($transferQuery);
        $stmt->bind_param('i', $a_data);
        $stmt->execute();
        $stmt->close();

        $deleteQuery = "DELETE FROM theses WHERE thesis_id = ?";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param('i', $a_data);
        $stmt->execute();
        $stmt->close();

        $result = $conn->query("SELECT IFNULL(MAX(thesis_id), 0) + 1 AS next_id FROM theses");
        $row = $result->fetch_assoc();
        $nextAutoIncrement = $row['next_id'];

        $conn->query("ALTER TABLE theses AUTO_INCREMENT = $nextAutoIncrement");

        $_SESSION['success'] = 'Successfully deleted thesis with an ID of ' . $padded_a_data . '.';
    }

    header("Location: admin.php");
    exit();
}

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

        $transferQuery = "INSERT INTO theses_backup SELECT * FROM theses WHERE thesis_id IN ($placeholders)";
        $stmt = $conn->prepare($transferQuery);
        $stmt->bind_param(str_repeat('i', count($ba_data)), ...$ba_data);
        $stmt->execute();
        $stmt->close();
    
        $deleteQuery = "DELETE FROM theses WHERE thesis_id IN ($placeholders)";
        $stmt = $conn->prepare($deleteQuery);
        $stmt->bind_param(str_repeat('i', count($ba_data)), ...$ba_data);
        $stmt->execute();
        $stmt->close();
    
        $result = $conn->query("SELECT IFNULL(MAX(thesis_id), 0) + 1 AS next_id FROM theses");
        $row = $result->fetch_assoc();
        $nextAutoIncrement = $row['next_id'];

        $conn->query("ALTER TABLE theses AUTO_INCREMENT = $nextAutoIncrement");
    }    

    header("Location: admin.php");
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
    header("Location: admin.php");
    exit();
}
