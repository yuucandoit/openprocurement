<table>
    <thead>
        <tr>
            <td style="background-color:#eaba2b;" colspan="6">{{ $prepr->project->name }}</td>
        </tr>
        <tr>
            <th style="background-color:#ea772b;"><strong>Part Name</strong></th>
            <th style="background-color:#ea772b;"><strong>QTY</strong></th>
            <th style="background-color:#ea772b;"><strong>Buffer</strong></th>
            <th style="background-color:#ea772b;"><strong>Total</strong></th>
            <th style="background-color:#ea772b;"><strong>Desc</strong></th>
            <th style="background-color:#ea772b;"><strong>Link</strong></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($item as $i)
                <tr>
                    <td style="border: 1px solid black">{{ $i->child_item ?? '' }}</td>
                    <td style="border: 1px solid black">{{ $i->qty ?? '' }}</td>
                    <td style="border: 1px solid black">{{ $i->buffer ?? '' }}</td>
                    <td style="border: 1px solid black">{{ $i->total ?? '' }}</td>
                    <td style="border: 1px solid black">{{ $i->desc ?? ''}}</td>
                    <td style="border: 1px solid black">{{ $i->link  ?? ''}}</td>
                </tr>
        @endforeach
    </tbody>
</table>
