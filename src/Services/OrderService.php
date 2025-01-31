<?php

namespace App\Services;

use App\Validation\ValidationManager;
use DateTime;
use Exception;

class OrderService 
{
    public $validation;

    public function __construct()
    {
        $this->validation = new ValidationManager();
    }


    public function validation(array $data)
    {
        if (isset($_COOKIE['form_submitted'])) {
            throw new Exception("You have already submitted the form today.", 403);
        }

        self::amountValidation($data['amount']);

        self::buyerValidation($data['buyer']);

        self::receiptIdValidation($data['receipt_id']);

        self::buyerEmailValidation($data['buyer_email']);

        self::noteValidation($data['note']);

        self::cityValidation($data['city']);

        self::phoneValidation($data['phone']);

        self::entryByValidation($data['entry_by']);

        self::itemsValidation($_POST['items']);
    }


    private function amountValidation($value)
    {
        $this->validation->isRequired('Amount', $value);
        $this->validation->isNumberCheck('Amount', $value);
    }

    private function buyerValidation($value)
    {
        $this->validation->isRequired('Buyer', $value);
        $this->validation->isTextSpaceNumberCheck('Buyer', $value);
        $this->validation->isWordLimit('Buyer', $value, 20);
    }

    private function receiptIdValidation($value) 
    {
        $this->validation->isRequired('Receipt Id', $value);
        $this->validation->isStringWithNoSpace('Receipt Id', $value);
    }

    private function buyerEmailValidation($value) 
    {
        $this->validation->isRequired('Buyer Email', $value);
        $this->validation->isMail('Buyer Email', $value);
    }

    private function noteValidation($value) 
    {
        $this->validation->isRequired('Note', $value);
        $this->validation->isWordLimit('Note', $value, 30);
        $this->validation->isUnicodeString('Note', $value);
    }


    private function cityValidation($value) 
    {
        $this->validation->isRequired('City', $value);
        $this->validation->isStringWithSpace('City', $value);
    }

    private function phoneValidation($value) 
    {
        $this->validation->isRequired('Phone', $value);
        $this->validation->isPhoneNumber('Phone', $value);
    }

    private function entryByValidation($value) 
    {
        $this->validation->isRequired('Entry_by', $value);
        $this->validation->isPhoneNumber('Entry by', $value);
    }

    private function itemsValidation($values) 
    {
        $this->validation->isRequiredArray('Items', $values);
    }


    public function requestDataManage(array $data) : array
    {
        $dataArray = [
            'amount'  => self::requestSanitize($_POST['amount']),
            'buyer'  => self::requestSanitize($_POST['buyer']),
            'receipt_id'  => self::requestSanitize($_POST['receipt_id']),
            'items'  => implode(', ', $_POST['items']),
            'buyer_email'  => self::requestSanitize($_POST['buyer_email']),
            'note'  => self::requestSanitize($_POST['note']),
            'city'  => self::requestSanitize($_POST['city']),
            'phone'  => self::requestSanitize($_POST['phone']),
            'entry_by'  => self::requestSanitize($_POST['entry_by'])
        ];
        $dataArray['buyer_ip'] = $_SERVER['REMOTE_ADDR']; 
        $dataArray['hash_key'] = self::generateHashkey($data);
        $dataArray['entry_at'] = self::generateTimezone($data);

        return $dataArray;

    }


    private static function generateHashkey(array $data) : string 
    {
        $input = $data['receipt_id'] . 'irfan'; 

        return hash('sha512', $input);
    }

    private static function generateTimezone(array $data) : string 
    {
        date_default_timezone_set('Asia/Dhaka');
        $currentDateTime = new DateTime();

        return $currentDateTime->format('Y-m-d H:i:s');
    }

    // public function requestSanitize(string $value) : string
    public function requestSanitize(string $value) 
    {
        // Step 1: Trim whitespace from the beginning and end
        $inputData = trim($value);
        
        // Step 2: Remove backslashes
        $inputData = stripcslashes($inputData);
        
        // Step 3: Convert special characters to HTML entities
        $result = htmlspecialchars($inputData);
        
        return $result;
    }


    /**
     * mysqli_real_escape_string
     * 
     * prevent SQL Injection & This function is used to create a legal SQL string that you can use in an SQL statement. 
     * The given string is encoded to an escaped SQL string, taking into account the current character set of the connection.
     * 
     */

}
