<?php
/**
 * Core bootloader
 *
 * @author Serhii Shkrabak
 */

//  require_once('/usr/share/nginx/apps/review/infographics/jpgraph/src/jpgraph.php');
//  require_once('/usr/share/nginx/apps/review/infographics/jpgraph/src/jpgraph_radar.php');
//  require_once('/usr/share/nginx/apps/review/infographics/jpgraph/src/jpgraph_bar.php');
//  require_once('/usr/share/nginx/apps/review/infographics/jpgraph/src/jpgraph_mgraph.php');
 
//  function infographics()
//  {
 
// 	 $role = "lecturer";
// 	 $teacherName = "Іванов О.В.";
 
// 	 $lecturerVotes = 14;
// 	 $practicianVotes = 4;
// 	 $rating = 77; //опитаних хочуть, щоб викладач продовжував викладати
 
// 	 $my_img = imagecreate(1280, 1280); //створюється зображення
// 	 if ($role == "lecturer") {
// 		 $background = imagecolorallocate($my_img, 8, 19, 27);
// 		 $bgcolor = "#08131B";
// 		 $graphcolor = "#25B6D4";
// 		 $ticks = "cyan";
// 		 $roleUkr = "Лектор";
 
// 		 //змінні, які використувується для побудови інфографіки для лектора
// 		 $materialsAdequacy = 2; //Достатність матеріалів
// 		 $testQuestions = 4.11; //Надання питань до заліку
// 		 $practiceAccordance = 2; //Відповідність практик лекціям
// 		 $informationAdequacy = 3; //Своєвчастність та достатність інформування
// 		 $materialsRelevance = 5; //Актуальність матеріалу
// 		 $politeness = 1; //Ввічливість
// 		 $punctuality = 5; //Пунктуальність
// 		 $objectivity = 1; //Об'єктивність
// 		 $data = array($materialsAdequacy, $testQuestions, $practiceAccordance, $informationAdequacy, $materialsRelevance, $politeness, $punctuality, $objectivity);
// 		 $titles = array('Достатність 
//   матеріалів', 'Надання питань 
// 	   до заліку', '   Відповідність 
//  практик лекціям', 'Своєвчасність та 
// 	 достатність
//    інформування', 'Актуальність матеріалу', 'Ввічливість', 'Пунктуальність', 'Об`єктивність 
//    оцінювання');
 
// 		 $lectures = 1.2; //Змістовність лекцій
// 		 $system = 2.5; //Система оцінювання
// 		 $gradesWithoutKnowledge = 4.2; //Викладач не ставить бали без знань
// 		 $knowsMaterial = 3.6; //Володіння матеріалом
// 		 $rates = array($rating, $lectures, $system, $gradesWithoutKnowledge, $knowsMaterial);
// 		 $leftDirections = array([220, 400], [130, 600], [310, 600], [130, 800], [310, 800]);
// 	 } elseif ($role == "practitian") {
// 		 $background = imagecolorallocate($my_img, 11, 18, 9);
// 		 $bgcolor = "#0B1209";
// 		 $graphcolor = "#889D2C";
// 		 $ticks = "green";
// 		 $roleUkr = "Практик";
 
// 		 //змінні, які використувується для побудови інфографіки для практика
// 		 $informationAdequacy = 3; //Своєвчастність та достатність інформування
// 		 $comfort = 5; //Зручність здачі завдань
// 		 $politeness = 1;
// 		 $punctuality = 5;
// 		 $objectivity = 1;
// 		 $data = array($informationAdequacy, $comfort, $politeness, $punctuality, $objectivity);
// 		 $titles = array('Своєвчасність та 
// 	 достатність
//    інформування', '    Зручність 
//   здачі завдань', 'Ввічливість', 'Пунктуальність', 'Об`єктивність 
//    оцінювання');
 
// 		 $gradesWithoutKnowledge = 4.2;
// 		 $knowsMaterial = 3.6;
// 		 $rates = array($rating, $knowsMaterial, $gradesWithoutKnowledge);
// 		 $leftDirections = array([220, 400], [220, 600], [220, 800]);
// 	 }
// 	 $text_colour = imagecolorallocate($my_img, 255, 255, 255);
// 	 imagettftext($my_img, 35, 0, 120, 200, $text_colour, "php7.0-gd/gd/DejaVuSans-Bold.ttf", $teacherName);
// 	 $text_colour_data = imagecolorallocate($my_img, 0, 255, 0);
// 	 imagettftext($my_img, 20, 0, 200, 280, $text_colour, "php7.0-gd/gd/DejaVuSans.ttf", " " . $roleUkr);
// 	 $ratingcolors = array(imagecolorallocate($my_img, 255, 0, 0), imagecolorallocate($my_img, 255, 51, 0), imagecolorallocate($my_img, 255, 102, 0),
// 		 imagecolorallocate($my_img, 255, 153, 0), imagecolorallocate($my_img, 255, 204, 0), imagecolorallocate($my_img, 255, 255, 0),
// 		 imagecolorallocate($my_img, 204, 255, 0), imagecolorallocate($my_img, 153, 255, 0), imagecolorallocate($my_img, 102, 255, 0), imagecolorallocate($my_img, 51, 255, 0));
 
// 	 for ($i = 0; $i <= count($rates); $i++) { //генерація значень з лівого боку інфографіки
// 		 if ($i == 0) {
// 			 $size = 50;
// 			 $leftDirections[$i][0] -= 30;
// 			 $rates[$i] .= "%";
// 			 if ($rates[$i] >= 0 && $rates[$i] < 10) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[0], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 10 && $rates[$i] < 20) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[1], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 20 && $rates[$i] < 30) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[2], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 30 && $rates[$i] < 40) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[3], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 40 && $rates[$i] < 50) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[4], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 50 && $rates[$i] < 60) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[5], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 60 && $rates[$i] < 70) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[6], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 70 && $rates[$i] < 80) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[7], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 80 && $rates[$i] < 90) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[8], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 90 && $rates[$i] <= 100) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[9], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 		 } else {
// 			 $size = 35;
// 			 if ($rates[$i] >= 0 && $rates[$i] < 0.5) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[0], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 0.5 && $rates[$i] < 1) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[1], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 1 && $rates[$i] < 1.5) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[2], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 1.5 && $rates[$i] < 2) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[3], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 2 && $rates[$i] < 2.5) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[4], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 2.5 && $rates[$i] < 3) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[5], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 3 && $rates[$i] < 3.5) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[6], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 3.5 && $rates[$i] < 4) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[7], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 4 && $rates[$i] < 4.5) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[8], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 			 elseif ($rates[$i] >= 4.5 && $rates[$i] <= 5) imagettftext($my_img, $size, 0, $leftDirections[$i][0], $leftDirections[$i][1], $ratingcolors[9], "php7.0-gd/gd/DejaVuSans-Bold.ttf", $rates[$i]);
// 		 }
// 		 if ($role == "lecturer") { //генерація надписів до значеннь
// 			 if ($i == 1) {
// 				 imagettftext($my_img, 14, 0, 180, 450, imagecolorallocate($my_img, 255, 255, 255), "php7.0-gd/gd/DejaVuSans.ttf", "Опитаних хочуть,
//    щоб викладач
// 	продовжував
// 	  викладати");
// 			 } elseif ($i == 2) {
// 				 imagettftext($my_img, 14, 0, 110, 650, imagecolorallocate($my_img, 255, 255, 255), "php7.0-gd/gd/DejaVuSans.ttf", "Змістовність
// 	  лекцій");
// 			 } elseif ($i == 3) {
// 				 imagettftext($my_img, 14, 0, 290, 650, imagecolorallocate($my_img, 255, 255, 255), "php7.0-gd/gd/DejaVuSans.ttf", "    Система
//   оцінювання");
// 			 } elseif ($i == 4) {
// 				 imagettftext($my_img, 14, 0, 110, 850, imagecolorallocate($my_img, 255, 255, 255), "php7.0-gd/gd/DejaVuSans.ttf", " Викладач не
//  ставить бали
//    без знань");
// 			 } elseif ($i == 5) {
// 				 imagettftext($my_img, 14, 0, 290, 850, imagecolorallocate($my_img, 255, 255, 255), "php7.0-gd/gd/DejaVuSans.ttf", "  Володіння
//   матеріалом");
// 			 }
// 		 } elseif ($role == "practitian") {
// 			 if ($i == 1) {
// 				 imagettftext($my_img, 14, 0, 180, 450, imagecolorallocate($my_img, 255, 255, 255), "/usr/share/nginx/apps/review/infographics/php7.0-gd/gd/DejaVuSans.ttf", "Опитаних хочуть,
//    щоб викладач
// 	продовжував
// 	  викладати");
// 			 } elseif ($i == 2) {
// 				 imagettftext($my_img, 14, 0, 200, 650, imagecolorallocate($my_img, 255, 255, 255), "/usr/share/nginx/apps/review/infographics/php7.0-gd/gd/DejaVuSans.ttf", "  Володіння
//   матеріалом");
// 			 } elseif ($i == 3) {
// 				 imagettftext($my_img, 14, 0, 200, 850, imagecolorallocate($my_img, 255, 255, 255), "/usr/share/nginx/apps/review/infographics/php7.0-gd/gd/DejaVuSans.ttf", " Викладач не
//  ставить бали
//    без знань");
// 			 }
// 		 }
// 	 }
 
// 	 imagettftext($my_img, 25, 0, 220, 1050, imagecolorallocate($my_img, 255, 255, 255), "/usr/share/nginx/apps/review/infographics/php7.0-gd/gd/DejaVuSans-Bold.ttf", $lecturerVotes . "/" . $practicianVotes);
// 	 imagettftext($my_img, 18, 0, 130, 1100, imagecolorallocate($my_img, 255, 255, 255), "/usr/share/nginx/apps/review/infographics/php7.0-gd/gd/DejaVuSans.ttf", "Кількість опитуваних
// 	(лектор/практик)");
// 	 $today = date("Y");
// 	 imagettftext($my_img, 18, 0, 610, 1200, imagecolorallocate($my_img, 255, 255, 255), "php7.0-gd/gd/DejaVuSans.ttf", $today);
 
// 	 imagepng($my_img, "infographics/image.png"); //зберігається зображення, яке стає фоном для зображень із інфографіками, а після використання видаляється

// 	 $graph = new RadarGraph (1100, 1100);
 
// 	 $graph->SetTitles($titles);
// 	 $graph->SetCenter(450, 550);
// 	 $graph->HideTickMarks();
// 	 $graph->SetColor($bgcolor);
// 	 $graph->axis->SetColor('white');
// 	 $graph->grid->SetColor('white');
// 	 $graph->axis->title->SetColor('white');
// 	 $graph->grid->Show();
// 	 $graph->SetFrame(true, 'black', 0);
// 	 $graph->SetBackgroundGradient($bgcolor, $bgcolor);
 
// 	 $graph->axis->title->SetFont(FF_DEFAULT, FS_NORMAL, 12);
// 	 $graph->axis->title->SetMargin(20);
// 	 $graph->SetGridDepth(DEPTH_BACK);
// 	 $graph->SetSize(0.4);
 
// 	 $plot = new RadarPlot($data);
// 	 $plot->SetColor('white');
// 	 $plot->SetLineWeight(1);
// 	 $plot->SetFillColor($graphcolor . "@0.7");
 
// 	 $plot->mark->SetType(MARK_IMG_SBALL, $ticks);
// 	 $graph->add($plot);
 
// 	 $grade1 = 3; //змінні для першої стовпчикової діаграми
// 	 $grade2 = 12;
// 	 $grade3 = 3;
// 	 $grade4 = 1;
// 	 $grade5 = 1;
 
// 	 $selfRate1 = 1; //змінні для другої стовпчикової діаграми
// 	 $selfRate2 = 7;
// 	 $selfRate3 = 2;
// 	 $selfRate4 = 9;
// 	 $selfRate5 = 1;
 
// 	 $datay = array([$grade1, $grade2, $grade3, $grade4, $grade5], [$selfRate1, $selfRate2, $selfRate3, $selfRate4, $selfRate5]);
 
// 	 $graph1 = new Graph(350, 350);
// 	 $graph1->SetScale('textint');
 
// 	 $graph1->SetMargin(40, 30, 20, 40);
 
// 	 $graph1->SetBox(false);
 
// 	 $bplot = new BarPlot($datay[0]);
 
// 	 $graph1->Add($bplot);
// 	 $bplot->SetFillColor($graphcolor);
// 	 $bplot->SetColor($graphcolor);
// 	 $bplot->SetWidth(40);
// 	 $graph1->title->Set('A basic bar graph');
// 	 $graph1->title->SetColor($bgcolor);
// 	 $graph1->xaxis->title->Set('Задоволення викладанням    
// 			  дисципліни
// 	 ');
// 	 $graph1->title->SetFont(FF_DEFAULT, FS_BOLD);
// 	 $graph1->ygrid->SetColor($bgcolor);
// 	 $graph1->ygrid->SetFill(true, $bgcolor, $bgcolor);
// 	 $graph1->xaxis->title->SetFont(FF_DEFAULT, FS_NORMAL, 12);
// 	 $graph1->xaxis->title->SetColor("white");
// 	 $graph1->xaxis->SetColor("white");
// 	 $graph1->yaxis->SetColor("white");
// 	 $graph1->xaxis->SetFont(FF_DEFAULT, FS_BOLD, 10);
// 	 $graph1->yaxis->SetFont(FF_DEFAULT, FS_BOLD, 10);
// 	 $graph1->SetBackgroundGradient($bgcolor, $bgcolor);
 
// 	 if ($role == "lecturer") { //для практика не потрібно другої стовпчикової діаграми, тому вона будується лише для лектора
 
// 		 $graph2 = new Graph(350, 350);
// 		 $graph2->SetScale('textint');
 
// 		 $graph2->SetMargin(40, 30, 20, 40);
 
// 		 $graph2->SetBox(false);
 
// 		 $bplot2 = new BarPlot($datay[1]);
 
// 		 $graph2->Add($bplot2);
// 		 $bplot2->SetFillColor($graphcolor);
// 		 $bplot2->SetWidth(40);
// 		 $bplot2->SetColor($graphcolor);
// 		 $graph2->title->Set('A basic bar graph');
// 		 $graph2->title->SetColor($bgcolor);
// 		 $graph2->xaxis->title->Set('Самооцінка власних знань    
//   після проходження курсу
// 	 ');
// 		 $graph2->title->SetFont(FF_DEFAULT, FS_BOLD);
// 		 $graph2->ygrid->SetColor($bgcolor);
// 		 $graph2->ygrid->SetFill(true, $bgcolor, $bgcolor);
// 		 $graph2->xaxis->title->SetFont(FF_DEFAULT, FS_NORMAL, 12);
// 		 $graph2->xaxis->title->SetColor("white");
// 		 $graph2->xaxis->SetColor("white");
// 		 $graph2->yaxis->SetColor("white");
// 		 $graph2->xaxis->SetFont(FF_DEFAULT, FS_BOLD, 10);
// 		 $graph2->yaxis->SetFont(FF_DEFAULT, FS_BOLD, 10);
// 		 $graph2->SetBackgroundGradient($bgcolor, $bgcolor);
// 	 }
 
// 	 $mgraph = new MGraph(1280, 1280);
// 	 $xpos1 = 420;
// 	 $ypos1 = -200;
// 	 if ($role == "lecturer") {
// 		 $xpos2 = 550;
// 		 $ypos2 = 700;
// 		 $xpos3 = 925;
// 		 $ypos3 = 700;
// 		 $mgraph->Add($graph, $xpos1, $ypos1);
// 		 $mgraph->Add($graph1, $xpos2, $ypos2);
// 		 $mgraph->Add($graph2, $xpos3, $ypos3);
// 	 } elseif ($role == "practitian") {
// 		 $xpos2 = 700;
// 		 $ypos2 = 700;
// 		 $mgraph->Add($graph, $xpos1, $ypos1);
// 		 $mgraph->Add($graph1, $xpos2, $ypos2);
// 	 }
// 	 $mgraph->SetBackgroundImage("infographics/image.png");
// 	 $mgraph->Stroke();
// 	 $mgraph->Stroke($role . "image" . ($practicianVotes + $lecturerVotes) . ".png"); //готова інфографіка
// 	//  unlink("infographics/image.png"); //видаляється фонове зображення
 
//  }

?>

<html>
  <head>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Slab:wght@200&display=swap" rel="stylesheet">
    <style>
      body {
        font-family: 'Roboto Slab', serif;
        font-size: 25px;
      }

      header {
        border: solid #e0e9fb 2px;
        height: 10%;
        margin-bottom: 1%;
        display: flex;
        align-items: center;
        padding-left: 1%;
        background-color: #e0e9fb;
      }

      header img {
        height: 73.7px;
        width: 67.2px;
        margin-right: 5rem;
      }

      .name {
        font-size: 40px;
      }

      .main {
        display: flex;
        justify-content: space-between;
        padding: 1%;
      }

      .left {
        border: solid #e0e9fb 2px;
        background-color: #e0e9fb;
        height: 70%;
        width: 55%;
        border-radius: 20px;
      }

      .left img {
        height: 50%;
        width: 20%;
      }

      .text {
        padding: 3% 3% 0 3%;
      }

      #first {
        float: left;
        padding: 3%;
      }

      #second {
        float: right;
        padding: 3% 3% 0 3%;
      }

      .right {
        border: solid #e0e9fb 2px;
        background-color: #e0e9fb;
        height: 70%;
        width: 40%;
        text-align: center;
        border-radius: 20px;
      }

      .right a {
        text-decoration: none;
        font-size: 27px;
        position: relative;
        top: 8em;
        bottom: 8em;
      }

      .item {
        border: 2px;
        padding: 3%;
        margin: 0 40% 0 40%;
      }

      .item:hover {
        background-color: #739fee;
        color: #e0e9fb;
      }

      footer {
        border: solid #e0e9fb 2px;
        background-color: #e0e9fb;
        height: 11%;
        margin-top: 1%;
        text-align: center;
      }

      .author {
        margin-top: 2%;
      }
    </style>
  </head>

  <body>
    <header>
      <a href="https://review2.pnit.od.ua/index.php"><img src="https://static.tildacdn.com/tild6230-3635-4631-a234-343936626562/logoics.png" alt=""></a>
      <div class="name">Система оцінки викладачів</div>
    </header>
    <div class="main">
      <div class="left">
        <h3 align="center">Система оцінки викладачів</h3>
        <div class="text" align = "justify">
          Метою курсової роботи є вивчення принципів об’єктно-орієнтованого програмування, набуття навичок проектування та створення діаграм проектів.
        </div>
        <div class="text" align = "justify">
          У сучасному світі багато речей змінюються та еволюціонують незалежно від того, є вони застарілими та непотрібними, чи ні. Так, застарілі системи, такі, як, наприклад, паперові в університетах поступово відходять на задній план та усе більше інформації знаходиться в цифровому вигляді. Ті папери, що зараз знаходяться в архівах, скоріш за все вже були оцифровані, чи будуть оцифровані в найближчі роки.
        </div>
        <div class="text" align = "justify">
          Саме цю проблему вирішує запропонована курсова робота - цифровізація університету, тобто за допомогою проекту курсової роботи університет має змогу позбутися паперів та перейти до безпаперового режиму.
        </div>
      </div>
      <div class="right">
        <a href="https://review.pnit.od.ua/index.php">
          <div class="item">Review</div>
        </a>
        <a href="https://review1.pnit.od.ua/index.php">
          <div class="item">Review1</div>
        </a>
        <a href="https://review2.pnit.od.ua/index.php">
          <div class="item">Review2</div>
        </a>
      </div>
    </div>
    <footer>
      <div class="author">Telegram: @OdesaPolytechnicBot</div>
    </footer>
  </body>
</html>