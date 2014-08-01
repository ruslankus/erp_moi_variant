<?php

class ServicesController extends Controller
{
    /**
     * @return array
     */
    public function GetSubMenu()
    {
        $arr = array(
            'services' => array('action' => 'list','visible' => $this->rights['services_see'] ? 1 : 0 , 'class' => 'list-products'),
            'add service' => array('action' => 'create', 'visible' => $this->rights['services_add'] ? 1 : 0, 'class' => 'create-product'),
        );

        return $arr;
    }

    /**
     * Entry point
     */
    public function actionIndex()
    {
        //do listing
        $this->actionList();
    }

    /**
     * List all processes
     */
    public function actionList()
    {
        //get all processes
        $processes = ServiceProcesses::model()->with('problemType','operation', 'serviceResolutions')->findAll();

        //render table
        $this->render('srv_list',array('services' => $processes));
    }

    /**
     * Create new service-process
     */
    public function actionCreate()
    {
        $this->render('srv_create');
        
    }//createAction

    public function actionEdit($id = null)
    {
        $form = new SrvEditForm();

        /* @var $worker_position Positions */

        //cities
        $cities = array('ALL' => $this->labels['all']) + UserCities::model()->findAllAsArray();

        //problem types
        $problem_types = json_encode(ServiceProblemTypes::model()->findAllAsArray());

        //get worker position
        $worker_position = Positions::model()->findByAttributes(array('name' => 'Worker'));

        //get all workers
        $workers = $worker_position->getAllUsersAsArray();

        $srv_process = ServiceProcesses::model()->with('client','problemType','currentEmployee','serviceResolutions')->findByPk($id);
        $this->render('srv_edit',array('service' => $srv_process, 'problem_types' => $problem_types, 'cities' => $cities, 'workers' => $workers, 'form_mdl' => $form));
    }
}