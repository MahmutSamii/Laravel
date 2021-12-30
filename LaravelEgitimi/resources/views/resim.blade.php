<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form action="{{route('yukle')}}" method="post" enctype="multipart/form-data">
      @csrf
      Resim Seç : <input type="file" name="resim">
      <input type="submit" name="ilet" value="Gönder">
    </form>
  </body>
</html>
