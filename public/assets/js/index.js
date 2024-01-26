if(document.getElementById('previous-page-button')){
    document.getElementById('previous-page-button').addEventListener('click', function() {
        history.back();
    });
}

function toggleFavorite(button) {
    var annonceId = button.getAttribute('data-annonce-id');

    button.classList.toggle('active');

    if (button.classList.contains('active')) {
        $.ajax({
            success: function (response) {
                console.log('Succès de la requête AJAX');
                window.location.href = '/favorite/'+annonceId;
            },
            error: function (error) {
                console.error('Erreur de la requête AJAX', error);
            }
        });
    }
}