<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div id="messages"></div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.socket.io/4.7.5/socket.io.min.js"
        integrity="sha384-2huaZvOR9iDzHqslqwpR87isEmrfxqyWOF7hr7BY6KG0+hVKLoEXMPUJw3ynWuhO" crossorigin="anonymous">
    </script>
    <script>
        $(function () {
            let ip_address = 'https://socket.io.test.hello-ivy.id';
            let socket_port = '1234';

            let socket = io(ip_address + ':' + socket_port);

            socket.on('receive-data', function (data) {

                $.each(data['data'], function (indexInArray, valueOfElement) {
                    $('#messages').append('<p>' + valueOfElement + '</p>');
                });
                // return console.log(data['message']);
                // Display the received data in the messages div

            });
        });
    </script>
</body>

</html>
