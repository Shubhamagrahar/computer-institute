<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Result</title>
    <?php include 'head.php';?>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background: #f4f4f4;
            color: #333;
            min-height: 100vh;
        }

        .header {
            background: #1b3b58;
            color: white;
            text-align: center;
            padding: 20px 0;
        }

        .header h1 {
            font-size: 2rem;
            color: #ffffff !important;
        }

        nav a {
            color: #c1c1c1;
            text-decoration: none;
            margin: 0 5px;
            font-size: 0.9rem;
        }

        nav span {
            color: #ccc;
        }

        .result_container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
        }

        .result-card {
            background: white;
            width: 90%;
            max-width: 800px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            padding: 30px;
            text-align: center;
        }

        .info {
            display: flex;
            justify-content: space-between;
            /*padding-bottom: 20px;*/
            border-bottom: 1px solid #ddd;
            margin-bottom: 20px;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-bottom: 20px;
        }

        .stat {
            background: #f1f1f1;
            padding: 15px;
            border-radius: 5px;
            font-size: 1rem;
        }
        .stat p{
            margin-bottom: 0;
        }

        .result-section img {
            width: 120px;
            margin: 20px 0;
        }

        .result-section p {
            font-size: 1.2rem;
            margin: 10px 0;
        }

        .grade {
            font-size: 1.5rem;
        }

        .fail {
            color: red;
        }

        .btn-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .btn1 {
            padding: 10px 20px;
            font-size: 1rem;
            border: none;
            cursor: pointer;
            transition: 0.3s;
            border-radius: 10px;
        }

        .correct {
            background: #007bff;
            color: white;
        }

        .wrong {
            background: #dc3545;
            color: white;
        }

        .btn1:hover {
            opacity: 0.8;
        }

        @media (max-width: 768px) {
            .info {
                flex-direction: column;
                text-align: left;
            }

            .stats {
                grid-template-columns: 1fr;
            }

            .btn-group {
                flex-direction: column;
                gap: 10px;
            }
            .btn1{
               font-size: 0.8rem; 
            }
        }
        .result-section span{
            font-weight: bold;
        }
        
    </style>
</head>
<body>

<header class="header">
    <h1>Final Result</h1>
    <nav>
        <a href="#">Home</a>
        <span>/</span>
        <a href="#">Test</a>
        <span>/</span>
        <a href="#">Result</a>
    </nav>
</header>

<div class="result_container">
    <div class="result-card">
        <div class="info">
            <p><strong>Name:</strong> Test</p>
            <p><strong>Paper:</strong> Web Designing & Publishing (M2-R5)</p>
        </div>

        <div class="stats">
            <div class="stat">
                <p>❓ <strong>Total Questions:</strong> 25</p>
            </div>
            <div class="stat">
                <p>👆 <strong>Attempt:</strong> 1</p>
            </div>
            <div class="stat">
                <p>✅ <strong>Correct:</strong> 25</p>
            </div>
            <div class="stat">
                <p>❌ <strong>Incorrect:</strong> 0</p>
            </div>
            <div class="stat">
                <p>🏆 <strong>Total Score:</strong> 100%</p>
            </div>
            <div class="stat">
                <p>🕒 <strong>Time Taken:</strong> 02:13 Minute</p>
            </div>
        </div>

        <div class="result-section">
            <img src="public/assets/images/trophy.svg" alt="Trophy Icon">
            <p>You got <span style="color:#47a98e">25</span> out of <span style="color:green">25</span></p>
            <p class="grade">Grade: <span class="fail">P</span></p>
        </div>

        <div class="btn-group">
            <button class="btn1 correct">View Correct Answer(25)</button>
            <button class="btn1 wrong">View Wrong Answer(0)</button>
        </div>
    </div>
</div>

<?php include 'footer.php';?>

<script>
    // Simulating button click behavior
    const correctBtn = document.querySelector('.correct');
    const wrongBtn = document.querySelector('.wrong');

    correctBtn.addEventListener('click', () => {
        alert('You have 25 correct answe!');
    });

    wrongBtn.addEventListener('click', () => {
        alert('No wrong answer!');
    });
</script>

</body>
</html>
