<?php

namespace App {

    class Constants {

        //Цвета
        const COLOR_LIGHT = 1;
        const COLOR_DARK = 2;
        const COLOR_HALF = 3;
        //Типы (модели)
        const MODEL_SLIMFIT = 1;
        const MODEL_MIDFIT = 2;
        const MODEL_CLASSIC = 3;

     
        
        const SERVICE_GROWTH_GUID = '00000000-0000-0000-0000-000000000000';
        
        const ORDER_TYPE = [
            'one_click'=>'Один клик',
//            'quick'=>'Быстрый заказ',
            'normal'=>'Стандартный'
        ];
        const OWL_SHOP_ORDER_TYPE_FIELD = 5; //При необходимости перестроить таблицу, нужно поменять на соответствющий номер поля. Отсчет с 0
    }

}