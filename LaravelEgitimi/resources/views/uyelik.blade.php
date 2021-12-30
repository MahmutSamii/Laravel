<!DOCTYPE html>
<html lang="tr" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Üyelik Formu</title>
  </head>
  <body>
    @if($errors->any())
    <ul>
       @foreach($errors->all() as $hatalar)
       <li>{{$hatalar}}</li>
       @endforeach
    </ul>
    @endif
    <form action="{{ route('uyekayit') }}" method="post">
      @csrf
      <label>Ad Soyad</label><br>
      <input type="text" name="adsoyad"><br>
      <label>e-mail</label><br>
      <input type="text" name="mail"><br>
      <label>telefon</label><br>
      <input type="text" name="telefon"><br>
      <input type="submit" name="ilet" value="Gönder">
    </form>
  </body>
</html>
