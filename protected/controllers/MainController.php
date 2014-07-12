<?php

class MainController extends Controller
{
    //I N D E X
    public function actionIndex()
    {
        //redirect to ERP module
        $this->render('welcome');
    }

    //L O G  O U T
    public function actionLogout()
    {
        //delete user info from session
        Yii::app()->user->logout();
        $this->redirect('/main/login');
    }

    //L O G  I N
    public function actionLogin()
    {

        //set titles
        $this->page_title = 'Login';
        $this->site_title = 'Olivia ERP';

        //redefine layout
        $this->layout = '//layouts/login_layout';

        //if logged in - redirect to index
        if(!Yii::app()->user->isGuest){$this->redirect($this->createUrl('main/index'));}
        
        $model = new LoginForm();

        //if post request
        if(isset($_POST['LoginForm']))
        {
            //set all parameters from post
            $model->attributes = $_POST['LoginForm'];

            // validate user input and redirect to the previous page if valid
            if($model->validate() && $model->login())
            {
                $this->redirect('index');
            }

        }
        //render form
        $this->render('login',array('model' => $model));
      
    }
}