<!DOCTYPE html>
<html lang="bn">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <style>
        /* বাংলা ফন্ট সাপোর্ট করার জন্য (যদি আপনার সার্ভারে ফন্ট সেটআপ থাকে) */
        body {
            font-family: 'nikosh', sans-serif;
            font-size: 14px;
            color: #333;
            line-height: 1.5;
        }

        .header {
            text-align: center;
            border-bottom: 2px solid #0056b3;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .gov-title {
            font-size: 20px;
            font-weight: bold;
            margin: 0;
        }

        .sub-title {
            font-size: 16px;
            margin: 5px 0;
        }

        .profile-section {
            margin-bottom: 30px;
        }

        .photo-box {
            float: right;
            width: 120px;
            height: 140px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .photo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .info-table th,
        .info-table td {
            border: 1px solid #dee2e6;
            padding: 8px;
            text-align: left;
        }

        .info-table th {
            background-color: #f8f9fa;
            width: 30%;
            color: #555;
        }

        .section-header {
            background-color: #0056b3;
            color: white;
            padding: 5px 10px;
            font-weight: bold;
            margin-top: 20px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #777;
            border-top: 1px solid #ddd;
            padding-top: 5px;
        }
    </style>
</head>

<body>

    <div class="header">
        <p class="gov-title">গণপ্রজাতন্ত্রী বাংলাদেশ সরকার</p>
        <p class="sub-title">মন্ত্রিপরিষদ বিভাগ</p>
        <p style="margin:0;">সচিবালয়, ঢাকা।</p>
        <h3 style="text-decoration: underline; margin-top: 15px;">কর্মচারীর জীবনবৃত্তান্ত</h3>
    </div>

    <div class="profile-section">
        <div class="photo-box">
            @if ($employee->photo)
                <img src="{{ public_path('storage/' . $employee->photo) }}" alt="Photo">
            @else
                <div style="padding-top: 50px; color: #ccc;">ছবি নেই</div>
            @endif
        </div>

        <div style="width: 75%;">
            <p><strong>আইডি:</strong> {{ $employee->employee_id }}</p>
            <p><strong>নাম (বাংলা):</strong> {{ $employee->name_bn }}</p>
            <p><strong>নাম (ইংরেজি):</strong> {{ $employee->name_en }}</p>
            <p><strong>পদবি:</strong> {{ optional($employee->stuffDesignation)->designation_name_bn }}</p>
        </div>
    </div>

    <div class="section-header">ব্যক্তিগত তথ্য</div>
    <table class="info-table">
        <tr>
            <th>জন্ম তারিখ</th>
            <td>{{ $employee->birth_date }}</td>
        </tr>
        <tr>
            <th>বর্তমান ঠিকানা</th>
            <td>{{ $employee->present_address_bn }}</td>
        </tr>
        <tr>
            <th>স্থায়ী ঠিকানা</th>
            <td>{{ $employee->permanent_address_bn }}</td>
        </tr>
        <tr>
            <th>জেলা</th>
            <td>{{ optional($employee->district)->district_name_bn }}</td>
        </tr>
    </table>

    <div class="section-header">চাকরি সংক্রান্ত তথ্য</div>
    <table class="info-table">
        <tr>
            <th>শাখা</th>
            <td>{{ optional($employee->section)->section_name_bn }}</td>
        </tr>
        <tr>
            <th>যোগদানের তারিখ</th>
            <td>{{ $employee->joining_date }}</td>
        </tr>
        <tr>
            <th>স্থায়ীকরণের তারিখ</th>
            <td>{{ $employee->confirmation_date }}</td>
        </tr>
        <tr>
            <th>পিআরএল (PRL) তারিখ</th>
            <td style="color: red; font-weight: bold;">{{ $employee->prl_date }}</td>
        </tr>
    </table>

    <div class="footer">
        এটি একটি সিস্টেম জেনারেটেড রিপোর্ট | ডাউনলোড সময়: {{ date('d/m/Y h:i A') }}
    </div>

</body>

</html>
