<?php
$cs = Yii::app()->clientScript;

$cs->registerCssFile(Yii::app()->request->baseUrl.'/css/stock_list.css');
	
?>
   
<?php $this->renderPartial('//partials/_sub_menu',array('links' => $this->GetSubMenu(), 'params' => array())); ?>
  
	<div class="container-fluid  main-content-holder content-wrapper">	
    	<div class="row filter-holder">
            <form>
                <input type="text" placeholder="Product name">
                <input type="text" placeholder="Product code">
                <select>
                	<option>Miestas</option>
                    <option>All</option>
                    <option>Vilnius</option>
                    <option>Kaunas</option>
                    <option>Klaipeda</option>
                </select>
                <select>
                	<option>Miesure units</option>
                    <option>all</option>
                	<option>kg</option>
                	<option>litres</option>
                    <option>units</option>
                </select>
                <button>Search<span class="glyphicon glyphicon-search"></span></button>
           </form> 
        </div><!--/filter-holder -->
        <div class="row table-holder">
        	<table class="table table-bordered table-striped table-hover" >
            	<thead>
                	<tr>
                    	<th>#</th>
                        <th>Product name</th>
                        <th>product code</th>
                        <th> stock</th>
                        <th>measure</th>
                        <th>quantity</th>
                        <th> refurb stock</th>
                        <th>actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php $count = 1;  foreach($products as $product):?>
                	<tr>
                    	<td><?php echo $count; ?></td>
                    	<td><?php echo $product->productCard->product_name;?></td>
                    	<td><?php echo $product->productCard->product_code;?></td>
                    	<td><?php echo $product->stock->location->city_name; ?></td>
                    	<td><?php echo $product->productCard->units; ?></td>
                    	<td><?php echo $product->qnt;?></td>
                        <td></td>
                        <td><a href="#">Send invoice</a></td>
                   <?php $count++; endforeach;?>
                </tbody>
            </table>
        </div><!--/table-holder -->
        
        <div class="modals-holder">
        <!--/ modal area -->
            
        </div><!--/modals-holder -->
        
    </div><!--/container -->
