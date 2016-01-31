/*
 * author: John Ravi
 * version: 0.7
 */

var data;
var dept;
var test;

$(document).ready(function(){
    init(1);
});

function init(counter) {
    loadJSON(function(response) {
        data = JSON.parse(response);
        dept = data.dept;
        var $selectDeptDiv = $('#dept' + counter);
        var $selectCourseDiv = $('#course' + counter);
        var $titleDiv = $('#title' + counter);
        var $sectionDiv = $('#sections' + counter);
        $selectCourseDiv.find('option').remove();
        
        $.each(dept, function( index, value ) {
            $.each(value, function( d, c ) {
                var newOption = '<option value=' + index + '>' + d + '</option>';
                $selectDeptDiv.append(newOption);
            });
        });
        var selectD1;
        var select_dept;
        var title;

        $selectDeptDiv.change(function() {
            reset($titleDiv, $sectionDiv, counter);
            $selectCourseDiv.find('option').remove();
            $selectCourseDiv.append('<option value="placeholder"> Select a Dept first </option>');
            selectD1 = $("#dept" + counter + " option:selected").val();
            select_dept = dept[selectD1];
            $.each(select_dept, function( index, value ) {
                $.each(value, function( a, b ) {
                    $.each(b, function( c, d ) {
                        $selectCourseDiv.append('<option value=' + c + '>' + c + " : " + d[0].title + '</option>');
                    });
                });
            });
        });

        $selectCourseDiv.change(function() {
            reset($titleDiv, $sectionDiv, counter);
            $.each(select_dept, function( index, value ) {
                var selectCIndex = $("#course" + counter + " option:selected").index();
                var selectCValue = $("#course" + counter + " option:selected").val();
                title = dept[selectD1][index][selectCIndex-1][selectCValue][0]["title"];
                $.each(dept[selectD1][index][selectCIndex-1][selectCValue], function( a, b ) {
                        $sectionDiv.append('<input type="checkbox" name="section' + counter + '" value="' + a + '" checked>' + 'Section #' + (a+1) + ' Days: ' + b['section']['days'] +' Begin Time: ' + b['section']['beginTime'] + ' End Time: ' + b['section']['endTime'] + '<br>');
                        //$sectionDiv.append();
                });
            });
            $titleDiv.append(title);
        });
    });
};

function reset($titleDiv, $sectionDiv, counter){
        $titleDiv.empty();
        $titleDiv.append('Class #' + counter + ' Title: '); 
        $sectionDiv.empty();
        $sectionDiv.append('Class #' + counter + ' Sections: <br>');
        //$sectionDiv.empty();
        //$sectionDiv.append('<p>Class #' + counter + ' Sections: </p>');
};


function loadJSON(callback) {
    var xobj = new XMLHttpRequest();
    xobj.overrideMimeType("application/json");
    xobj.open('GET', 'test_schedules/optimizedSchedule.json', true);
    xobj.onreadystatechange = function () {
        if (xobj.readyState == 4 && xobj.status == "200") {
            callback(xobj.responseText);
        }
    }
    xobj.send(null);
}