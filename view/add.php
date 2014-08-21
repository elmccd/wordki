<article>
    <h4>Dodaj nowe słówko</h4>
    <div id="add-controller" class="control-group">
        <div class="controls">
            <div class="input-prepend input-append">
                <span class="add-on"><i class="icon-plus"></i></span>
                <input class="span2" id="addwordpl" type="text">
                <button class="btn" id="add-word-expand" type="button">Dodaj</button>
            </div>
            <div id="word-loading"><img src="../css/img/loading.gif"></div>
        </div>

    </div>
    <div id="add-word-form">
        <div class="input-prepend block">
            <span class="add-on">EN</span>
            <input id="word-add-en" type="text">
        </div>
        <div class="input-prepend block">
            <span class="add-on">PL</span>
            <input id="word-add-pl" type="text">
        </div>
        <button class="btn btn-large btn-success" type="button" id="word-add-submit">Dodaj</button>
        <button class="btn btn-large btn-info word-sound play-sound"  type="button"><i class="speaker"></i></button>

    </div>
</article>