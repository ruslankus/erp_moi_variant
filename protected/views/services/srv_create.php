<?php /* @var $service ServiceProcesses */ ?>
<?php /* @var $services array */ ?>
<?php /* @var $this ServicesController */ ?>

<?php /* @var $cs CClientScript */ ?>

<?php /* @var $form_mdl ServiceForm */?>
<?php /* @var $form CActiveForm */ ?>
<?php /* @var $clients array */ ?>
<?php /* @var $problems array */ ?>
<?php /* @var $cities array */ ?>
<?php /* @var $workers array */ ?>

<?php
$cs = Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/bootstrap-editable.css');
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/tickets_card.css');

$cs->registerCoreScript('jquery.ui',CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/bootstrap-editable.js',CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/service.js',CClientScript::POS_END);
?>

<?php $this->renderPartial('//partials/_sub_menu',array('links' => $this->GetSubMenu(), 'params' => array())); ?>

    <div class="container-fluid  main-content-holder content-wrapper">	  
        <div class="row card-holder">
        
            <div class="col-md-12">
                <div class="form-holder">
                
                    <div class="form-group">
                        <label for="client-type">Client Type</label>
                        <select id="client-type" class="form-control">
                            <option value="0">Please select</option>
                            <option value="1">Fizinis</option>
                            <option value="2">Juridinis</option>
                        </select>
                    </div><!--/form-group -->
                    
                    <div class="col-md-12 filter-wrapper">
                    <!--/filter ajax goes here --> 
                    <h5 class="text-center">Select client type</h5>
                    </div><!--filter-wrapper -->
                    
                    <div class="light-box-holder">
                        <div class="modal cust-info"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header clearfix">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">Jonas Petraitis</h4>
                                    </div><!--/modal-header -->
                                    
                                    <div class="modal-body">
                                    	<div class="cust-info-table">
                                        	<h5>Customer info</h5>
                                        	<table>
                                            	<tr>
                                                	<td>First name</td>
                                                    <td>Jonas</td>
                                                </tr>
                                            	<tr>
                                                	<td>Last Name</td>
                                                    <td>Petraitis</td>
                                                </tr>
                                            	<tr>
                                                	<td>Personal code</td>
                                                    <td>23432432432</td>
                                                </tr>
                                            	<tr>
                                                	<td>tel</td>
                                                    <td>353454354</td>
                                                </tr>
                                            	<tr>
                                                	<td>email</td>
                                                    <td>4354365436</td>
                                                </tr>
                                                <tr>
                                                	<td>Adress</td>
                                                    <td>Kanto al. 18-29, Kaunas ,Lithuania</td>
                                                </tr>
										     </table>                                   
                                        </div><!--/cust-info-table -->
                                        <div class="last-purchase-table">
                                        <h5>Last Purchase</h5>
                                        	<table>
                                        		<thead>
                                                	<tr>
                                                    	<th>#</th>
                                                    	<th>date</th>
                                                        <th>code</th>
                                                        <th>product</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                	<tr>
                                                    	<td>1</td>
                                                        <td>12.23.2014</td>
                                                        <td>F2143214321</td>
                                                        <td>Filtras 131</td>
                                                    </tr>
                                                    
                                                	<tr>
                                                    	<td>1</td>
                                                        <td>12.23.2014</td>
                                                        <td>F2143214321</td>
                                                        <td>Filtras 131</td>
                                                    </tr>
                                                    
                                                	<tr>
                                                    	<td>1</td>
                                                        <td>12.23.2014</td>
                                                        <td>F2143214321</td>
                                                        <td>Filtras 131</td>
                                                    </tr>
                                                </tbody>
                                                </tbody>
                                                </tbody>
                                        	</table>
                                        </div><!--/last-purchase-table -->
                                    </div><!--/modoal-body -->
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close<span class="glyphicon glyphicon-thumbs-down"></span></button>
                                        <button type="button" class="btn btn-primary">Continue<span class="glyphicon glyphicon-share-alt"></span></button>
                                    </div><!--/modal-footer -->
                                    
                                </div><!--/modal-content -->
                            </div><!--/modal-dialog -->
                        </div><!--/modal -->                    
                    	
                        <div class="modal new-customer" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-md">
                                <div class="modal-content">
                                    <div class="modal-header clearfix">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                        <h4 class="modal-title">New user</h4>
                                    </div><!--/modal-header -->
									<form action="#" method="post";>
                                    
                                    <div class="modal-body">
                                    	<div class="new-customer-table-holder">
                                        	<table>
                                            	<tr>
                                                	<td><label>First Name</label></td>
                                                    <td><input type="text" name="fname"><div class="errorMessage error">Error message</div></td>
                                                </tr>
                                                
                                            	<tr>
                                                	<td><label>Last Name</label></td>
                                                    <td><input type="text" name="fname"><div class="errorMessage error">Error message</div></td>
                                                </tr>
                                                
                                            	<tr>
                                                	<td><label>email</label></td>
                                                    <td><input type="text" name="fname"></td>
                                                </tr>
                                        	</table>
                                        </div><!--/new-customer-table-holder -->
                                    </div><!--/modal-body -->
                                    
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close<span class="glyphicon glyphicon-thumbs-down"></span></button>
                                        <button type="button" class="btn btn-primary">Continue<span class="glyphicon glyphicon-share-alt"></span></button>
                                    </div><!--/modal-footer -->
                                    </form>
                                </div><!--/modal-content -->
                            </div><!--/modal-dioalog -->
                        </div><!--/moda new-customer -->
                    </div><!--/light-box-holder -->
                </div><!--/form-holder -->
            </div><!--/left -->
        </div><!--row -->
    </div><!--/container -->


