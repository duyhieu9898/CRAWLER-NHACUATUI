// function loadLink() {
//     var xhttp = new XMLHttpRequest();
//     xhttp.onreadystatechange = function() {
//         if (this.readyState == 4 && this.status == 200) {
//             document.getElementById("demo").innerHTML = this.responseText;
//         }
//     };
//     xhttp.open("GET", "../data.php", true);
//     xhttp.send();
// }
$(document).ready(function() {

    $('#loadData').click(function(event) {
        event.preventDefault();
        var link = document.getElementById('link').value;
        $.ajax({
                url: 'data.php',
                type: 'GET',
                dataType: 'html',
                data: { url: link },
            })
            .done(function(data) {
                $('#data').html(data);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

    });
    $('#downLoad').click(function(e) {
        e.preventDefault();
        var link = document.getElementById('link').value;
        $.ajax({
                url: 'download.php',
                type: 'GET',
                dataType: 'html',
                data: {
                    url: link
                },
            })
            .done(function(data) {
                $('#status').html(data);
            })
            .fail(function() {
                console.log("error");
            })
            .always(function() {
                console.log("complete");
            });

    })
});