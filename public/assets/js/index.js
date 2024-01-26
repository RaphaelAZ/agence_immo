//
//  VARIABLES
//


//
//  FUNCTIONS
//


//
//  MAIN CODE
//

if(document.getElementById('previous-page-button')){
    document.getElementById('previous-page-button').addEventListener('click', function() {
        history.back();
    });
}