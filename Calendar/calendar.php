
<?php

/*

Да се създаде работещ календар. За целта трябва да бъдат изпълнени следните условия:

1. При избран месец от падащото меню и попълнена година в полето - да се визуализира календар за въпросните месец и година
2. Ако не е избран месец или година, да се използват текущите (пример: ноември, 2021)
3. Месецът и годината, за които е показан календар да са попълнени в падащото меню и полето за година
3. При натискане на бутон "Today" да се показва календар за текущите месец и година
5. В първия ред на календара да има:
  1. Стрелка на ляво, която да показва предишния месец при кликване
  2. Текст с името на месеца и годината, за които са показани дните
  3. Стрелка в дясно, която да показва следващия месец при кликване
6. Таблицата да показва дни от предишния и/или следващия месец до запълване на седмиците (пример: Ако месеца започва в сряда, да се покажат последните два дни от предишния месец за вторник и понеделник)
7. Показаните дни в таблицата трябва да са черни и удебелени за текущия месец, и сиви за предишен или следващ месец (css клас "fw-bold" за текущия месец и "text-black-50" за останалите)

*/

// your code here...


// Проверяваме дали има зададени стойности за година и месец, ако няма даваме такива по подразбиране
if(!isset($_GET['m']) && !isset($_GET['y'])){
    $_GET['m'] = date('m');
    $_GET['y'] = date('Y');
} 

// Създаваме променливи за месец и година с които ще работим за календара
$month =  $_GET['m'];
$year =  $_GET['y'];

// Създаваме променлива за текущата дата
$date = date('F, Y',mktime(0,0,0, $month , 1, $year));
// Намираме броя на дните в избрания месец
$days_count = date('t', mktime(0,0,0,$month,1,$year));
//Намираме деня от седмицата, в който ще стартира месеца
$offset = date('w', mktime(0,0,0,$month,0,$year));
// Променлива за предходния месец
$prev = date('t',mktime(0,0,0, $month -1, 1, $year));
// Променлива броя на дните в последната седмица на месеца
$end = date('w', mktime(0, 0, 0, $month, $days_count, $year));
// Намираме празните дни от календара в края на месеца
$nextMonthCounter = 7-$end;

// Логиката за бутона за предишния месец
if ($month == 1) {
    $prevMonth = 12;
    $prevYear = $year - 1;
}else {
    $prevMonth = $month -1;
    $prevYear = $year;
}
                            
// Логиката за бутона за следващия месец                                                        
if ($month == 12){
    $nextMonth = 1;
    $nextYear = $year + 1;
}else{
    $nextMonth = $month +1;
    $nextYear = $year;
}
                            
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Calendar</title>
  </head>
  <body>
    <div class="container">
      <div class="row">
        <div class="col">
          <h1>Calendar</h1>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 offset-md-3 col-lg-6 offset-lg-3">
          <form class="row g-3">
            <div class="col-md-6 col-lg-6">
              <label class="form-label" for="month">Select month</label>
              <select name="m" class="form-control" id="month">
                  <!-- PHP код, с който избраната опция остава постоянна на екрана -->
                <option  value="1" <?php if($_GET['m'] == '1') {echo "selected=selected"; }?>>January</option>
                <option  value="2" <?php if($_GET['m'] == '2') {echo "selected=selected"; }?>>February</option>
                <option  value="3" <?php if($_GET['m'] == '3') {echo "selected=selected"; }?>>March</option>
                <option  value="4" <?php if($_GET['m']== '4') {echo "selected=selected"; }?>>April</option>
                <option  value="5" <?php if($_GET['m'] == '5') {echo "selected=selected"; }?>>May</option>
                <option  value="6" <?php if($_GET['m'] == '6') {echo "selected=selected"; }?>>June</option>
                <option  value="7" <?php if($_GET['m'] == '7') {echo "selected=selected"; }?>>July</option>
                <option  value="8" <?php if($_GET['m'] == '8') {echo "selected=selected"; }?>>August</option>
                <option  value="9" <?php if($_GET['m'] == '9') {echo "selected=selected"; }?>>September</option>
                <option  value="10" <?php if($_GET['m'] == '10') {echo "selected=selected"; }?>>October</option>
                <option  value="11" <?php if($_GET['m'] == '11') {echo "selected=selected"; }?>>November</option>
                <option  value="12" <?php if($_GET['m'] == '12') {echo "selected=selected"; }?>>December</option>
              </select>
            </div>
            <div class="col-md-6 col-lg-6">
              <label class="form-label" for="year">Year:</label>
              <input type="text" name="y" class="form-control" value="<?php echo $_GET['y'] ?>">
            </div>
            <div class="col-md-12 col-lg-12">
              <button type="submit" class="btn btn-primary">Show</button>
              <a href="?m=11&y=2021" class="btn btn-secondary">Today</a>
            </div>
          </form>
        </div>
      </div>
        <div class="row">
            <div class="col-md-6 mt-5 offset-md-3 col-lg-6 offset-lg-3">
                <table class="table table-bordered text-center">
                    <thead>
                    <th>
                        <a  href = "?m=<?= $prevMonth; ?>&y=<?= $prevYear; ?>" title = "Previous month">&larr;
                        </a>
                    </th>
                    <th colspan="5" class="text-center"><?= $date; ?></th>
                    <th>

                        <a href = "?m=<?= $nextMonth; ?>&y=<?= $nextYear; ?>" title = "Next month">&rarr;
                        </a>
                    </th>
                    </tr>
                    <tr>
                        <th>Mon</th>
                        <th>Tue</th>
                        <th>Wed</th>
                        <th>Thu</th>
                        <th>Fri</th>
                        <th>Sat</th>
                        <th>Sun</th>
                    </tr>
            </thead>
            <tbody>
              <!-- remove the following and add your code to display the days: -->
              <?php
              // С първия for цикъл, стартираме месеца с правилния ден от седмицата и визуализираме последните дни от предходния.
              for ($i = 1; $i <= $offset; $i++) {
                 //първия ден от предходния месец, който ще се изобрази в началото на календара
                  $counter = $prev - $offset;
                  // Изброявам следващите дни от предходния месец до достигане на 1-во число на избрания
                  while ($counter < $prev) {
                      // Поставяме изброените дни в таблицата с желания шрифт и цвят
                      echo '<td class="text-black-50">' . ++$counter . '</td>';
                  }
                  //Спираме цикъла след като постигне желания резултат
                  break;
              }
              // С втроя for цикъл построяваме календара
              for ($j = 1; $j <= $days_count; $j++) {
                  // Извеждаме дните с желания шрифт и цвят
                  echo '<td class="fw-bold">' . $j . '</td>';
                  // Минаваме на нов ред, след като стигнем седмия ден в месеца
                  if (($j + $offset) % 7 === 0 && $j != 0) {

                      echo "</tr> <tr>";
                  }
              }
                // С третия for цикъл показваме първите дни от следващия месец
                for($i = 1; $i <= $nextMonthCounter; $i++){
                    // Ограничаваме символите, които се показват, за да не се построи нов ред при месеците приключващи в Неделя
                    if($nextMonthCounter < 7){
                        echo '<td class="text-black-50">' . +$i . '</td>';
                    }
                    }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </body>
</html>
