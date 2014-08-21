EXPORT = {};

EXPORT.words = [];
EXPORT.cats = [];
EXPORT.selected_cats = [];

EXPORT.run = function(){
    EXPORT.getWords();
}

EXPORT.refresh = function(){

}

EXPORT.getWords = function(){
    $.getJSON('rest/get/allwords', function(data) {
        EXPORT.words=data[0];
        EXPORT.cats=data[1];
        EXPORT.fillCats();
    });
}

EXPORT.fillCats = function(){
    for(var i=0;i<EXPORT.cats.length;i++){
        $('#export-cats').append("<tr class='record'><td>" + EXPORT.cats[i][0] + "<input name='" + EXPORT.cats[i][1] + "' data='" + EXPORT.cats[i][0] + "' type='checkbox'></td><td>" + EXPORT.cats[i][1] + "</td></tr>");
        if(i==EXPORT.cats.length-1){
            EXPORT.events();
            EXPORT.getSelected();
        }
    }
}

EXPORT.getSelected = function(){
    EXPORT.selected_cats = []
    $('#export-cats .record input:checked').each(function(){
        EXPORT.selected_cats.push($(this).attr('data'));
        console.log($(this).attr('data'));
    });
    EXPORT.fillWords();
}

EXPORT.fillWords = function(){
    $('#export-content').html('');
    for(var i=0;i<EXPORT.words.length;i++){
        if(jQuery.inArray(EXPORT.words[i][0][6], EXPORT.selected_cats) > 0){
            $('#export-content').append("<article><b>" + EXPORT.words[i][0][6] +  EXPORT.getCatName(EXPORT.words[i][0][6]) + "</b><br/>");
            for(var j=0;j<EXPORT.words[i].length;j++){
                console.log(EXPORT.words[i][j]);
                $('#export-content').append(EXPORT.words[i][j][1] + " - "+ EXPORT.words[i][j][2] + "<br/>");
            }
            $('#export-content').append("</article>");
        }
    }
}

EXPORT.getCatName = function(id){
    return $('#export-cats td input[data=' + id + ']').attr('name');
}

EXPORT.events = function(){
    $('#export-cats input').change(function() {
        EXPORT.getSelected();
    });
}