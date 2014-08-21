<article id="words">
    <section>
        <h4>Dodaj nowe słówko</h4>
        <div id="add-word-form">
            <div id="add-controller" class="control-group">
                <div class="controls">
                    <div class="input-prepend block">
                        <span class="add-on">EN</span>
                        <input id="word-add-en" type="text">
                        <div id="word-loading"><img src="css/img/loading.gif"></div>
                    </div>
                </div>

            </div>
            <div class="input-prepend block">
                <span class="add-on">PL</span>
                <input id="word-add-pl" type="text">
            </div>
            <div id="cat-select">
                <div class="btn-group">
                    <button class="btn dropdown-toggle" data-toggle="dropdown">
                        Kategoria
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                    </ul>
                </div>
                <span id="selected-cat"></span>
            </div>
            <button class="btn btn-large btn-success button-higher" type="button" id="word-add-submit">Dodaj</button>
            <button class="btn btn-large btn-info word-sound button-higher"  id="add-word-expand" type="button">Pobierz tłumaczenie</button>
            <button class="btn btn-large btn-info word-sound play-sound" id="play-button" type="button"><i class="speaker"></i></button>

        </div>
    </section>
    <div class="row">
        <div class="span6">
            <h4>Lista słówek</h4>
        </div>
        <div class="span6" style='text-align:right'>
            <button class="btn btn-small" type="button"><a href="words-import">Importuj słówka</a></button>
            <button class="btn btn-small" type="button"><a href="words-export">Eksportuj słówka</a></button>
        </div>
    </div>
    <div class="accordion" id="accordion">

    </div>
</article>
<div id="template-accordion" class="template">
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle">
                Collapsible Group Item #1
            </a>
        </div>
        <div class='accordion-content'>
            <table class="table table-hover table-striped render-allwords">
                <tr>
                    <th>Lp</th>
                    <th></th>
                    <th>ENG</th>
                    <th>PL</th>
                    <th></th>
                    <th class='last'>Progres</th>
                </tr>
            </table>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        WORDS.run();
        $('.navbar-fixed-top a[href=words]>button').addClass('active');
    });
</script>