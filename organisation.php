<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>DATÀC – Plan du site</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css"/>
    <link id="css" rel="stylesheet" href="mise_en_forme.css"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script href="bootstrap/js/bootstrap.js"></script>
    <script href="bootstrap/js/npm.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
    <!-- import pour zoom sur images -->
    <link href="fancybox-3.0/fancybox-3.0/dist/jquery.fancybox.css" rel="stylesheet">
    <script src="fancybox-3.0/fancybox-3.0/dist/jquery.fancybox.js"></script>
    <!-- import pour images dynamiques responsives -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jQuery-rwdImageMaps/1.6/jquery.rwdImageMaps.js"></script>
</head>
<body>
<!--container-fluid : div avec possibilitée de placement des éléments grâce à bootstrap (row, col,...);les éléments remplissent tout l'écran-->
<div class="container-fluid">

    <!--header = bannière blance avec logos, connexion et recherche + titre sur fond bleu-->
    <?php include ("header.php"); ?>

    <!--suite bannière bleu (après titre)-->
    <div class="row" id="rArianne">
        <!--Fil d’Ariane-->
        <p class="ariane col-sm-offset-1">
            <a class="ariane" href="accueil.php">Accueil</a> // Plan du site
        </p>
    </div>

    <!--fond bleu penché-->
    <div class="row penche"></div>
    <!--fond gris penché haut-->
    <div class="row pencheSect"></div>

    <!--bannière grise avec organnigrammes et liens pour les téléchargements-->
    <section class="row" id="rSect">
        <article>
            <br>
            <fieldset>
                <h2 class="sousTitre">Plan du site</h2><br>
                <p class="col-sm-offset-1 col-sm-10 txtOrga">
                    Le plan s’articule actuellement autour de 5 déficiences. Les organigrammes ci-dessous
                    représentent l’architecture au sein de ces 5 déficiences. Ceux-ci permettent de connaître
                    l’ensemble des chemins possibles à partir d’une déficience. Toute catégorie peut
                    contenir des dispositifs, mais généralement ce sont les dernières catégories qui
                    possèdent des dispositifs.
                </p>
            </fieldset>
            <br>

            <!-- affichage des organigrammes -->

            <!-- import de l'image-->
                <img src="images/organigramme/1.png" width="1373" height="1351" border="0" usemap="#map1" class=" col-sm-offset-3 col-xs-offset-3 img-responsive imgOrga organigrammeSpeUn" />

            <!--placement des liens sur l'image-->
                <map name="map1">
                    <area shape="rect" coords="17,652,504,731" href="deficience.php?idDef=1" />
                    <area shape="rect" coords="537,131,996,185" href="categorie.php?idCat=1&niv=1" />
                    <area shape="rect" coords="536,303,828,354" href="categorie.php?idCat=8&niv=1" />
                    <area shape="rect" coords="537,410,774,461" href="categorie.php?idCat=11&niv=1" />
                    <area shape="rect" coords="537,562,681,614" href="categorie.php?idCat=15&niv=1" />
                    <area shape="rect" coords="537,715,836,766" href="categorie.php?idCat=21&niv=1" />
                    <area shape="rect" coords="536,921,725,973" href="categorie.php?idCat=25&niv=1" />
                    <area shape="rect" coords="536,1202,944,1253" href="categorie.php?idCat=34&niv=1" />
                    <area shape="rect" coords="1026,55,1337,87" href="categorie.php?idCat=2&niv=2" />
                    <area shape="rect" coords="1026,92,1229,116" href="categorie.php?idCat=3&niv=2" />
                    <area shape="rect" coords="1027,127,1195,154" href="categorie.php?idCat=4&niv=2" />
                    <area shape="rect" coords="1027,162,1312,191" href="categorie.php?idCat=5&niv=2" />
                    <area shape="rect" coords="1025,197,1171,226" href="categorie.php?idCat=6&niv=2" />
                    <area shape="rect" coords="1029,236,1249,260" href="categorie.php?idCat=7&niv=2" />
                    <area shape="rect" coords="855,280,1167,304" href="categorie.php?idCat=9&niv=2" />
                    <area shape="rect" coords="854,314,1018,343" href="categorie.php?idCat=10&niv=2" />
                    <area shape="rect" coords="798,367,1000,395" href="categorie.php?idCat=12&niv=2" />
                    <area shape="rect" coords="799,404,948,431" href="categorie.php?idCat=13&niv=2" />
                    <area shape="rect" coords="798,441,986,468" href="categorie.php?idCat=14&niv=2" />
                    <area shape="rect" coords="712,485,1047,510" href="categorie.php?idCat=16&niv=2" />
                    <area shape="rect" coords="711,521,1013,548" href="categorie.php?idCat=17&niv=2" />
                    <area shape="rect" coords="713,558,986,586" href="categorie.php?idCat=18&niv=2" />
                    <area shape="rect" coords="710,594,1044,619" href="categorie.php?idCat=19&niv=2" />
                    <area shape="rect" coords="710,630,1166,657" href="categorie.php?idCat=20&niv=2" />
                    <area shape="rect" coords="864,674,1124,703" href="categorie.php?idCat=22&niv=2" />
                    <area shape="rect" coords="865,710,1126,738" href="categorie.php?idCat=23&niv=2" />
                    <area shape="rect" coords="865,745,1088,776" href="categorie.php?idCat=24&niv=2" />
                    <area shape="rect" coords="753,787,1073,822" href="categorie.php?idCat=26&niv=2" />
                    <area shape="rect" coords="753,827,952,857" href="categorie.php?idCat=27&niv=2" />
                    <area shape="rect" coords="753,863,1264,891" href="categorie.php?idCat=28&niv=2" />
                    <area shape="rect" coords="755,901,1092,927" href="categorie.php?idCat=29&niv=2" />
                    <area shape="rect" coords="756,936,1247,963" href="categorie.php?idCat=30&niv=2" />
                    <area shape="rect" coords="756,974,1276,1002" href="categorie.php?idCat=31&niv=2" />
                    <area shape="rect" coords="755,1009,982,1036" href="categorie.php?idCat=32&niv=2" />
                    <area shape="rect" coords="756,1046,1087,1070" href="categorie.php?idCat=33&niv=2" />
                    <area shape="rect" coords="965,1087,1202,1118" href="categorie.php?idCat=35&niv=2" />
                    <area shape="rect" coords="970,1124,1148,1154" href="categorie.php?idCat=36&niv=2" />
                    <area shape="rect" coords="969,1162,1139,1188" href="categorie.php?idCat=37&niv=2" />
                    <area shape="rect" coords="973,1197,1168,1224" href="categorie.php?idCat=38&niv=2" />
                    <area shape="rect" coords="973,1232,1353,1262" href="categorie.php?idCat=39&niv=2" />
                    <area shape="rect" coords="972,1268,1129,1295" href="categorie.php?idCat=40&niv=2" />
                    <area shape="rect" coords="974,1305,1236,1331" href="categorie.php?idCat=41&niv=2" />
                </map>

            <br>



            <!-- import de l'image-->
                <img src="images/organigramme/2.png" width="2045" height="1136" border="0" usemap="#map2" class="col-sm-offset-2 col-xs-offset-2 img-responsive imgOrga organigramme"/>
            <!--placement des liens sur l'image-->
                <map name="map2" id="map2">
                    <area shape="rect" coords="15,525,510,607" href="deficience.php?idDef=2" />
                    <area shape="rect" coords="542,204,917,255" href="categorie.php?idCat=42&niv=1" />
                    <area shape="rect" coords="541,446,949,498" href="categorie.php?idCat=57&niv=1" />
                    <area shape="rect" coords="541,616,842,668" href="categorie.php?idCat=64&niv=1" />
                    <area shape="rect" coords="541,877,961,930" href="categorie.php?idCat=68&niv=1" />
                    <area shape="rect" coords="930,49,1158,83" href="categorie.php?idCat=43&niv=2" />
                    <area shape="rect" coords="937,197,1174,227" href="categorie.php?idCat=47&niv=2" />
                    <area shape="rect" coords="941,344,1106,372" href="categorie.php?idCat=56&niv=2" />
                    <area shape="rect" coords="972,389,1146,417" href="categorie.php?idCat=58&niv=2" />
                    <area shape="rect" coords="977,426,1169,452" href="categorie.php?idCat=59&niv=2" />
                    <area shape="rect" coords="977,496,1148,522" href="categorie.php?idCat=60&niv=2" />
                    <area shape="rect" coords="869,575,1099,604" href="categorie.php?idCat=65&niv=2" />
                    <area shape="rect" coords="870,612,1125,640" href="categorie.php?idCat=66&niv=2" />
                    <area shape="rect" coords="870,647,1134,677" href="categorie.php?idCat=67&niv=2" />
                    <area shape="rect" coords="987,767,1325,795" href="categorie.php?idCat=69&niv=2" />
                    <area shape="rect" coords="988,982,1405,1010" href="categorie.php?idCat=75&niv=2" />
                    <area shape="rect" coords="1185,21,1571,46" href="categorie.php?idCat=44&niv=3" />
                    <area shape="rect" coords="1187,56,1559,84" href="categorie.php?idCat=45&niv=3" />
                    <area shape="rect" coords="1188,91,1721,118" href="categorie.php?idCat=46&niv=3" />
                    <area shape="rect" coords="1198,142,1436,172" href="categorie.php?idCat=48&niv=3" />
                    <area shape="rect" coords="1201,252,1499,281" href="categorie.php?idCat=51&niv=3" />
                    <area shape="rect" coords="1175,459,1567,489" href="categorie.php?idCat=61&niv=3" />
                    <area shape="rect" coords="1180,498,1615,523" href="categorie.php?idCat=62&niv=3" />
                    <area shape="rect" coords="1179,531,1487,558" href="categorie.php?idCat=63&niv=3" />
                    <area shape="rect" coords="1355,693,1621,721" href="categorie.php?idCat=70&niv=3" />
                    <area shape="rect" coords="1358,728,1642,757" href="categorie.php?idCat=71&niv=3" />
                    <area shape="rect" coords="1359,765,1652,795" href="categorie.php?idCat=72&niv=3" />
                    <area shape="rect" coords="1362,802,1662,828" href="categorie.php?idCat=73&niv=3" />
                    <area shape="rect" coords="1360,836,1869,866" href="categorie.php?idCat=74&niv=3" />
                    <area shape="rect" coords="1432,873,1727,900" href="categorie.php?idCat=76&niv=3" />
                    <area shape="rect" coords="1434,909,1749,936" href="categorie.php?idCat=77&niv=3" />
                    <area shape="rect" coords="1435,946,1773,973" href="categorie.php?idCat=78&niv=3" />
                    <area shape="rect" coords="1434,983,1780,1009" href="categorie.php?idCat=79&niv=3" />
                    <area shape="rect" coords="1436,1018,1736,1045" href="categorie.php?idCat=80&niv=3" />
                    <area shape="rect" coords="1439,1054,1760,1083" href="categorie.php?idCat=81&niv=3" />
                    <area shape="rect" coords="1437,1089,2019,1117" href="categorie.php?idCat=82&niv=3" />
                    <area shape="rect" coords="1464,127,1874,154" href="categorie.php?idCat=49&niv=4" />
                    <area shape="rect" coords="1465,162,2025,190" href="categorie.php?idCat=50&niv=4" />
                    <area shape="rect" coords="1530,197,1843,225" href="categorie.php?idCat=52&niv=4" />
                    <area shape="rect" coords="1532,237,1942,263" href="categorie.php?idCat=53&niv=4" />
                    <area shape="rect" coords="1534,269,1738,299" href="categorie.php?idCat=54&niv=4" />
                    <area shape="rect" coords="1534,306,1885,337" href="categorie.php?idCat=55&niv=4" />
                </map>

            <br>


            <!-- import de l'image-->
                <img src="images/organigramme/3.png" width="2072" height="1217" border="0" usemap="#map3" class="col-sm-offset-2 col-xs-offset-2 img-responsive imgOrga organigramme"/>

            <!--placement des liens sur l'image-->
                <map name="map3">
                    <area shape="rect" coords="16,613,500,692" href="deficience.php?idDef=3" />
                    <area shape="rect" coords="534,149,983,201" href="categorie.php?idCat=83&niv=1" />
                    <area shape="rect" coords="532,338,1079,391" href="categorie.php?idCat=91&niv=1" />
                    <area shape="rect" coords="533,510,833,560" href="categorie.php?idCat=99&niv=1" />
                    <area shape="rect" coords="533,789,1350,841" href="categorie.php?idCat=103&niv=1" />
                    <area shape="rect" coords="533,1103,942,1157" href="categorie.php?idCat=119&niv=1" />
                    <area shape="rect" coords="961,1029,1190,1058" href="categorie.php?idCat=120&niv=2" />
                    <area shape="rect" coords="963,1065,1219,1091" href="categorie.php?idCat=121&niv=2" />
                    <area shape="rect" coords="967,1098,1227,1127" href="categorie.php?idCat=122&niv=2" />
                    <area shape="rect" coords="967,1134,1324,1162" href="categorie.php?idCat=123&niv=2" />
                    <area shape="rect" coords="969,1171,1138,1197" href="categorie.php?idCat=124&niv=2" />
                    <area shape="rect" coords="1372,587,1513,615" href="categorie.php?idCat=104&niv=2" />
                    <area shape="rect" coords="1372,656,1557,687" href="categorie.php?idCat=105&niv=2" />
                    <area shape="rect" coords="1372,781,1560,813" href="categorie.php?idCat=109&niv=2" />
                    <area shape="rect" coords="1375,907,1651,938" href="categorie.php?idCat=114&niv=2" />
                    <area shape="rect" coords="1377,978,1746,1010" href="categorie.php?idCat=118&niv=2" />
                    <area shape="rect" coords="1577,622,1757,651" href="categorie.php?idCat=106&niv=3" />
                    <area shape="rect" coords="1580,659,1704,687" href="categorie.php?idCat=107&niv=3" />
                    <area shape="rect" coords="1582,694,1696,722" href="categorie.php?idCat=108&niv=3" />
                    <area shape="rect" coords="1588,730,1765,756" href="categorie.php?idCat=110&niv=3" />
                    <area shape="rect" coords="1591,766,1738,793" href="categorie.php?idCat=111&niv=3" />
                    <area shape="rect" coords="1592,800,1832,829" href="categorie.php?idCat=112&niv=3" />
                    <area shape="rect" coords="1593,839,1901,863" href="categorie.php?idCat=113&niv=3" />
                    <area shape="rect" coords="1674,874,1940,901" href="categorie.php?idCat=115&niv=3" />
                    <area shape="rect" coords="1679,912,1893,937" href="categorie.php?idCat=116&niv=3" />
                    <area shape="rect" coords="1681,946,2052,972" href="categorie.php?idCat=117&niv=3" />
                    <area shape="rect" coords="851,468,1092,497" href="categorie.php?idCat=100&niv=2" />
                    <area shape="rect" coords="853,504,1114,535" href="categorie.php?idCat=101&niv=2" />
                    <area shape="rect" coords="856,543,1124,569" href="categorie.php?idCat=102&niv=2" />
                    <area shape="rect" coords="1100,244,1208,271" href="categorie.php?idCat=92&niv=2" />
                    <area shape="rect" coords="1238,243,1471,272" href="categorie.php?idCat=93&niv=3" />
                    <area shape="rect" coords="1105,281,1276,308" href="categorie.php?idCat=94&niv=2" />
                    <area shape="rect" coords="1106,318,1614,343" href="categorie.php?idCat=95&niv=2" />
                    <area shape="rect" coords="1110,356,1502,381" href="categorie.php?idCat=96&niv=2" />
                    <area shape="rect" coords="1108,388,1265,416" href="categorie.php?idCat=97&niv=2" />
                    <area shape="rect" coords="1110,425,1450,451" href="categorie.php?idCat=98&niv=2" />
                    <area shape="rect" coords="1007,197,1243,227" href="categorie.php?idCat=90&niv=2" />
                    <area shape="rect" coords="1009,88,1378,117" href="categorie.php?idCat=84&niv=2" />
                    <area shape="rect" coords="1408,17,1940,48" href="categorie.php?idCat=85&niv=3" />
                    <area shape="rect" coords="1410,56,1773,84" href="categorie.php?idCat=86&niv=3" />
                    <area shape="rect" coords="1412,93,1864,118" href="categorie.php?idCat=87&niv=3" />
                    <area shape="rect" coords="1414,126,1785,155" href="categorie.php?idCat=88&niv=3" />
                    <area shape="rect" coords="1416,163,1879,192" href="categorie.php?idCat=89&niv=3" />
                </map>

            <br>


            <!-- import de l'image-->
                <img src="images/organigramme/4.png" width="1722" height="1073" border="0" usemap="#map4" class="col-sm-offset-2 col-xs-offset-2 img-responsive imgOrga organigramme" />

            <!--placement des liens sur l'image-->
                <map name="map4">
                    <area shape="rect" coords="16,394,519,520" href="deficience.php?idDef=4" />
                    <area shape="rect" coords="552,60,852,110" href="categorie.php?idCat=125&niv=1" />
                    <area shape="rect" coords="551,195,741,246" href="categorie.php?idCat=129&niv=1" />
                    <area shape="rect" coords="551,383,696,435" href="categorie.php?idCat=134&niv=1" />
                    <area shape="rect" coords="551,554,1081,606" href="categorie.php?idCat=141&niv=1" />
                    <area shape="rect" coords="551,803,960,852" href="categorie.php?idCat=145&niv=1" />
                    <area shape="rect" coords="974,633,1085,662" href="categorie.php?idCat=146&niv=2" />
                    <area shape="rect" coords="983,723,1261,750" href="categorie.php?idCat=147&niv=2" />
                    <area shape="rect" coords="984,810,1341,842" href="categorie.php?idCat=152&niv=2" />
                    <area shape="rect" coords="985,848,1224,877" href="categorie.php?idCat=153&niv=2" />
                    <area shape="rect" coords="980,964,1164,993" href="categorie.php?idCat=154&niv=2" />
                    <area shape="rect" coords="1181,1025,1335,1056" href="categorie.php?idCat=160&niv=3" />
                    <area shape="rect" coords="1186,993,1561,1020" href="categorie.php?idCat=159&niv=3" />
                    <area shape="rect" coords="1191,954,1404,982" href="categorie.php?idCat=158&niv=3" />
                    <area shape="rect" coords="1189,901,1462,930" href="categorie.php?idCat=155&niv=3" />
                    <area shape="rect" coords="1486,883,1699,910" href="categorie.php?idCat=156&niv=4" />
                    <area shape="rect" coords="1490,921,1702,946" href="categorie.php?idCat=157&niv=4" />
                    <area shape="rect" coords="1279,667,1417,696" href="categorie.php?idCat=148&niv=3" />
                    <area shape="rect" coords="1281,704,1391,730" href="categorie.php?idCat=149&niv=3" />
                    <area shape="rect" coords="1281,741,1382,769" href="categorie.php?idCat=150&niv=3" />
                    <area shape="rect" coords="1281,776,1375,802" href="categorie.php?idCat=151&niv=3" />
                    <area shape="rect" coords="1099,514,1207,545" href="categorie.php?idCat=142&niv=2" />
                    <area shape="rect" coords="1101,550,1215,580" href="categorie.php?idCat=143&niv=2" />
                    <area shape="rect" coords="1103,586,1253,615" href="categorie.php?idCat=144&niv=2" />
                    <area shape="rect" coords="723,286,997,317" href="categorie.php?idCat=135&niv=2" />
                    <area shape="rect" coords="723,325,1085,352" href="categorie.php?idCat=136&niv=2" />
                    <area shape="rect" coords="725,362,1189,389" href="categorie.php?idCat=137&niv=2" />
                    <area shape="rect" coords="727,398,1059,423" href="categorie.php?idCat=138&niv=2" />
                    <area shape="rect" coords="727,432,979,462" href="categorie.php?idCat=139&niv=2" />
                    <area shape="rect" coords="728,471,1199,496" href="categorie.php?idCat=140&niv=2" />
                    <area shape="rect" coords="762,136,1068,165" href="categorie.php?idCat=130&niv=2" />
                    <area shape="rect" coords="764,173,1195,200" href="categorie.php?idCat=131&niv=2" />
                    <area shape="rect" coords="767,209,1052,236" href="categorie.php?idCat=132&niv=2" />
                    <area shape="rect" coords="769,245,1279,271" href="categorie.php?idCat=133&niv=2" />
                    <area shape="rect" coords="872,15,1146,47" href="categorie.php?idCat=126&niv=2" />
                    <area shape="rect" coords="874,52,1144,82" href="categorie.php?idCat=127&niv=2" />
                    <area shape="rect" coords="876,90,1110,119" href="categorie.php?idCat=128&niv=2" />
                </map>

            <br>


            <!-- import de l'image-->
                <img src="images/organigramme/5.png" class="col-sm-offset-2 col-xs-offset-2 img-responsive imgOrga organigramme"   width="1538" height="551" border="0" usemap="#map5" />

            <!--placement des liens sur l'image-->
                <map name="map5">
                    <area shape="rect" coords="17,239,571,364" href="deficience.php?idDef=5" />
                    <area shape="rect" coords="605,79,989,129" href="categorie.php?idCat=161&niv=1" />
                    <area shape="rect" coords="604,287,749,336" href="categorie.php?idCat=166&niv=1" />
                    <area shape="rect" coords="605,474,793,525" href="categorie.php?idCat=174&niv=1" />
                    <area shape="rect" coords="1005,16,1264,48" href="categorie.php?idCat=162&niv=2" />
                    <area shape="rect" coords="1016,56,1517,84" href="categorie.php?idCat=163&niv=2" />
                    <area shape="rect" coords="1017,92,1493,121" href="categorie.php?idCat=164&niv=2" />
                    <area shape="rect" coords="1018,129,1467,157" href="categorie.php?idCat=165&niv=2" />
                    <area shape="rect" coords="775,172,1287,200" href="categorie.php?idCat=167&niv=2" />
                    <area shape="rect" coords="776,208,1257,237" href="categorie.php?idCat=168&niv=2" />
                    <area shape="rect" coords="778,243,1274,273" href="categorie.php?idCat=169&niv=2" />
                    <area shape="rect" coords="778,280,1100,308" href="categorie.php?idCat=170&niv=2" />
                    <area shape="rect" coords="778,315,989,344" href="categorie.php?idCat=171&niv=2" />
                    <area shape="rect" coords="780,352,1049,381" href="categorie.php?idCat=172&niv=2" />
                    <area shape="rect" coords="780,386,1035,418" href="categorie.php?idCat=173&niv=2" />
                    <area shape="rect" coords="816,435,1333,462" href="categorie.php?idCat=175&niv=2" />
                    <area shape="rect" coords="817,505,1155,535" href="categorie.php?idCat=176&niv=2" />
                    <area shape="rect" coords="817,468,1360,498" href="categorie.php?idCat=177&niv=2" />
                </map>

            <br>
            <fieldset>

                <!-- lien de téléchargement des organigrammes -->
                <h2 class="sousTitre">Téléchargement des organigrammes</h2><br>
                <ul class="col-sm-offset-1 col-sm-10 txtOrga">
                    <li>Télécharger l&rsquo;organigramme des <a href="images/organigramme/1.xmind">d&eacute;ficiences visuelles</a> au format Xmind</li>
                    <li>Télécharger l&rsquo;organigramme des <a href="images/organigramme/2.xmind">d&eacute;ficiences auditives</a> au format Xmind</li>
                    <li>Télécharger l&rsquo;organigramme des <a href="images/organigramme/3.xmind">d&eacute;ficiences motrices</a> au format Xmind</li>
                    <li>Télécharger l&rsquo;organigramme des <a href="images/organigramme/4.xmind">d&eacute;ficiences mentales et psychiques</a> au format Xmind</li>
                    <li>Télécharger l&rsquo;organigramme des <a href="images/organigramme/5.xmind">d&eacute;ficiences de la parole et du langage</a> au format Xmind</li>
                    <li>Télécharger l&rsquo;<a href="images/organigramme/global.xmind">organigramme global</a> au format Xmind</li>
                </ul>
            </fieldset>
            <br/>
        </article>
    </section>
    <footer class="row">
        <div class="col-lg-12">
            <?php include("bas.php"); ?>
        </div>
    </footer>
    </div>
</div>
<!-- definition de la flèche précédent (retour à accueil) -->
<a class="pagePreced" href="accueil.php"><img class="logoRetour" src="images/retour_fleche.png"> </a>
</body>

<!--fonction pour avoir les images responsives-->
<script>
    $(document).ready(function() {
        $('img[usemap]').rwdImageMaps();
    });
</script>
</html>