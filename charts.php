<?php
 include('queries.php');
$where =$_POST['where'];
if($where == 'fastmoving' )
{   
       $fastsum = 0;
       $fastmovingproducts = array(['Products', 'Number of products sold']);
        foreach($fastmoving as $row){
        $name = $row['name'];
        $total = $row['sum'];
        $fastsum = $fastsum + $total;
        $resultArray = array($name, $total);
        array_push($fastmovingproducts, $resultArray);
        }
        $row1 = mysqli_fetch_array($sum);
        $totalsum = $row1['sumtotal'];
        $other = $totalsum - $fastsum;
        array_push($fastmovingproducts,['Other',$other]);
       $array = json_encode($fastmovingproducts);
        echo $array;
}  
else if($where == 'fastselling' )
{   
       $fastsum = 0;
       $fastmovingproducts = array(['Products', 'Number of products sold']);
        foreach($fastselling as $row){
        $name = $row['name'];
        $total = $row['sum'];
        $fastsum = $fastsum + $total;
        $resultArray = array($name, $total);
        array_push($fastmovingproducts, $resultArray);
        }
        $row1 = mysqli_fetch_array($sumSales);
        $totalsum = $row1['sumtotal'];
        $other = $totalsum - $fastsum;
        array_push($fastmovingproducts,['Other',$other]);
       $array = json_encode($fastmovingproducts);
        echo $array;
}  
else if($where == 'biggestPayers' )
{   
       $payerList = array(['Customer', 'Amount Paid']);
        foreach($biggestPayers as $row){
        $name = $row['name'];
        if($name == 'Unregistered Customer')
        {
          $name = $row['new_name'];
        }
        $total = $row['sum'];
        $resultArray = array($name, $total);
        array_push($payerList, $resultArray);
        }
       $array = json_encode($payerList);
        echo $array;
}
else if($where == 'customerType' )
{   
       $typeList = array(['Customer Type', 'Number']);
        foreach($customerTypeNumbers as $row){
        $type = $row['type'];
        $count = $row['count'];
        $resultArray = array($type, $count);
        array_push($typeList, $resultArray);
        }
       $array = json_encode($typeList);
        echo $array;
}
else if($where == 'salesTotal')
{   
       $salesTotal = array();
        $row1 = mysqli_fetch_array($salesWk1);
        $total1 = $row1['sum'];
        $Total1 = $total1;
        $row2 = mysqli_fetch_array($salesWk2);
        $total2 = $row2['sum'];
        $Total2 = $total2;
        $row3 = mysqli_fetch_array($salesWk3);
        $total3 = $row3['sum'];
        $Total3 = $total3;
        $row4 = mysqli_fetch_array($salesWk4);
        $total4 = $row4['sum'];
        $Total4 = $total4;
        array_push($salesTotal, $Total1);
        array_push($salesTotal, $Total2);
        array_push($salesTotal, $Total3);
        array_push($salesTotal, $Total4);
       $array = json_encode($salesTotal);
        echo $array;
}
else if($where == 'profit/loss')
{   
       $values = array();
        $row1 = mysqli_fetch_array($monthSalesValue);
        $sales = $row1['sum'];
        $row2 = mysqli_fetch_array($monthIncomeValue);
        $income = $row2['sum'];
        $row3 = mysqli_fetch_array($monthExpenseValue);
        $expenses = $row3['sum'];
        $row4 = mysqli_fetch_array($salariesTotal);
        $salaries = $row4['salaries'];
        $expenses = $expenses + $salaries;
        $gross = $income  - $sales;
        $net = $gross - $expenses ;
        array_push($values, $gross);
        array_push($values, $expenses);
        array_push($values, $net);
       $array = json_encode($values);
        echo $array;
}
else if($where == 'salesExpenses')
{   
       $salesExpensesTotal = array();
        $row1 = mysqli_fetch_array($salesWk1);
        $total1 = $row1['sum'];
        $row5 = mysqli_fetch_array($extraSalesWk1);
        $total5 = $row5['sum'];
        $Total1 = $total1 + $total5;
        $row2 = mysqli_fetch_array($salesWk2);
        $total2 = $row2['sum'];
        $row6 = mysqli_fetch_array($extraSalesWk2);
        $total6 = $row6['sum'];
        $Total2 = $total2 + $total6;
        $row3 = mysqli_fetch_array($salesWk3);
        $total3 = $row3['sum'];
        $row7 = mysqli_fetch_array($extraSalesWk3);
        $total7 = $row7['sum'];
        $Total3 = $total3 + $total7;
        $row4 = mysqli_fetch_array($salesWk4);
        $total4 = $row4['sum'];
        $row8 = mysqli_fetch_array($extraSalesWk4);
        $total8 = $row8['sum'];
        $Total4 = $total4 + $total8;
        $row5 = mysqli_fetch_array($expensesWk1);
        $total5 = $row5['sum'];
        $row6 = mysqli_fetch_array($expensesWk2);
        $total6 = $row6['sum'];
        $row7 = mysqli_fetch_array($expensesWk3);
        $total7 = $row7['sum'];
        $row8 = mysqli_fetch_array($expensesWk4);
        $total8 = $row8['sum'];
        array_push($salesExpensesTotal, $Total1);
        array_push($salesExpensesTotal, $total5);
        array_push($salesExpensesTotal, $Total2);
        array_push($salesExpensesTotal, $total6);
        array_push($salesExpensesTotal, $Total3);
        array_push($salesExpensesTotal, $total7);
        array_push($salesExpensesTotal, $Total4);
        array_push($salesExpensesTotal, $total8);
       $array = json_encode($salesExpensesTotal);
        echo $array;
}
else if($where == 'salescomparison' )
{  
    $titleComparison = array('Day');
    $fiveDaysAgo = date('d/m/Y', strtotime("-5 days"));
    $fourDaysAgo = date('d/m/Y', strtotime("-4 days"));
    $threeDaysAgo = date('d/m/Y', strtotime("-3 days"));
    $twoDaysAgo = date('d/m/Y', strtotime("-2 days"));
    $yesterday = "Yesterday";
    $today = "Today";
    $salesComparisonFiveDaysAgo = array($fiveDaysAgo);
    $salesComparisonFourDaysAgo = array($fourDaysAgo);
    $salesComparisonThreeDaysAgo = array($threeDaysAgo);
    $salesComparisonTwoDaysAgo = array($twoDaysAgo);
    $salesComparisonYesterday = array($yesterday);
    $salesComparisonToday = array($today);
    foreach($distributionComparisonFiveDaysAgo as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($titleComparison,$name);
      array_push($salesComparisonFiveDaysAgo,$sum);
    }
    foreach($distributionComparisonFourDaysAgo as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesComparisonFourDaysAgo,$sum);
    }
    foreach($distributionComparisonThreeDaysAgo as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesComparisonThreeDaysAgo,$sum);
    }
    foreach($distributionComparisonTwoDaysAgo as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesComparisonTwoDaysAgo,$sum);
    }
    foreach($distributionComparisonYesterday as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesComparisonYesterday,$sum);
    }
    foreach($distributionComparisonToday as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesComparisonToday,$sum);
    }
    array_push($titleComparison,'Average');
    $arrayTitle = json_encode($titleComparison);
     $row = mysqli_fetch_array($distributionTotalToday);
    $todaySum = $row['count'];
    $row1 = mysqli_fetch_array($distributionTotalYesterday);
    $yesterdaySum = $row1['count'];
    $row2 = mysqli_fetch_array($distributionTotalTwoDaysAgo);
    $twoDaysAgoSum = $row2['count'];
    $row3 = mysqli_fetch_array($distributionTotalThreeDaysAgo);
    $threeDaysAgoSum = $row3['count'];
    $row4 = mysqli_fetch_array($distributionTotalFourDaysAgo);
    $fourDaysAgoSum = $row4['count'];
    array_push($salesComparisonThreeDaysAgo,$threeDaysAgoSum);
    $row5 = mysqli_fetch_array($distributionTotalFiveDaysAgo);
    $fiveDaysAgoSum = $row5['count'];
    array_push($salesComparisonToday,$todaySum);
    array_push($salesComparisonYesterday,$yesterdaySum);
    array_push($salesComparisonTwoDaysAgo,$twoDaysAgoSum);
    array_push($salesComparisonThreeDaysAgo,$threeDaysAgoSum);
    array_push($salesComparisonFourDaysAgo,$fourDaysAgoSum);
    array_push($salesComparisonFiveDaysAgo,$fiveDaysAgoSum);
    $finalArray = array($arrayTitle,$salesComparisonFiveDaysAgo,$salesComparisonFourDaysAgo,$salesComparisonThreeDaysAgo,$salesComparisonTwoDaysAgo,$salesComparisonYesterday,$salesComparisonToday);
    $array = json_encode($finalArray);
    echo $array;
}
else if($where == 'salescomparison1' )
{  
    $salesNamesToday = array();
    $salesFiguresToday = array();
    foreach($distributionComparisonToday as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesNamesToday,$name);
      array_push($salesFiguresToday,$sum);
    }
    $finalArray = array($salesNamesToday,$salesFiguresToday);
    $array = json_encode($finalArray);
    echo $array;
}
else if($where == 'salescomparison2' )
{  
    $salesNamesYesterday = array();
    $salesFiguresYesterday = array();
    foreach($distributionComparisonYesterday as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesNamesYesterday,$name);
      array_push($salesFiguresYesterday,$sum);
    }
    $finalArray = array($salesNamesYesterday,$salesFiguresYesterday);
    $array = json_encode($finalArray);
    echo $array;
}
else if($where == 'salescomparison3' )
{  
    $twoDaysAgo = date('d/m', strtotime("-2 days"));
    $salesNames_2 = array();
    $salesFigures_2 = array();
    foreach($distributionComparisonTwoDaysAgo as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesNames_2,$name);
      array_push($salesFigures_2,$sum);
    }
    $finalArray = array($salesNames_2,$salesFigures_2);
    $array = json_encode($finalArray);
    echo $array;
}
else if($where == 'salescomparison4' )
{  
    $threeDaysAgo = date('d/m', strtotime("-3 days"));
    $salesNames_3 = array('Deliverer');
    $salesFigures_3 = array($threeDaysAgo); 
    foreach($distributionComparisonThreeDaysAgo as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesNames_3,$name);
      array_push($salesFigures_3,$sum);

    }
    array_push($salesNames_3,"{ role: 'annotation' }");
    array_push($salesFigures_3,"''");
    $finalArray = array($salesNames_3,$salesFigures_3);
    $array = json_encode($finalArray);
    echo $array;
}
else if($where == 'salescomparison5' )
{  
    $salesNames_4 = array();
    $salesFigures_4 = array();
    $fourDaysAgo = date('d/m', strtotime("-4 days"));
    foreach($distributionComparisonFourDaysAgo as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
      array_push($salesNames_4,$name);
      array_push($salesFigures_4,$sum);
    }
    $finalArray = array($fourDaysAgo,$salesNames_4,$salesFigures_4);
    $array = json_encode($finalArray);
    echo $array;
}
else if($where == 'salescomparison6' )
{  
    
    $salesNames_5 = array();
    $salesFigures_5 = array();
    $fiveDaysAgo = date('d/m', strtotime("-5 days"));
    foreach($distributionComparisonFiveDaysAgo as $row){
      $name = $row['deliverer'];
      $sum = $row['count'];
       array_push($salesNames_5,$name);
      array_push($salesFigures_5,$sum);
    }
    $finalArray = array($fiveDaysAgo,$salesNames_5,$salesFigures_5);
    $array = json_encode($finalArray);
    echo $array;
}
else if($where == 'biggestExpenses' )
{   
       $biggestExpensesArr = array();
        foreach($biggestExpenses as $row){
        $name = $row['name'];
        $total = $row['sum'];
        $color = "silver";
        $resultArray = array($name, $total);
        array_push($biggestExpensesArr, $resultArray);
        }
       $array = json_encode($biggestExpensesArr);
        echo $array;
}
?>