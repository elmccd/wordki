/**
 * App Słowka
 *
 * @version 0.1
 * @author elmccd
 */
WORDS = {};
WORDS.addPL = '';
WORDS.addEN='';
WORDS.addSound=0;
WORDS.lastCat=null; //Last filled cat
WORDS.activeCat=0; // Selected category to add new words
/**
 * REST fill all words
 */
WORDS.fill = function(){
    $.getJSON('rest/get/allwords', function(data) {
        $.each(data[0], function(key0, val0) {
            $('#words #accordion').append($('#template-accordion').html());
            WORDS.lastCat = $('#words #accordion .accordion-group').last();
            WORDS.lastCat.attr('data', data[1][key0][0]);
            WORDS.lastCat.attr('id', 'cat-'+data[1][key0][0]);
            WORDS.lastCat.find('.accordion-toggle').html(data[1][key0][1])
                .append('<div class="cat-progress progress progress-info progress-striped"><div class="bar"></div></div>');
            $.each(val0, function(key, val) {
                WORDS.insertInList(key, val, false);
            });
        });

        WORDS.events();
    });
}

/**
 * Insert record to the table
 *
 * @param key
 * @param val array val[0]:id-val[1]:worden-val[2]:wordpl-val[3]:context-val[4]:box-val[5]:sound
 * @param prepend if true prepend, not append
 */
WORDS.insertInList = function(key, val, prepend){
    var sound = (val[5]!=0)?'<td class="word-sound" data="' + val[5] + '"> <i class="icon-volume-up"></i></td>':'<td></td>';
    var record = $('<tr data="'+val[0]+'"></tr>').append('<td class="word-lp">' + (key+1) + '</td>')
        .append(sound)
        .append('<td class="word-en">' + val[2] + '</td>')
        .append('<td class="word-pl">' + FS_FUNC.collapseWords(val[1], 50).replace(/;/g, ' · ') + '</td>')
        .append('<td class="word-remove"><i class="icon-remove"></i></td>')
        .append('<td class="word-progress" data="'+(val[4]-1)+'"><div class="progress progress-success progress-striped"><div class="bar" style="width: ' + ((val[4]-1)*25) + '%"></div></div></td>');
    if(!prepend){
        WORDS.lastCat.find('.render-allwords').append(record);
    } else {
        $('#cat-'+WORDS.activeCat+ ' tr').first().after(record);
        WORDS.slideCategory($('#cat-'+WORDS.activeCat+ ' .accordion-content'));
    }
}

/**
 * Correct incrementation after adding new record
 */
WORDS.updateLp = function(){
    $('.render-allwords tr').each(function(){
        $(this).find('td').eq(0).html($(this).index());
    });
}

WORDS.events = function(){
    $('#play-button').hide();
   // $('#words .accordion-content').eq(0).show();
    $("#words").on("click", ".collapse-text-show", function(){
        console.log('click');
        $(this).hide();
        $(this).parent().find('.collapse-text').show();
    });

    $("#words").on("click", ".word-sound", function(){

        FS_FUNC.babSpeakIt($(this).attr('data'));
    });

    $("#words").on("click", ".accordion-heading", function(){
        WORDS.slideCategory($(this).parent('.accordion-group').find('.accordion-content'));
    });

    $("#word-add-en").keyup(function(){
        if($(this).val()!=""){
            $("#word-add-pl").removeAttr('disabled');
        } else {
            $("#word-add-pl").attr('disabled', 'disabled');
        }

    });

    $('.render-allwords').on('click', '.word-remove', function(){
        $(this).parent('tr').fadeOut();
        WORDS.removeOne($(this).parent('tr').attr('data'));
    });

    $('#word-add-submit').click(function(){
        WORDS.addSubmit();
    });

    WORDS.fillCatStats();
};

WORDS.slideCategory = function(el){
    $('.accordion-content').not(el).slideUp(300);
    el.slideDown(300);
}

WORDS.addSubmit = function(){
    if($("#word-add-pl").val()!="" && $("#word-add-en").val()!="" && WORDS.activeCat!=0){
        WORDS.addPL = $('#word-add-pl').val();
        WORDS.addEN = $('#word-add-en').val();
        console.log(WORDS);
        $.post("rest/increase/add", { pl: WORDS.addPL, en: WORDS.addEN, sound_id:WORDS.addSound, cat_id:WORDS.activeCat})
            .done(function(data) {
                console.log('words');
                console.log(WORDS);
                $('.render-allwords tr').eq(1).attr('data', parseInt(data));
            });
        var val=[0, WORDS.addPL, WORDS.addEN, 0, 0, WORDS.addSound];

        WORDS.insertInList(0, val, true);
        WORDS.updateLp();

        $("#word-add-pl").val('');
        $("#word-add-en").val('');
        $('#play-button').fadeOut();
        $('#play-button').removeAttr('data');
        WORDS.addPL = WORDS.addEN ='';
        WORDS.addSound = 0;

    } else {
        $('#add-controller').addClass('error');
    }
};

WORDS.add = function(){
    $('html').click(function() {
        $('#add-controller').removeClass('error');
    });

    $("#add-word-expand").click(function(){

        var word = $('#word-add-en').val();
        if(word!='' && word.match(/^[-\s'a-zA-Z]+$/)){
            WORDS.getTranslate(word);
        } else {
            $('#add-controller').addClass('error');
        }
    });
};

WORDS.getTranslate = function(word){

    $('#word-loading img').stop().fadeIn();
    $('#add-controller').removeClass('error');

    $.getJSON('rest/translate/' + word, function(data) {
        WORDS.addPL=data[0].join(';');
        WORDS.addEN=data[2];
        WORDS.addSound=data[1];

        WORDS.setTranslate();

    });

};

WORDS.setTranslate = function(){
    console.log('setTranslate');
    $('#word-loading img').stop().fadeOut();
    $('.play-sound').attr('data', WORDS.addSound);
    $('#word-add-en').val(WORDS.addEN);
    $('#word-add-pl').val(WORDS.addPL);
    $('#add-word-form').slideDown();
    $('#play-button').fadeIn();
};

WORDS.removeOne = function(id){
    $.post("rest/remove/one", { id:id })
        .done(function(data) {
            console.log(data);
        });
}

WORDS.fillCats = function(){
    $.getJSON('rest/get/cats', function(data) {
        $.each(data, function(index, val){
           console.log(index, val);
           $('#cat-select .dropdown-menu').append('<li role="presentation" data="'+val[0]+'"><a>'+ val[1] +'</a></li>');
        });
        $('#words').on('click', '#cat-select .dropdown-menu li', function(){
            WORDS.activeCat = $(this).attr('data');
            $('#selected-cat').html($(this).text());
        });
    });
}

WORDS.fillCatStats = function(){
    $('#accordion .accordion-group').each(function(){
        var el=$(this);
        var sum=0;
        var count=0;
        $(this).find('table tr').slice(1).each(function(){
            sum+=parseInt($(this).find('td.word-progress').attr('data'));
            count++;
        })
        $(this).find('.accordion-heading .bar').css('width', sum/count/4*100+'%')
    });

}

WORDS.run = function(){
    WORDS.fill();
    WORDS.add();
    $(document).ready(function(){
        WORDS.setTranslate();
        WORDS.fillCats();
    });
};
