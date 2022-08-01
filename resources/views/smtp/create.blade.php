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
            <label for="mailer-id">Server</label>
            <input type="text" name="mailer-id" class="mailer-id" id="mailer-id">
        </div>
        <div>
            <label for="mailer-id">Email</label>
            <input type="text" name="mailer-id" class="mailer-id" id="mailer-id">
        </div>
        <div>
            <label for="mailer-id">Password</label>
            <input type="text" name="mailer-id" class="mailer-id" id="mailer-id">
        </div>
        <div>
            <label for="mailer-id">Port</label>
            <input type="text" name="mailer-id" class="mailer-id" id="mailer-id">
        </div>
        <div>
            <label for="mailer-id">Encryption Mode</label>
            <select name="transport-type" class="transport-type" id="transport-type">
                <option value="">--Select--</option>
                <option value="smtp">SMTP</option>
                <option value="gmail">Gmail</option>                
                <option value="yahoo">Yahoo</option>
            </select>
        </div>
        <div>
            <label for="mailer-id">Authentication Mode</label>
            <select name="transport-type" class="transport-type" id="transport-type">
                <option value="">--Select--</option>
                <option value="smtp">SMTP</option>
                <option value="gmail">Gmail</option>                
                <option value="yahoo">Yahoo</option>
            </select>
        </div>
        <div>
            <label for="mailer-id">Sender Address</label>
            <input type="text" name="mailer-id" class="mailer-id" id="mailer-id">
        </div>
        <div>
            <label for="mailer-id">Delivery Address</label>
            <input type="text" name="mailer-id" class="mailer-id" id="mailer-id">
        </div>
    </form>
</body>
</html>