<?php

    class ButtonProvider{

        public static function createButton($text, $imagesSrc, $action, $class){

            if($imagesSrc == null){
                $image = "";
            }
            else{
                $image = "<img src='$imagesSrc'>";
            }

            // Change Action if needed
            return "<button class='$class' onClick='$action'>
                        $image
                        <span class='text'>$text</span>
                    </button>";
        }
    }

?>