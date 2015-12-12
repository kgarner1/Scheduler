/*
 * author: John Ravi
 * version: 0.1
 */

var temp1; 
var temp2;


loadJSON(function(response) {
    temp1 = JSON.parse(response);
    temp2 = temp1.ACCT;
    console.log(temp2);
});

var temp = {"1" : "string1","2" : "string2"};

var $select = $('#className1');
 $select.find('option').remove();
$.each(temp,function(key, value)
{
    $select.append('<option value=' + key + '>' + value + '</option>');
});

function loadJSON(callback) {
    var xobj = new XMLHttpRequest();
    xobj.overrideMimeType("application/json");
    xobj.open('GET', '/test_schedules/ScheduleFall2015.json', true);
    xobj.onreadystatechange = function () {
        if (xobj.readyState == 4 && xobj.status == "200") {
            callback(xobj.responseText);
        }
    }
    xobj.send(null);
}