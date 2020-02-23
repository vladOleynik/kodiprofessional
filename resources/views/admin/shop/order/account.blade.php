
<div class="form-group form-element-text ">
    <label>Phone</label>
    <div>{{$order->user->phone ?? 'empty'}}</div>
    <label>Email</label>
    <div>{{$order->user->email ?? 'empty'}}</div>
    <label>Note</label>
    <div>{{$order->data->note ?? 'empty'}}</div>

</div>
