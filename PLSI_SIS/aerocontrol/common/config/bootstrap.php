<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');

Yii::setAlias('@root', dirname(dirname(__DIR__)));
Yii::setAlias('@uploads', '@common/uploads');
Yii::setAlias('@uploadsUrl', '../../../common/uploads');

Yii::setAlias('@uploadRestaurants', '@uploads/restaurants');
Yii::setAlias('@uploadRestaurantsUrl', '@uploadsUrl/restaurants');

Yii::setAlias('@uploadStores', '@uploads/stores');
Yii::setAlias('@uploadStoresUrl', '@uploadsUrl/stores');

Yii::setAlias('@uploadLostItems', '@uploads/lost-items');
Yii::setAlias('@uploadLostItemsUrl', '@uploadsUrl/lost-items');
