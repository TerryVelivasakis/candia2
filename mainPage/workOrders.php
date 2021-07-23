<style>
.addSpacing{
  margin-right: 15px !important;
}
</style>

<h5 class="card-header">Add Work Order</h5>
<div>
<table class='table table-sm'>
  <tr>
    <td width=50%>Priority</td>
    <td>Category</td>
  </tr>
  <tr>
    <td>
      <div class = "addSpacing">
        <select class="form-select" id="selPriority" placeholder="Priority">
          <option value="" disabled selected>Priority</option>
          <option value='5'>Emergency</option>
          <option value='4'>High</option>
          <option value='3'>Average</option>
          <option value='2'>Low</option>
          <option value='1'>Routine</option>
          <option value='0'>On The List</option>
        </select>
      </div>
    </td>

    <td>
      <div class = "addSpacing">
        <select class="form-select addSpacing" id="selCategory">
          <option value="" disabled selected>Category</option>
          <option value='electric'>Electric</option>
          <option value='HotCold'>Hot/Cold Call</option>
          <option value='plumbing'>Plumbing</option>
          <option value='janitorial'>Janitorial</option>
          <option value='paper'>Paper/Soap Refill</option>
          <option value='IT'>Internet/IT</option>
          <option value='other'>Other</option>
        </select>
      </div>
    </td>
  </tr>
  <tr>
    <td>Location</td>
    <td>Requesting Tenant</td>
  </tr>
  <tr>
    <td>
      <div class = "addSpacing">
        <input id='inputlocation' class='form-control'></input>
      </div>
    </td>
    <td>
      <div class = "addSpacing">
        <input id='inputrequester' class='form-control'></input>
      </td>
    </div>
  </tr>
  <tr>
    <td colspan='2'>Description</td>
  </tr>
  <tr>
    <td colspan=2><input class='form-control' id='inputWODescription'></input></td>
  </tr>
</table>
<div class=mt-2>
<button class='btn btn-sm btn-primary'>Add Work Order</button>
<button class='btn btn-sm btn-Secondary' onclick='clearForm()'>Clear Form</button>
</div>
</div>


<script>
function clearForm(){
$('#selPriority option').eq(0).prop('selected', true);
$('#selCategory option').eq(0).prop('selected', true);
$('#inputlocation').val('');
$('#inputrequester').val('');
$('#inputWODescription').val('');
}

</script>
