<?php
/**
 * Creates an API call to fetch the available movie genres that are listed by TMDB.
 *
 * The returned genres are then used to dynamically create a sidebar on the homepage that the user can use to view
 * movies belonging to each genre.
 *
 * @return mixed - JSON object holding information about each of the genres such as the name, id, etc.
 */
function GetGenres()
{
    // Create the API call to get the available movie genres
    $genreAPI = file_get_contents("https://api.themoviedb.org/3/genre/movie/list?api_key=" . getenv("TMDB_API") . "&language=en-US");
    $genreJSON = json_decode($genreAPI);

    // Loop through each genre and add it to the genre sidebar on the homepage
    foreach ($genreJSON->genres as $index => &$genre)
    {
        // Give the first element the active class
        $idx = $index == 0 ? 'active' : '';
        $selected = $index == 0 ? 'true' : 'false';

        $genreID = $genre->id;
        $genreName = $genre->name;
        echo "<a class='nav-link {$idx}' id='{$genreID}-tab' data-toggle='pill' href='#{$genreName}-pill' role='tab' aria-controls='{$genreName}-pill' aria-selected='{$selected}'>{$genreName}</a>";
    }

    return $genreJSON;
}

/**
 * Create an API call to fetch the available movies belonging to a specific genre on TMDB.
 *
 * Hundreds of movies belonging to a specific genre are returned by the API call so only 10 movies are taken from each
 * genre.
 *
 * The 10 movies have invididual boxes on a card so that each movie can be clearly seen. When clicking through the movie
 * genre sidebar on the homepage, movies belonging to the corresponding genre are shown accordingly.
 *
 * @param $genresObject - JSON object holding information about each of the genres from the GetGenres() function. The genre ID of each genre is needed for the API call.
 */
function GetMovies($genresObject)
{
    // Loop through each genre and get movies belonging to the category
    foreach ($genresObject->genres as $index => &$genre)
    {
        // Give the first element the active class
        $idx = $index == 0 ? 'active' : '';

        $genreID = $genre->id;
        $genreName = $genre->name;

        // Create the API call to get the movies
        $movieAPI = file_get_contents("https://api.themoviedb.org/3/discover/movie?api_key=" . getenv("TMDB_API") . "&with_genres={$genreID}");
        $moviesJSON = json_decode($movieAPI);

        // Start building the movie card
        $movieBox = "<div class='tab-pane {$idx}' id='{$genreName}-pill' role='tabpanel' aria-labelledby='{$genreName}-tab'>
                                    <h6 class='font-weight-bold dark-grey-text pt-3 movie_category_title'>{$genreName}</h6>
                                    <hr class='dark-grey-text'>";

        // Loop through the first 10 returned movies and create a box for each one on the card
        foreach ($moviesJSON->results as $index2 => &$movie)
        {
            if ($index2 == 10) break;

            $movieBox = $movieBox . "<a href='movie_profile.php?movie_id={$movie->id}'><div class='card hoverable mt-3'>
                                          <img src='https://image.tmdb.org/t/p/w500{$movie->poster_path}' class='card-img-top' alt='{$movie->title} Movie Poster'/>
                                          <div class='card-body'>
                                            <h5 class='card-title'>{$movie->title}</h5>
                                            <p class='card-text movie-description mb-2'>{$movie->overview}</p>
                                          </div>
                                        </div></a>
                                       ";
        }
        $movieBox = $movieBox . "</div>";
        echo $movieBox;
    }
}

?>