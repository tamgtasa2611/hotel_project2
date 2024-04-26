<h1 style="color: #3b71ca; text-align: center">Skyrim Hotel</h1>
<p style="text-align: center">Employees data - {{ date('Y:m:d H:i:s') }}</p>
<p style="text-align: center; color: #3b71ca">Made by NguyenDucTam</p>
<table style="border: 1px solid #ccc;
    border-collapse: collapse;
    border-spacing: 1px;
    text-align: center;
    width: 100%">
    <thead style="background-color: #d8e3f4">
    <tr>
        <th style="width: 40px">ID</th>
        <th style=" border-left: 1px solid #ccc">Full name</th>
        <th style=" border-left: 1px solid #ccc">Email</th>
        <th style="border-left: 1px solid #ccc">Role</th>
        <th style=" border-left: 1px solid #ccc">Phone number</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($employees as $employee)
        <tr style="border: 1px solid #ccc">
            <td>
                {{ $employee->id }}
            </td>
            <td style="border-left: 1px solid #ccc">
                {{ $employee->name }}
            </td>
            <td style="border-left: 1px solid #ccc">
                {{ $employee->email }}
            </td>
            <td style="border-left: 1px solid #ccc">
                {{ $employee->role }}
            </td>
            <td style="border-left: 1px solid #ccc">
                {{ $employee->phone_number }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
