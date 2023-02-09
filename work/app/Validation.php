<?php
namespace Reserve\Validation;
class Validation
{
    /**
     * 予約者入力検証
     * @param array $input
     * @return array
     */
    public static function inputValueCheck(array $input): array
    {
        $error = [];

        if (empty($input['reserve_date'])) {
            $error['reserve_date_err'] = '予約日を選択して下さい';
        }
        // TODO:予約日はプリダウン設定値を決定後にバリデーション実装

        if (empty($input['reserve_num'])) {
            $error['reserve_num_err'] = '人数を選択して下さい';
        } elseif (!preg_match('/^[0-9]+$/', $input['reserve_num'])) {
            $error['reserve_num_err'] = '人数を正しく入力して下さい';
        }

        if (empty($input['reserve_time'])) {
            $error['reserve_time_err'] = '予約時間を選択して下さい';
        }
        // TODO:予約時間はプリダウン設定値を決定後にバリデーション実装

        if (empty(trim($input['name']))) {
            $error['name_err'] = '名前を入力して下さい';
        } elseif (mb_strlen($input['name'], 'utf-8') > 20) {
            $error['name_err'] = '名前をは20文字以内で入力して下さい';
        }

        if (empty(trim($input['email']))) {
            $error['email_err'] = 'メールアドレスを入力して下さい';
        } elseif (trim(mb_strlen($input['email'], 'utf-8')) > 100) {
            $error['email_err'] = 'メールアドレスは100文字以内で入力して下さい';
        } elseif (trim(!filter_var($input['email'], FILTER_VALIDATE_EMAIL))) {
            $error['email_err'] = 'メールアドレスが不正です';
        }

        if (empty(trim($input['tel']))) {
            $error['tel_err'] = '電話番号を入力して下さい';
        } elseif (trim(mb_strlen($input['tel'], 'utf-8')) > 20) {
            $error['tel_err'] = '電話番号は20文字以内で入力して下さい';
        } elseif (trim(!preg_match('/^\d{2,4}-\d{2,4}-\d{4}$/', $input['tel']))) {
            $error['tel_err'] = '電話番号正しく入力して下さい';
        }

        if (mb_strlen($input['comment'], 'utf-8') > 2000) {
            $error['comment_err'] = '備考欄は2000文字以内で入力して下さい';
        }

        return $error;
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
