<?php

namespace app\models;


use Yii;
use yii\db\ActiveRecord;
use app\components\helpers\HelperFormat;


/**
 * RegistrationForm is the model behind the registration form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Payment extends ActiveRecord
{
    const PAYMENT_DAYS = [5, 20];

    /**
     * @return string the name of the table associated with this ActiveRecord class.
     */
    public static function tableName()
    {
        return '{{%payments}}';
    }

    /**
     * Get payment by payment_id = [$id]
     *
     * @return ActiveRecord
     */
    public static function findIdentity($id)
    {
        return  Payment::find()->where(['payment_id' => $id])->one();
    }

    /**
     * Get last payment record
     *
     * @param $data
     * @return ActiveRecord
     */
    public static function getLastPaymentRecord()
    {
        return Payment::find()->orderBy('ends_at desc')->limit('1')->one();
    }

    /**
     * Save new payment record by last date from base
     *
     * @return bool
     */
    public static function generateNext()
    {
        $payment = new Payment();
        $lastPayment = Payment::getLastPaymentRecord();
        $start = $lastPayment ? $lastPayment['ends_at'] : date('Y-m-d');
        $newStartData = strtotime("{$start} +1 day");
        $payment->starts_at = date('Y-m-d', $newStartData);
        $day = date("d", $newStartData);
        echo $payment->starts_at.' ';
        $end = 0;
        foreach (self::PAYMENT_DAYS as $days){
            if($day < $days){
                $end = $days - 1;
                echo $end;
                break;
            }
        }
        $monthAddFlag = false;
        if (!$end) {
            $end = self::PAYMENT_DAYS[0]-1;
            $monthAddFlag = true;
        }
        $newEndData = strtotime("{$payment->starts_at}");
        if ($monthAddFlag) {
            $newEndData = strtotime("{$payment->starts_at} +1 month");
        }
        $tempDataArray = date('Y-m-d', $newEndData);
        list($year, $month, $day) = explode("-", $tempDataArray);
        $end = mktime(0, 0, 0, $month, $end, $year);
        $end = date('Y-m-d', $end);
        $payment->ends_at = $end;
        $payment->user_userid = Yii::$app->user->getId();
        return $payment->save();
    }

    /**
     * For join with User table
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['user_id' => 'user_userid']);
    }

    /**
     * Get query for find all
     *
     * @return \yii\db\ActiveQuery
     */
    public static function getAllPayments()
    {
        $query = Payment::find()
            ->select('{{%payments}}.payment_id, {{%payments}}.starts_at, {{%payments}}.ends_at, {{%payments}}.user_userid, u.email')
            ->orderBy('{{%payments}}.payment_id')
            ->groupBy('{{%payments}}.payment_id, u.email')
            ->joinWith(['user u'], true, 'INNER JOIN');
        return $query;
    }

    /**
     * Delete payment by 'payment_id' = $id
     *
     * @param $id
     */
    public function paymentDelete($id, $user_id)
    {
        $payment = Payment::findOne($id);
        if ($payment->user->id == $user_id) {
            $payment->delete();
        }
    }
}
