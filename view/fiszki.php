<article id="fiszki">
    <div style="float:left;width:200px;">
        <section>
            <div id="select-cat" data-toggle="buttons-checkbox">
            </div>
            <br/>
            <button type="button" id='select-toggle-all' class="btn btn200 btn-info">Zaznacz wszystkie</button>
            <button type="button" id='select-toggle-none' class="btn btn200 btn-info">Odznacz wszystkie</button>
            <button type="button" id='select-start' class="btn btn200 btn-primary">Wybierz</button>
        </section>
    </div>
    <div style="float:left;width:450px;">
        <section>
            <div id="box1" class='box'>0</div>
            <div id="box2" class='box'>0</div>
            <div id="box3" class='box'>0</div>
            <div id="box4" class='box'>0</div>
            <div id="box5" class='box'>0</div>
        </section>
        <section id='flashcard'>
            <h2 id="word" class='flashcard-swap'></h2>
            <h4 id="tip" class='flashcard-swap'></h4>
            <div id="flip"></div>
        </section>
        <section>
            <button class="btn btn-large btn-success check" type="button" id="check-positive">Umiem</button>
            <button class="btn btn-large btn-danger check" type="button" id="check-negative">Nie umiem</button>
            <button class="btn btn-large btn-info" type="button" id="play-sound"><i class="speaker"></i></button>
            <div style="clear:both;"></div>
        </section>
    </div>
    <div style='clear:both;'></div>
</article>
<script>
    $(document).ready(function(){
        FC.run();
        $('.navbar-fixed-top a[href=fiszki]>button').addClass('active');
    });
</script>
