<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="{{route('yukle')}}" method="post" enctype="multipart/form-data">
      @csrf
      <label>Resim Seçiniz</label><br>
      <input type="file" name="resim" value=""><br><br><br>
      <input type="submit" name="ilet" value="Resim Yükle">
    </form>
  </body>
</html>
