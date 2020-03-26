<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>
        <link href="{{asset('css/app.css')}}" type="text/css" rel="stylesheet">
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
          <div id="app">
              <v-app>
              <user></user>
              </v-app>
          </div>
    </body>
    <script src="{{asset('js/app.js')}}"></script>

</html>
