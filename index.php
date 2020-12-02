<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form method="post" action="index.php/">
            <label for="pwd">password:</label><br>
            <input type="password" id="pwd" name="pwd"><br>
            <input type="submit" value="Login">
        </form>
        <?php
        // put your code here
        $pwd = "";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $pwd = test_input($_POST["pwd"]);
            check_input($data);
        }
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        function check_input($str){
                if(!isLength($str)){
        echo "length not enough";
        }
        //2
        else if(!isMulti($str)){
            echo "complexity not enough";
        }
        //3
        else if(hasSubstr($str)){
            echo "cannot duplicate str";
        }else{
            $_SESSION['pwd'] = $str;
            header("Location: /welcome.php?pwd=".$str);
        }
        }
        
        function isLength($str){
            $len=strlen($str);
            if($len>8) return true;
            else return false;
        }

        function isMulti($str){
            $myType=0;
            //have number
            if(preg_match('/\d/',$str)) $myType++;
            //have cap
            if(preg_match('/[A-Z]/',$str)) $myType++;
            //have lower case
            if(preg_match('/[a-z]/',$str)) $myType++;
            //have other char
            $str2=preg_replace('/[A-Za-z0-9]/','',$str);
            $len2=strlen($str2);
            if($len2>=1) $myType++;

            if($myType>=3) return true;
            else return false;
        }

            function hasSubstr($str){
                $len=strlen($str);
                for($i=0;$i<$len;$i++){
                    $ii=$i;
                    for($j=$ii+2;$j<$len;$j++){
                        $jj=$j;
                        $count=0;
                        while($jj<$len&&$count<=2&&$str[$ii]==$str[$jj]){
                            //echo $str[$ii]." ".$str[$jj].PHP_EOL;
                            $ii++;
                            $jj++;
                            $count++;
                        }
                        if($count==3) return true;

                    }

                }
                return false;
            }
        ?>
    </body>
</html>
