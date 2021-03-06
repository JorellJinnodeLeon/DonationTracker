<!DOCTYPE html>
<html lang="en">

    <?php 
        require 'nav.php';
    ?>
    <script>

    function makeApiCall() {
      var params = {
        spreadsheetId: '1LBicfoklwBlSKayw8k_cL_Lk_d4RD8iAuy0GDiJ3Pnk',  
        range: 'List of Cash Donors!D4:D4',  
      };
        
      var request = gapi.client.sheets.spreadsheets.values.get(params);
      request.then(function(response) {
        let total = response.result.values[0];
        //console.log(total);
        document.getElementById("titletrack").innerHTML = "We have raised a total of Php "+total+" !";
        total = parseFloat(total.toString().replace(/,/g,""));
        let perc = parseInt(((total/500000)*100));
        //console.log(perc);
        document.getElementById("numInside").innerHTML = perc+"% ("+total+" / 500,000)";
        
        document.getElementById("pbar").style = "width:"+perc+"%";
      }, function(reason) {
        console.error('error: ' + reason.result.error.message);
      });

      
      
      var params = {
        spreadsheetId: '1LBicfoklwBlSKayw8k_cL_Lk_d4RD8iAuy0GDiJ3Pnk',  
        range: 'List of Cash Donors!B7:G200',  
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
        range: 'List of non Cash Donors!B4:G200',  
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
            let name = (value[1]) ? value[1] : null ; 
            let amount = (value[2]) ? value[2] : null ; 
            let via = (value[4]) ? value[4] : null ; 
            let notes = (value[5]) ? value[5] : null ; 

            if(!name && !date && !amount && !via && !notes){
                console.log('empty');
            }  
            else if(date.substring(0, 9) === "Donations"){
                console.log('donations');
            } 
            else{                     
                $('#dataTables-example').DataTable().row.add([
                    name, date, amount, via, notes
                ]).draw();
            }          
        }         
    }

    function tblLooper2(value) {
        if(value)
        {
            let date = (value[0]) ? value[0] : null ; 
            let name = (value[1]) ? value[1] : null ; 
            let donation = (value[2]) ? value[2] : null ; 
            let target = (value[4]) ? value[4] : null ; 
            let notes = (value[5]) ? value[5] : null ; 

            if(!name && !date && !amount && !via && !notes){
                console.log('empty');
            }  
            else if(date.substring(0, 9) === "Donations"){
                console.log('donations');
            } 
            else{                     
                $('#dataTables-example2').DataTable().row.add([
                    name, date, donation, target, notes
                ]).draw();
            }          
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
                        <h1 class="mt-4">One Bayanihan Donation Tracker</h1>

                        <?php
                            /*require __DIR__ . '/../vendor/autoload.php';
                            $client = new \Google_Client();
                            $client->setApplicationName('Google Sheets and PHP');
                            $client->setScopes([\Google_Service_sheets::SPREADSHEETS]);
                            $client->setAccessType('offline');
                            $client->setAuthConfig(__DIR__.'/credentials.json');
                            $service= new Google_Service_Sheets($client);
                            $spreadsheetId = "1LBicfoklwBlSKayw8k_cL_Lk_d4RD8iAuy0GDiJ3Pnk";

                            $total = "List of Cash Donors!D4:D4";
                            $response = $service->spreadsheets_values->get($spreadsheetId,$total);
                            $values = $response->getValues();
                            
                            if(empty($values)){
                                print "error";    
                            } else {
                                foreach($values as $row){
                                    $total =  $row[0];
                                }
                            }
                            $total2 = str_replace( ',', '', $total );
                            $perc = (int)(($total2/500000)*100);
                            */
                        ?>
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Total Donations</div>
                            <div class="card-body">
                                <h1 id="titletrack"> </h1>
                                <div class="progress" style="height: 3rem;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated" id="pbar" role="progressbar" 
                                    style="width:10%">
                                        <span id="numInside"> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                       
                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Cash Donations</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example" border="1">
                                        <thead>
                                            <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Donation Via</th>
                                            <th>Notes</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Donation Via</th>
                                                <th>Notes</th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>            
                        


                        <div class="card mb-4">
                            <div class="card-header"><i class="fas fa-table mr-1"></i>Donations In Kind</div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example2" border="1">
                                        <thead>
                                            <tr>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Donation</th>
                                            <th>Target Recipient</th>
                                            <th>Notes</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>Donation</th>
                                                <th>Target Recipient</th>
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
