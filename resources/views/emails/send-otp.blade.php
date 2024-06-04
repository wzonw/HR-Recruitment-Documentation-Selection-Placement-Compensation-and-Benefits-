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
        .text-lg {
            font-size: 1.125rem/* 18px */;
            line-height: 1.75rem/* 28px */;
        }
        .text-base {
            font-size: 1rem/* 16px */;
            line-height: 1.5rem/* 24px */;
        }
        .font-inter {
            font-family: Inter, sans-serif;
        }
    </style>
</head>
<body>
    <div>
        <div class="font-inter text-sm">
            <p class="text-lg">Dear {{$applicant->first_name}} {{$applicant->last_name}},</p>
            <p>This is your otp: <b class="text-base">{{$otp}}</b></p>
            <p>Please be informed that <b>otp will expire once input incorrectly</b>.</p>
            <p>Regards,<br>Recruitment Team</p>
            <img src="https://www.plm.edu.ph/images/ui/plm-logo--with-header.png" alt="plm-logo" width="350" height="75">
        </div>

    </div>
</body>
</html>