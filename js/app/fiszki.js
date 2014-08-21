//Flashcard object
var FC = {

    //all words
    data:[],

    //al words as template for selecting
    data_all:[],

    //Selected cats
    cats : [],

    //words in box<5 for learn
    data_clear:[],

    //5 boxes for flashcards
    boxes:[0, 0, 0, 0, 0],

    //actual word index
    random_word:'',

    active : true,

    sound_id : false,

    //actual language on flashcard en-true, pl-false
    actual_lang : true,
    /**
     * Get all words from DB
     */
    run : function(){
        $.getJSON('rest/get/allwords', function(data) {
            console.log(data);
            $.each(data[0], function(index, value){
                $.each(value, function(index, value){
                    FC.data.push(value);
                });
            });

            $.each(data[1], function(index, value){
                console.log(value);
                var count_cat = parseInt("0"+value[4]);
                if(!count_cat==0){
                    $('#select-cat').append('<button type="button" data="'+value[0]+'" class="btn ">'+value[1]+' (' + count_cat +')</button><br/>');
                }

            });
            FC.data_all = FC.data;
           // FC.parseArray(FC.data);
        });
        FC.actions();
    },

    /**
     * Insert words in right box
     */
    parseArray : function(data){
        FC.boxes[0]=FC.boxes[1]=FC.boxes[2]=FC.boxes[3]=FC.boxes[4]=0;
        FC.data_clear=[];
        $.each(data, function(key, val) {
            switch(val[4])
            {
                case '1':
                    FC.boxes[0]++;
                    FC.data_clear.push(FC.data[key]);
                    break;
                case '2':
                    FC.boxes[1]++;
                    FC.data_clear.push(FC.data[key]);
                    break;
                case '3':
                    FC.boxes[2]++;
                    FC.data_clear.push(FC.data[key]);
                    break;
                case '4':
                    FC.boxes[3]++;
                    FC.data_clear.push(FC.data[key]);
                    break;
                case '5':
                    FC.boxes[4]++;
                    break;
                default:
            }
        });
        this.fillBoxes();
        this.generateWord(this.data_clear);
    },

    fillBoxes : function(){
        $('#fiszki #box1').html(this.boxes[0]);
        $('#fiszki #box2').html(this.boxes[1]);
        $('#fiszki #box3').html(this.boxes[2]);
        $('#fiszki #box4').html(this.boxes[3]);
        $('#fiszki #box5').html(this.boxes[4]);
    },

    generateWord : function(words){
            FC.random_word = Math.floor(Math.random()*words.length);
            //console.log(words);

            $('#fiszki #word').html(words[FC.random_word][2]);
            $('#fiszki #flip').html("<h1 class='flashcard-eng'>"+$('#word').html()+"</h1>");
            $('#fiszki #tip').html(words[FC.random_word][1].replace(/;/g, ' &middot; '));

            FC.sound_id = words[FC.random_word][5];
            if(FC.sound_id==0){
                $('#play-sound').fadeOut();
            } else {
                $('#play-sound').fadeIn();
            }
            FC.actual_lang = true;
    },
    actions : function(){
        $('#fiszki .check').click(function(){
            FC.generateWord(FC.data_clear);
        });

        $('#fiszki #check-positive').click(function(){
            FC.increaseBox(FC.data_clear[FC.random_word][4]);
            $.post("rest/fiszki/increasebox",{ id: FC.data_clear[FC.random_word][0]});
            $.post("rest/increase/studied", { id: FC.data_clear[FC.random_word][0]});
            FC.data_clear[FC.random_word][4]++;
            FC.data_clear[FC.random_word][4]+='';
            if(FC.data_clear[FC.random_word][4]=="5"){
                 $.post("rest/increase/known", { id: FC.data_clear[FC.random_word][0]});
                 FC.data_clear.splice(FC.random_word, 1);
                 if(FC.data_clear.length==0){
                     $('#fiszki #word').html("Wszystko umiesz!");
                     $('#flip').html("Wszystko umiesz!");

                     FC.active = false;
                 }
            }
        });

        $('#fiszki #check-negative').click(function(){
            if(parseInt(FC.data_clear[FC.random_word][4])>1){
                $.post("rest/fiszki/decreasebox", { id: FC.data_clear[FC.random_word][0]});
                FC.decreaseBox(FC.data_clear[FC.random_word][4]);
                FC.data_clear[FC.random_word][4]--;
                FC.data_clear[FC.random_word][4]+='';
            }
        });

        $('#fiszki #word').click(function(){
            $(this).hide();
            $('#fiszki #tip').show();
        });

        $('#fiszki #tip').click(function(){
            $(this).hide();
            $('#fiszki #word').show();
        });

        $('#fiszki #play-sound').click(function(){
            FS_FUNC.babSpeakIt(FC.sound_id);
        });
        $("#flip").click(function(){
            if(FC.actual_lang){
                var f = Math.floor(200/$('#fiszki #tip').text().length+15);
                console.log(f);
                $("#flip").css('font-size', f + 'px')
                $(this).flip({
                    direction:'lr',
                    content:$('#tip').html(),
                    color:'#fff',
                    speed:50
                });
                FC.actual_lang=false;
            } else {
                $(this).flip({
                    direction:'rl',
                    content:"<h1 class='flashcard-eng'>"+$('#word').html()+"</h1>",
                    color:'#fff',
                    speed:50
                });
                FC.actual_lang=true;
            }

        });

        $('#select-cat').on('click', '.btn', function(){
            $(this).toggleClass('btn-info').toggleClass('active').toggleClass('selected');
            FC.refresh();
        });

        $('#select-toggle-none').hide();

        $('#select-toggle-all').click(function(){
            $('#select-cat button').addClass('btn-info').addClass('selected');
            $(this).toggle();
            $('#select-toggle-none').toggle();
            FC.refresh();
        });

        $('#select-toggle-none').click(function(){
            $('#select-cat button').removeClass('btn-info').removeClass('selected');
            $(this).toggle();
            $('#select-toggle-all').toggle();
            FC.refresh();
        });

        $('#select-start').click(function(){
            FC.refresh();
        });
    },

    refresh: function(){
        $('#word, .flashcard-eng, #flip, #tip').html('Wszystko umiesz!');
        $('#play-sound').hide();
        FC.data=[];
        $('#select-cat .selected').each(function(){
            var cat = $(this).attr('data');
            $.each(FC.data_all, function(index, value){
                if(value[6]==cat){
                    FC.data.push(value);
                }
            });
        });
        FC.parseArray(FC.data);
    },

    increaseBox : function(nr){
        console.log(nr);
        data=FC.data_clear;
        console.log(data[0], data[1], data[2], data[3]);
        $('#fiszki #box' + nr).html(parseInt($('#fiszki #box' + nr).html())-1);
        $('#fiszki #box' + nr).next().html(parseInt($('#fiszki #box' + nr).next().html())+1);
    },
    decreaseBox : function(nr){
        console.log(nr);
        data=FC.data_clear;
        console.log(data[0], data[1], data[2], data[3]);
        $('#fiszki #box' + nr).html(parseInt($('#fiszki #box' + nr).html())-1);
        $('#fiszki #box' + nr).prev().html(parseInt($('#fiszki #box' + nr).prev().html())+1);
    }
}