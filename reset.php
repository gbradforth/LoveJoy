<?php
// Check for tokens
$selector = filter_input(INPUT_GET, 'selector');
$validator = filter_input(INPUT_GET, 'validator');

if ( false !== ctype_xdigit( $selector ) && false !== ctype_xdigit( $validator ) ) :
?>
    <form action="resetCheck.php" method="post">
        <input type="hidden" name="selector" value="<?php echo $selector; ?>">
        <input type="hidden" name="validator" value="<?php echo $validator; ?>">
        <input type="password" class="text" name="password" placeholder="Enter your new password" required>
        <input type="submit" class="submit" value="Submit">
    </form>
    <p><a href="index.php">Login here</a></p>
<?php endif; ?>
