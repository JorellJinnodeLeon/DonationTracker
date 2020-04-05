<!DOCTYPE html>
<html lang="en">

    <?php 
        require 'nav.php';
    ?>
    <script>

    function makeApiCall() {

      var params = {
        spreadsheetId: '1LBicfoklwBlSKayw8k_cL_Lk_d4RD8iAuy0GDiJ3Pnk',  
        range: 'Expenses!A5:K200',  
      };
        
      var request = gapi.client.sheets.spreadsheets.values.get(params);
      request.then(function(response) {
        let tbl = response.result.values;
        //console.log(test);
        tbl.forEach(tblLooper);
            
      }, function(reason) {
        console.error('error: ' + reason.result.error.message);
      });
      


      var params = {
        spreadsheetId: '1LBicfoklwBlSKayw8k_cL_Lk_d4RD8iAuy0GDiJ3Pnk',  
        range: 'Allocation!A4:L200',  
      };
        
      var request = gapi.client.sheets.spreadsheets.values.get(params);
      request.then(function(response) {
        let tbl = response.result.values;
        //console.log(test);
        tbl.forEach(tblLooper2);
            
      }, function(reason) {
        console.error('error: ' + reason.result.error.message);
      });
    }

    function tblLooper(value) {
        if(value)
        {
            let date = (value[0]) ? value[0] : null ; 
            let supplier = (value[1]) ? value[1] : null ; 
            let item = (value[2]) ? value[2] : null ; 
            let unit = (value[3]) ? value[3] : null ; 
            let unitCost = (value[4]) ? value[4] : null ; 
            let qty = (value[5]) ? value[5] : null ; 
            let totCost = (value[6]) ? value[6] : null ; 
            let dateOrdered = (value[7]) ? value[7] : null ; 
            let paid = (value[8]) ? value[8] : null ; 
            let rec = (value[9]) ? value[9] : null ; 
            let notes = (value[10]) ? value[10] : null ; 
             
            $('#dataTables-example').DataTable().row.add([
                date, supplier, item, unit, unitCost, qty, totCost, dateOrdered, paid, rec, notes
            ]).draw();
            
        }         
    }

    function tblLooper2(value) {
        if(value)
        {
            let recip = (value[0]) ? value[0] : null ; 
            let fshield = (value[1]) ? value[1] : null ; 
            let smask = (value[2]) ? value[2] : null ; 
            let alc = (value[3]) ? value[3] : null ; 
            let n95 = (value[4]) ? value[4] : null ; 
            let hwash = (value[5]) ? value[5] : null ; 
            let hsoap = (value[6]) ? value[6] : null ; 
            let soln = (value[7]) ? value[7] : null ; 
            let sanit = (value[8]) ? value[8] : null ; 
            let disDate = (value[9]) ? value[9] : null ; 
            let recDate = (value[10]) ? value[10] : null ; 
            let notes = (value[11]) ? value[11] : null ; 
            $('#dataTables-example2').DataTable().row.add([
                recip, fshield, smask, alc, n95, hwash, hsoap, soln, sanit, disDate, recDate, notes
            ]).draw();
                     
        }         
    }

    function initClient() {
      var API_KEY = 'AIzaSyDTtjLT8wfsLFHSqDoPmClbcsyeOdgCYqM';  // TODO: Update placeholder with desired API key.
      var CLIENT_ID = '25013647154-ur71nda0bd4vv3eg8a38e9sig75homhp.apps.googleusercontent.com';  // TODO: Update placeholder with desired client ID.

      var SCOPE = 'https://www.googleapis.com/auth/spreadsheets.readonly';

      gapi.client.init({
        'apiKey': API_KEY,
        'clientId': CLIENT_ID,
        'scope': SCOPE,
        'discoveryDocs': ['https://sheets.googleapis.com/$discovery/rest?version=v4'],
      }).then(function() {
        gapi.auth2.getAuthInstance().isSignedIn.listen(updateSignInStatus);
        updateSignInStatus(gapi.auth2.getAuthInstance().isSignedIn.get());
      });
    }

    function handleClientLoad() {
      gapi.load('client:auth2', initClient);
    }

    function updateSignInStatus(isSignedIn) {
        makeApiCall();
    }

    function handleSignInClick(event) {
      gapi.auth2.getAuthInstance().signIn();
    }
    </script>
    <script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">List of Expenses and Allocation</h1>

                        </div>

                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Expenses</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example" border="1">
                                        <thead>
                                            <tr>
                                            <th>Date</th>
                                            <th>Supplier</th>
                                            <th>Item</th>
                                            <th>Unit</th>
                                            <th>Unit Cost</th>
                                            <th>Quantity</th>
                                            <th>Total Cost</th>
                                            <th>Date Ordered</th>
                                            <th>Paid</th>
                                            <th>Received</th>
                                            <th>Notes</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Date</th>
                                                <th>Supplier</th>
                                                <th>Item</th>
                                                <th>Unit</th>
                                                <th>Unit Cost</th>
                                                <th>Quantity</th>
                                                <th>Total Cost</th>
                                                <th>Date Ordered</th>
                                                <th>Paid</th>
                                                <th>Received</th>
                                                <th>Notes</th>
                                            </tr>
                                        </tfoot>
                                        <d>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>            
                        


                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Allocation</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example2" border="1">
                                        <thead>
                                            <tr>
                                                <th>Recipient</th>
                                                <th>Face Shield (per pc)</th>
                                                <th>Surgical Mask (50 per box)</th>
                                                <th>Alcohol (per gallon)</th>
                                                <th>KN/N95 Mask (10 per box)</th>
                                                <th>Surdex-Surgical hand was per gallon</th>
                                                <th>Lysodex-liquid hand soap</th>
                                                <th>Benzol 1-concentraded disinfectant solution</th>
                                                <th>60ml alcodex hand-sanitizer</th>
                                                <th>Dispatch Date</th>
                                                <th>Received Date</th>
                                                <th>Notes</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Recipient</th>
                                                <th>Face Shield (per pc)</th>
                                                <th>Surgical Mask (50 per box)</th>
                                                <th>Alcohol (per gallon)</th>
                                                <th>KN/N95 Mask (10 per box)</th>
                                                <th>Surdex-Surgical hand was per gallon</th>
                                                <th>Lysodex-liquid hand soap</th>
                                                <th>Benzol 1-concentraded disinfectant solution</th>
                                                <th>60ml alcodex hand-sanitizer</th>
                                                <th>Dispatch Date</th>
                                                <th>Received Date</th>
                                                <th>Notes</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>   
                        


                    </div>
                </main>

                <?php 
                    require 'footer.php';
                ?>
                
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.4.1.min.js" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/datatables-demo.js"></script>
    </body>
</html>
