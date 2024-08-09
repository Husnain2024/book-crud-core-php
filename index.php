<?php
session_start();

include 'functions.php';

$db = db_connection();


$allbookList =  get_All_book($db);
$success_msg = '';

if (isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    book_Delete($db,$id);
    $_SESSION['success_msg'] = "Book record deleted successfully!";
    header('location:index.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Records</title>
    <link rel="stylesheet" href="./assets/style.css">
    <script src="./assets/script.js"></script>
</head>
<body class="record_list">
    <div class="row">
        <h1>Book Records</h1>
        <a class="add_book_record" href="create-book.php">Add Book Record</a>
    </div>
    <?php if (isset($_SESSION['success_msg'])): ?>
    <div class="success_msg">
        <?php echo htmlspecialchars($_SESSION['success_msg']); ?>
    </div>
    <?php unset($_SESSION['success_msg']); ?>
<?php endif; ?>
    <table border="1" width="100%">
        <thead>
            <tr>
                <th>#</th>
                <th>Book Name</th>
                <th>discription</th>
                <th>Autor</th>
                <th>Publisher</th>
                <th>ISBN</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                while($booklist = mysqli_fetch_assoc($allbookList)){ ?>

                <tr>
                    <td><?php echo $booklist['id'] ?></td>
                    <td><?php echo $booklist['book_name'] ?></td>
                    <td><?php echo $booklist['book_discription'] ?></td>
                    <td><?php echo $booklist['book_autor'] ?></td>
                    <td><?php echo $booklist['book_publisher'] ?></td>
                    <td><?php echo $booklist['ISBN'] ?></td>
                    <td>
                        <a href="create-book.php?update_id=<?php echo $booklist['id']  ?>">Edit</a>
                        <a onclick="confirmDelete(<?php echo $booklist['id']  ?>)" href="#">Delete</a>
                    </td>
                </tr>
                    
              <?php  } ?>
        </tbody>
    </table>
</body>
</html>