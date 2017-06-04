<?php
    function connect_db(){
        global $connection;
        $host="localhost";
        $username="test";
        $password="t3st3r123";
        $db="test";
        $connection = mysqli_connect($host, $username, $password, $db) or die("Cannot connect to DB: " . mysqli_error());
        mysqli_query($connection, "SET CHARACTER SET UTF8") or die("Cannot set charset to UTF8 - " . mysqli_error($connection));
    }

    function login($username, $password) {
        global $connection;
        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);

        $userQuery = "SELECT * FROM anita_eksam_users WHERE username='$username' AND password=SHA1('$password')";
        $userResult = mysqli_query($connection, $userQuery) or die ("$userQuery - ". mysqli_error($connection));
        if (mysqli_num_rows($userResult) != 0) {
            $_SESSION['user'] = mysqli_fetch_assoc($userResult);
        }
}

    function isUserLoggedIn() {
        return isset($_SESSION['user']);
    }

    function toIndexPage() {
        header("Location: ?");
    }


function addComment($comment) {
    global $connection;
    $comment = mysqli_real_escape_string($connection, $comment);

    $commentInsertQuery = "insert into anita_eksam_comment(user_ID, comment) values ('".$_SESSION['user']['ID']."', '$comment')";
    $commentInsertResult = mysqli_query($connection, $commentInsertQuery) or die ("Comment adding failed: " . mysqli_error($connection));
}

function getUserComments() {
    global $connection;

    $query = "select comment from anita_eksam_comment 
    where user_id='".$_SESSION['user']['ID']."'";
    $queryResult = mysqli_query($connection, $query) or die ("Getting all comments failed: " . mysqli_error($connection));
    return mysqli_fetch_all($queryResult, MYSQLI_ASSOC);
}

function logout(){
    $_SESSION=array();
    session_destroy();
}

?>