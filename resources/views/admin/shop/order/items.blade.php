
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            
            <th>Превью</th>
            <th>Название</th>
            <th>Количество</th>
            <th>Цена</th>
            <th>Сумма</th>
        </tr>
    </thead>
    <tbody>
        
        @php($sum = $qty = 0)
      
        @foreach($order->details as $product)
    
        <tr>
    
            <td><img src="/{{$product->product->images[0] ?? ''}}" alt="Нет изображения" style="max-width: 100px"></td>

            <td class="title">{{$product->product->title}}</td>
            <td class="qty">{{$product->qty}}</td>
            <td class="price">{{$product->price}}</td>
            <td>
                
                @php($subtotal = $product->qty*$product->price)
                @php($sum+=$subtotal)
                @php($qty+=$product->qty)
               
                {{$subtotal}}
            </td>

        </tr>
      
        @endforeach
  
        <tr>
            <td colspan="2">Итого</td>
            <td>{{$qty}}</td>
            <td></td>
            <td>{{$sum}}</td>
        </tr>
        
      
    </tbody>
 
</table>

