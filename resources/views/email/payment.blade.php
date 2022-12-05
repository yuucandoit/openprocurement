<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Approval Payment Request</title>
</head>

<body>
    <h3>Approval Email</h3>
    @php
        use Carbon\Carbon;
        $now = Carbon::now();
        $date = Carbon::parse($now)->format('d/m/Y');
    @endphp
    @foreach ($pengajuan as $p)
        <p>Dear,<br><br>

            Mr/Mrs {{ $p->atasanpymnt->name }}<br><br>

            There is an application for Purchase Request for your employee.<br>

            Name : {{ $p->whosubmit->name }}<br>
            Position :{{ $p->dps->name }}<br>
            Description :{{ $p->desc }}<br>
            Unit :{{ $item->qty }}<br>
            Project :{{ $p->purpose->name }}<br> <br>

            Please give approval as soon as possible to the Application for Purchase Request so that it can be followed
            up to the next process. <br><br>

            To see the results of the submission, you can check the Fund Approval
            menu on the link
            <a href="{{ url('menu-taskList-atasan-payment/detail/' . $p->id) }}"
                style="background-color: #4287f5; /* Green */
                border: none;
                color: white;
                padding: 10px;
                text-align: center;
                text-decoration: none;
                display: inline-block;
                font-size: 14px;
                margin: 4px 2px;
                cursor: pointer;
                border-radius: 12px;">Login</a> <br><br>

            This is an automatically generated email, please do not reply. <br><br>

            Jakarta,{{ $date }}</p>
    @endforeach

</body>

</html>
