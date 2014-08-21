
<div id="countstats">
    <table>
        <tr>
            <td><div>Tłumaczeń: <span><?=($data[0][0])?$data[0][0]:0; ?></div></td>
            <td><div>Dodanych: <span><?=($data[0][1])?$data[0][1]:0; ?></span></div></td>
            <td><div>Ćwiczeń <span><?=($data[0][2])?$data[0][2]:0; ?></span></div></td>
            <td><div>Nauczonych: <span><?=($data[0][3])?$data[0][3]:0; ?></span></div></td>
        </tr>
    </table>
</div>
<div>
    <div id="graph"></div>
</div>

<script src="js/highcharts.js"></script>
<script src="js/highstock.js"></script>
<script src="js/exporting.js"></script>
<script src="js/app/graph.js"></script>
<script>
    $('.navbar-fixed-top a[href=stats]>button').addClass('active');
</script>
