IMPORT = {};

IMPORT.change_direction=false;
IMPORT.activeCat=false;
IMPORT.words=[];

IMPORT.run = function(){
    IMPORT.events();
    IMPORT.fillCats();
}

IMPORT.events = function(){
    IMPORT.refreshform();
    $('#page-word-import input, #page-word-import textarea').change(function(){
        IMPORT.refreshform();
    });
    $('#page-word-import input, #page-word-import textarea').keyup(function(){
        IMPORT.refreshform();
    });

    $('.import-direction').click(function(){
        IMPORT.change_direction=(IMPORT.change_direction==true)?false:true;
        IMPORT.refreshform();
    });

    $("#add").click(function(){
        IMPORT.submit();
    });
}

IMPORT.refreshform = function(){
    console.log(0);
    $('#preview tbody').empty();
    var lines = $.trim($('#import-source').val()).split("\n");
    var word;
    IMPORT.words=null;
    IMPORT.words=[];
    for (var i=0;i<lines.length;i++)
    {
        if($.trim(lines[i])!=""){
            word = lines[i].split($('#delimiter').val());
            if(IMPORT.change_direction===false){
                word[0]=$.trim(word[0]);
                word[1]=$.trim(word[1]);
            } else {
                var temp = word[0];
                word[0]=$.trim(word[1]);
                word[1]=$.trim(temp);
            }
            IMPORT.words.push(word);

            $('#preview tbody').append("<tr><td>" + (i+1) + "</td><td>" + word[0] + "</td><td>" + word[1] + "</td></tr>");
            console.log(word);
        }
    }
}

IMPORT.fillCats = function(){
    $.getJSON('rest/get/cats', function(data) {
        $.each(data, function(index, val){
            console.log(index, val);
            $('#cat-select .dropdown-menu').append('<li role="presentation" data="'+val[0]+'"><a>'+ val[1] +'</a></li>');
        });
        $('#cat-select .dropdown-menu li').on('click', function(event){
            IMPORT.activeCat = $(this).attr('data');
            $('#selected-cat').html($(this).text());
        });
    });
}

IMPORT.submit = function(){
    for (var i=0;i<IMPORT.words.length;i++){
        IMPORT.addWord(IMPORT.words[i][0], IMPORT.words[i][1], IMPORT.activeCat);
    }
    alert("Słówka zostały dodane!");
}

IMPORT.addWord = function(pl, en, cat){
    $.post("rest/increase/add", { pl: pl, en: en, sound_id:0, cat_id:cat}).done(function(data) {

        });
}