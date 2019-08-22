<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        // добавляем разрешение "makeCRUD"
        $makeCRUD = $auth->createPermission('makeCRUD');
        $makeCRUD->description = 'Create Read Update Delete';
        $auth->add($makeCRUD);

        // добавляем роль "admin" и даём роли разрешение "makeCRUD"
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $makeCRUD);

        // Назначение ролей пользователям. 1 это IDs возвращаемые IdentityInterface::getId()
        // обычно реализуемый в модели User.
        $auth->assign($admin, 1);
    }
}