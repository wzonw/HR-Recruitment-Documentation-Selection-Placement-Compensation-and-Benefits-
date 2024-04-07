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
        .font-semibold{
            font-weight: 600px;
        }
    </style>
</head>
<body>
    <div class="font-inter text-sm">
        <h1>Dear {{$applicant}},</h1>
        <p> We are pleased to offer you the position <span class="font-semibold">{{ $job->job_name }}</span> 
            in {{$job->college}}. 
        </p>
        <p> To finalize your application, we can now proceed to signing of required documents. If it fits your schedule, 
            please go to the University Human Resources Department and look for the recruitment head. Also, feel free
            to reach out for any concern.
        </p>
        <p>Looking forward to hearing back from you.</p>
        <br>
        <br>
        <p> Regards, <br>
            Recruitment Team</p>

        <img src="https://www.plm.edu.ph/images/ui/plm-logo--with-header.png" alt="plm-logo" width="350" height="75">
    </div>
</body>
</html>