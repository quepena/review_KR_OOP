<?php

require_once('/usr/share/nginx/apps/base/infograph.php');

// <!--
// while($info = mysqli_fetch_assoc($result1)) {
//   $main = $info['main'];
// }
// if($query1) {
//   infographics("lecturer", $name, $row["main"], evaluation, distance, punctuality, objectivity, politness, relevans, exams, lecture, knowledge);
// } -->

?>
<html>
<head>
    <title>Review</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Jura:wght@300&display=swap" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type="text/javascript">

        $(document).ready(function(){
            $("#b-info").click(function(){
                $("#data").toggle(false);
                $("#info").toggle();
            });
        });
        $(document).ready(function(){
            $("#b-data").click(function(){
                $("#info").toggle(false);
                $("#data").toggle();
            });
        });
    </script>
    <style type="text/css">
        body {
            font-family: 'Jura', sans-serif;
            background-color: #EEE;
        }
        header {
            font-size: 24pt;
            color: #f0f8ff;
            border: solid #2c2c2d 2px;
            background-color: #2a2a32;
            height: 10%;
            display: flex;
            margin-bottom: 1%;
            padding-left: 1%;
            align-items: center;
        }
        header img {
            height: 50px;
            width: 50px;
            margin: 0 auto;
            padding-right: 25%;
        }
        .container {
            width: 100%;
            text-align: center;
            font-size: 20pt;
        }
        #info, #data {
            display: none;
            margin-left: auto;
            margin-right: auto;
            margin-top: 3%;
            padding: 3%;
            border: solid #2a2a32 2px;
            background-color: #EEE;
            text-align: justify;
            border-radius: 20px;
            height: 340px;
            width: 80%;
        }
        button {
            margin-right: 3%;
            font-family: 'Jura', sans-serif;
            text-transform: uppercase;
            text-decoration: none;
            border: none;
            color: #FFF;
            font-size: 12pt;
            padding: 10px;
            font-weight: bold;
            background-color: #2a2a32;
            box-shadow: 2px 2px 3px #0C0C0C;
            transition: .4s;
        }
        button:hover {
            background: #5c5c6e;
            color: white;
            transform: translateY(-7px);
        }
        footer {
            position: fixed;
            font-size: 13pt;
            color: aliceblue;
            left: 0; bottom: 0;
            border: solid #2c2c2d 2px;
            background-color: #2f2f30;
            height: 7%;
            padding: 10px;
            width: 100%;
            text-align: center;
        }
        .bottom {
            padding-top: 1%;
            font-size: 17pt;
        }
    </style>
</head>
<body>
<header>
    <a href="https://opu.ua/"><img src="https://dashboard.pnit.od.ua/media/logo.svg" alt="OPU_logo"></a>
    <div class="name">Система оцінки викладачів</div>
</header>
<div class ="container">
    <button id="b-info">Інформація про систему</button>
    <button id="b-data">Список викладачів</button>
    <div id="info">
        Метою курсової роботи є вивчення принципів об’єктно-орієнтованого програмування, набуття навичок проектування та створення діаграм проектів.
        У сучасному світі багато речей змінюються та еволюціонують незалежно від того, є вони застарілими та непотрібними, чи ні. Так, застарілі системи, такі, як, наприклад, паперові в університетах поступово відходять на задній план та усе більше інформації знаходиться в цифровому вигляді. Ті папери, що зараз знаходиться в архівах, скоріш за все вже були оцифровані, чи будуть оцифровані в найближчі роки.
        Саме цю проблему вирішує запропонована курсова робота - цифровізація університету, тобто за допомогою проекту курсової роботи університет має змогу позбутися паперів та перейти до безпаперового режиму.
        Завдяки створеній в курсовій роботі системі — системі оцінки викладачів — студенти будуть мати змогу поділитися своєю думкою щодо роботи викладачів вищого навчального закладу та оцінювати їх.
    </div>
    <div id="data">
        <?php
        // require_once('/usr/share/nginx/apps/base/infograph.php');

        $link = mysqli_connect("mysql", "", "", "");

        $result=mysqli_query($link, "SELECT name FROM Teacher WHERE guid IN (SELECT teacher FROM Lecturer)");



        $i=0;
        while ($row = mysqli_fetch_assoc($result)) {
            $replName = str_ireplace(" ", "_", $row["name"]);
            $replName2 = str_ireplace(".", "", $replName);
            ?><a href="infographics/<?php echo $replName2 ?>2.png"><?php echo $row["name"] ?></a><br> <?php
            $i++;
            $name[$i] = $row["name"];
        }
        $mainAll =0; $evalAll=0; $distAll=0; $punctAll=0; $objAll=0; $politAll=0; $relevAll=0; $examsAll=0; $lectAll=0; $knowledgeAll = 0;
        for($i=1;$i<=count($name);$i++) {
            $result = mysqli_query($link, "SELECT guid FROM Teacher where name='$name[$i]'");
            while($row = $result->fetch_assoc()) {
                $guid[$i] = $row["guid"];
            }           
            $result1 = mysqli_query($link, "SELECT main, evaluation, distance, punctuality, objectivity, politeness, relevance, exams, lecture, knowledge FROM Lecturer where teacher='$guid[$i]'");
            while($row = $result1->fetch_assoc()) {
                $main[$i] = $row["main"];
                $evaluation[$i] = $row["evaluation"];
                $distance[$i] = $row["distance"];
                $punctuality[$i] = $row["punctuality"];
                $objectivity[$i] = $row["objectivity"];
                $politeness[$i] = $row["politeness"];
                $relevance[$i] = $row["relevance"];
                $exams[$i] = $row["exams"];
                $lecture[$i] = $row["lecture"];
                $knowledge[$i] = $row["knowledge"];
                $mainAll += $main[$i];
                $evalAll += $evaluation[$i];
                $distAll += $distance[$i];
                $punctAll += $punctuality[$i];
                $objAll += $objectivity[$i];
                $politAll += $politeness[$i];
                $relevAll += $relevance[$i];
                $examsAll += $exams[$i];
                $lectAll += $lecture[$i];
                $knowledgeAll += $knowledge[$i];
                $mainAvg = $mainAll/count($main);
                $evalAvg = $evalAll/count($evaluation);
                $distAvg = $distAll/count($distance);
                $punctAvg = $punctAll/count($punctuality);
                $objAvg = $objAll/count($objectivity);
                $politAvg = $politAll/count($politeness);
                $relevAvg = $relevAll/count($relevance);
                $examsAvg = $examsAll/count($exams);
                $lectAvg = $lectAll/count($lecture);
                $knowledgeAvg = $knowledgeAll/count($knowledge);
                infographics("lecturer", $name[$i], 2, 3, round($mainAvg*100, 1), round($evalAvg, 1), round($knowledgeAvg, 1), $relevAvg, $examsAvg, $lectAvg, $distAvg, $punctAvg, $objAvg, $politAvg);
            }
        }

        ?>
    </div>
</div>
<footer>
    <div class="bottom">Цифрова трансформація Одеської політехніки</div>
    <div class="date">2021</div>
</footer>
</body>
</html>
