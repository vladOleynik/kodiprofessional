<table>
    <thead>
    <tr>
        <th>Email</th>
        <th>Phone</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Country</th>
        <th>Zip</th>
    </tr>
    </thead>
    <tbody>
    @foreach($users as $user)
        @if(isset($user->shopOrder))
        <tr>
            <td>{{ $user->email }}</td>
            <td>{{ $user->phone }}</td>
            <td>{{$user->shopOrder->data->firstName ?? '-' }}</td>
            <td>{{$user->shopOrder->data->lastName ?? '-'}}</td>
            <td>{{$user->shopOrder->data->country ?? '-'}}</td>
            <td>{{$user->shopOrder->data->zip ?? '-'}}</td>
        </tr>
        @endif
    @endforeach
    </tbody>
</table>
