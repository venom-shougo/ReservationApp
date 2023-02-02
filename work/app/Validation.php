<?php

class ValidateForm
{
    /**
     * エントリーバリデーション
     * @param array $email
     * @return array $err
     */
    public static function setEntry($email)
    {
        $err = [];
        $validateemail = trim(filter_var($email['email'], FILTER_VALIDATE_EMAIL));
        if (empty($validateemail)) {
        $err['email'] = 'メールアドレスを入力してください';
        }
        return $err;
    }

    /**
     * サインアップバリデーション
     * @param array $userData
     * @return array $err
     */
    public static function setSignup($userData)
    {
        $err = [];

        if (empty(trim($userData['last_name']))) {
            $err['last'] = '姓を入力してください';
        }
        if (empty(trim($userData['first_name']))) {
            $err['first'] = '名を入力してください';
        }
        if (empty(trim($userData['last_name_kana']))) {
            $err['last_kana'] = 'セイ を入力してください';
        }
        if (empty(trim($userData['first_name_kana']))) {
            $err['first_kana'] = 'メイ を入力してください';
        }
        $password = trim($userData['password']);
        if (!preg_match("/\A[a-z\d]{8,20}+\z/i", $password)) {
            $err['password'] = 'パスワードを入力して下さい';
        }
        $password_conf = trim($userData['password_conf']);
        if ($password !== $password_conf) {
            $err['pass_conf'] = 'パスワードと確認用パスワードが一致しません';
        }
        if (empty(trim($userData['postcode1'] && $userData['postcode2']))) {
            $err['postcode'] = '郵便番号を入力してください';
        }
        if (empty(trim($userData['prefectures']))) {
            $err['prefectures'] = '都道府県を入力してください';
        }
        if (empty(trim($userData['city']))) {
            $err['city'] = '市村町を入力してください';
        }
        if (empty(trim($userData['block']))) {
            $err['block'] = '丁番地を入力してください';
        }
        if (empty(trim($userData['phone_number']))) {
            $err['phone'] = '電話番号を入力してください';
        }
        return $err;
    }
}
