<?php
use Tmdb\Repository\GenreRepository;

/**
 * Creates an API call to fetch the available movie genres that are listed by TMDB.
 *
 * The returned genres are then used to dynamically create a sidebar on the homepage that the user can use to view
 * movies belonging to each genre.
 *
 * @param $client - The API client.
 * @return mixed - JSON object holding information about each of the genres such as the name, id, etc.
 */
function BuildGenreSidebar($client)
{
    $repository = new GenreRepository($client);
    $genres = $repository->loadMovieCollection();

    foreach ($genres as $index => &$genre)
    {
        // Give the first element the active class
        $idx = $index == 0 ? 'active' : '';
        $selected = $index == 0 ? 'true' : 'false';

        $genreID = $genre->GetID();
        $genreName = $genre->GetName();
        echo "<a class='nav-link {$idx}' id='{$genreID}-tab' data-toggle='pill' href='#{$genreName}-pill' role='tab' aria-controls='{$genreName}-pill' aria-selected='{$selected}'>{$genreName}</a>";
    }

    return $genres;
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
 * @param $genres
 * @param $client
 */
function GetGenreMovies($genres, $client)
{
    // Loop through each genre and get movies belonging to the category
    foreach ($genres as $index => &$genre)
    {
        // Give the first element the active class
        $idx = $index == 0 ? 'active' : '';

        $genreID = $genre->GetID();
        $genreName = $genre->GetName();

        // Create the API call to get the movies
        $repository = new GenreRepository($client);
        $movies = $repository->getMovies($genreID);

        // Start building the movie card
        $movieBox = "<div class='tab-pane {$idx}' id='{$genreName}-pill' role='tabpanel' aria-labelledby='{$genreName}-tab'>
                                    <h6 class='font-weight-bold dark-grey-text pt-3 movie_category_title'>{$genreName}</h6>
                                    <hr class='dark-grey-text'>";

        // Loop through the first 10 returned movies and create a box for each one on the card
        foreach ($movies as $index2 => &$movie)
        {
            if ($index2 == 10) break;

            $title = $movie->GetTitle();
            $movieID = $movie->GetID();
            $overview = $movie->GetOverview();
            $poster = $movie->GetPosterPath();

            $movieBox = $movieBox . "<a href='movie_profile.php?movie_id={$movieID}'><div class='card hoverable mt-3'>
                                          <img src='https://image.tmdb.org/t/p/w500{$poster}' class='card-img-top' alt='{$title} Movie Poster'/>
                                          <div class='card-body'>
                                            <h5 class='card-title'>{$title}</h5>
                                            <p class='card-text movie-description mb-2'>{$overview}</p>
                                          </div>
                                        </div></a>
                                       ";
        }
        $movieBox = $movieBox . "</div>";
        echo $movieBox;
    }
}

?>