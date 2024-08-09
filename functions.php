<?php
function db_connection(){
    $db_conn = mysqli_connect('localhost','root','','book_records');
    if(!$db_conn){
        die("Database connection Error: " . mysqli_connect_error($db_conn));
    } 
    return $db_conn;
}


function get_book_author($db){

    $query = "SELECT `author_id`, `author_title` FROM `phptest3_author`";
    $result = mysqli_query($db,$query);
    if(!$result){
        die("Qurey Field: " . mysqli_error($db));
    }
    return $result;
}
function get_book_publisher($db){

    $query = "SELECT `publisher_id`, `publisher_title` FROM `phptest3_publisher`";
    $result = mysqli_query($db,$query);
    if(!$result){
        die("Qurey Field: " . mysqli_error($db));
    }
    return $result;
}


function create_book_record($db, $book_name,$book_discription,$book_autor,$book_publisher,$ISBN){

    $query = "INSERT INTO `book_records`(`book_name`, `book_discription`, `ISBN`, `book_autor_id`, `book_publisher_id`) 
    VALUES ('$book_name','$book_discription','$ISBN',$book_autor,$book_publisher)";
    $result = mysqli_query($db,$query);
    if(!$result){
        die("Qurey Field: " . mysqli_error($db));
    }
    return $result;
}
function update_book_record($db,$id, $book_name,$book_discription,$book_autor,$book_publisher,$ISBN){

    $query = "UPDATE `book_records` SET `book_name`='$book_name',`book_discription`='$book_discription',
    `ISBN`=$ISBN,`book_autor_id`=$book_autor,`book_publisher_id`=$book_publisher WHERE id = $id";
    $result = mysqli_query($db,$query);
    if(!$result){
        die("Qurey Field: " . mysqli_error($db));
    }
    return $result;
}



function get_All_book($db){

    $query = "SELECT book_records.id, book_records.book_name, book_records.book_discription,book_records.ISBN, phptest3_author.author_title AS book_autor , phptest3_publisher.publisher_title AS book_publisher FROM book_records JOIN phptest3_author ON book_records.book_autor_id = phptest3_author.author_id JOIN phptest3_publisher ON book_records.book_publisher_id = phptest3_publisher.publisher_id";
    $result = mysqli_query($db,$query);
    if(!$result){
        die("Qurey Field: " . mysqli_error($db));
    }
    return $result;
}
function get_book_by_id($db,$id){

    $query = "SELECT `id`, `book_name`, `book_discription`, `ISBN`, `book_autor_id`, `book_publisher_id` FROM `book_records` WHERE id = $id";
    $result = mysqli_query($db,$query);
    if(!$result){
        die("Qurey Field: " . mysqli_error($db));
    }
    return $result;
}

function book_Delete($db,$id){

    $query = "DELETE FROM `book_records` WHERE `id`= $id";
    $result = mysqli_query($db,$query);
    if(!$result){
        die("Qurey Field: " . mysqli_error($db));
    }
    return $result;
}

?>