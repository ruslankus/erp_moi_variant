
<div class="form-inline">
    <div class="form-group filter-group">
        <label>Filter</label>
        <input type="text" class="form-control client-filter by-name">
        <input type="text" class="form-control client-filter by-number">
        <button id="filter-search" class="form-control clearfix">Search<span class="glyphicon glyphicon-search text-right"></span></button>
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
	<button data-toggle="modal" data-target=".new-customer">New company<span class="glyphicon glyphicon-plus-sign"></span></button>
</div><!--/new-cust-btn-holder -->