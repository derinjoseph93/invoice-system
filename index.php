<!DOCTYPE html>
<html>
<head>

<style>
#invoiceItem {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#invoiceItem td, #invoiceItem th {
  border: 1px solid #ddd;
  padding: 8px;
}

#invoiceItem tr:nth-child(even){background-color: #f2f2f2;}

#invoiceItem tr:hover {background-color: #ddd;}

#invoiceItem th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #00BFFF;
  color: white;
}
.button {
  background-color: #28a745;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.buttondel {
  background-color: #E41B17;
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
</style>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<title>Invoice</title>
<script src="js/invoicetest.js"></script>
<div class="container content-invoice">
   <div class="cards">
     <div class="card-bodys">
       <form action="print.php" id="invoice-form" method="post" class="invoice-form" role="form" novalidate="">
      <div class="load-animate animated fadeInUp">
         <div class="row">
            <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
               <h2 class="title"></h2>
            </div>
         </div>
		 
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
               <h3>Address</h3>
              <!-- <div class="form-group">
                  <input type="text" class="form-control" name="companyName" id="companyName" placeholder="Company Name" autocomplete="off">
               </div>-->
               <div class="form-group">
                  <textarea class="form-control" rows="3" name="address" id="address" placeholder="Address"></textarea>
               </div>
            </div>
         </div>
		 
		 
         <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
               <table class="table table-condensed table-striped" id="invoiceItem">
                  <tr>
                     <th width="2%">
                      <div class="custom-control custom-checkbox mb-3">
                       <!-- <input type="checkbox" class="custom-control-input" id="checkAll" name="checkAll">
                        <label class="custom-control-label" for="checkAll"></label>-->
                        </div>
                    </th>
                     <th width="38%">Name</th>
                     <th width="15%">Quantity</th>
                     <th width="15%">Unit Price</th>
                     <th width="15%">Tax</th>
                     <th width="15%">LineTotal</th>
                  </tr>
                  <tr>
                     <td><div class="custom-control custom-checkbox">
                        <input type="checkbox" class="itemRow custom-control-input" id="itemRow_1">
                        <label class="custom-control-label" for="itemRow_1"></label>
                        </div></td>
                     <td><input type="text" name="productName[]" id="productName_1" class="form-control" autocomplete="off"></td>
                     <td><input type="number" name="quantity[]" id="quantity_1" class="form-control quantity" autocomplete="off"></td>
                     <td><input type="number" name="price[]" id="price_1" class="form-control price" autocomplete="off"></td>
                     <td>
                     <select name="tax[]" id="tax_1" class="form-control tax">
                       <option value="0"> 0 </option>
                       <option value="1"> 1 </option>
                       <option value="5"> 5 </option>
                       <option value="10"> 10 </option>
                     <select>
                     </td>
                     <td><input readonly type="text" name="total[]" id="total_1" class="form-control total" autocomplete="off"></td>
                  </tr>
               </table>
            </div>
         </div>
         <div class="row">
            <div class="col-xs-12">
              
               <button class="button" id="addRows" type="button">+ Add More</button>
			    <button class="buttondel delete" id="removeRows" type="button">- Delete</button>
            </div>
         </div>
         <div class="row">
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group mt-3 mb-3 ">
              <label>Subtotal without Tax: &nbsp;</label>
                 <div class="input-group mb-3">
            <div class="input-group-prepend">
            </div>
            <input value="" readonly type="text" class="form-control" name="subTotal" id="subTotal" placeholder="Subtotal">
          </div>
              </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group mt-3 mb-3 ">
              <label>Total tax in(%): &nbsp;</label>
                 <div class="input-group mb-3">
            <div class="input-group-prepend">
            </div>
           <input value="" readonly type="text" class="form-control" name="taxRate" id="taxRate" placeholder="Tax Rate">
          </div>
              </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group mt-3 mb-3 ">
              <label>Tax Amount: &nbsp;</label>
                 <div class="input-group mb-3">
            <div class="input-group-prepend">
            </div>
            <input value="" readonly type="text" class="form-control" name="taxAmount" id="taxAmount" placeholder="Tax Amount">
          </div>
              </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group mt-3 mb-3 ">
              <label>Subtotal with tax: &nbsp;</label>
                 <div class="input-group mb-3">
            <div class="input-group-prepend">
            </div>
             <input type="text" readonly class="form-control" name="totalAftertax" id="totalAftertax" placeholder="Total">
          </div>
              </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group mt-3 mb-3 ">
              <label>Discount in($) : &nbsp;</label>
                 <div class="input-group mb-3">
            <div class="input-group-prepend">
            </div>
            <input value="" type="number" class="form-control" name="discount" id="discount" placeholder="Discount">
          </div>
              </div>
          </div>
          <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <div class="form-group mt-3 mb-3 ">
              <label>Final Total: &nbsp;</label>
                 <div class="input-group mb-3">
            <div class="input-group-prepend">
            </div>
             <input readonly class="form-control" name="finaltotal" id="finaltotal" placeholder="Final Total">
          </div>
              </div>
          </div>
            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
               <div class="form-group">
                  <input type="submit" name="invoice_btn" value="Generate Invoice" class="button">           
               </div>
            </div>
         </div>
         <div class="clearfix"></div>
      </div>
   </form>
     </div>
   </div>
</div>
</div>
        </div>
      </div>
    </div>
  </body>
</html>