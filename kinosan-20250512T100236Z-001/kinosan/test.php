<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    header('Content-Type: text/plain');
    echo "POST data received:\n";
    print_r($_POST);
} else {
    echo '<form method="POST" action="">
        <label for="test">Test:</label>
        <input type="text" id="test" name="test" required>
        <br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button type="submit">Submit</button>
    </form>';
}
?>
