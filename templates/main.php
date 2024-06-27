<!DOCTYPE html>
<html>

<head>
    <title>Hello World Page</title>
    <style>
        /* Necessary style definitions for the page */
        /* Center the content vertically and horizontally */
        myPageContent {
            width: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        /* Style the header with a background color */
        /* and some padding */
        myHeader {
            background-color: #4CAFF0;
            color: #fff;
            border-radius: 10px;
            padding: 10px;
            font-size: 36px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <myPageContent>
        <?php
        if (
            isset($_GET['getParameter']) &&
            $_GET['getParameter'] !== ''
        ) {
            // Display the message if it is specified
            echo '<myHeader>' .
                $_GET['getParameter'] .
                '</myHeader>';
            // Display a reset button
            $submitGetParameter = '';
            $buttonText = 'Reset';
        } else {
            // If no get parameters were specified, display
            // a button that when clicked, reloads the page
            // with the get parameter:
            // myMessage => "HelloWorld"
            echo '<myHeader>Press the button!</myHeader>';
            // Display a "Click me" button
            $submitGetParameter = 'HelloWorld!👋';
            $buttonText = 'Click Me';
        }
        ?>
        <!-- Display the button -->
        <form method="GET" action="">
            <button type="submit" name="getParameter" value="<?php echo $submitGetParameter; ?>">
                <?php echo $buttonText; ?>
            </button>
        </form>
    </myPageContent>
</body>

</html>
