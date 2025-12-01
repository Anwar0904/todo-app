<?php
$todo_items = null;
// $todo_items = [
//     [
//         'name' => 'Buy groceries',
//         'description' => 'Milk, Bread, Eggs, Butter',
//         'due_date' => '2024-07-01'
//     ],
//     [
//         'name' => 'Finish project report',
//         'description' => 'Complete the final draft of the project report and send it to the manager.',
//         'due_date' => '2024-07-03'
//     ]
// ];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ToDo List</title>
  <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
  <h1>TODO APP</h1>
  <main>
    <section class="form_section">
      <h2>Add TODO</h2>
      <form action="./includes/database.php" method="post">
        <input type="text" name="todo_name" class="todo_name" id="todo_name" placeholder="Enter TODO name">
        <input type="date" name="todo_date" class="todo_date" id="todo_date" placeholder="TODO date">
        <textarea name="todo_desc" id="todo_desc" rows="5" placeholder="Enter TODO description"></textarea>
        <input type="submit" name="submit" value="Submit/Add" id="submit_btn" class="submit_btn">
      </form>
    </section>
    <section class="display_section">
      <h2>TODO List</h2>
      <div class="todo_display" id="todo_display">
        <?php
        if (!$todo_items) {
          echo "<p class='no_todo_msg'>TODO items will be displayed here</p>";
        } else {
          // Display TODO items
          foreach ($todo_items as $item) {
            echo "<div class='todo_item'>
                                    <h3>{$item['name']}</h3>
                                    <p>{$item['description']}</p>
                                    <span>Due Date: {$item['due_date']}</span>
                                    <button class='edit_btn'>Edit</button>
                                    <button class='delete_btn'>Delete</button>
                                    <button class='complete_btn'>Completed</button>
                                  </div>";
          }
        }
        ?>

      </div>
    </section>
  </main>
</body>

</html>