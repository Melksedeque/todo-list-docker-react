<?php
require 'database.php';
header("Content-Type: application/json");

$pdo = getDatabaseConnection();

// Obtém todas as tarefas (GET /tasks)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $stmt = $pdo->query("SELECT * FROM tasks");
    $tasks = $stmt->fetchAll();
    echo json_encode($tasks);
    exit();
}

// Adiciona uma nova tarefa (POST /tasks)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $title = $input['title'] ?? '';
    if ($title) {
        $stmt = $pdo->prepare("INSERT INTO tasks (title) VALUES (:title)");
        $stmt->execute(['title' => $title]);
        echo json_encode(['id' => $pdo->lastInsertId(), 'title' => $title, 'completed' => 0]);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Title is required']);
    }
    exit();
}

// Atualiza uma tarefa (PUT /tasks/{id})
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    $input = json_decode(file_get_contents('php://input'), true);
    $id = $_GET['id'] ?? null;
    $completed = $input['completed'] ?? 0;
    if ($id) {
        $stmt = $pdo->prepare("UPDATE tasks SET completed = :completed WHERE id = :id");
        $stmt->execute(['completed' => $completed, 'id' => $id]);
        echo json_encode(['message' => 'Task updated']);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'ID is required']);
    }
    exit();
}

// Exclui uma tarefa (DELETE /tasks/{id})
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $id = $_GET['id'] ?? null;
    if ($id) {
        $stmt = $pdo->prepare("DELETE FROM tasks WHERE id = :id");
        $stmt->execute(['id' => $id]);
        echo json_encode(['message' => 'Task deleted']);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'ID is required']);
    }
    exit();
}
