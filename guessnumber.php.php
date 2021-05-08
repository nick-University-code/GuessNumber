<?php session_start();

function NumberGen(){
    $arrNumber=array();
    $arrNumber[0]=rand(0,9);
    for($i=1;$i<=3;$i++){
        while(1){
            $n=rand(0,9);
            if(!in_array($n,$arrNumber)){
                $arrNumber[$i]=$n;
                break;
            }
        }
    }
   return $arrNumber;
}

function ABCompare($MyGuess,$YourGuess){
    $count=$_SESSION['count'];
    $A=$B=0;
     for($i=0;$i<4;$i++){
         $n=$YourGuess[$i];
             if(in_array($n, $MyGuess)){
                if($n==$MyGuess[$i])$A++;
              else   $B++;

             }
     }
     $Answer = $A.'A'.$B.'B';
    $_SESSION['recordResult'][$count]=$Answer;
    $_SESSION['count']++;
     return $Answer;
}

if(isset($_POST['Replay'])){
    unset($_SESSION['MyNumber']);
    unset($_SESSION['YourGuess']);
    unset($_SESSION['count']);
    unset($_SESSION['recordResult']);
    unset($_SESSION['recordYourGuess']);
}

if(isset($_SESSION['MyNumber'])){
    $arrNumber = $_SESSION['MyNumber'];
}
else{
    $arrNumber=  NumberGen();   
    $_SESSION['count']=0;
    $_SESSION['MyNumber']=$arrNumber;
}

$yGuess='';

if(isset($_POST['Send'])&&!empty($_POST['Send'])){
    if(isset($_POST['YourGuess']))$yGuess=$_POST['YourGuess'];
    if(strlen($yGuess)==4 && is_numeric($yGuess)){
        $arrYourNumber=array();
        for($i=0;$i<4;$i++){
            $arrYourNumber[$i]= substr($yGuess, $i , 1);
          
        }
        $Leagal =TRUE;
        for($i=0;$i<4;$i++){
            $n=$arrYourNumber[$i];
            for($j=0;$j<4;$j++){
                if($i<>$j && $n==$arrYourNumber[$j]){
                    $Leagal=FALSE;
                }
            }
        }
        if($Leagal){
            $_SESSION['recordYourGuess'][$_SESSION['count']]=$yGuess;
            $Result=  ABCompare($arrNumber, $arrYourNumber);
        }
    }
}

?>

<html>
<head>
  
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Pragma" content="no-cache">
<title>猜數字遊戲</title>
</head>
   <body>  
        <div style="color:white; background-color:#8DAA9D; height:100%;width: 100%;   padding:50px;">
            <div style="position: absolute; color: blue; right: 100; height:100%; width:20%;  padding:0px;">
               <font face="Microsoft JhengHei" color="#4A4E69" size="5" > 
               紀錄 &nbsp; 你的數字 &nbsp; 結果  
               </font>     
                <font face="Microsoft JhengHei" color="#4A4E69" size="4" > 
                <?php
                 for($i=0; $i <$_SESSION['count']; $i++){
                echo  '</br>',$i+1;
                for($j=0; $j <13; $j++)echo '&nbsp';
                echo  $_SESSION['recordYourGuess'][$i];
                for($j=0; $j <16; $j++)echo '&nbsp';
                echo  $_SESSION['recordResult'][$i], '</br>';
                 }
                ?>
               </font>    
            </div>
             <a  align="left" href="https://p9056.isrcttu.net/20200413" ></a>  
             <h1 align="center"><font face="Microsoft JhengHei" color="#4A4E69" size="6" >
                 <b>20200413</b></font>       
                  </h1> 
                 <h2 align="center"><font face="Microsoft JhengHei" color="#4A4E69" size="4" >
                     
                    </font></h2>  
            <h3 align="center"><font face="Microsoft JhengHei" color="#4A4E69" size="5" >
                 <b>猜數字</b></font>       
                  </h3>   
            <h4 align="center"> <font face="Microsoft JhengHei" color="#4A4E69" size="4" >          
          <form action="" method="post" style="font-size:16px; line-height:150%;">
              <input type="text" size="4" name="YourGuess" maxlength="4">&nbsp;
              <input type="submit" name="Send" value="送出">&nbsp; 
              <input type="submit" name="Replay" value="重新再來">&nbsp;
              <input type="submit" name="quit" value="放棄">&nbsp; 
          </form>
            
           <?php        
            if(!empty($yGuess)&&$Result!='4A0B')echo '&nbsp;&nbsp;你猜的數字:'.$yGuess;
            if(isset($Result)){
                if($Result=='4A0B'){echo '你答對了';echo '我的數字:'.  implode('', $arrNumber).'<br/>';}
                else {echo '&nbsp;&nbsp;結果:'.$Result;}
            }
            else if(isset($_POST['quit'])){
                echo '&nbsp;&nbsp;遊戲結束 答案是 '.implode('', $arrNumber);
            }
            else{
                if(!empty($yGuess))echo '&nbsp;&nbsp;妳輸入的數字不合規定';
            }
           ?>
               </a>
          </font>  </h4>
        </div>
</body>
</html>