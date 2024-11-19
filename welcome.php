<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Zain Eater Store</title>
    <style>
        /* General reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Background styling */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('images/background.jpeg') center/cover no-repeat;
            color: #333;
            position: relative;
            overflow: hidden;
        }

        /* Background blur overlay */
        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: inherit;
            filter: blur(8px);
            z-index: -1;
        }

        /* Dark overlay to enhance text visibility */
        .overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        /* Container styling */
        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.85);
            padding: 30px;
            width: 90%;
            max-width: 700px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        /* Blinking greeting message */
        .greeting {
            font-size: 1.5rem;
            color: #007bff;
            margin-bottom: 20px;
            animation: blink 1s steps(2, start) infinite;
            font-weight: bold;
        }

        @keyframes blink {
            50% {
                opacity: 0;
            }
        }

        h1 {
            font-size: 2rem;
            color: #007bff;
            margin-bottom: 20px;
        }

        p {
            font-size: 1.1rem;
            color: #555;
            margin-bottom: 30px;
        }

        /* Option button styling */
        .options {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .option {
            padding: 15px;
            border-radius: 8px;
            background: #007bff;
            color: #fff;
            text-align: center;
            font-size: 1.2rem;
            font-weight: bold;
            cursor: pointer;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .option:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        /* Media query for larger screens */
        @media (min-width: 600px) {
            .options {
                flex-direction: row;
            }

            .option {
                width: 45%;
            }
        }
    </style>
</head>
<body>
    <!-- Dark overlay to enhance contrast -->
    <div class="overlay"></div>

    <div class="container">
        <!-- Animated greeting message -->
        <div class="greeting">Hi, User! This is Zain Eater Store</div>
        
        <h1>Welcome to Zain Eater Store</h1>
        <p>Choose an option to get started with Zain Eater Store:</p>

        <div class="options">
            <!-- Option 1: Browse Kotas -->
            <div class="option" onclick="location.href='browse_kotas.php'">
                Browse Kotas
            </div>

            <!-- Option 2: Create and Sell Your Own Kota -->
            <div class="option" onclick="location.href='create_kota.php'">
                Create & Sell Your Own Kota
            </div>
        </div>
    </div>
</body>
</html>