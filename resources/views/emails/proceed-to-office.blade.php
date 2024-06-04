<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        .Img {
            height:75px;
            width:350px;
        }
        .text-sm {
            font-size: 0.875rem/* 14px */;
            line-height: 1.25rem/* 20px */;
        }
        .font-inter {
            font-family: Inter, sans-serif;
        }
    </style>
</head>
<body>
    <div>
        <div class="font-inter text-sm">
            <h1>Dear {{$applicant->first_name}} {{$applicant->last_name}},</h1>
            <p>Congratulations! We are pleased to tell you that your application and credentials have been passed to the hiring office.</p>
            <p>Please, wait for the hiring office to contact you for your application status and futher instructions.</p>
            <p>Here is your login credentials to <a href="http://127.0.0.1:8000/login">our website</a>, <br>
            Email: {{$applicant->email}}<br>
            Password: {{$password}}
            </p>
            <p>Thank you for applying and we wish you the best of luck.</p>
            <p>Regards,<br>Recruitment Team</p>
            
            <img src="https://www.plm.edu.ph/images/ui/plm-logo--with-header.png" alt="plm-logo" width="350" height="75">
        </div>

    </div>
</body>
</html>