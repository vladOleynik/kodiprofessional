<div class="form-group form-element-text ">

    <label>Country</label>
    <div>{{$order->data->country ?? 'empty'}}</div>
    <label>City</label>
    <div>{{$order->data->city ?? 'empty'}}</div>
    <label>State</label>
    <div>{{$order->data->state?? 'empty'}}</div>
    <label>Zip</label>
    <div>{{$order->data->zip?? 'empty'}}</div>
    <label>Apartment</label>
    <div>{{$order->data->apartment ?? 'empty'}}</div>
    <label>Address</label>
    <div>{{$order->data->address ?? 'empty'}}</div>

</div>
