<?php
/**
 * Created by PhpStorm.
 * User: andrey
 * Date: 12.04.16
 * Time: 13:52
 */
return [
        'params'=>[],
        'fields'=>[
            [
                'name' => 'stazh',
                'label' => 'Стаж вождения',
                'rules' => ['integer'],
                'fieldType' => 'dropDown',
                'items' => [
                    '0' => 'менее 1 года',
                    '1' => '1 - 3 года',
                    '2' => 'от 3 до 5 лет',
                    '3' => 'более 5 лет',
                ],
                'options' => [],
            ],
            [
                'name' => 'nedostatki',
                'label' => 'Недостатки',
                'rules' => ['string'],
                'fieldType' => 'textarea',
                'options' => [],
            ],
            [
                'name' => 'dostoinstva',
                'label' => 'Достоинства',
                'rules' => ['string'],
                'fieldType' => 'textarea',
                'options' => [],
            ],
            [
                'name' => 'buy_again',
                'label' => 'Купите опять',
                'rules' => ['integer'],
                'fieldType' => 'dropDown',
                'items' => [
                    '1'=>'Да',
                    '0'=>'Нет',
                ],
                'options' => [],
            ],
        ],
        'userClass'=>'\app\models\User1',
    ];