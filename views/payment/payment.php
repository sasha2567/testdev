<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;


$this->title = 'Get Payment';
?>
<div class="site-payment">

    <div class="payment-title">


        <p class="lead payment-data-title">Payment from
            <span class="from-to"><?=(isset($start) ? $start : '')?></span>
            to <span class="from-to"><?=(isset($end) ? $end : '')?></span>
        </p>

        <div class="button payment-add">
            <?php
                echo Html::beginForm(['/payment/add'], 'post', ['class' => 'navbar-form']);

                echo Html::submitButton('Create  Payment',['class' => 'btn btn-link payment-add-button', 'name' => 'paymentAdd']);

                echo Html::endForm();
            ?>
        </div>
        <br class="clearfix">
    </div>

    <div class="body-content">

        <div class="row table-payment">
            <div class="col-lg-12">
                <div class="row row-title">
                    <div class="numbers">
                        <span>#</span>
                    </div>
                    <div class="start-date">
                        <span>Dates</span>
                    </div>
                    <div class="user-email">
                        <span>Creator</span>
                    </div>
                    <div class="delete-button">
                        <span>Action</span>
                    </div>
                </div>
            <?php
                for ($i = 0;  $i < + count($data); $i++) :
            ?>
                <div class="row <?=($i%2==0)?'even':'odd'?>">
                    <div class="numbers">
                        <span><?=($pagination->offset * $pagination->getPage() + $i + 1)?></span>
                    </div>
                    <div class="start-end-date">
                        <span><?=$data[$i]->starts_at?></span> -
                        <span><?=$data[$i]->ends_at?></span>
                    </div>
                    <div class="user-email">
                        <span><?=$data[$i]->user->email?></span>
                    </div>
                    <div class="delete-button">

                            <?php
                                if(Yii::$app->user->identity->id === $data[$i]->user_userid) :
                            ?>
                                <p>
                            <?php
                                    echo Html::a('Delete', Url::toRoute(['/payment/delete', 'id' => $data[$i]->payment_id]));
                            ?>
                                </p>
                            <?php
                                endif;
                            ?>
                    </div>
                </div>
            <?php endfor; ?>
            </div>
            <?=LinkPager::widget([
            'pagination' => $pagination,
            ]);?>
        </div>

    </div>
</div>
