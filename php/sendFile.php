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

        $ids = array();

        for ($i = 0; $i < count($files["content"]); $i++) {
            $content = $files["content"][$i];
            
            $type = explode( '/', $content["type"] )[0];

            $query = "SELECT max(id) FROM `content`";
            $result = mysqli_query($linkIdentifier, $query);
            $lastId = mysqli_fetch_array($result);
            $lastId = $lastId[0] + 1;
            $ids[] = $lastId;
            ini_set('max_execution_time', 0);         

            if($type == "image"){
                $directory = "Content/" . $lastId . ".png";
                imagepng(imagecreatefromstring(file_get_contents($content["tmp_name"])), "../" . $directory);
            }
            else if($type == "video"){
                $directory = "Content/" . $lastId . ".mp4";
                $video = $content["tmp_name"];
                $ffmpeg = getcwd() . "/../ffmpeg/bin/ffmpeg";       //getcwd return current path
                $finalVideo = getcwd() . "/../$directory";

                $comand="$ffmpeg -y -i $video -c:v libx264 -preset slow -crf 22 -pix_fmt yuv420p -c:a libvo_aacenc -b:a 128k $finalVideo";
                system($comand,$status);
            }
            else continue;
            $query = "INSERT INTO `content`(`url`) VALUES ( '$directory' )";
            mysqli_query($linkIdentifier, $query);

        }
    }
?>

