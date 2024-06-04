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
        <h2>Dear {{$applicant->first_name}} {{$applicant->last_name}},</h2>
        <p> Congratulations! We would like to inform you that you passed the pre-screening for applicants. 
            <span>However, you have incomplete requirements.</span>
        </p>
        <p>Please upload the following as soon as possible thru 
        <a href="http://127.0.0.1:8000/application/verify"> our website</a>:
        <br> 1. Letter of Application (indicate the position title, item#, place of assignment, 
        and certify that all attached documents are true and correct);
        <br> 2. Accomplished Personal Data Sheet (form may be downloaded here: 
            <span><a href="https://bit.ly/GetPDSForm">https://bit.ly/GetPDSForm</a></span>)
        <br> 3. Fully accomplished Work Experience Sheet (WES) with signature (if applicable); which can be downloaded at
            <span><a href="https://www.csc.gov.ph/">https://www.csc.gov.ph/</a></span>
        <br> 4. Photocopy of school credentials (Diploma and Transcript of Records); for position requiring 
        Graduate Studies, Diploma;
        <br> 5. Photocopy of relevant trainings seminars/certificates
        <br> 6. Photocopy of previous and current employment certificate with duties and responsibilities (if applicable)
        <br> 7. Photocopy of PRC License and Board Rating (if applicable)
        <br> 8. Other supporting documents
        </p>
        <p>Thank you for applying and we wish you the best of luck.</p>
        <br>
        <br>
        <p> Regards, <br>
            Recruitment Team</p>

        <img src="https://www.plm.edu.ph/images/ui/plm-logo--with-header.png" alt="plm-logo" width="350" height="75">
    </div>
</body>
</html>