<table>
    <thead>
        <tr>
            <td></td>
        </tr>
        <tr>
            <td style="border: 1px solid black"><strong>ID</strong></td>
            <td style="border: 1px solid black"><strong>Role</strong></td>
            <td style="border: 1px solid black"><strong>Guard Name</strong></td>
        </tr>
    </thead>
    <tbody>
        @foreach ($roles as $r)
        <tr>
            <td style="border: 1px solid black">{{ $r->name }}</td>
            <td style="border: 1px solid black">{{ $r->guard_name }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
