<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Your Kota</title>
    <style>
        /* General reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Page styling */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: url('food-background.jpg') no-repeat center center fixed;
            background-size: cover;
            color: #333;
        }

        .container {
            text-align: center;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            width: 90%;
            max-width: 500px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            animation: fadeIn 0.5s ease;
        }

        h1 {
            font-size: 2rem;
            color: #ff6347;
            margin-bottom: 20px;
        }

        p {
            font-size: 1rem;
            color: #666;
            margin-bottom: 20px;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            align-items: center;
        }

        label {
            font-size: 1rem;
            color: #555;
        }

        input[type="text"],
        input[type="number"],
        input[type="file"] {
            padding: 12px;
            width: 100%;
            max-width: 350px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            text-align: center;
            transition: background 0.3s ease;
        }

        input[type="file"] {
            cursor: pointer;
        }

        input:focus {
            background: #ffefe6;
            outline: none;
        }

        /* Button styling */
        .button {
            padding: 12px;
            background: #ff6347;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.3s ease;
        }

        .button:hover {
            background: #ff4500;
            transform: scale(1.05);
        }

        /* Success overlay styling */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
            display: none;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            font-size: 1.5rem;
            text-align: center;
            animation: fadeIn 0.5s ease;
        }

        .overlay.show {
            display: flex;
        }

        .overlay .message {
            background: #333;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            max-width: 80%;
        }

        .ok-button {
            padding: 10px 20px;
            background: #ff6347;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 1.2rem;
            cursor: pointer;
            transition: transform 0.3s ease, background 0.3s ease;
        }

        .ok-button:hover {
            background: #ff4500;
            transform: scale(1.05);
        }

        /* Fade-in animation */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Create Your Kota</h1>
    <p>Fill in the details below to add your delicious Kota creation to the store!</p>

    <form action="" method="POST" enctype="multipart/form-data" class="form-container">
        <label for="price">Price</label>
        <input type="number" id="price" name="price" placeholder="Enter price (in R)" required>

        <label for="location">Location</label>
        <input type="text" id="location" name="location" placeholder="Enter your location" required>

        <label for="number">Contact Number</label>
        <input type="number" id="number" name="number" placeholder="Enter your contact number" required>

        <label for="picture">Upload Kota Picture</label>
        <input type="file" id="picture" name="picture" accept="image/*">

        <button type="submit" class="button" name="request">Request</button>
    </form>
</div>

<!-- Success overlay -->
<div class="overlay" id="overlay">
    <div class="message">Your Kota will be confirmed soon by the admin</div>
    <button class="ok-button" onclick="closeOverlay()">OK</button>
</div>

<?php
// Include database connection
include 'DbConnect.php';

if (isset($_POST['request'])) {
    // Get form values (excluding the picture)
    $price = $_POST['price'];
    $location = $_POST['location'];
    $number = $_POST['number'];

    // Insert data into the items table
    $sql = "INSERT INTO items (price, location, number) VALUES ('$price', '$location', '$number')";
    if ($conn->query($sql) === TRUE) {
        echo "<script>document.getElementById('overlay').classList.add('show');</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<script>
    // Function to close the overlay
    function closeOverlay() {
        document.getElementById('overlay').classList.remove('show');
    }
</script>

</body>
</html>