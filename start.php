<?php if(!isUserLoggedIn()):
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        login($_POST['username'], $_POST['password']);
        toIndexPage();
        return;
    }
    ?>
        <form method="post" action="?page=start">
            <table>
                <tr>
                    <td>Username</td>
                    <td><input type="text" name="username"/> </td>
                </tr>
                <tr>
                    <td>Password</td>
                    <td><input type="password" name="password"/> </td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" value="Login"/> </td>
                </tr>
            </table>
        </form>
    <?php else:?>
        <p><a href="?page=logout">Logout</a></p>
        <table border="0">
            <tr>
                <th>Comments</th>
            </tr>
    <?php
        foreach (getUserComments() as $comment) {
            echo "<tr>";
            echo "<td>".htmlspecialchars($comment['comment'])."</td>";
            echo "</tr>";
        }
    echo "</table>";
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            addComment($_POST['comment']);
            toIndexPage();
            return;
        }

    ?>
    <div id="form">
    <form method="post" action="?page=start">
        <table>
            <tr>
                <td>Comment</td>
                <td><textarea name="comment"><?php if(!empty($_POST["comment"])) echo htmlspecialchars($_POST["comment"]); ?></textarea></td>
             </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Add"/> </td>
            </tr>
        </table>
    </form>


<?php endif; ?>
