<?php
    if(isset($_POST) and $_SERVER['REQUEST_METHOD'] == "POST"){
        
        $files = array();                       //these loops is to reorder the $_FILES array (check at the end 
        foreach($_FILES as $key0=>$FILES) {     //of the php file how the array is going too look like)
            foreach($FILES as $key=>$value) {
                foreach($value as $key2=>$value2) {
                    $files[$key0][$key2][$key] = $value2;
                }
            }
        }

        $linkIdentifier = mysqli_connect("localhost:3306", "root", "");      //TODO replace localhost with nameSpace
        mysqli_select_db($linkIdentifier, "smi_final");

        for ($i = 0; $i < count($files["content"]); $i++) {
            $content = $files["content"][$i];
            
            $type = explode( '/', $content["type"] )[0];

            if($type == "image"){
                ini_set('max_execution_time', 0);

                
                $query = "INSERT INTO `post`(`user_id`, `event_id`, `content`) VALUES (" . $_POST['userId'] . "," . $_POST['eventId'] . ", 'temp')";
                mysqli_query($linkIdentifier, $query);

                $lastId = mysqli_insert_id($linkIdentifier);

                echo "<br>" . $lastId;
                $directory = "Content/" . $lastId . ".png";
                
                imagepng(imagecreatefromstring(file_get_contents($content["tmp_name"])), "../" . $directory);
                $query = "UPDATE `post` SET `content`='" . $directory . "' WHERE `id` = " . $lastId;
                mysqli_query($linkIdentifier, $query);
                
            }
            if($type == "video"){
                ini_set('max_execution_time', 0);

                $query = "INSERT INTO `post`(`user_id`, `event_id`, `content`) VALUES (" . $_POST['userId'] . "," . $_POST['eventId'] . ", 'temp')";
                mysqli_query($linkIdentifier, $query);

                $lastId = mysqli_insert_id($linkIdentifier);

                echo "<br>" . $lastId;
                $directory = "Content/" . $lastId . ".mp4";
                $video = $content["tmp_name"];
                $ffmpeg = getcwd() . "/../ffmpeg/bin/ffmpeg";       //getcwd return current path
                $finalVideo = getcwd() . "/../$directory";

                $comand="$ffmpeg -y -i $video -c:v libx264 -preset slow -crf 22 -pix_fmt yuv420p -c:a libvo_aacenc -b:a 128k $finalVideo";
                system($comand,$status);
                
                $query = "UPDATE `post` SET `content`='" . $directory . "' WHERE `id` = " . $lastId;
                mysqli_query($linkIdentifier, $query);
            }
        }

        $query = "UPDATE `sub` SET `notification`= TRUE WHERE `event_id` = " . $_POST['eventId'];
        mysqli_query($linkIdentifier, $query);

        mysqli_close($linkIdentifier);
        header("Location:eventPage.php?eventId=".$_POST["eventId"]);
    }
?>







<!--    example of what the 3 foreach do
Array 
( 
    [content] => Array 
        ( 
            [0] => Array 
                ( 
                    [name] => teste1.jpg 
                    [type] => image/jpeg 
                    [tmp_name] => C:\xampp\tmp\phpC1F8.tmp 
                    [error] => 0 
                    [size] => 528350 
                ) 
            [1] => Array 
                ( 
                    [name] => teste2.jpg 
                    [type] => image/jpeg 
                    [tmp_name] => C:\xampp\tmp\phpC209.tmp 
                    [error] => 0 
                    [size] => 528350 
                ) 
        )
) 
-->