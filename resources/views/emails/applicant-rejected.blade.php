<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
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
    <div class="font-inter text-sm">
        <h1>Dear {{$applicant->first_name}} {{$applicant->last_name}},</h1>
        <p>Thank you for taking the time to apply in Pamantasan. After reviewing your application,
        we'd like to inform you that you did not passed the pre-screening of applicants. As 
        a result, we won't proceed with your application.</p>
        <p>Thank you for applying and we wish you the best of luck in your future endevours.</p>
        <p>Regards,<br>
        Recruitment Team</p>
        <img src="https://www.plm.edu.ph/images/ui/plm-logo--with-header.png" alt="plm-logo" width="350" height="75">
    </div>
</body>
</html>