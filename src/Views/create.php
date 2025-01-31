<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Simple Form Submission</title>
</head>

<body>
    <div class="container">

        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
                <h1 class="mt-4 mb-4">Simple Form Submission</h1>
                <a href="/" class="mb-3 btn btn-info text-white">Back to Home</a>
                </br>

                <form method="POST" id="submitForm" action="/store" >
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Amount</label> <span class="text-danger">*</span>
                                <input type="number" name="amount" min="0" step="1" class="form-control" placeholder="Enter Amount">
                                <small id="amountError" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label>Buyer</label> <span class="text-danger">*</span>
                                <input type="text" name="buyer" class="form-control" placeholder="Enter Buyer Name">
                                <small id="buyerError" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label>Receipt Id</label> <span class="text-danger">*</span>
                                <input type="text" name="receipt_id" class="form-control" placeholder="Enter Receipt Id">
                                <small id="receiptIdError" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label>Buyer Email</label> <span class="text-danger">*</span>
                                <input type="email" name="buyer_email" class="form-control" placeholder="Enter Buyer Email">
                                <small id="buyerEmailError" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label>Note</label> <span class="text-danger">*</span>
                                <textarea name="note" class="form-control"></textarea>
                                <small id="noteError" class="text-danger"></small>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City</label> <span class="text-danger">*</span>
                                <input type="text" name="city" class="form-control" placeholder="Enter City">
                                <small id="cityError" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label>Phone</label> <span class="text-danger">*</span>
                                <input type="number" name="phone" class="form-control" placeholder="Enter Phone">
                                <small id="phoneError" class="text-danger"></small>
                            </div>
                            <div class="form-group">
                                <label>Entry By</label> <span class="text-danger">*</span>
                                <input type="number" name="entry_by" class="form-control" placeholder="Enter Entry By">
                                <small id="entryByError" class="text-danger"></small>
                            </div>
                            <div class="form-group" id="item-list">
                                <div id="1" class="item">
                                    <label>Items</label> <span class="text-danger">*</span>
                                    <input type="text" name="items[]" class="form-control" placeholder="Enter Items">
                                </div>
                            </div>
                            <div class="col-xs-12 mt-2">
                                <button type="button" data-repeater-create="" class="btn btn-primary btn-sm" id="add-invoice-item"> <i class="fa fa-plus"></i> Add Item</button>
                            </div>
                        </div>

                        <button type="submit" id="submitButton" class="mt-3 mb-3 p-2 btn btn-success btn-lg btn-block">Submit</button>
                    </div>
                    
                </form>
            </div>
            <div class="col-md-2"></div>
        </div>


    </div>

    <!-- Optional JavaScript -->

    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    
    <!-- Popper.js and Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/store.js"></script>
    <script src="/js/alertMessages.js"></script>

</body>

</html>