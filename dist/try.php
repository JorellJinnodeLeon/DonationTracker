<html>
  <head></head>
  <body >
    <!--
    BEFORE RUNNING:
    ---------------
    1. If not already done, enable the Google Sheets API
       and check the quota for your project at
       https://console.developers.google.com/apis/api/sheets
    2. Get access keys for your application. See
       https://developers.google.com/api-client-library/javascript/start/start-js#get-access-keys-for-your-application
    3. For additional information on authentication, see
       https://developers.google.com/sheets/api/quickstart/js#step_2_set_up_the_sample
    -->
    <script>

    function makeApiCall() {
        
      var params = {
        // The ID of the spreadsheet to retrieve data from.
        spreadsheetId: '1LBicfoklwBlSKayw8k_cL_Lk_d4RD8iAuy0GDiJ3Pnk',  // TODO: Update placeholder value.

        // The A1 notation of the values to retrieve.
        range: 'List of Cash Donors!D4:D4',  // TODO: Update placeholder value.

        // How values should be represented in the output.
        // The default render option is ValueRenderOption.FORMATTED_VALUE.
        // valueRenderOption: '',  // TODO: Update placeholder value.

        // How dates, times, and durations should be represented in the output.
        // This is ignored if value_render_option is
        // FORMATTED_VALUE.
        // The default dateTime render option is [DateTimeRenderOption.SERIAL_NUMBER].
        // dateTimeRenderOption: '',  // TODO: Update placeholder value.
      };

      var request = gapi.client.sheets.spreadsheets.values.get(params);
      var res = request.then(function(response) {
        // TODO: Change code below to process the `response` object:
        let ret = response.result.values[0];
        alert(ret);
        return ret;
      }, function(reason) {
        console.error('error: ' + reason.result.error.message);
      });

      console.log('nsa labas')
      console.log(res);
    }

    function initClient() {
      var API_KEY = 'AIzaSyDTtjLT8wfsLFHSqDoPmClbcsyeOdgCYqM';  // TODO: Update placeholder with desired API key.

      var CLIENT_ID = '25013647154-ur71nda0bd4vv3eg8a38e9sig75homhp.apps.googleusercontent.com';  // TODO: Update placeholder with desired client ID.

      // TODO: Authorize using one of the following scopes:
      //   'https://www.googleapis.com/auth/drive'
      //   'https://www.googleapis.com/auth/drive.file'
      //   'https://www.googleapis.com/auth/drive.readonly'
      //   'https://www.googleapis.com/auth/spreadsheets'
      //   'https://www.googleapis.com/auth/spreadsheets.readonly'
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

    function handleSignOutClick(event) {
      gapi.auth2.getAuthInstance().signOut();
    }
    </script>
    <script async defer src="https://apis.google.com/js/api.js"
      onload="this.onload=function(){};handleClientLoad()"
      onreadystatechange="if (this.readyState === 'complete') this.onload()">
    </script>
    <button id="signin-button" onclick="handleSignInClick()" onload="makeApiCall1()" >Sign in</button>
    <button id="signout-button" onclick="handleSignOutClick()">Sign out</button>
    
  </body>
</html>