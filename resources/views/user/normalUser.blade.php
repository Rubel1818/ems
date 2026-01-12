<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
        }

        .container {
            max-width: 1000px;
            margin: 40px auto;
            background: #fff;
            padding: 25px;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background: #f0f0f0;
            width: 30%;
            text-align: left;
        }

        .no-data {
            color: red;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- User Info -->
        <h1>Welcome, {{ auth()->user()->name }}</h1>
        <p><strong>Email:</strong> {{ auth()->user()->email }}</p>

        <hr>

        <h2>Employee Information</h2>

        @if ($employees->count() > 0)

            @foreach ($employees as $emp)
                <table>
                    <tr>
                        <th>Name (English)</th>
                        <td>{{ $emp->name_en }}</td>
                    </tr>

                    <tr>
                        <th>Name (Bangla)</th>
                        <td>{{ $emp->name_bn }}</td>
                    </tr>

                    <tr>
                        <th>Designation</th>
                        <td>{{ $emp->stuffDesignation->designation_name_bn ?? 'N/A' }}</td>
                    </tr>

                    <tr>
                        <th>Section</th>
                        <td>{{ $emp->section->name_bn ?? 'N/A' }}</td>
                    </tr>

                    <tr>
                        <th>Office</th>
                        <td>{{ $emp->office->name_bn ?? 'N/A' }}</td>
                    </tr>

                    <tr>
                        <th>District</th>
                        <td>{{ $emp->district->name_bn ?? 'N/A' }}</td>
                    </tr>

                    <tr>
                        <th>Division</th>
                        <td>{{ $emp->division->name_bn ?? 'N/A' }}</td>
                    </tr>

                    <tr>
                        <th>Mobile</th>
                        <td>{{ $emp->mobile }}</td>
                    </tr>

                    <tr>
                        <th>NID</th>
                        <td>{{ $emp->nid }}</td>
                    </tr>

                    <tr>
                        <th>Date of Birth</th>
                        <td>{{ $emp->dob }}</td>
                    </tr>

                    <tr>
                        <th>Status</th>
                        <td>
                            @if ($emp->status == 1)
                                <span style="color: green;">Active</span>
                            @else
                                <span style="color: red;">Inactive</span>
                            @endif
                        </td>
                    </tr>
                </table>
                <br>
            @endforeach
        @else
            <p class="no-data">No employee information found for your account.</p>
        @endif

    </div>

</body>

</html>
