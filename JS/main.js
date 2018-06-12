console.log('main.js here');


function searchUser() {
    const url = '../UTILS/ajaxhandler.php?action=getlastuser';
    $.get(url,
        response => {
            $('#display-lastuser').text(response);
        }, 'text'
    );
}

//Affichage tableau articles commandés

$('#add-commandearticle').submit(function () {
    console.log('test')
    //displayArticlesList();
});

function displayArticlesList() {
    const url = '../UTILS/Ajax.php?action=getlist' ;
    $.get(url,
        response => {
            //var tableArticles = $('#list-articles');
            // var showId = document.createElement('td');
            // var showNom = document.createElement('td');
            // var showPrix = document.createElement('td');
            // var showQuantite = document.createElement('td');


            console.log(response)


        }, 'json'
    );
}


