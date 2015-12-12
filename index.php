<html>
    <head>
        <title>PHP Test</title>
        <script src="/js/jquery-2.1.4.min.js"></script>
    </head>
    <body>
        <form action="action.php" method="post">
            <div name="classes">
                <p> Select classes and class numbers, then click "COMPILE" to generate 
                    schedules.</p>
                <p>First Class: <t/>
                <select id="className1" name="className1">
                    <option value="Select Class" selected>Select Class</option>
                    <option value="ACCT">ACCT</option>
                    <option value="AFST">AFST</option>
                </select>
                <input type="text" name="classNum1"><br/>
                </p>
                <input type="submit" value="Compile Schedules">
                
                <script src="/js/classes.js" type="text/javascript"></script>
            </div>
        </form>
    </body>
</html>