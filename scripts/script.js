window.onload = () =>
{
    var COUNT = 0;
    $('.filmPoster').each(function () {
        var URL = "https://api.themoviedb.org/3/search/movie?api_key=267ec9"+
            "f80bdb9fbe984bcfd1ae90b535&language=en-US&page=1&include_adult"+
            "=false&query=";
        var title = $(this).text();
        URL += title;
        ImgPoster(URL, COUNT);
        COUNT++;
    });
    filmsALaffiche();
    pagination_button_gestion();
};
function ImgPoster (URL, COUNT)
{
    $.getJSON(URL, function (datas) {
        document.getElementsByClassName("filmPoster")[COUNT]
            .innerHTML = "<img src='http://image.tmdb.org/t/p/w300/"
            + datas['results'][0]['poster_path']
            + "'>";
        if (!datas['results'][0]['poster_path'])
        {
            document.getElementsByClassName("filmPoster")[COUNT]
                .innerHTML = "<img src='https://via.placeholder.com/300x500'>";
        }
    });
}
function filmsALaffiche()
{
    $(".films_affiche").append(
        "<h4>Our movies currently playing</h4><table>"
    );
    $.getJSON("https://api.themoviedb.org/3/movie/now_playing?"+
        "api_key=267ec9f80bdb9fbe984bcfd1ae90b535&language=en-US&page=1-6",
        function (datas) {
            $.each(datas['results'], function (key, array) {
                $(".films_affiche").append("<table class=''><tr><td>" +
                    "<img src='http://image.tmdb.org/t/p/w500" +
                    array['poster_path'] + "'></td>" +
                    "<td>" + array['title'] + "</td>"+
                    "<td>" + array['overview'] + "</td>"+
                    "<td>" + array['release_date'] + "</td>"+
                    "</tr></table>");
            });
        });
}
function pagination_button_gestion()
{
    var buttons = document.getElementsByClassName("button_page");
    var actual_link = window.location.href;
    var to_change_pos = actual_link.indexOf("pageNbr=") + "pageNbr=".length;
    var to_change = actual_link.substr(to_change_pos);
    buttons[0].onclick = () =>
    {
        to_change--;
        window.location.href = actual_link.substr(0, to_change_pos) +
            to_change;
    };
    buttons[1].onclick = () =>
    {
        to_change++;
        window.location.href = actual_link.substr(0, to_change_pos) +
            to_change;
    };
}