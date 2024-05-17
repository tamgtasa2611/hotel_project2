<h1 style="color: #3b71ca; text-align: center">Skyrim Hotel</h1>
<p style="text-align: center">Rooms data - {{ date('Y:m:d H:i:s') }}</p>
<p style="text-align: center; color: #3b71ca">Made by NguyenDucTam</p>
<table style=": 1px solid #ccc;
    -collapse: collapse;
    -spacing: 1px;
    text-align: center;
    width: 100%">
    <thead style="background-color: #d8e3f4">
    <tr>
        <th style="width: 40px">ID</th>
        <th style="-left: 1px solid #ccc">Name</th>
        <th style="-left: 1px solid #ccc">Capacity</th>
        <th style="-left: 1px solid #ccc">Room Type ID</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($rooms as $room)
        <tr style=": 1px solid #ccc">
            <td>
                {{ $room->id }}
            </td>
            <td style="-left: 1px solid #ccc">
                {{ $room->name }}
            </td>
            <td style="-left: 1px solid #ccc; padding: 10px">
                {{ $room->capacity }}
            </td>
            <td style="-left: 1px solid #ccc; padding: 10px">
                {{ $room->room_type_id }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
