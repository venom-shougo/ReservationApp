<?php
namespace Reservation\Validation;
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
            $error['reserve_date_err'] = '予約日を選択して下さい。';
        }
        // TODO:予約日はプリダウン設定値を決定後にバリデーション実装

        if (empty($input['reserve_num'])) {
            $error['reserve_num_err'] = '人数を選択して下さい。';
        } elseif (!preg_match('/^[0-9]+$/', $input['reserve_num'])) {
            $error['reserve_num_err'] = '人数を正しく入力して下さい。';
        }

        if (empty($input['reserve_time'])) {
            $error['reserve_time_err'] = '予約時間を選択して下さい。';
        }
        // TODO:予約時間はプリダウン設定値を決定後にバリデーション実装

        if (empty(trim($input['name']))) {
            $error['name_err'] = '名前を入力して下さい。';
        } elseif (mb_strlen($input['name'], 'utf-8') > 20) {
            $error['name_err'] = '名前をは20文字以内で入力して下さい。';
        }

        if (empty(trim($input['email']))) {
            $error['email_err'] = 'メールアドレスを入力して下さい。';
        } elseif (trim(mb_strlen($input['email'], 'utf-8')) > 100) {
            $error['email_err'] = 'メールアドレスは100文字以内で入力して下さい。';
        } elseif (trim(!filter_var($input['email'], FILTER_VALIDATE_EMAIL))) {
            $error['email_err'] = 'メールアドレスが不正です。';
        }

        if (empty(trim($input['tel']))) {
            $error['tel_err'] = '電話番号を入力して下さい。';
        } elseif (trim(mb_strlen($input['tel'], 'utf-8')) > 20) {
            $error['tel_err'] = '電話番号は20文字以内で入力して下さい。';
        } elseif (trim(!preg_match('/^\d{2,4}-\d{2,4}-\d{4}$/', $input['tel']))) {
            $error['tel_err'] = '電話番号正しく入力して下さい。';
        }

        if (mb_strlen($input['comment'], 'utf-8') > 2000) {
            $error['comment_err'] = '備考欄は2000文字以内で入力して下さい。';
        }

        return $error;
    }

    /**
     * サインアップバリデーション
     * @param array $userData
     * @return array $err
     */
    public static function validateSignup(array $shopData): array
    {
        $error = [];

        if (empty(trim($shopData['shop_name']))) {
            $error['shop_name_error'] = 'ショップ名を入力して下さい。';
        } elseif (mb_strlen($shopData['shop_name'], 'utf-8') > 30) {
            $error['shop_name_error'] = '名前をは30文字以内で入力して下さい。';
        }
        if (empty(trim($shopData['shop_id']))) {
            $error['shop_id_error'] = 'ショップIDを入力して下さい。';
        } elseif (mb_strlen($shopData['shop_id'], 'utf-8') > 20) {
            $error['shop_id_error'] = 'ショップIDは20文字以内で入力して下さい。';
        }
        if (empty(trim($shopData['email']))) {
            $error['shop_email_err'] = 'メールアドレスを入力して下さい。';
        } elseif (trim(mb_strlen($shopData['email'], 'utf-8')) > 100) {
            $error['shop_email_err'] = 'メールアドレスは100文字以内で入力して下さい。';
        } elseif (trim(!filter_var($shopData['email'], FILTER_VALIDATE_EMAIL))) {
            $error['shop_email_err'] = 'メールアドレスが不正です。';
        }
        if (empty(trim($shopData['password']))) {
            $error['shop_password_error'] = 'パスワードを入力して下さい。';
        } elseif (!preg_match("/^(?=.*[A-Z])[0-9a-zA-Z]{8,20}$/", $shopData['password'])) {
            $error['shop_password_error'] = "8文字以上20文字以下で入力して下さい。\n大文字を1文字含む半角英数字で入力して下さい。";
        }
        return $error;
    }
}
