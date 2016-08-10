<?php
/**
 * Created by PhpStorm.
 * User: sasha2567
 * Date: 05.08.16
 * Time: 17:14
 */

namespace app\controllers;


use Yii;
use app\models\Payment;
use yii\web\Controller;
use yii\data\Pagination;
use app\components\helpers\HelperArray;


class PaymentController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Payment page action.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $this->redirect('user/login');
        }

        $query      = Payment::getAllPayments();
        $countQuery = clone $query;
        $pages      = new Pagination(['totalCount' => $countQuery->count()]);
        $listing    = $query->orderBy('id DESC')->offset($pages->offset)->limit($pages->limit)->all();
        $first      = HelperArray::first($listing);
        $last       = HelperArray::last($listing);

        $data = [
            'pages'    => $pages,
            'listing'  => $listing,
            'start_at' => $first ? Payment::getDateOnFormat($first->start_at) : null,
            'end_at'   => $last ? Payment::getDateOnFormat($last->end_at) : null,
        ];
        foreach ($listing as $row){
            $row->ends_at = Payment::getDateOnFormat($row->ends_at);
            $row->starts_at = Payment::getDateOnFormat($row->starts_at);
        }
        return $this->render('payment', $data);
    }

    /**
     * Add new payment record action
     *
     */
    public function actionAdd()
    {
        Payment::generateNext();
        $this->redirect('index');
    }

    /**
     * Delete payment record by $id
     * @param $id
     */
    public function actionDelete($id)
    {
        (new Payment())->paymentDelete($id);
        $this->redirect('index');
    }
}
