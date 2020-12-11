<! DOCTYPE html>
<html>
<body>
<form action="/upload" method="post" enctype="multipart/form-data">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload" name="submit">
</form>
</body>
</html>
