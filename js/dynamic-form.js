/*
 * author: John Ravi
 * version: 0.4
 */

$(document).ready(function () {
    var counter = 2;
    
    $("#addButton").click(function () {
        if (counter > 10) {
            alert("Only 10 allowed");
            return false;
        }
        init(counter);
        var newClassDiv = $(document.createElement('div')).attr("id", 'ClassDiv' + counter);
        newClassDiv.after().html('<label>Class #' + counter + ' : </label>' +
            //'<select id="select' + counter + '" ><option value="' + "val" + ' ">"' + "desc2" + '"</option><option value="' + "val2" + ' ">"' + "desc" + '"</option><option value="' + "val3" + ' ">"' + "desc3" + '"</option>');
            '<select id="dept' + counter + '" name="dept' + counter + '"> <option value="placeholder" selected>Select Dept</option> </select> <select id="course' + counter + '" name="course' + counter + '"> <option value="placeholder" selected>Select a Dept first</option> </select> <div id="title' + counter + '">Class #' + counter + ' Title: </div>'+
            '<div id="sections' + counter + '">Class #' + counter + ' Sections:<br></div>');
           
        newClassDiv.appendTo("#ClassGroup");
        counter++;
    });
    
    /*
    //adding hidden inputs
    $('#myFORM').on('submit', function(){
        $('#myFORM select').each(function(){
            slct = $('<input type="hidden" name="mySelect[]" value="' +  $(this).val() +'">');
            $('#myFORM').append(slct);
        });
        console.log(slct);
    });
    */
   
    $( "#myform" ).submit(function(event) {
        event.preventDefault();
        //var test = $("#myform").serializeObject();
        var test = $("#myform").serializeJSON();
        console.log(test);
        //alert("stop");
        /*
        $('#myform select').each(function(){
            alert($(this).val());
        });
        */
    });    
});