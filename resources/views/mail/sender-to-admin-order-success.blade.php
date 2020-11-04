<h1>Пользователь с email {{$emailUser}} оформил на сайте заказ</h1>
<p>Список товаров:</p>
    @foreach($details as $detail)
    ----------------------------------<br>
        Название - {{$detail->product->title}}<br>
        Цена - {{$detail->price}}<br>
        Количество - {{$detail->qty}}<br>
    ----------------------------------<br><br>
    @endforeach
