@php($sum = 0)
@foreach($order->details as $detail)
@php($sum+=($detail->qty*$detail->price))
@endforeach
<div class="form-group form-element-text ">
    <label>Order Date</label>
    <div>{{$order->created_at}}</div>
    <label>Client Name</label>
    <div>{{$order->user->name}}</div>
    <label>Order amount</label>
    <div>{{$sum}}</div>

</div>
