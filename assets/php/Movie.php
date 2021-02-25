<?php

class Movie
{
    private $_id;
    private $_title;
    private $_overview;
    private $_tagline;
    private $_poster;
    private $_runtime;
    private $_voteAverage;

    public function __construct($id)
    {
        $this->_id = $id;
        $movieInformation = file_get_contents("https://api.themoviedb.org/3/movie/{$id}?api_key=".getenv("TMDB_API")."&language=en-US");
        $movieObject = json_decode($movieInformation);

        $this->_title = $movieObject->title;
        $this->_overview = $movieObject->overview;
        $this->_tagline = $movieObject->tagline;
        $this->_poster = $movieObject->poster_path;
        $this->_runtime = $movieObject->runtime;
        $this->_voteAverage = $movieObject->vote_average;
    }

    public function GetTitle()
    {
        return $this->_title;
    }

    public function GetOverview()
    {
        return $this->_overview;
    }

    public function GetTagline()
    {
        return $this->_tagline;
    }

    public function GetPoster()
    {
        return "https://image.tmdb.org/t/p/w500{$this->_poster}";
    }

    public function GetRuntime()
    {
        return $this->_runtime;
    }

    public function GetVoteAverage()
    {
        return $this->_voteAverage;
    }

    public function GetID()
    {
        return $this->_id;
    }
}
