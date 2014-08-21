<section id="page-word-export">

    <div class="row">
        <div class="span6">
            <div id="export-content">

            </div>
        </div>
        <div class="span6">
            <h4>Wybierz kategorie:</h4>
            <table class='table loading' id='export-cats'>
                <tr class='info'>
                    <td><input id="toggle-cats" type='checkbox'></td>
                    <td>Zaznacz/Odznacz wszystkie</td>
                </tr>
            </table>
        </div>
    </div>
</section>
<script src="js/app/words-export.js"></script>
<script>
    $(document).ready(function(){
        EXPORT.run();
    });
</script>
