<h1 style="color: #3b71ca; text-align: center">Skyrim Hotel</h1>
<p style="text-align: center">Activities data - {{ date('Y:m:d H:i:s') }}</p>
<p style="text-align: center; color: #3b71ca">Made by NguyenDucTam</p>
<table style="border: 1px solid #ccc;
    border-collapse: collapse;
    border-spacing: 1px;
    text-align: center;
    width: 100%">
    <thead style="background-color: #d8e3f4">
    <tr>
        <th style="width: 40px">ID</th>
        <th style="border-left: 1px solid #ccc">Admin (ID)</th>
        <th style="border-left: 1px solid #ccc">Description</th>
        <th style="border-left: 1px solid #ccc">Date</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($activities as $activity)
        <tr style="border: 1px solid #ccc">
            <td>
                {{ $activity->id }}
            </td>
            <td style="border-left: 1px solid #ccc">
                {{$activity->admin->first_name . ' ' . $activity->admin->first_name . ' (' . $activity->admin->id . ')'}}
            </td>
            <td style="text-align: left; border-left: 1px solid #ccc; padding: 10px">
                {{ $activity->detail }}
            </td>
            <td style="text-align: left; border-left: 1px solid #ccc; padding: 10px">
                {{ $activity->date }}
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
