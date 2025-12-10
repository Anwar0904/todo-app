<?php
require_once __DIR__ . '/../config/database.config.php';

$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// update or create new todo item
if (isset($_POST['submit'])) {
    $todo_item_name = $_POST['todo_name'];
    $todo_item_date = $_POST['todo_date'];
    $todo_item_desc = $_POST['todo_desc'];


    if (isset($_POST['todo_id']) && !empty($_POST['todo_id'])) {
        // update todo item
        $todo_id = $_POST['todo_id'];
        $stmt = $conn->prepare("UPDATE todoItems SET todo_name = ?, todo_date = ?, todo_desc = ? WHERE id = ?");
        $stmt->bind_param("sssi", $todo_item_name, $todo_item_date, $todo_item_desc, $todo_id);

        if ($stmt->execute()) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        // create new todo item
        $stmt = $conn->prepare("INSERT INTO todoItems (todo_name, todo_date, todo_desc) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $todo_item_name, $todo_item_date, $todo_item_desc);

        if ($stmt->execute()) {
            header("Location: ../index.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
}


if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    $stmt = $conn->prepare("DELETE FROM todoItems WHERE id = ?");
    $stmt->bind_param("i", $delete_id);

    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}


function complete_todo($conn, $complete_id)
{
    $stmt = $conn->prepare("UPDATE todoItems SET completed = 1 WHERE id = ?");
    $stmt->bind_param("i", $complete_id);

    if ($stmt->execute()) {
        header("Location: ../index.php");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

if (isset($_GET['complete_id'])) {
    $complete_id = $_GET['complete_id'];
    complete_todo($conn, $complete_id);
}

function fetch_todo_items($conn)
{
    $items = [];
    $result = $conn->query("SELECT * FROM todoItems ORDER BY completed ASC");

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $items[] = $row;
        }
    }
    return $items;
}


function get_item($conn, $edit_id)
{
    $stmt = $conn->prepare("SELECT * FROM todoItems WHERE id = ?");
    $stmt->bind_param("i", $edit_id);
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        }
    }
    return null;
}

$todo_items = fetch_todo_items($conn);
$item = null;

if (isset($_GET['edit_id'])) {
    $edit_id = $_GET['edit_id'];
    $item = get_item($conn, $edit_id);
}

$conn->close();
