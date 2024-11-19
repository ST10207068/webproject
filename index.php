<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zain Eater Store</title>
    <style>
        /* General reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        /* Full-screen background styling */
        body, html {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }

        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('images/logo.jpeg') no-repeat center center;
            background-size: cover;
            filter: blur(8px);
            z-index: -1; /* Keeps the background behind the form */
        }

        .container {
            width: 100%;
            max-width: 800px;
            padding: 20px;
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
            z-index: 1;
        }

        h1 {
            color: #007bff;
            margin-bottom: 20px;
            font-size: 2rem;
        }

        /* Form styling */
        .form-container {
            display: flex;
            justify-content: space-between;
            gap: 20px;
            margin-top: 20px;
        }

        form {
            width: 48%;
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        form h2 {
            margin-bottom: 10px;
            font-size: 1.5rem;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-size: 0.9rem;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            margin-top: 10px;
            color: #666;
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

    <!-- Blurred Background Image -->
    <div class="background"></div>

    <!-- Form Container -->
    <div class="container">
        <h1>Welcome to the Zain Eater Store</h1>
        <div class="form-container">

            <!-- Registration Form -->
            <form action="register.php" method="POST">
                <h2>Register</h2>
                <div class="form-group">
                    <label for="reg_username">Username:</label>
                    <input type="text" id="reg_username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="reg_email">Email:</label>
                    <input type="email" id="reg_email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="reg_password">Password:</label>
                    <input type="password" id="reg_password" name="password" required>
                </div>
                <button type="submit">Register</button>
            </form>

            <!-- Login Form -->
            <form action="login.php" method="POST">
                <h2>Login</h2>
                <div class="form-group">
                    <label for="login_username">Username or Email:</label>
                    <input type="text" id="login_username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="login_password">Password:</label>
                    <input type="password" id="login_password" name="password" required>
                </div>
                <button type="submit">Login</button>
            </form>

        </div>
        <p class="message">Join or log in to access our exclusive kota and more!</p>

    <!-- Admin Login Form -->
<form action="adminverify.php" method="POST">
    <h2>Admin Login</h2>
    <div class="form-group">
        <label for="admin_email">Admin Email:</label>
        <input type="email" id="admin_email" name="email" required>
    </div>
    <div class="form-group">
        <label for="admin_password">Password:</label>
        <input type="password" id="admin_password" name="password" required>
    </div>
    <button type="submit">Admin Login</button>
</form>
</div>

</body>
</html>