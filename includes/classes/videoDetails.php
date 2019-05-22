<?php
    class VideoDetailsFromProvider{

        private $con;

        public function __construct($con){
            $this->con = $con;
        }

        public function createUploadForm(){
            $fileInput = $this->createFileInput();
            $titleInput = $this->createTitleInput();
            $descriptionInput = $this->createDescriptionInput();
            $privacyInput = $this->createPrivacyInput();
            $categoriesInput = $this->createCategoriesInput();
            $uploadButton = $this->createUploadButton();
            
            return "<form action='processing.php' method='POST'>
                $fileInput
                $titleInput
                $descriptionInput
                $privacyInput
                $categoriesInput
                $uploadButton
            </form>";
        }

        private function createFileInput(){
            return "<div class='form-group'>
                        <label for='exampleFormControlFile1'>Your file</label>
                        <input type='file' class='form-control-file' id='exampleFormControlFile1' name='fileInput' required>
                    </div>";
        }

        private function createTitleInput(){
            return "<div class='form-group'>
                        <input class='form-control' type='text' placeholder='Video Title' name='titleInput' required>
                    </div>";
        }
        private function createdescriptionInput(){
            return "<div class='form-group'>
                        <textarea class='form-control' rows='3' name='descriptionInput' placeholder='Video Discription' required></textarea>
                    </div>";
        }
        private function createCategoriesInput(){
            return "<div class='form-group'>
                        <select class='form-control' name='privacyInput'>
                            <option value='0'>Private</option>
                            <option value='1'>Public</option>
                        </select>
                    </div>";
        }
        private function createPrivacyInput(){
            $query = $this->con->prepare("SELECT * FROM categories");
            $query->execute();

            $html = "<div class='form-group'>
            <select class='form-control' name='categoryInput'>";

            while($row = $query->fetch(PDO::FETCH_ASSOC)){
               $name = $row['name'];
               $id = $row['id'];

               $html .= "<option value='$id'> $name</option>";
    }
    $html.=     "</select>
            </div>";
            
        return $html;
        }

        private function createUploadButton(){
            return "<button type='submit' class='btn btn-primary btn-block' name='uploadButton'>Upload Video</button>";
        }

    }
?>


