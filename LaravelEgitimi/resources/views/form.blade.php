<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="{{route('sonuc')}}" method="post">
      @csrf
      <textarea name="metin" style="width:200px; height:200px;"></textarea><br>
      <button type="submit" name="button">Gönder</button>
    </form>
  </body>
</html>
