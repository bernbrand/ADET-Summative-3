<?php
session_start();

// Function to reset session data
function resetSession()
{
    $_SESSION['todos'] = [];
}

// Function to simulate adding a todo
function addTodoTest($todo)
{
    $_SESSION['todos'][] = $todo;
}

// Function to simulate editing a todo
function editTodoTest($index, $todo)
{
    if (isset($_SESSION['todos'][$index])) {
        $_SESSION['todos'][$index] = $todo;
    }
}

// Function to simulate deleting a todo
function deleteTodoTest($index)
{
    if (isset($_SESSION['todos'][$index])) {
        array_splice($_SESSION['todos'], $index, 1);
    }
}

// Test function for adding todos
function testAddTodo()
{
    resetSession();
    addTodoTest('Test Task 1');
    addTodoTest('Test Task 2');
    assert(count($_SESSION['todos']) == 2, 'Add Todo Test Failed');
    assert($_SESSION['todos'][0] == 'Test Task 1', 'Add Todo Test Failed');
    assert($_SESSION['todos'][1] == 'Test Task 2', 'Add Todo Test Failed');
}

// Test function for editing todos
function testEditTodo()
{
    resetSession();
    addTodoTest('Test Task 1');
    addTodoTest('Test Task 2');
    editTodoTest(1, 'Updated Task 2');
    assert($_SESSION['todos'][1] == 'Updated Task 2', 'Edit Todo Test Failed');
}

// Test function for deleting todos
function testDeleteTodo()
{
    resetSession();
    addTodoTest('Test Task 1');
    addTodoTest('Test Task 2');
    deleteTodoTest(0);
    assert(count($_SESSION['todos']) == 1, 'Delete Todo Test Failed');
    assert($_SESSION['todos'][0] == 'Test Task 2', 'Delete Todo Test Failed');
}

// Run all tests
function runTests()
{
    testAddTodo();
    testEditTodo();
    testDeleteTodo();
    echo "All tests passed!";
}

// Run the tests
runTests();
?>
