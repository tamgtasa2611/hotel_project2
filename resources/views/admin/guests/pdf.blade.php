<h1 style="color: #3b71ca; text-align: center">Skyrim Hotel</h1>
<p style="text-align: center">Guests data - {{ date('Y:m:d H:i:s') }}</p>
<p style="text-align: center; color: #3b71ca">Made by NguyenDucTam</p>
<table style=": 1px solid #ccc;
    -collapse: collapse;
    -spacing: 1px;
    text-align: center;
    width: 100%">
    <thead style="background-color: #d8e3f4">
    <tr>
        <th style="width: 40px;">ID</th>
        <th style=" -left: 1px solid #ccc">First name</th>
        <th style=" -left: 1px solid #ccc">Last name</th>
        <th style="-left: 1px solid #ccc">Email</th>
        <th style=" -left: 1px solid #ccc">Phone number</th>
        <th style="-left: 1px solid #ccc">Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($guests as $guest)
        <tr style=": 1px solid #ccc">
            <td>
                {{ $guest->id }}
            </td>
            <td style="-left: 1px solid #ccc">
                {{ $guest->first_name }}
            </td>
            <td style="-left: 1px solid #ccc">
                {{ $guest->last_name }}
            </td>
            <td style="-left: 1px solid #ccc">
                {{ $guest->email }}
            </td>
            <td style="-left: 1px solid #ccc">
                {{ $guest->phone_number }}
            </td>
            <td style="-left: 1px solid #ccc">
                {{ $guest->status }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
