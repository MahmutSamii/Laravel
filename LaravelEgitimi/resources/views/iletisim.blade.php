<!DOCTYPE html>
<html lang="tr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>İletişim Formu</title>
  </head>
  <body>
    <form action="{{ route('iletisim-sonuc') }}" method="post">
      @csrf
      <label>Ad Soyad</label><br>
      <input type="text" name="adsoyad"><br>
      <label>e-mail</label><br>
      <input type="text" name="mail"><br>
      <label>telefon</label><br>
      <input type="text" name="telefon"><br>
      <label>Mesaj</label><br>
      <textarea name="metin" style="width:300px; height:200px;"></textarea>
      <input type="submit" name="ilet" value="Gönder">
    </form>
  </body>
</html>
