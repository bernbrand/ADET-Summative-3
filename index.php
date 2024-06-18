<?php
session_start();

// Initialize the session if not already done
if (!isset($_SESSION['todos'])) {
    $_SESSION['todos'] = [];
}

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['action'])) {
        switch ($_POST['action']) {
            case 'add':
                $new_todo = htmlspecialchars($_POST['todo']);
                if ($new_todo) {
                    $_SESSION['todos'][] = $new_todo;
                }
                break;
            case 'edit':
                $index = $_POST['index'];
                $updated_todo = htmlspecialchars($_POST['todo']);
                if (isset($_SESSION['todos'][$index]) && $updated_todo) {
                    $_SESSION['todos'][$index] = $updated_todo;
                }
                break;
            case 'delete':
                $index = $_POST['index'];
                if (isset($_SESSION['todos'][$index])) {
                    array_splice($_SESSION['todos'], $index, 1);
                }
                break;
            case 'run_tests':
                header('Location: test.php');
                exit;
        }
    }
}

// Function to display todos
function displayTodos()
{
    foreach ($_SESSION['todos'] as $index => $todo) {
        echo '<li>' . htmlspecialchars($todo) . 
            ' <form style="display:inline;" method="POST">' .
            '<input type="hidden" name="index" value="' . $index . '">' .
            '<input type="hidden" name="action" value="delete">' .
            '<button type="submit">Delete</button>' .
            '</form>' .
            ' <form style="display:inline;" method="POST">' .
            '<input type="hidden" name="index" value="' . $index . '">' .
            '<input type="hidden" name="action" value="edit">' .
            '<input type="text" name="todo" value="' . htmlspecialchars($todo) . '">' .
            '<button type="submit">Edit</button>' .
            '</form>' .
            '</li>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To-do App</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('bg.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 10px;
        }
        h1 {
            text-align: center;
        }
        form {
            margin: 20px 0;
            text-align: center;
        }
        input[type="text"] {
            padding: 10px;
            font-size: 16px;
            width: 70%;
            margin-right: 10px;
        }
        button {
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            background: #f4f4f4;
            margin: 10px 0;
            padding: 10px;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        ul li form {
            display: inline;
        }
        ul li input[type="text"] {
            width: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>To-do App</h1>
        <form method="POST">
            <input type="text" name="todo" placeholder="Enter a new task">
            <input type="hidden" name="action" value="add">
            <button type="submit">Add</button>
        </form>
        <ul>
            <?php displayTodos(); ?>
        </ul>
        
    </div>
</body>
</html>
