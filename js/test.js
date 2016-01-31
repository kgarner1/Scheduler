//json='';

//var parsed = $.parseJSON(json);


loadJSON(function(response) {
    temp1 = JSON.parse(response);
    console.log(temp1);
});

/*
var test = parsed.Users;


$.each(parsed, function (key, data) {
    //console.log(key)
    $.each(data, function (index, data) {
        $.each(data, function (index, data){
            console.log(index)
        })
    })
})


//console.log(test);
*/

function loadJSON(callback) {
    var xobj = new XMLHttpRequest();
    xobj.overrideMimeType("application/json");
    xobj.open('GET', 'test_schedules/schedule.json', true);
    xobj.onreadystatechange = function () {
        if (xobj.readyState == 4 && xobj.status == "200") {
            callback(xobj.responseText);
        }
    }
    xobj.send(null);
}