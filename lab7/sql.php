<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Ex8</title>
  </head>
  <body>
    <form action="sql.php" method="post">
      <div>
        DB name <input type="text" name="name">
      </div>
      <div>
        SQL Query <input type="text" name="query">
      </div>
      <div>
        <input type="submit" name="sm" value="submit">
      </div>
    </form>

    <?php
      if(isset($_POST['name']) && isset($_POST['query']) && $_POST['name'] != "" && $_POST['query'] != ""){
        $name = $_POST['name'];
        $query = $_POST['query'];

        try {
          $db = new PDO("mysql:host=localhost;dbname={$name}",
          "root", "");
          $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          $rows = $db->query($query);?>
          <ul>
          <?php foreach($rows as $value) {?>
            <li><?= var_dump($value) ?></li>
          <?php
          }
         ?>
         </ul>
        <?php  } catch (PDOException $e) {?>
          <p>Sorry, a database error occurred. Please try again later.</p>
          <p>(Error details: <?= $ex->getMessage() ?>)</p>
          <?php
        } ?>
     <?php } ?>



  </body>
</html>
