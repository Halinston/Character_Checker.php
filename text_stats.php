<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Text Statistics</title>
    <style>
        /* Reset some default styling */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Dark theme colors */
        body {
            background-color: #1e1e1e;
            color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        h1 {
            font-size: 2em;
            color: #6a6a6a;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            color: #a8a8a8;
            text-align: center;
            margin-bottom: 20px;
        }

        /* Container for the form and output */
        .container {
            background-color: #2e2e2e;
            border-radius: 8px;
            padding: 30px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        /* Textarea styling */
        textarea {
            width: 100%;
            height: 150px;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #444;
            border-radius: 4px;
            background-color: #1e1e1e;
            color: #f0f0f0;
            font-size: 1em;
            resize: vertical;
        }

        /* Button styling */
        button {
            width: 100%;
            padding: 10px;
            font-size: 1em;
            color: #fff;
            background-color: #4a90e2;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #357ab8;
        }

        /* Output styling */
        h2 {
            color: #6a6a6a;
            font-size: 1.5em;
            margin-top: 20px;
            text-align: center;
        }

        pre {
            background-color: #1e1e1e;
            color: #e0e0e0;
            padding: 15px;
            border-radius: 4px;
            border: 1px solid #444;
            white-space: pre-wrap;
            font-size: 1em;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Text Statistics Calculator</h1>
        <p>Enter your text in the box below to calculate various statistics:</p>

        <form method="post" action="">
            <textarea name="textInput"><?php echo isset($_POST['textInput']) ? htmlspecialchars($_POST['textInput']) : ''; ?></textarea>
            <button type="submit">Calculate Statistics</button>
        </form>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['textInput'])) {
            $text = $_POST['textInput'];
            
            // Define character sets
            $vowels = 'aeiouAEIOU';
            $consonants = 'bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ';
            $punctuation = '!~`^()_{}[]|\\;:"\',.?';
            $wordCharacters = '@#$%&+-=<>*/';

            // Initialize counters
            $charCount = strlen($text);
            $letterCount = 0;
            $consonantCount = 0;
            $digitCount = 0;
            $spaceCount = 0;
            $wordCharCount = 0;
            $punctuationCount = 0;
            $wordFrequency = [];

            // Calculate statistics
            for ($i = 0; $i < $charCount; $i++) {
                $char = $text[$i];

                if (ctype_alpha($char)) $letterCount++;                     // Check if it's a letter
                if (strpos($consonants, $char) !== false) $consonantCount++; // Check if it's a consonant
                if (ctype_digit($char)) $digitCount++;                       // Check if it's a digit
                if (ctype_space($char)) $spaceCount++;                       // Check if it's whitespace
                if (strpos($wordCharacters, $char) !== false) $wordCharCount++; // Check if it's a word character
                if (strpos($punctuation, $char) !== false) $punctuationCount++; // Check if it's punctuation
            }

            // Calculate word frequencies
            $words = str_word_count(strtolower($text), 1);
            foreach ($words as $word) {
                if (isset($wordFrequency[$word])) {
                    $wordFrequency[$word]++;
                } else {
                    $wordFrequency[$word] = 1;
                }
            }

            // Display the results
            echo "<h2>Statistics:</h2>";
            echo "<pre>";
            echo "Characters: $charCount\n";
            echo "Letters: $letterCount\n";
            echo "Consonants: $consonantCount\n";
            echo "Digits: $digitCount\n";
            echo "Spaces: $spaceCount\n";
            echo "Word characters: $wordCharCount\n";
            echo "Punctuation: $punctuationCount\n";
            echo "Word frequencies:\n";
            foreach ($wordFrequency as $word => $count) {
                echo "  $word: $count\n";
            }
            echo "</pre>";
        }
        ?>
    </div>
</body>
</html>
