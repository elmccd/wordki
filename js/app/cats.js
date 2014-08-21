/**
 * Categories
 *
 *
 */
CATS={};



CATS.fillCats = function(){
    $.getJSON('rest/get/cats', function(data) {
        $.each(data, function(index, val){
            console.log(index, val);
            var controls = (val[2]==0)?'':'<i class="cat-remove icon-remove"></i>';
            $('#cats-all tbody').append('<tr data="'+val[0]+'"><td>'+(index+1)+'</td><td>'+val[1]+'</td><td  class="count">'+parseInt("0"+val[4])+'</td><td>'+controls+'</td><td><i class="cat-refresh icon-refresh"></i></td></tr>');
        });
    });
}

CATS.add = function(name, id){
    if(name!=''){
        $.post("rest/cats/add", { name:name, id:id })
            .done(function(data) {
                console.log(data);
                $('#cats-all tbody').prepend('<tr data="'+data+'"><td>0</td><td class="cat-name"></td><td  class="count">0</td><td><i class="cat-remove icon-remove"></i></td><td><i class="cat-refresh icon-refresh"></i></td></tr>');
                $('.cat-name').text(name);
                $('#cat-add-name').val('');
                CATS.updateLp();
            });
    }

}

/**
 * Correct incrementation after adding new record
 */
CATS.updateLp = function(){
    $('#cats-all tr').each(function(){
        $(this).find('td').eq(0).html($(this).index()+1);
    });
}

CATS.events = function(){
    $('#cat-add-submit').click(function(){
        CATS.add($('#cat-add-name').val(), 0);
    });
    $('#cats-all').on('click','.cat-remove', function(){
        var count = $(this).closest('tr').find('.count').text();
        var r = confirm("Usunąć kategorię? Słówek w kategorii: " + count);
        if(r){
            $(this).closest('tr').fadeOut(300, function(){
                $(this).remove();
                CATS.updateLp();
            });
            CATS.removeOne($(this).closest('tr').attr('data'));
        }
    });
    $('#cats-all').on('click','.cat-refresh', function(){
        var r = confirm("Zrestarować wszystkie postępy dla tej kategorii?");
        if(r){
            CATS.clearStats($(this).closest('tr').attr('data'));
        }
    });

}

CATS.removeOne = function(id){
    $.post("rest/cats/remove", { id:id })
        .done(function(data) {
            console.log(data);
        });
}

CATS.clearStats = function(id){
    $.post("rest/cats/clearstats", { id:id })
        .done(function(data) {
            console.log(data);
        });
}

CATS.run = function(){
    CATS.fillCats();
    CATS.events();
}