<h4>Dodaj kategorię</h4>
<form>
    <div class="input-append">
        <input class="span2"  id="cat-add-name" type="text">
        <button class="btn" id="cat-add-submit" type="button">Dodaj!</button>
    </div>
</form>
<h4>Lista kategorii</h4>
<table id="cats-all" class="table table-hover table-striped render-allwords">
    <thead>
        <tr>
            <th>Lp</th>
            <th>Kategoria</th>
            <th>Ilość słówek</th>
            <th>Usuń</th>
            <th>Zrestartuj postępy</th>
        </tr>
    </thead>
    <tbody>

    </tbody>
</table>
<script>
    $(document).ready(function(){
        CATS.run();
        $('.navbar-fixed-top a[href=cats]>button').addClass('active');
    });
</script>
