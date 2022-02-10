<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@600&display=swap" rel="stylesheet">
    <title>Excel Upload</title>
  </head>
  <style>
    * {
      font-family: "Cairo", sans-serif;
    }
    .center {
      margin: auto;
      margin-top: 150px;
      width: 50%;
      padding: 10px;
    }
    h4{
        text-align: center;
        font-size: 60px;
    }
  </style>
  <body>
    <h4 class="center">Upload Your Excel File</h4>
    <form action="{{route('Excel')}}" method="POST" enctype="multipart/form-data" class="center">
        @csrf
        <input class="form-control" id="input" type="file" name="excel" accept=".xls,.xlsx"/>
      <button class="btn btn-success" style="margin-top: 20px; margin-left: 45%" type="submit" id="button">Download</button>

    </form>
  </body>
</html>
