<!DOCTYPE html>
<html>
<head>
    <title>ActivePC</title>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: flex-start; 
            width: 100%; 
            padding: 20px; 
        }
        .header a {
            display: inline-flex;
            align-items: center;
            text-decoration: none; 
        }
        .header img {
            height: 50px;
            margin-right: 20px;
            cursor: pointer; 
        }
        h1 {
            margin: 0;
            color: #343a40;
        }
        .content {
            text-align: center;
            margin-top: 20px;
        }
        .content p {
            font-size: 18px;
            color: #343a40;
        }
        .return-button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px; 
            text-decoration: none; 
        }
        .return-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

    <div class="header">
        <a href="index.php">
            <img src="images/logo.png" alt="ActivePC"> 
            <h1>ActivePC</h1>
        </a>
    </div>

    <div class="content">
        <h2>Thank you for buying!</h2>
        <a href="index.php" class="return-button">Buy More</a>
    </div>

</body>
</html>
