<section id="page-word-import">

    <div class="row">
        <div class="span6">
            <div class="input-prepend input-append">
                <span class="add-on">Seperator</span>
                <input type='text' id='delimiter' value='-' style='width:30px'>
                <button class='btn import-direction'>Zmień kierunek</button>
            </div>
            <textarea style="width:100%;height:500px;" id="import-source"></textarea>
        </div>
        <div class="span6">
            <div id="import-settings"  class="form-inline">
                <div id="cat-select">
                    <button class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                        Kategoria
                        <span class="caret"></span>
                    </button>
                    <span id="selected-cat"></span>
                    <button class='btn btn-success' id="add">Dodaj</button>
                    <ul class="dropdown-menu" style="top:auto;left:auto;">
                    </ul>
                </div>
            </div>
            <table id="preview" class="table table-bordered table-striped" style="width:100%;">
                <thead>
                <tr>
                    <th style='width:30px;'>Lp</th>
                    <th>PL</th>
                    <th>EN</th>
                </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
    </div>
</section>
<script src="js/app/words-import.js"></script>
<script>
    $(document).ready(function(){
        IMPORT.run();
    });
</script>
