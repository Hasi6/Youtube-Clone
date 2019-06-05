<?php
class SettingsFormProvider {

    // Change User Details
    public function createUserDetailsForm($firstName, $lastName, $email) {

        $firstNameInput = $this->createFirstNameInput($firstName);
        $lastNameInput = $this->createLastNameInput($lastName);
        $emailInput = $this->createEmailInput($email);
        $saveButton = $this->createSaveUserDetailsButton();

        return "<form action='#' method='POST'>
                    <span class='title'>User Details</span>
                    $firstNameInput
                    $lastNameInput
                    $emailInput
                    $saveButton
                </form>";
    }

    // Change password
    public function createPasswordForm() {

        $oldPasswordInput = $this->createPasswordInput("oldPassword", "Old Password");
        $newPassword1Input = $this->createPasswordInput("newPassword", "New Password");
        $newPassword2Input = $this->createPasswordInput("newPassword2", "Confirm New Password");
        $saveButton = $this->createSavePasswordButton();

        return "<form action='#' method='POST'>
                    <span class='title'>Change Password</span>
                    $oldPasswordInput
                    $newPassword1Input
                    $newPassword2Input
                    $saveButton
                </form>";
    }


    private function createFirstNameInput($value) {
        if($value == null) $value = "";
        return "<div class='form-group'>
                    <input type='text' class='form-control' placeholder='First Name' name='firstName' value='$value' required>
                </div>";
    }

    private function createLastNameInput($value) {
        if($value == null) $value = "";
        return "<div class='form-group'>
                    <input type='text' class='form-control' placeholder='Last Name' name='lastName' value='$value' required>
                </div>";
    }

    private function createEmailInput($value) {
        if($value == null) $value = "";
        return "<div class='form-group'>
                    <input type='email' class='form-control' placeholder='Email' name='email' value='$value' required>
                </div>";
    }

    private function createSaveUserDetailsButton() {
        return "<button type='submit' class='btn btn-primary' name='saveDetailsButton'>Update</button>";
    }

    private function createPasswordInput($name, $placeholder) {
        return "<div class='form-group'>
                    <input type='password' class='form-control' placeholder='$placeholder' name='$name' required>
                </div>";
    }

    private function createSavePasswordButton() {
        return "<button type='submit' class='btn btn-primary' name='savePasswordButton'>Update Password</button>";
    }
}
?>