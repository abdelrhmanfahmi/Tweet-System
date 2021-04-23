<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  </head>
  <body>
    <table class="table table-bordered">
    <thead>
      <tr class="table-danger">
        <td>Name</td>
        <td>Email</td>
        <td>Date_Of_Birth</td>
        <td>Tweet_Number</td>
      </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->date_of_birth}}</td>
          <td>{{$user->tweet_number}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="text-center">
      <p>Average Tweets Per User : <span class="text-danger">{{$average}}</span></p>
    </div>
  </body>
</html>