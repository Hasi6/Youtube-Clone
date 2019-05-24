<?Php

    class FormSanitizer {

        // Make first name and last name to the currect format
    public static function sanitizeFromString($inputText){
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "_",$inputText);
        $inputText = strtolower($inputText);
        $inputText = ucFirst($inputText);

        return $inputText;
    }
    // Make Username to the currect format
    public static function sanitizeFromUserName($inputText){
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "_",$inputText);

        return $inputText;
    }

    //Make Password to the currect Format
    public static function sanitizeFromPassword($inputText){
        $inputText = strip_tags($inputText);

        return $inputText;
    }

    // Make email to the currect format 
    public static function sanitizeFromEmail($inputText){
        $inputText = strip_tags($inputText);
        $inputText = str_replace(" ", "_",$inputText);

        return $inputText;
    }
}
?>