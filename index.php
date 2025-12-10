<?php
include './includes/database.php';
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
      <h2><?= $item ? "Edit TODO" : "Add TODO" ?></h2>
      <form action="./includes/database.php" method="post">
        <!-- Hidden field to store todo ID when editing -->
        <input type="hidden" name="todo_id" value="<?= $item ? $item['id'] : '' ?>">

        <input type="text" name="todo_name" class="todo_name" id="todo_name"
          placeholder="Enter TODO name" required
          value="<?= $item ? htmlspecialchars($item['todo_name']) : '' ?>">

        <input type="date" name="todo_date" class="todo_date" id="todo_date"
          placeholder="TODO date" required
          value="<?= $item ? $item['todo_date'] : '' ?>">

        <textarea name="todo_desc" id="todo_desc_input" rows="5"
          placeholder="Enter TODO description" maxlength="100"><?= $item ? htmlspecialchars($item['todo_desc']) : '' ?></textarea>

        <input type="submit" name="submit" value="<?= $item ? 'Update' : 'Submit/Add' ?>"
          id="submit_btn" class="submit_btn">

        <?php if ($item): ?>
          <a class="edit_cancel_btn" href="index.php" class="cancel_btn">Cancel</a>
        <?php endif; ?>
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
        ?>
            <div class='todo_item'>
              <div class='todo_item_display'>
                <div class='todo_name_and_date'>
                  <h3 id='todo_name'><?= $item["todo_name"] ?></h3>
                  <p id='todo_date'><?= $item["todo_date"] ?></p>
                </div>

                <div class='todo_item_btns'>
                  <?php if (!$item["completed"]): ?>
                    <a href='index.php?edit_id=<?= $item['id'] ?>' class='edit_btn'>Edit</a>
                  <?php endif; ?>

                  <form action="./includes/database.php" method="get" style="display: inline;">
                    <input type="hidden" name="delete_id" value="<?= $item['id'] ?>">
                    <button type='submit' class='delete_btn'>Delete</button>
                  </form>

                  <?php if (!$item["completed"]): ?>
                    <form action="./includes/database.php" method="get" style="display: inline;">
                      <input type="hidden" name="complete_id" value="<?= $item['id'] ?>">
                      <button type='submit' class='complete_btn'>Complete</button>
                    </form>
                  <?php endif; ?>
                </div>
              </div>
              <div class='todo_dropdown'>
                <img src='./assets/images/arrow-down-sign-to-navigate.png' alt='dropdown arrow' class='dropdown_arrow' id='dropdown_arrow' width='20' height='20'>

              </div>
              <p id='todo_desc'><?= $item["todo_desc"] ?></p>

            </div>
        <?php
          }
        }
        ?>


    </section>
  </main>
  <script src="./assets/js/script.js"></script>
</body>

</html>