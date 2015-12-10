<html>
    <head>
        <title>Schedule Week Test</title>
        <script src="js/javascript.js"></script>
        <script src="js/jquery-1.11.3.min.js"></script>
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
    </head>
    <body>
        <br/>
        
        <form action="action.php" method="post">
            <div name="classes">
                <p> Enter up to 4 classes and class numbers you want to schedule.</p>
                <p>First Class: <t/>
                    <select name="className1">
                        <option value="Select Class" selected>Select Class</option>
                        <option value="ACCT">ACCT</option>
                        <option value="AFST">AFST</option>
                        <option value="ANTH">ANTH</option>
                        <option value="ART">ART</option>
                        <option value="ARTH">ARTH</option>
                        <option value="ARTS">ARTS</option>
                        <option value="ASIA">ASIA</option>
                        <option value="ASTR">ASTR</option>
                        <option value="ATMS">ATMS</option>
                        <option value="BIOL">BIOL</option>
                        <option value="CCS">CCS</option>
                        <option value="CHEM">CHEM</option>
                        <option value="CLAS">CLAS</option>
                        <option value="CSCI">CSCI</option>
                        <option value="DAN">DAN</option>
                        <option value="DRAM">DRAM</option>
                        <option value="E">E</option>
                        <option value="ECE">ECE</option>
                        <option value="ECON">ECON</option>
                        <option value="EDUC">EDUC</option>
                        <option value="ENG">ENG</option>
                        <option value="ENVR">ENVR</option>
                        <option value="ESI">ESI</option>
                        <option value="FREN">FREN</option>
                        <option value="GERM">GERM</option>
                        <option value="HIST">HIST</option>
                        <option value="HON">HON</option>
                        <option value="HUM">HUM</option>
                        <option value="HW">HW</option>
                        <option value="HWP">HWP</option>
                        <option value="INTS">INTS</option>
                        <option value="IST">IST</option>
                        <option value="JEM">JEM</option>
                        <option value="LA">LA</option>
                        <option value="LANG">LANG</option>
                        <option value="LIT">LIT</option>
                        <option value="MAE">MAE</option>
                        <option value="MATH">MATH</option>
                        <option value="MCOM">MCOM</option>
                        <option value="MGMT">MGMT</option>
                        <option value="MLAS">MLAS</option>
                        <option value="MSE">MSE</option>
                        <option value="MUSC">MUSC</option>
                        <option value="NM">NM</option>
                        <option value="PHIL">PHIL</option>
                        <option value="PHYS">PHYS</option>
                        <option value="POLS">POLS</option>
                        <option value="PORT">PORT</option>
                        <option value="PSYC">PSYC</option>
                        <option value="RELS">RELS</option>
                        <option value="SABR">SABR</option>
                        <option value="SOC">SOC</option>
                        <option value="SPAN">SPAN</option>
                        <option value="STAT">STAT</option>
                        <option value="UNCX">UNCX</option>
                        <option value="VMP">VMP</option>
                        <option value="WGSS">WGSS</option>
                    </select>
                    <input type="text" name="classNum1"><br/>
                </p>
                <p>Second Class: <t/>
                    <select name="className2">
                        <option value="Select Class" selected>Select Class</option>
                        <option value="ACCT">ACCT</option>
                        <option value="AFST">AFST</option>
                        <option value="ANTH">ANTH</option>
                        <option value="ART">ART</option>
                        <option value="ARTH">ARTH</option>
                        <option value="ARTS">ARTS</option>
                        <option value="ASIA">ASIA</option>
                        <option value="ASTR">ASTR</option>
                        <option value="ATMS">ATMS</option>
                        <option value="BIOL">BIOL</option>
                        <option value="CCS">CCS</option>
                        <option value="CHEM">CHEM</option>
                        <option value="CLAS">CLAS</option>
                        <option value="CSCI">CSCI</option>
                        <option value="DAN">DAN</option>
                        <option value="DRAM">DRAM</option>
                        <option value="E">E</option>
                        <option value="ECE">ECE</option>
                        <option value="ECON">ECON</option>
                        <option value="EDUC">EDUC</option>
                        <option value="ENG">ENG</option>
                        <option value="ENVR">ENVR</option>
                        <option value="ESI">ESI</option>
                        <option value="FREN">FREN</option>
                        <option value="GERM">GERM</option>
                        <option value="HIST">HIST</option>
                        <option value="HON">HON</option>
                        <option value="HUM">HUM</option>
                        <option value="HW">HW</option>
                        <option value="HWP">HWP</option>
                        <option value="INTS">INTS</option>
                        <option value="IST">IST</option>
                        <option value="JEM">JEM</option>
                        <option value="LA">LA</option>
                        <option value="LANG">LANG</option>
                        <option value="LIT">LIT</option>
                        <option value="MAE">MAE</option>
                        <option value="MATH">MATH</option>
                        <option value="MCOM">MCOM</option>
                        <option value="MGMT">MGMT</option>
                        <option value="MLAS">MLAS</option>
                        <option value="MSE">MSE</option>
                        <option value="MUSC">MUSC</option>
                        <option value="NM">NM</option>
                        <option value="PHIL">PHIL</option>
                        <option value="PHYS">PHYS</option>
                        <option value="POLS">POLS</option>
                        <option value="PORT">PORT</option>
                        <option value="PSYC">PSYC</option>
                        <option value="RELS">RELS</option>
                        <option value="SABR">SABR</option>
                        <option value="SOC">SOC</option>
                        <option value="SPAN">SPAN</option>
                        <option value="STAT">STAT</option>
                        <option value="UNCX">UNCX</option>
                        <option value="VMP">VMP</option>
                        <option value="WGSS">WGSS</option>
                    </select>
                    <input type="text" name="classNum2"><br/>
                </p>
                <input type="submit" value="Create My Schedule">
            </div>
        </form>
    </body>
</html>