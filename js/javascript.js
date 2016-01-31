
function disableOtherSections(_checked, aId, section, startTime, endTime){
    var collection = document.getElementById(aId).getElementsByTagName('input');
    if(_checked == true){
        disableOtherClasses(_checked, aId, section, collection, startTime, endTime);
    } else {
        enableOtherClasses(_checked, aId, section, collection, startTime, endTime);
    }
}
function disableOtherClasses(_checked, aId, section, collection, startTime, endTime){
    var aidClass = document.getElementById(aId);
    var currentClass = 0;
    if (aId == 'class1'){
        currentClass = 1;
    } else if (aId == 'class2'){
        currentClass = 2;
    } else if (aId == 'class3'){
        currentClass = 3;
    } else if (aId == 'class4'){
        currentClass = 4;
    }
    var collection1 = document.getElementById('class1').getElementsByTagName('input');
    var collection2 = document.getElementById('class2').getElementsByTagName('input');
    var collection3 = document.getElementById('class3').getElementsByTagName('input');
    var collection4 = document.getElementById('class4').getElementsByTagName('input');
    console.log(currentClass + '_' + section);
    
    
    
    if(aId == 'class1'){
        for (var x=0; x<collection1.length; x++) {
            for (var y=startTime; y<endTime; y++){
                if(document.getElementById(currentClass + '_' + section) != ('1_' + section) || y == startTime){
                    collection1[x].disabled = true;
                    collection1[x].style.color = "red";
                    document.getElementById(currentClass + '_' + section).disabled = false;
                    break;
                }
            }
        }
        for (var x=0; x<collection2.length; x++) {
            for (var y=startTime; y<endTime; y++){
                if(document.getElementById('2_' + section) != ('2_' + section) && y == startTime){
                    collection2[x].disabled = true;
                }
            }
        }
        for (var x=0; x<collection3.length; x++) {
            for (var y=startTime; y<endTime; y++){
                if(document.getElementById('3_' + section) != ('3_' + section) && y == startTime){
                    collection3[x].disabled = true;
                }
            }
        }
        for (var x=0; x<collection4.length; x++) {
            for (var y=startTime; y<endTime; y++){
                if(document.getElementById('4_' + section) != ('4_' + section) && y == startTime){
                    collection4[x].disabled = true;
                }
            }
        }
    } else if(aId == 'class2'){
        for (var x=0; x<collection1.length; x++) {
            for (var y=startTime; y<endTime; y++){
                if(document.getElementById('1_' + section) != ('1_' + section) && y){
                    collection1[x].disabled = true;
                }
            }
        }
        for (var x=0; x<collection2.length; x++) {
            for (var y=startTime; y<endTime; y++){
                if(document.getElementById('2_' + section) != ('2_' + section) && y){
                    collection2[x].disabled = true;
                    console.log('2_' + section);
                    document.getElementById('2_' + section).disabled = false;
                    break;
                }
            }
        }
        for (var x=0; x<collection3.length; x++) {
            for (var y=startTime; y<endTime; y++){
                if(document.getElementById('3_' + section) != ('3_' + section) && y){
                    collection3[x].disabled = true;
                }
            }
        }
        for (var x=0; x<collection4.length; x++) {
            for (var y=startTime; y<endTime; y++){
                if(document.getElementById('4_' + section) != ('4_' + section) && y){
                    collection4[x].disabled = true;
                }
            }
        }
    }  else if(aId == 'class3'){
        for (var x=0; x<collection1.length; x++) {
            for (var y=startTime; y<endTime; y++){
                if(document.getElementById('1_' + section) != ('1_' + section) && y){
                    collection1[x].disabled = true;
                }
            }
        }
        for (var x=0; x<collection2.length; x++) {
            for (var y=startTime; y<endTime; y++){
                if(document.getElementById('2_' + section) != ('2_' + section) && y){
                    collection2[x].disabled = true;
                }
            }
        }
        for (var x=0; x<collection3.length; x++) {
            for (var y=startTime; y<endTime; y++){
                if(document.getElementById('3_' + section) != ('3_' + section) && y){
                    collection3[x].disabled = true;
                    console.log('3_' + section);
                    document.getElementById('3_' + section).disabled = false;
                }
            }
        }
        for (var x=0; x<collection4.length; x++) {
            for (var y=startTime; y<endTime; y++){
                if(document.getElementById('4_' + section) != ('4_' + section) && y){
                    collection4[x].disabled = true;
                }
            }
        }
    } else if(aId == 'class4'){
        for (var x=0; x<collection1.length; x++) {
            for (var y=startTime; y<endTime; y++){
                if(document.getElementById('1_' + section) != ('1_' + section) && y){
                    collection1[x].disabled = true;
                }
            }
        }
        for (var x=0; x<collection2.length; x++) {
            for (var y=startTime; y<endTime; y++){
                if(document.getElementById('2_' + section) != ('2_' + section) && y){
                    collection2[x].disabled = true;
                }
            }
        }
        for (var x=0; x<collection3.length; x++) {
            for (var y=startTime; y<endTime; y++){
                if(document.getElementById('3_' + section) != ('3_' + section) && y){
                    collection3[x].disabled = true;
                }
            }
        }
        for (var x=0; x<collection4.length; x++) {
            for (var y=startTime; y<endTime; y++){
                if(document.getElementById('4_' + section) != ('4_' + section) && y){
                    collection4[x].disabled = true;
                    console.log('4_' + section);
                    document.getElementById('4_' + section).disabled = false;
                }
            }
        }
    }
}
function enableOtherClasses(_checked, aId, section, collection, startTime, endTime){
    var aidClass = document.getElementById(aId);
    var currentClass = 0;
    if (aId == 'class1'){
        currentClass = 1;
    } else if (aId == 'class2'){
        currentClass = 2;
    } else if (aId == 'class3'){
        currentClass = 3;
    } else if (aId == 'class4'){
        currentClass = 4;
    }
    var collection1 = document.getElementById('class1').getElementsByTagName('input');
    var collection2 = document.getElementById('class2').getElementsByTagName('input');
    var collection3 = document.getElementById('class3').getElementsByTagName('input');
    var collection4 = document.getElementById('class4').getElementsByTagName('input');
    if(true){
        for (var x=0; x<collection1.length; x++) {
            collection1[x].disabled = false;
        }
        for (var x=0; x<collection2.length; x++) {
            collection2[x].disabled = false;
        }
        for (var x=0; x<collection3.length; x++) {
            collection3[x].disabled = false;
        }
        for (var x=0; x<collection4.length; x++) {
            collection4[x].disabled = false;
        }
    }
}