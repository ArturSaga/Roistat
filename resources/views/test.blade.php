<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Test</title>
</head>
<body>
<form action="{{route('test')}}" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="filename">
    <input type="submit" value="Отправить файл" id="submit">
</form>
</body>
</html>
