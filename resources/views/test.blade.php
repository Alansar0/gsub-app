let convert this to tailwind  <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cool Data Plug</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }


        body {
            background: #f4f6fa;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            min-height: 100vh;
        }

        .top-section {
            width: 100%;
            height: 60vh;
            /* flexible instead of fixed */
            background: url("{{ Vite::asset('resources/images/wellcomepagebg.jpg') }}") no-repeat center center/cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            margin-top: -30%;
            border-bottom-right-radius: 12px;
            border-bottom-left-radius: 12px;
        }


        .top-section img {
            width: 160px;
            height: 160px;
            margin-top: -12%;
        }

        .top-section h2 {
            position: absolute;
            top: 30%;
            font-size: 32px;
            font-weight: bold;
            letter-spacing: 1px;
            z-index: 2;
        }

        /* Card Section */
        .card {
            background: #fff;
            width: 90%;
            margin-top: -50px;
            /* overlap effect */
            border-radius: 16px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 5px 11px rgba(0, 0, 0, 0.1);
        }

        .card h3 {
            font-size: 18px;
            margin-bottom: 8px;
            color: #111;
        }

        .card p {
            font-size: 14px;
            color: #555;
            margin-bottom: 20px;
        }

        /* Buttons */
        .btn {
            display: block;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            margin-bottom: 12px;
        }

        .btn.login {
            background: linear-gradient(90deg, #101E2B, #45494d);
            color: white;
            font-weight: bold;
        }

        .btn.register {
            background: transparent;
            border: 2px solid #aeafb0;
            color: #101E2B;
            font-weight: bold;
        }

        /* Social Icons */
        .socials {
            margin-top: 15px;
        }

        .socials p {
            font-size: 14px;
            margin-bottom: 10px;
            color: #333;
        }

        .social-icons {
            display: flex;
            justify-content: center;
            gap: 15px;
        }

        .social-icons a {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 45px;
            height: 45px;
            border-radius: 8px;
            background: #000;
            color: white;
            font-size: 20px;
            text-decoration: none;
        }

        .social-icons a.youtube {
            background: #FF0000;
        }

        .social-icons a.whatsapp {
            background: #25D366;
        }

        .social-icons a.facebook {
            background: #1877F2;
        }

        .social-icons a.tiktok {
            background: #000;
        }

    </style>
</head>

<body>

    <!-- Top Background with Logo -->
    <div class="top-section">
        <img src="{{ Vite::asset('resources/images/logo.png') }}" alt="Cool Data Plug Logo">
        <h2>Gconnect</h2>
    </div>

    <!-- Card Section -->
    <div class="card">
        <h3>Welcome to Gconnect</h3>
        <p>Discover unlimited internet access and enjoy wifii voucher-card.</p>
        <button class="btn login">Login</button>
        <button class="btn register">Register</button>

        <!-- Social Media -->
        <div class="socials">
            <p>Explore us with</p>
            <div class="social-icons">
                <a href="#" class="youtube"><i class="fab fa-youtube"></i></a>
                <a href="#" class="whatsapp"><i class="fab fa-whatsapp"></i></a>
                <a href="#" class="facebook"><i class="fab fa-facebook-f"></i></a>
                <a href="#" class="tiktok"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>
    </div>

    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>

</html>
