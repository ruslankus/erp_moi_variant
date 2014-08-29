    <div class="modal-header clearfix">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title"><?php echo $data->company_name; ?></h4>
    </div><!--/modal-header -->
    
    <div class="modal-body">
    	<div class="cust-info-table">
        	<h5>Customer info</h5>
        	<table>
            	<tr>
                	<td>Company name</td>
                    <td><?php echo $data->company_name; ?></td>
                </tr>
            
            	<tr>
                	<td>Company code</td>
                    <td><?php echo $data->company_code?></td>
                </tr>
                <tr>
                	<td>VAT code</td>
                    <td><?php echo $data->vat_code?></td>
                </tr>
            	<tr>
                	<td>Tel</td>
                    <td><?php echo $data->phone1; echo ' ,'.$data->phone2; ?></td>
                </tr>
            	<tr>
                	<td>email</td>
                    <td><?php echo $data->email1; echo ($data->email2)? ' ,'.$data->email2 : ''; ?></td>
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
        <a href="/buy/createinvoice/<?php echo $data->id ?>" type="button" class="btn btn-primary">Continue<span class="glyphicon glyphicon-share-alt"></span></a>
    </div><!--/modal-footer -->