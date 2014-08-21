<style>
    body {
        margin: 0;
        overflow: hidden;
    }
    #webtranslate {
        border: 0;
        overflow: hidden;
        width: 100%;
        height: 100%;
    }
</style>


<script src="http://127.0.0.1/angielski/app/js/jquery-1.9.1.min.js"></script>
<iframe id="webtranslate"></iframe>

<script>
    $.get('http://127.0.0.1/angielski/app/webtranslate/<?php echo $id; ?>', function(data) {
        console.log(data);
        $('#webtranslate').contents().find('html').html(data)
    });
</script>

<!--  src="<?php echo $id; ?>" -->