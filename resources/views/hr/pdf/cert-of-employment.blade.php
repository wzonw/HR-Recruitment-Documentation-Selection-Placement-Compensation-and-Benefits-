<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>Certificate of Employment</title>
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <style>
            .font-inter {font-family: Inter, sans-serif;}.font-semibold{font-weight: 600px;}
            .text-red-500 {color: rgb(239 68 68);}.text-center {text-align: center;}.uppercase {text-transform: uppercase;}
            .flex {display: flex;}.justify-center {justify-content: center;}
            p {padding-left: 3%;padding-right: 3%;text-align: justify;}
            p.a {text-indent: 50px;}.absolute {position: absolute;}.tracking-wide {letter-spacing: 0.025em;}
        </style>
    </head>
    <body>
        <img style="width:15%;height: 10%;" class="absolute" src="https://plm.edu.ph/images/Seal/PLM_Seal_BOR-approved_2014.png" alt="">
        <br>
        <h2 class="text-center uppercase tracking-wide">Certificate of Employment</h2>
        <br>
        <p class="a">
            This is to certify that Mr/Ms <span><b><u>{{$data->name}}</u></b></span> is employed as 
            <b>{{$job->job_name}}</b> in Pamantasan ng Lungsod ng Maynila since 
            {{date('F j, Y',strtotime($data->created_at))}}.
        </p>
        <p>
            This certification is being issued upon the request of the aforementioned employee for any lawful purpose
            it may serve him best.
        </p>
        <p>
            Given this <b>{{$day}}</b> of <b>{{date('F Y', strtotime(NOW()))}}</b> at
            PLM, Intramuros, Manila.
        </p>
        <br>

        <div style="text-align:center;width:31%;">
            <p></p>
            <b>Herminia D. Nuñez</b>
            <hr>
            Human Resources Department <br>
            Head
        </div>
    </body>
</html>