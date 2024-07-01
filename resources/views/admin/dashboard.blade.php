<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
  <style>
 
  </style>
  @vite('resources/css/app.css')
</head>

<body class="bg-white w-screen h-screen p-0 m-0 overflow-x-hidden">
  <x-admin.side-bar/>
  @stack('scripts')
</body>

</html>