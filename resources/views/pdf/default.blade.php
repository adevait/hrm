<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
  <link href="//fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="{{asset('css/pdf.css')}}"/>  
  <style>
    body { 
      font-family: DejaVu Sans; 
    }
  </style>
</head>
<body>
    <div class="container">
      <table>
        <tr>
          <td class="brand">{{ config('app.name', 'HRM') }}</td>
        </tr>
        <tr>
          <td>{!! $content !!}</td>
        </tr>
      </table>
    </div>
</body>
</html>
