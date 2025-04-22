<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Manrope:wght@200..800&display=swap"
        rel="stylesheet">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body style=" font-family: 'Manrope', sans-serif; font-optical-sizing: auto; font-style: normal;">
    <div style="text-align: center;">
        <h1 style="font-weight: 800; font-size: 40px; line-height: 10px; color: #003259; margin-top: 121px;">
            <x-site-name></x-site-name>
        </h1>
        <h2 style="font-weight: 700; font-size: 36px; line-height: 10px; margin-top: 96px;">Hi {{$admin}}</h2>
        <p
            style="font-size: 20px; line-height: 31px; font-weight: 400; text-align: center; color: #101F35; max-width: 413px; margin: 40px auto;">
            Use this code to sign up to transmit security. This button will expire in 10 minutes.</p>
        <span style="    
        max-width: 313px;
        width: 100%;
        margin: 0 auto;
        text-align: center;
        color: #FF1F00;
        font-size: 42px;
        font-weight: 700px;
        line-height: 42px;
        margin-top: 82px; ">
            <span style="display: block; letter-spacing: 0.5em; font-weight: bold;">{{$otp}}</span>

        </span>
        <p
            style="font-size: 20px; line-height: 31px; font-weight: 400; text-align: center; color: #101F35; margin-top: 82px;">
            This code will securely sign you up using</p>
        <p style="
        color: #6A7E9B;
        text-align: center;
        font-family: Manrope;
        font-size: 15px;
        font-style: normal;
        font-weight: 400;
        line-height: 31px; ">If you didn't request this e-mail, you can safely ignore it </p>
    </div>
</body>

</html>