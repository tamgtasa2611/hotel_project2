<h1 style="color: #3b71ca; text-align: center">Skyrim Hotel</h1>
<p style="text-align: center">Room types data - {{ date('Y:m:d H:i:s') }}</p>
<p style="text-align: center; color: #3b71ca">Made by NguyenDucTam</p>
<table style=": 1px solid #ccc;
    -collapse: collapse;
    -spacing: 1px;
    text-align: center;
    width: 100%">
    <thead style="background-color: #d8e3f4">
    <tr>
        <th style="width: 40px">ID</th>
        <th style="-left: 1px solid #ccc">Type name</th>
        <th style="-left: 1px solid #ccc">Description</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($roomTypes as $roomType)
        <tr style=": 1px solid #ccc">
            <td>
                {{ $roomType->id }}
            </td>
            <td style="-left: 1px solid #ccc">
                {{ $roomType->name }}
            </td>
            <td style="text-align: left; -left: 1px solid #ccc; padding: 10px">
                {{ $roomType->description }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
