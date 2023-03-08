<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <style>
        .card {
            padding: 20px
        }

        .table {
            width: 100%;
            border: 1px solid #f1f1f1;
            border-spacing: none;
        }

        .logo-wrapper {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="logo-wrapper">
            <img src="{{ asset('assets/images/logo.png') }}" alt="logo" width="100px" />
            <h3 class="text-warning">Code<span class="text-danger">Lab</span>265</h3>
            <p class="my-4">
                Payroll for <strong>June, 12 2023</strong> to <strong>july, 20 2023</strong>
            </p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Employee</th>
                    <th>Hours</th>
                    <th>Hourly Rate</th>
                    <th>Gross</th>
                    <th>DeductionS</th>
                    <th>Tax</th>
                    <th>Net Pay</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $key => $user)
                    @php
                        $hourly_rate = $user->employee_detail->hour_rate;
                        $number_of_hours = $user->attendance->sum('number_of_hours');
                        $gross = $hourly_rate * $number_of_hours;
                        $deduction = $user->employee_deduction->sum('deduction.value');
                        $tax = ($user->employee_tax->sum('tax.value') / 100) * $gross;
                        $deductions = $deduction + $tax;
                        $net_pay = $gross - $deductions;
                    @endphp
                    <tr>
                        <td scope="row">{{ $key + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $number_of_hours }}</td>
                        <td>{{ number_format($hourly_rate, 2) }}</td>
                        <td>{{ number_format($gross, 2) }}</td>
                        <td>{{ number_format($deduction, 2) }}</td>
                        <td>{{ number_format($tax, 2) }}</td>
                        <td>{{ number_format($net_pay, 2) }}</td>
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
</body>

</html>
