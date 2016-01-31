<html>
    <head>
        <title>Dynamic Sandbox test</title>
        <script src="js/jquery-2.1.4.min.js"></script>
        <script src="js/dynamic-form.js"></script>
        <script src="js/jquery.serializejson.js"></script>
    </head>
    <body>
        <form id="myform" method="post">
            <p> Select classes and class numbers, then click "COMPILE" to generate schedules.</p>
            <div id="ClassGroup">
                <div id="ClassDiv1">
                    <label>Class #1 :</label>
                    <select id="dept1" name="dept1">
                        <option value="placeholder" selected>Select Dept</option>
                    </select>
                    <select id="course1" name="course1">
                        <option value="placeholder" selected>Select a Dept first</option>
                    </select>
                    <div id="title1">Class #1 Title: </div>
                    <div id="sections1">Class #1 Sections:<br>
                    </div>
                </div>

                <script src="js/class-data.js"></script>
            </div>
            <input type="button" value="Add Class" id="addButton">
            <input type="submit" value="Compile Schedules" id="compile">
        </form>
    </body>
</html>