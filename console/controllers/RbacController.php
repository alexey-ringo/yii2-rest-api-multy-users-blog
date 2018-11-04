<?php
namespace console\controllers;
use common\rbac\Rbac;
use common\rbac\rules\PostAuthorRule;
use common\rbac\rules\ProfileOwnerRule;
use Yii;
use yii\console\Controller;
class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();
        
        //Создание правила (совместно с разрешением MANAGE_PROFILE), 
        // проверяющее - соответствует ли id-редактируемого пользователя id-залогиненного в настоящее время
        //т.е. - наш ли это пользователь?
        $rule = new ProfileOwnerRule();
        
        $auth->add($rule);
        
        //Создание разрешения (по константе 'manageProfile' в common\rbac\Rbac.php)
        $manageProfile = $auth->createPermission(Rbac::MANAGE_PROFILE);
        $manageProfile->ruleName = $rule->name;
        $auth->add($manageProfile);
        
        //Создание роли 'user'
        $user = $auth->createRole('user');
        $auth->add($user);
        $auth->addChild($user, $manageProfile);
    }
}