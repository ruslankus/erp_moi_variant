    <div class="modal-header clearfix">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
         <?php if($data->type == 1):?>
        <h4 class="modal-title"><?php echo $data->company_name?></h4>
        <?php else:?>
         <h4 class="modal-title"><?php echo $data->name?> <?php echo $data->surname?></h4>
        <?php endif;?>
    </div><!--/modal-header -->
    
    <div class="modal-body">
    	<div class="cust-info-table">
        <?php if($data->type == 1):?>
       
        	<h5>Company info</h5>
        	<table>
            	<tr>
                	<td>Company name</td>
                    <td><?php echo $data->company_name;?></td>
                </tr>
            	<tr>
                	<td>Company code</td>
                    <td><?php echo $data->company_code ?></td>
                </tr>
            	<tr>
                	<td>VAT code</td>
                    <td><?php echo $data->vat_code ?></td>
                </tr>
            	<tr>
                	<td>tel</td>
                    <td><?php echo $data->phone1; ?></td>
                </tr>
            	<tr>
                	<td>email</td>
                    <td><?php echo $data->email1; ?></td>
                </tr>
                <tr>
                	<td>Adress</td>
                    <td>Kanto al. 18-29, Kaunas ,Lithuania</td>
                </tr>
    	     </table> 
        <?php else:?>
            <h5>Customer info</h5>
        	<table>
            	<tr>
                	<td>First name</td>
                    <td><?php echo $data->name;?></td>
                </tr>
            	<tr>
                	<td>Last Name</td>
                    <td><?php echo $data->surname; ?></td>
                </tr>
            	<tr>
                	<td>Personal code</td>
                    <td><?php echo $data->personal_code; ?></td>
                </tr>
            	<tr>
                	<td>tel</td>
                    <td><?php echo $data->phone1; ?></td>
                </tr>
            	<tr>
                	<td>email</td>
                    <td><?php echo $data->email1; ?></td>
                </tr>
                <tr>
                	<td>Adress</td>
                    <td>Kanto al. 18-29, Kaunas ,Lithuania</td>
                </tr>
    	     </table> 
        <?php endif;?>                                  
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