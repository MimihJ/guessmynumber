<?php

    /*******w******** 
        
        Name: Hyeryung Jin
        Date: 30 May 2024
        Description:

    ****************/
    
    session_start();
    
    define("RANDOM_NUMBER_MAXIMUM", 100);
    define("RANDOM_NUMBER_MINIMUM", 1);
    
    $user_submitted_a_guess = isset($_POST['guess']);
    $user_requested_a_reset = isset($_POST['reset']);
    
    // Implement the guessing game logic here.
    // Initialize or retrieve the random number and guess count from the session
if (!isset($_SESSION['randomNumber']) || $user_requested_a_reset) {
    // Generate a new random number when starting the game or resetting
    $_SESSION['randomNumber'] = rand(RANDOM_NUMBER_MINIMUM, RANDOM_NUMBER_MAXIMUM);
    $_SESSION['guessCount'] = 0;
}

// Check if the user submitted a guess
if ($user_submitted_a_guess) {
    $user_guess = intval($_POST['user_guess']);
    
    // Increment the guess count
    $_SESSION['guessCount']++;

    // Check if the user guessed correctly
    if ($user_guess == $_SESSION['randomNumber']) {
        $result_message = "Congratulations! You guessed it in {$_SESSION['guessCount']} guesses.";
        // Reset the random number on correct guess
        unset($_SESSION['randomNumber']);
    } elseif ($user_guess < $_SESSION['randomNumber']) {
        $result_message = 'Too low! Try again.';
    } else {
        $result_message = 'Too high! Try again.';
    }
}
    
?>
<!DOCTYPE html>
<html>
<head>
    <title>Number Guessing Game</title>
</head>
<body>
    <h1>Guessing Game</h1>

    <?php if (isset($result_message)) : ?>
        <p><?php echo $result_message; ?></p>
    <?php endif; ?>
    
    <form method="post">
        <label for="user_guess">Your Guess</label>
        <input id="user_guess" name="user_guess" autofocus>
        <input type="submit" name="guess" value="Guess">
        <input type="submit" name="reset" value="Reset">
    </form>
</body>
</html>