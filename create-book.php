<?php
session_start();
include 'functions.php';

$db = db_connection();

$authors = get_book_author($db);
$publishers = get_book_publisher($db);

$id = $_GET['update_id'] ?? "";

if($id){
    $get_book_byId = mysqli_fetch_assoc(get_book_by_id($db,$id));
}



$error_msg = [];
$success_msg = '';

if (isset($_POST['submitBook'])) {
    $book_name = trim($_POST['book_name']);
    $book_description = trim($_POST['book_discription']);
    $book_author = trim($_POST['book_autor']);
    $book_publisher = trim($_POST['book_publisher']);
    $ISBN = trim($_POST['ISBN']); 

    if (empty($book_name)) {
        $error_msg[] = "Book name is required.";
    }

    if (empty($book_author)) {
        $error_msg[] = "Book author is required.";
    }

    if (empty($book_publisher)) {
        $error_msg[] = "Book publisher is required.";
    }

    if (empty($ISBN)) {
        $error_msg[] = "ISBN is required.";
    } elseif (!preg_match('/^\d{6}$/', $ISBN)) {
        $error_msg[] = "ISBN must be exactly 6 digits.";
    }

    if (empty($error_msg)) {

        if(!$id){
            create_book_record($db, $book_name, $book_description, $book_author, $book_publisher, $ISBN);
            $_SESSION['success_msg'] = "Book record created successfully!";
            header('Location: create-book.php');
        }else{
            update_book_record($db,$id, $book_name, $book_description, $book_author, $book_publisher, $ISBN);
            $_SESSION['success_msg'] = "Book record update successfully!";
            header("Location: create-book.php?update_id=$id");
        }
        
       
        exit();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Book</title>
    <link rel="stylesheet" href="./assets/style.css">
    <script src="./assets/script.js"></script>
</head>
<body>
    <h1>Create a New Book Record</h1>

  

    <?php if (isset($_SESSION['success_msg'])): ?>
        <div class="success_msg">
            <?php
            echo htmlspecialchars($_SESSION['success_msg']);
            unset($_SESSION['success_msg']);
            ?>
        </div>
    <?php endif; ?>

    <form action="<?php echo $id ? 'create-book.php?update_id=' . $id : 'create-book.php'; ?>" method="post" onsubmit="return validateForm(event)">
    <div id="error_container">
        <?php
        if (!empty($error_msg)) {?>
        <ul>
        <?php
            foreach ($error_msg as $msg) {
                echo '<li class="error_msg">' . htmlspecialchars($msg) . '</li>';
            }?>
        </ul>
            <?php
        }
        ?>
    </div>
    <div class="row">
            <div class="col">
                <label>Book Name<span style="color:red;font-size:20px">*</span> </label>
            </div>
            <div class="col">
                <input type="text" name="book_name" id="book_name" value="<?php echo $get_book_byId['book_name'] ?? ''?>">
                <div class="error_msg" id="book_name_error"></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label>Book Description:</label>
            </div>
            <div class="col">
                <textarea name="book_discription" id="book_discription"><?php echo $get_book_byId['book_discription'] ?? ''?></textarea>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label>Book Author<span style="color:red;font-size:20px">*</span></label>
            </div>
            <div class="col">
                <select name="book_autor" id="book_autor">
                    <option value="">Select option</option>
                    <?php
                    while ($author = mysqli_fetch_assoc($authors)) { ?>
                        <option <?php if($id && $get_book_byId['book_autor_id'] == $author['author_id']) echo "selected" ?> value="<?php echo $author['author_id'] ?>"><?php echo $author['author_title'] ?></option>
                    <?php } ?>
                </select>
                <div class="error_msg" id="book_autor_error"></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label>Book Publisher<span style="color:red;font-size:20px">*</span></label>
            </div>
            <div class="col">
                <select name="book_publisher" id="book_publisher">
                    <option value="">Select option</option>
                    <?php
                    while ($publisher = mysqli_fetch_assoc($publishers)) { ?>
                    <option <?php if ($id && $get_book_byId['book_publisher_id'] == $publisher['publisher_id']) echo "selected" ?> value="<?php echo $publisher['publisher_id'] ?>">
                        <?php echo $publisher['publisher_title'] ?>
                    </option>
                    <?php } ?>
                </select>
                <div class="error_msg" id="book_publisher_error"></div>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <label>ISBN<span style="color:red;font-size:20px">*</span></label>
            </div>
            <div class="col">
                <input type="number" name="ISBN" id="ISBN" value="<?php echo $get_book_byId['ISBN'] ?? null ?>">
                <div class="error_msg" id="ISBN_error"></div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <button type="submit" name="submitBook"><?php echo $id ? 'Update Book' : 'Add Book'; ?> </button>
                <a class="button" href="index.php">Back</a>
            </div>
        </div>

    </form>
</body>
</html>
