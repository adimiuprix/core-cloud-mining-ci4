<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <div>
        <h4>Your balance</h4>
        <input type="hidden" id="getBalance" value="<?= $balance ?>" />
        <span id="balance"><?= $balance ?></span>
    </div>

    <p>User adreess: <?= $address; ?></p>

    <div>
        <button type="button" onclick="location.href='logout'">Logout</button>
    </div>

    <h2>Your Active Plan</h2>
    <table>
        <tbody>
            <tr>
                <th>Name</th>
                <th>Speed</th>
                <th>Earning Rate</th>
                <th>Start</th>
                <th>Time left</th>
                <th>Status</th>
            </tr>
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script type="text/javascript">
    //Counter
    $(document).ready(function() {
        var speed = (parseFloat(<?php echo $userEarningRate;?>)/60).toFixed(8);
        setInterval(function() {
            var oldvalue =  parseFloat($('#balance').html()).toFixed(8);
            var result = parseFloat(parseFloat(oldvalue) + parseFloat(speed)).toFixed(8);
            $("#balance").html(result);
        }, 1000);
    });
    </script>
</body>
</html>
