<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('smtp.store')}}" method="POST">
        @csrf
        <div>
            <label for="mailer-id">Mailer ID</label>
            <input type="text" name="mailer-id" class="mailer-id" id="mailer-id">
        </div>
        <div>
            <label for="transport-type">Transport Type</label>
            <select name="transport-type" class="transport-type" id="transport-type">
                <option value="">--Select--</option>
                <option value="smtp">SMTP</option>
                <option value="gmail">Gmail</option>                
                <option value="yahoo">Yahoo</option>
            </select>
        </div>
        <hr>
        <div>
            <label for="server">Server</label>
            <input type="text" name="server" class="server" id="server">
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" class="email" id="email">
        </div>
        <div>
            <label for="password">Password</label>
            <input type="text" name="password" class="password" id="password">
        </div>
        <div>
            <label for="port">Port</label>
            <input type="text" name="port" class="port" id="port">
        </div>
        <div>
            <label for="encryption-mode">Encryption Mode</label>
            <select name="encryption-mode" class="encryption-mode" id="encryption-mode">
                <option value="">--Select--</option>
                <option value="smtp">SMTP</option>
                <option value="gmail">Gmail</option>                
                <option value="yahoo">Yahoo</option>
            </select>
        </div>
        <div>
            <label for="authentication-mode">Authentication Mode</label>
            <select name="authentication-mode" class="authentication-mode" id="authentication-mode">
                <option value="">--Select--</option>
                <option value="smtp">SMTP</option>
                <option value="gmail">Gmail</option>                
                <option value="yahoo">Yahoo</option>
            </select>
        </div>
        <div>
            <label for="sender-address">Sender Address</label>
            <input type="text" name="sender-address" class="sender-address" id="sender-address">
        </div>
        <div>
            <label for="delivery-address">Delivery Address</label>
            <input type="text" name="delivery-address" class="delivery-address" id="delivery-address">
        </div>
    </form>
</body>
</html>