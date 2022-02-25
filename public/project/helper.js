function checkArray(object) {
    if(object !== 'undefined'){
        if(object.length > 0){
            return splitArrayElements(object);
        }
    }
    return 'N/A';
}

function splitArrayElements(object){
    let html = '';
    for(let i=0; i<object.length; i++){
        html += '<span style="margin: 2px;">'+ object[i].name +'</span>';
    }
    return html;
}