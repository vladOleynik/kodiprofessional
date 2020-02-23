<form action="{{route('store')}}" method="post" enctype="multipart/form-data">
    @csrf()
    <input type="file" name="excel">
    <input type="submit" name="submit" value="Send">
</form>