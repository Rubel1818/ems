<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="container py-5">
        <h3 class="mb-4">ইউজার ম্যানেজমেন্ট</h3>
        <table class="table table-hover shadow-sm bg-white">
            <thead class="table-dark">
                <tr>
                    <th>নাম</th>
                    <th>ইমেইল</th>
                    <th>স্ট্যাটাস</th>
                    <th>রোল পরিবর্তন</th>
                    <th>অ্যাকশন</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->is_approved)
                                <span class="badge bg-success">Approved</span>
                            @else
                                <span class="badge bg-warning text-dark">Pending</span>
                            @endif
                        </td>
                        <td>
                            <form action="{{ route('admin.users.role', $user->id) }}" method="POST">
                                @csrf
                                <select name="role" onchange="this.form.submit()" class="form-select form-select-sm">
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->name }}"
                                            {{ $user->hasRole($role->name) ? 'selected' : '' }}>
                                            {{ $role->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </td>
                        <td>
                            @if (!$user->is_approved)
                                <form action="{{ route('admin.users.approve', $user->id) }}" method="POST">
                                    @csrf
                                    <button class="btn btn-sm btn-primary">Approve</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
