<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\components\helpers\HelperFormat;


$this->title = 'Get Payments';
?>
<div class="site-payment">

    <div class="payment-title">


        <p class="lead payment-data-title">Payments from
            <span class="from-to"><?=(isset($start) ? $start : '')?></span>
            to <span class="from-to"><?=(isset($end) ? $end : '')?></span>
        </p>

        <div class="button payment-add">
            <?php
                echo Html::beginForm(['/payment/add'], 'post', ['class' => 'navbar-form']);

                echo Html::submitButton('Create  Payment',['class' => 'btn btn-link btn btn-primary', 'name' => 'paymentAdd']);

                echo Html::endForm();
            ?>
        </div>
        <br class="clearfix">
    </div>

    <div class="body-content">

        <div class="row table-payment">
            <div class="col-lg-12">
                <table class="table table-striped">
                    <tr>
                        <th>#</th>
                        <th>Dates</th>
                        <th>Creator</th>
                        <th>Action</th>
                    </tr>
            <?php
                for ($i = 0;  $i < + count($listing); $i++) :
            ?>
                    <tr>
                    <td>
                        <span><?=($pages->offset * $pages->getPage() + $i + 1)?></span>
                    </td>
                    <td>
                        <span><?=HelperFormat::getDateOnFormat($listing[$i]->starts_at)?></span> -
                        <span><?=HelperFormat::getDateOnFormat($listing[$i]->ends_at)?></span>
                    </td>
                    <td>
                        <span><?=$listing[$i]->user->email?></span>
                    </td>
                    <td>
                            <?php
                                if(Yii::$app->user->id === $listing[$i]->user_userid) :
                            ?>
                                <p>
                            <?php
                                    echo Html::a('Delete', Url::toRoute(['/payment/delete', 'id' => $listing[$i]->payment_id]));
                            ?>
                                </p>
                            <?php
                                endif;
                            ?>
                    </td>
                    </tr>
            <?php endfor; ?>
                </table>
            </div>
            <?=LinkPager::widget([
                'pagination' => $pages,
            ]);?>
        </div>
    </div>
</div>
