<?php
/**
 * Created by PhpStorm.
 * User: pkociaj
 * Date: 22/11/2018
 * Time: 12:34
 */
?>

<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>New Message form  <strong>{{ $name }}</strong> on  Funding Joint contact Page</h2>
<br>
From: <strong>{{ $name }}</strong> <br>
Message : {{ $comments }} <br>

Address:
<pre>
    {{ $address_1 }}
    {{ $address_2 }}
</pre>

</body>
</html>