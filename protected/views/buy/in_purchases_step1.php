<?php
/* @var $cs CClientScript */
$cs = Yii::app()->clientScript;
$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/ui-lightness/jquery-ui-1.10.4.custom.min.css');
$cs->registerCssFile(Yii::app()->baseUrl.'/css/purchases_step1.css');

$cs->registerCoreScript('jquery.ui',CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->baseUrl.'/js/purchase.js',CClientScript::POS_END);
?>    
    
 <?php $this->renderPartial('//partials/_sub_menu',array('links' => $this->GetSubMenu(), 'params' => array())); ?>   

  
  
    <div class="container-fluid  main-content-holder content-wrapper">	  
        <div class="row card-holder">
        
            <div class="col-md-12">
                <div class="form-holder">
                
                    
                    <div class="col-md-12 filter-wrapper">
                    	<div class="form-inline">
                            <div class="form-group filter-group">
                                <label>Find client</label>
                                <input type="text" class="form-control client-filter by-name">
                                <input type="text" class="form-control client-filter by-number">
                                <button class="form-control clearfix">Search<span class="glyphicon glyphicon-search text-right"></span></button>
                            </div><!--/form-group -->
                        </div><!--/form-inline -->
                        
                        <div class="table-holder header-holder">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Cust name</th>
                                        <th>Kod</th>
                                        <th>Adress</th>
                                    </tr>
                                </thead>
                            </table> 
                        </div><!--/table-header-holder -->
                        <div class="table-holder body-holder">
                            <table class="table table-bordered table-hover">
                                <tbody>
                                    <tr>
                                        <td colspan="3" class="text-center"><h5>No data</h5></td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div><!--body-holder-->
                        
                        <div class="new-cust-btn-holder">
                        	<button data-toggle="modal" data-target=".new-customer">New client<span class="glyphicon glyphicon-plus-sign"></span></button>
                        </div><!--/new-cust-btn-holder --> 
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
